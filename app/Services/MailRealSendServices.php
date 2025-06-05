<?php

namespace App\Services;

use App\Models\MailSend;
use App\Models\WiseUMailBody;
use App\Models\WiseUMailInterface;
use App\Models\WiseUMailLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class MailSendServices
 * @package App\Services
 */
class MailRealSendServices extends AppServices
{
    private $mailConfig;

    private $secretariatMail = 'allergy@allergy.or.kr'; // 학회사무국 메일

    private $plannerMail = ''; // 기획자 메일

    public function __construct()
    {
        $this->mailConfig = getConfig('mail');
    }

    // 메일 수신 대상 추가
    private function mailSendTartgetAppend($mailData)
    {
        return [
            [ // 사무국
                'receiver_name' => $mailData['receiver_name'],
                'receiver_email' => $this->secretariatMail,
                'body' => $mailData['body'],
            ],

            [ // 기획자
                'receiver_name' => $mailData['receiver_name'],
                'receiver_email' => $this->plannerMail,
                'body' => $mailData['body'],
            ],
        ];
    }

    public function mailSendService($mailData, $case, $additionalData = null)
    {
        switch ($case) {
            case 'user-create':
                $subject = '['.env('APP_NAME').'] 회원가입을 축하 드립니다.';

                $data[] = $mailData;
//                $data = array_merge($data, $this->mailSendTartgetAppend($mailData));
                break;

            case 'forget-password':
                $subject = '['.env('APP_NAME').'] 임시 비밀번호 안내 드립니다.';

                $data[] = $mailData;
//                $data = array_merge($data, $this->mailSendTartgetAppend($mailData));
                break;

            case 'fee-ok':
                $subject = '['.env('APP_NAME').'] 회비 납부가 정상적으로 완료되었습니다.';

                $data[] = $mailData;
//                $data = array_merge($data, $this->mailSendTartgetAppend($mailData));
                break;
            case 'fee-request':
                $subject = '['.env('APP_NAME').'] 회비 입금 요청 드립니다.';

                $data[] = $mailData;
//                $data = array_merge($data, $this->mailSendTartgetAppend($mailData));
                break;

            case 'registration-ok':
            case 'registration-refund':
            case 'abstract-ok':
            case 'support-ok':
            case 'support-bank':
                $subject = $additionalData['subject'];

                $data[] = $mailData;
//                $data = array_merge($data, $this->mailSendTartgetAppend($mailData));
                break;

            // 관리자 발송 메일
            case 'user-confirm':
                $subject = '['.env('APP_NAME').'] 회원 가입 승인 완료 안내 드립니다.';

                $data[] = $mailData;
                break;

            case 'admin-type-send':
            case 'admin-target-resend':
                $subject = $additionalData['subject'];

                $sender = [
                    'sender_name' => $additionalData['sender_name'],
                    'sender_email' => $additionalData['sender_email'],
                ];

                $data = $mailData;
//                $data = array_merge($data, $this->mailSendTartgetAppend($mailData[0]));
                break;

            default:
                return notFoundRedirect();
        }

        return $this->mailSend($data, $subject, $sender ?? null);
    }

    // 메일 발송 로직
    private function mailSend($mailData, $subject, $sender = null)
    {
        $this->sender_name = env('APP_NAME');
        $this->sender_email = env('APP_EMAIL');
        $this->ecare_no = env('ECARE_NUMBER');

        $this->transaction();


        try {
            //서버에 odbc17 에러로 PDO로 연결
            $wiseUconnection = wiseuConnection();

            // 메일 데이터를 10개씩 분할
            $chunks = array_chunk($mailData, 200);

            foreach ($chunks as $chunkIndex => $chunk) {

                foreach ($chunk as $key => $data) {
                    $now = now();
                    $seq = $now->timestamp . $now->micro;

                    $body = $data['body'];
                    $body = preg_replace('/\xC2\xA0|\xE2\x80\x83|\xE3\x80\x80/', ' ', $body); //공백을 강제로 일반 스페이스로 변환 (PHP)

                    // 이후 연속된 스페이스는 &nbsp;로 바꿔서 HTML에 보존 (아웃룩 때문에 추가)
//                $body = preg_replace_callback('/ {2,}/', function ($matches) {
//                    $count = strlen($matches[0]); // 연속된 스페이스 수
//                    return str_repeat('&nbsp;', $count); // 그 수만큼 &nbsp; 반환
//                }, $body);

                    $receiver_name = $data['receiver_name'];
                    $receiver_email = $data['receiver_email'];

                    if (strpos($_SERVER['REMOTE_ADDR'], "218.235.94.247") !== false) {
                        $receiver_email = "jh2.park@m2community.co.kr";
                    }

                    $stmt = $wiseUconnection->prepare("INSERT INTO NVREALTIMEACCEPT 
                        (ECARE_NO, RECEIVER_ID, CHANNEL, SEQ, REQ_DT, REQ_TM, TMPL_TYPE, RECEIVER_NM, RECEIVER, SENDER_NM, SENDER, SUBJECT, SEND_FG, DATA_CNT) 
                        VALUES (:ECARE_NO, :RECEIVER_ID, :CHANNEL, :SEQ, :REQ_DT, :REQ_TM, :TMPL_TYPE, :RECEIVER_NM, :RECEIVER, :SENDER_NM, :SENDER, :SUBJECT, :SEND_FG, :DATA_CNT)");

                    $stmt->execute([
                        ':ECARE_NO' => $this->ecare_no,
                        ':RECEIVER_ID' => $seq,
                        ':CHANNEL' => 'M',
                        ':SEQ' => $seq,
                        ':REQ_DT' => $now->format('Ymd'),
                        ':REQ_TM' => $now->format('His'),
                        ':TMPL_TYPE' => 'T',
                        ':RECEIVER_NM' => $receiver_name,
                        ':RECEIVER' => $receiver_email,
                        ':SENDER_NM' => $sender['sender_name'] ?? $this->sender_name,
                        ':SENDER' => $sender['sender_email'] ?? $this->sender_email,
                        ':SUBJECT' => $subject,
                        ':SEND_FG' => 'R',
                        ':DATA_CNT' => 1,
                    ]);

                    $stmt = $wiseUconnection->prepare("INSERT INTO NVREALTIMEACCEPTDATA (SEQ, DATA_SEQ, ATTACH_YN, DATA) VALUES (:SEQ, :DATA_SEQ, :ATTACH_YN, :DATA)");

                    $stmt->execute([
                        ':SEQ' => $seq,
                        ':DATA_SEQ' => 1,
                        ':ATTACH_YN' => 'N',
                        ':DATA' => $body,
                    ]);


                    // 메일 발송내역 저장
                    try {
                        MailSend::insert([
                            'ml_sid' => $data['ml_sid'] ?? 0,
                            'wiseu_seq' => $seq ?? 0,
                            'receiver_name' => $receiver_name ?? '',
                            'receiver_email' => $receiver_email ?? '',
                            'subject' => $subject ?? '',
                            'contents' => $body ?? '',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        Log::channel('adminMailLog')->error("ml_sid: {$data['ml_sid']} | receiver_email {$receiver_email} | wiseu_seq {$seq}");
                    } catch (\Exception $e) {
                        Log::channel('adminMailLog')->error("메일 발송내역 저장 실패 건별: {$e->getMessage()} ");
                    }

                }

                DB::commit();
            }
            return 'suc';
        } catch (\Exception $e) {

            return $this->dbRollback($e);
        }
    }

    // 메일 발송 상태 업데이트
    public function mailSendStatusUpdate()
    {
        $mailConfig = $this->mailConfig;

        $whereIn = MailSend::where('status', 'R')->whereRaw('DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)')->limit(1000)->pluck('wiseu_seq');

        if (!$whereIn->isEmpty()) {
            $wiseuLog = WiseUMailLog::where('ECARE_NO', $mailConfig['eCareNo'])->whereIn('CUSTOMER_KEY', $whereIn)->get();

            foreach ($wiseuLog as $row) {
                $code = $row->ERROR_CD;

                if (!empty($mailConfig['code'][$code])) {
                    $mail_send = MailSend::where('wiseu_seq', $row->CUSTOMER_KEY)->first();

                    if ($code === '250' || $code === '000') {
                        $mail_send->status = 'S';
                    } else {
                        $mail_send->status = 'F';
                    }

                    $mail_send->status_msg = $mailConfig['code'][$code];
                    $mail_send->update();
                }
            }
        }
    }
}
