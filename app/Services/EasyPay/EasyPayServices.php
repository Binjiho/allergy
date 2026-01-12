<?php

namespace App\Services\EasyPay;

use App\Services\AppServices;
use App\Models\QueryLog;
use App\Models\Fee;
use App\Models\Registration;
use App\Services\MailRealSendServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class EasyPayServices
 * @package App\Services
 */
class EasyPayServices extends AppServices
{
    private $mid;
    private $url = 'https://pgapi.easypay.co.kr'; // LIVE
    private $mode = 'LIVE'; // LIVE or TEST

    public function __construct()
    {
//        if (isDev()) {
//            $this->url = 'https://testpgapi.easypay.co.kr'; // TEST
//            $this->mode = 'TEST';
//        }

        $this->mid = env("EASYPAY_MID_{$this->mode}");
    }

    public function resultAction(Request $request)
    {
        $payType = $request->payType; // 결제 종류 구분

        $resCd = $request->resCd; // 결과 코드
        $resultSid = $request->shopValue1; // 결제 했던 sid 값 정보


        if ($resCd != '0000') {
            return view('easyPay.fail', [
                'code' => $resCd,
                'msg' => $request->resMsg, // 결과 메시지
                'payType' => $payType,
            ]);
        }

        // 결제 검증
        $response = Http::post("{$this->url}/api/ep9/trades/approval", [
            'mallId' => $this->mid,
            'shopTransactionId' => $this->makeShopTransactionId($payType), // 상점 거래고유번호: API 호출 시마다 중복되지 않는 고유한 트랜잭션 ID를 생성하여 전송해야 합니다.
            'authorizationId' => $request->authorizationId, // 인증 거래번호. 승인요청 시 필수 값
            'shopOrderNo' => $request->shopOrderNo, // 상점 주문번호
            'approvalReqDate' => now()->format('Ymd'), // 승인요청일자(yyyyMMdd)
        ]);

        $result = $response->json();

//        dd($result);

        // 결제 검증 실패
        if ($result['resCd'] != '0000') {
            return view('easyPay.fail', [
                'code' => $result['resCd'],
                'msg' => $result['resMsg'], // 결과 메시지
                'payType' => $payType,
            ]);
        }

        /* 결제 검증 정보 DB 저장 추가시 해당 위치에 추가 */

        /* END 결제 검증 정보 DB 저장 추가시 해당 위치에 추가 */
        $userConfig = config('site.user');
        $defaultConfig = config('site.default-workshop');

        switch ($payType) {
            case 'FEE':
                $sidArr = explode(',', $resultSid);
                $feeConfig = getConfig('fee');

                $this->transaction();

                //udpate
                Fee::whereIn('sid', $sidArr)->update([
                    'payment_method' => 'C',
                    'payment_status' => 'Y',
                    'payment_date' => now()->format('Y-m-d H:i:s'),
                ]);

                //평생회비 납부시 당해년도 입회비/연회비 해당없음으로 변경
                // 1. 선택된 항목 중 평생회비(C)가 있는지 먼저 확인
                $hasLifeFee = Fee::whereIn('sid', $sidArr)->where('category', 'C')->exists();

                if ($hasLifeFee) {
                    // 2. 평생회비가 있다면 당해년도 입회비/연회비(C가 아닌 것들)를 한 번에 '해당없음' 처리
                    Fee::where([
                        'year' => date('Y'),
                        'user_sid' => thisPK(),
                        'del' => 'N'
                    ])
                        ->whereNotIn('category', ['C'])
                        ->update([
                            'payment_status' => 'E', // 해당없음
                        ]);
                }

                $this->dbCommit( ' 사용자 - 회비결제');


                // 결제 완료메일 발송
                foreach (Fee::whereIn('sid', $sidArr)->get() as $index => $fee) {
                    $feeCategory = $feeConfig['category'][$fee->category] ?? '';
                    $titleSTR = "{$fee->year}년 {$feeCategory}";

                    $body = view("template.fee-ok", ['fee' => $fee, 'title_str' => $titleSTR, 'tot_price' => $fee->price])->render();

                    $mailData = [
                        'receiver_name' => $fee->user->name_kr ?? '',
                        'receiver_email' => $fee->user->email ?? '',
                        'body' => $body,
                    ];

                    (new MailRealSendServices())->mailSendService($mailData, 'fee-ok');
                }
                break;

            case 'REG':
                $this->transaction();

                $reg = Registration::findOrFail($resultSid);
                $reg->pay_method = 'C';
                $reg->pay_status = 'Y';
                $reg->pay_confirm_date = now()->format('Y-m-d H:i:s');
                $reg->complete = 'Y';
                $reg->completed_at = now()->format('Y-m-d H:i:s');
                $reg->update();

                $this->dbCommit( ' 사용자 - 학술대회 사전등록 결제');

                $result['wsid']=$reg->wsid;
                $result['sid']=$reg->sid;

                // 결제 완료메일 발송
                $body = view("template.registration-ok", ['reg' => $reg, 'userConfig'=>$userConfig, 'defaultConfig'=>$defaultConfig])->render();

                $mailSubject = "[".env('APP_NAME')."] ".$reg->workshop->title." 사전등록이 완료되었습니다.";

                $mailData = [
                    'receiver_name' => $reg->name_kr ?? '',
                    'receiver_email' => $reg->email ?? '',
                    'body' => $body,
                ];

                (new MailRealSendServices())->mailSendService($mailData, 'registration-ok',['subject'=>$mailSubject]);

                $replaceUrl = url("workshop/{$reg->wsid}/registration/upsert/complete/{$reg->sid}");
                break;

            default:
                break;

        }

        return view('easyPay.suc', [
            'payType' => $payType,
            'resCd' => $resCd,

            'replaceUrl' => ($replaceUrl ?? ''),
        ]);
    }

    // 거래요청 등록
    public function transactionRegistration($payType, $sid)
    {
        switch ($payType) {
            case 'FEE':
                $goodsName = '회비 납부';
                $amount = Fee::whereIn('sid', $sid)->sum('price');
                
                $sid = implode(',', $sid); // 가맹점 필드에 보내려면 String 타입이여야함 회비 sid 값은 배열이라 잘라서 보냄
                break;
            case 'REG': //학술대회 사전등록
                $goodsName = '학술대회 사전등록';
                $reg = Registration::findOrFail($sid);
                $amount = $reg->amount;
                break;

            default:
                return [
                    'status' => 'fail',
                    'msg' => '유효하지 않은 거래 요청입니다.',
                ];

        }

        $orderInfo = [
            'goodsName' => $goodsName, // 상품명

//            'customerInfo' => [ // 고객정보 필수 아님
//                'customerId' => '고객 ID',
//                'customerName' => '고객명',
//                'customerMail' => '고객 Email',
//                'customerContactNo' => '고객 연락처(숫자만 허용)',
//                'customerAddr' => '고객 주소',
//            ],
        ];

        $response = Http::post("{$this->url}/api/ep9/trades/webpay", [
            'mallId' => $this->mid,
            'shopOrderNo' => $this->makeOrderNo($payType),
            'amount' => $amount,
            'payMethodTypeCode' => '11', // 신용카드
            'currency' => '00', // 원화
            'returnUrl' => url("api/easyPay/{$payType}/result"),
            'deviceTypeCode' => (isMobile() ? 'mobile' : 'pc'),
            'clientTypeCode' => '00', // 고정값
            'langFlag' => 'KOR', // KOR: 한국어, ENG:영어, JPN:일본어, CHN:중국어

            'orderInfo' => $orderInfo,

            'shopValueInfo' => [ // 가맹점 필드: String 타입
                'value1' => $sid,
//                'value2' => '',
//                'value3' => '',
//                'value4' => '',
//                'value5' => '',
//                'value6' => '',
//                'value7' => '',
            ],
        ]);

        $data = $response->json();

//        dd($data);

        if (!$response->successful() || $data['resCd'] != '0000') {
            return [
                'status' => 'fail',
                'msg' => ($data['resMsg'] ?? 'ERROR'),
            ];
        }

        return [
            'status' => 'suc',
            'url' => $data['authPageUrl'],
        ];
    }

    // 주문번호 생성
    private function makeOrderNo($payType)
    {
        $randomFloat = mt_rand() / mt_getrandmax();
        $randomString = (string)$randomFloat;
        $base64String = base64_encode($randomString);

        $orderId = $payType . '-' . substr($base64String, 0, 15);

        return $orderId;
    }

    // 상점 거래고유번호
    private function makeShopTransactionId($payType)
    {
        $time = now()->format('YmdHisv'); // 17자리 (ms)
        $rand = bin2hex(random_bytes(5)); // 10자리
        $pid = getmypid() ?: mt_rand(1000, 9999); // 4자리 내외

        return "{$payType}-T{$time}{$pid}{$rand}";
    }
}
