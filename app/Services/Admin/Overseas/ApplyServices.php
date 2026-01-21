<?php

namespace App\Services\Admin\Overseas;

use App\Exports\ApplyExcel;
use App\Exports\MemberExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use App\Models\OverseasApply;
use App\Models\OverseasSetting;
use App\Models\Country;
use App\Models\User;
use App\Exports\OverseasApplyExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;
/**
 * Class RegistrationServices
 * @package App\Services
 */
class ApplyServices extends AppServices
{
    public function indexService(Request $request)
    {
        $this->overseasConfig = getConfig("overseas") ?? [];
        $this->data['overseas'] = OverseasSetting::findOrFail($request->o_sid);

        $li_page = $request->li_page ?? 20;
        $this->data['li_page'] = $li_page;

        $listCase = $request->case ?? null;
        $this->data['listCase'] = empty($listCase) ? [] : ['case' => $listCase];

        switch ($listCase) {
            case 'elimination' :
                $excelName = date('Y-m-d').'_'.$this->data['overseas']->title.'_등록삭제list';
                $query = OverseasApply::where(['o_sid'=>$request->o_sid, 'del'=>'Y'])->orderByDesc('created_at');
                break;
            default:
                $excelName = date('Y-m-d').'_'.$this->data['overseas']->title.'_등록list';
                $query = OverseasApply::where(['o_sid'=>$request->o_sid, 'del'=>'N'])->orderByDesc('sid'); // 삭제 제외 전체
                break;
        }

		$query->with('user');

        if($request->name_kr){
            $query->whereHas('user', function ($q) use ($request) {
				$q->where('name_kr', 'like', "%{$request->name_kr}%");
			});
        }
        if($request->license_number){
            $query->whereHas('user', function ($q) use ($request) {
				$q->where('license_number', 'like', "%{$request->license_number}%");
			});
        }
        if ($request->sosok_kr) {
            $query->where('sosok_kr', 'like', "%{$request->sosok_kr}%");
        }
        if ($request->email) {
            $query->where('email', 'like', "%{$request->email}%");
        }


        if ($request->excel) {
            $excel_query = clone $query;

            $this->data['query'] = $excel_query;
            $this->data['total'] = $excel_query->count();
            $this->data['collection'] = $excel_query->lazy();

            $fileName = date('Y-m-d').'_'.($excelName ?? '명단정보');


            $export = new OverseasApplyExcel($this->data);

            //미리보기
//            if (isDev()) {
//                return view('admin.components.excel-preview', [
//                        'previewData' => $export->getPreviewData(),
//                        'fileName' => $fileName,
//                    ]
//                );
//            }

            return (new CommonServices())->excelDownload($export, $fileName);
        }


        //completeZip 파일
        if ($request->completeZip) {
            $addedFilesCount = 0; // 실제 압축에 추가된 파일 개수 카운트

            // 워드 백업 시 제출상태가 최종제출인 초록만 다운되도록 수정 부탁드립니다.
            $word_query = clone $query;
            $word_query->where('complete','Y');

            $zipFileName = $this->data['overseas']->title.'_신청자료.zip';
            $zipFilePath = storage_path('app/' . $zipFileName);

            $zip = new ZipArchive;
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

                foreach ($word_query->lazy() as $row) {

                    // 1. 폴더명으로 사용할 성명 가져오기 (apply -> user -> name_kr)
                    // 관계절이 없을 경우를 대비해 '알수없음' 또는 '신청번호' 등을 기본값으로 설정
                    $userName = $row->user->name_kr ?? 'Unknown_' . $row->sid;

                    // 폴더명에 사용할 수 없는 특수문자 제거 (안전 장치)
                    $folderName = preg_replace('/[\/\\:*?"<>|]/', '', $userName);

                    for ($i = 1; $i <= 2; $i++) {
                        $fileField = 'realfile' . $i;
                        $nameField = 'filename' . $i;

                        if (!empty($row->$fileField)) {
                            $filePath = public_path($row->$fileField);

                            if (file_exists($filePath)) {
                                // 2. ZIP 내부 경로 생성: 성명폴더/파일명
                                // $row->$nameField 가 실제 파일명(예: Figure1.jpg)이라고 가정합니다.
                                $zipInternalPath = $folderName . '/' . $row->$nameField;

                                // ZIP에 파일 추가 (폴더 구조 포함)
                                $zip->addFile($filePath, $zipInternalPath);

                                $addedFilesCount++;
                            }
                        }
                    }
                }
                $zip->close();
            } else {
                return response()->json(['error' => '압축 파일 생성 실패'], 500);
            }

            // [중요] 추가된 파일이 하나도 없으면 ZIP 파일 자체가 생성되지 않아 에러가 납니다.
            if ($addedFilesCount === 0) {
                return response()->json(['error' => '압축 파일 갯수 없음'], 500);
            }

            // 압축 파일 다운로드
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        }

        //reportZip 파일
        if ($request->reportZip) {
            $addedFilesCount = 0; // 실제 압축에 추가된 파일 개수 카운트

            // 워드 백업 시 제출상태가 최종제출인 초록만 다운되도록 수정 부탁드립니다.
            $word_query = clone $query;
            $word_query->where('complete','Y');

            $zipFileName = $this->data['overseas']->title.'_결과보고서.zip';
            $zipFilePath = storage_path('app/' . $zipFileName);

            $zip = new ZipArchive;
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

                foreach ($word_query->lazy() as $row) {

                    // 1. 폴더명으로 사용할 성명 가져오기 (apply -> user -> name_kr)
                    // 관계절이 없을 경우를 대비해 '알수없음' 또는 '신청번호' 등을 기본값으로 설정
                    $userName = $row->user->name_kr ?? 'Unknown_' . $row->sid;

                    // 폴더명에 사용할 수 없는 특수문자 제거 (안전 장치)
                    $folderName = preg_replace('/[\/\\:*?"<>|]/', '', $userName);

                    for ($i = 3; $i <= 13; $i++) {
                        $fileField = 'realfile' . $i;
                        $nameField = 'filename' . $i;

                        if (!empty($row->$fileField)) {
                            $filePath = public_path($row->$fileField);

                            if (file_exists($filePath)) {
                                // 2. ZIP 내부 경로 생성: 성명폴더/파일명
                                // $row->$nameField 가 실제 파일명(예: Figure1.jpg)이라고 가정합니다.
                                $zipInternalPath = $folderName . '/' . $row->$nameField;

                                // ZIP에 파일 추가 (폴더 구조 포함)
                                $zip->addFile($filePath, $zipInternalPath);

                                $addedFilesCount++;
                            }
                        }
                    }
                }
                $zip->close();
            } else {
                return response()->json(['error' => '압축 파일 생성 실패'], 500);
            }

            // [중요] 추가된 파일이 하나도 없으면 ZIP 파일 자체가 생성되지 않아 에러가 납니다.
            if ($addedFilesCount === 0) {
                return response()->json(['error' => '압축 파일 갯수 없음'], 500);
            }

            // 압축 파일 다운로드
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        }

        // 신청상태별 카운트
        $this->data['statusCnt'] = $query->get('complete')->groupBy('complete')
            ->map(function ($group) {
                return $group->count();
            });

        // 심사상태 카운트
        $this->data['judgeCnt'] = $query->get('judge')->groupBy('judge')
            ->map(function ($group) {
                return $group->count();
            });

        // 지원협회별 카운트
        $this->data['assistantCnt'] = $query->get('assistant')->groupBy('assistant')
            ->map(function ($group) {
                return $group->count();
            });

        // 전체 카운트
        $this->data['total_cnt'] = $query->count();

        $list = $query->paginate($li_page)->appends($request->query());
        $this->data['list'] = setListSeq($list);



        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['overseas'] = OverseasApply::findOrFail($request->sid);
        $this->data['overseasSetting'] = OverseasSetting::findOrFail($this->data['overseas']->o_sid);
        $this->data['step'] = $request->step ?? '1';

        return $this->data;
    }

    public function popupService(Request $request)
    {
        $this->data['overseas'] = OverseasApply::findOrFail($request->sid);
        return $this->data;
    }

    public function allJudgeChangeService(Request $request)
    {
		$o_sid = $request->o_sid;
        $this->data['overseas'] = OverseasSetting::findOrFail($o_sid);

		$query = OverseasApply::where(['o_sid'=>$o_sid, 'del'=>'N']);
        $query->where(function($q) {
            $q->where('judge', '!=', 'Y')
                ->orWhereNull('judge');
        });

		$query->orderBy('sid', 'desc');
		$list = $query->get();

		$this->data['list'] = $list;


        return $this->data;
    }

    //지급여부 일괄변경
    public function allPayChangeService(Request $request)
    {
        $o_sid = $request->o_sid;
        $this->data['overseas'] = OverseasSetting::findOrFail($o_sid);

        $query = OverseasApply::where(['o_sid'=>$o_sid, 'del'=>'N']);
        $query->where(function($q) {
            $q->where('pay_result', '!=', 'Y')
                ->orWhereNull('pay_result');
        });
        $query->orderBy('sid', 'desc');
        $list = $query->get();

        $this->data['list'] = $list;


        return $this->data;
    }

	

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'memo-write':
                return $this->memoWrite($request);
			case 'all-judge-change':
                return $this->allJudgeChange($request);
            case 'all-pay-change':
                return $this->allPayChange($request);

            case 'overseas-step2':
                return $this->step2Services($request);
            case 'overseas-step3':
                return $this->step3Services($request);
            case 'overseas-delete':
                return $this->overseasDelete($request);
            case 'report-modify':
                return $this->reportModifyServices($request);


            case 'email-check':
                return $this->emailCheckServices($request);
            case 'phone-check':
                return $this->phoneCheckServices($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'resend-mail':
                return $this->resendMail($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function step2Services(Request $request)
    {
        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);

            $overseas->setByStep2($request);
            $overseas->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step2 수정');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('apply.modify',['step'=>'3','sid'=>$overseas->sid, 'o_sid'=>$overseas->o_sid]) ));


        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function step3Services(Request $request)
    {
        $userConfig = config('site.user');

        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);

            $overseasSetting = OverseasSetting::findOrFail($overseas->o_sid);
            $request->merge(['title' => $overseasSetting->title]);
            $request->merge(['name_kr' => $overseas->user->name_kr]);

            $overseas->setByStep3($request);
            $overseas->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step3 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function overseasDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = OverseasApply::findOrFail($request->sid);
            $registration->del='Y';
            $registration->deleted_at=date('Y-m-d H:i:s');

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 해외등록 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
    private function reportModifyServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);
            $overseasSetting = OverseasSetting::findOrFail($overseas->o_sid);

            $request->merge(['title' => $overseasSetting->title]);
            $request->merge(['name_kr' => $overseas->user->name_kr]);

            $overseas->setByReport($request);
            $overseas->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 결과보고서 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(),
            ]);


        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }


    private function emailCheckServices(Request $request)
    {
        $email = trim($request->email);

        $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'email'=>$email, 'work_code'=>$request->work_code])->whereNotIn('sid', [$request->reg_sid])->first();

        if (empty($registration)) {
            $this->setJsonData('data', [
                $this->ajaxActionData('#email', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 이메일 입니다.',
            ]);
        } else {
            $this->setJsonData('focus', '#email');

            return $this->returnJsonData('alert', [
                'msg' => '사용중인 이메일입니다. 다른 이메일을 입력해주세요.',
            ]);
        }
    }

    private function phoneCheckServices(Request $request)
    {
        $phone = $request->phone1.'-'.$request->phone2.'-'.$request->phone3;

        $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'phone'=>$phone, 'work_code'=>$request->work_code])->whereNotIn('sid', [$request->reg_sid])->first();

        if (empty($registration)) {
            $this->setJsonData('data', [
                $this->ajaxActionData('#phone1', 'chk', 'Y'),
                $this->ajaxActionData('#phone2', 'chk', 'Y'),
                $this->ajaxActionData('#phone3', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 휴대폰번호 입니다.',
            ]);
        } else {
            return $this->returnJsonData('alert', [
                'msg' => '사용중인 휴대폰번호입니다. 다른 휴대폰번호를 입력해주세요.',
            ]);
        }
    }

    private function dbChangeServices(Request $request)
    {
        $this->transaction();

        try {

            $field = $request->field;
            $value = $request->value;

            $overseas = OverseasApply::findOrFail($request->sid);
            
            if($field == 'judge'){
                if($overseas->complete != 'Y'){
                    return $this->returnJsonData('alert', [
                        'case' => true,
                        'msg' => '등록완료시에만 심사상태 수정할 수 있습니다.',
                        'location' => $this->ajaxActionLocation('reload'),
                    ]);
                }
            }

            $overseas->{$field} = $value;

            switch ($field) {
				case 'complete':
					$overseas->completed_at = ($value == 'Y') ? now() : null;
					break;
                case 'report':
                    $overseas->reported_at = ($value == 'Y') ? now() : null;
                    break;
                case 'judge':
                    $overseas->judged_at = ($value == 'Y') ? now() : null;
                    break;

				default:
					break;
            }

            $overseas->timestamps = false; // updated_at 자동 업데이트 방지
            $overseas->update();

            $this->dbCommit('관리자 - 국외학술대회지원 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function resendMail(Request $request)
    {
        $reg = Registration::withTrashed()->findOrFail($request->sid);
        if(empty($request->email)){
            $email = $reg->email;
        }else{
            $email = $request->email;
        }

        $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];
        $reg_country = Country::where(['cc'=>$reg->country])->first();

        // 메일 한번만 발송
        $mailData = [
            'receiver_name' => $reg->name_kr ?? '',
            'receiver_email' => $email ?? '',
            'body' => view("template.".$request->work_code.".registration-ok", [ 'reg'=>$reg, 'workshopConfig' =>$this->workshopConfig, 'mail_country'=>$reg_country->cn ])->render(),
        ];

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-ok',['subject'=>"[대한환경공학회] ".$reg->workshop->subject." 사전등록 완료 안내 드립니다."]);

        if ($mailResult != 'suc') {
            return $mailResult;
        }
        // END 메일 발송

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '발송 되었습니다.',
            'winClose' => $this->ajaxActionWinClose(),
        ]);
    }
    private function memoWrite(Request $request)
    {
        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);
            $overseas->memo = $request->memo;

            $overseas->timestamps = false; // updated_at 자동 업데이트 방지
            $overseas->update();

            $this->dbCommit('관리자 - 국외학술대회지원 메모 작성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '저장 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

	private function allJudgeChange(Request $request)
    {
		$judge = $request->judge;
        $assistant = $request->assistant;
		$sids = $request->sids;

        $this->transaction();

        try {
			OverseasApply::whereIn('sid', $sids)
				->update([
					'judge' => $judge,
					'assistant' => $assistant,
					'updated_at' => DB::raw('updated_at'),
				]);

            $this->dbCommit('관리자 - 국외학술대회지원 심사상태 일괄 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '저장 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function allPayChange(Request $request)
    {
        $pay_result = $request->pay_result;
        $sids = $request->sids;

        $this->transaction();

        try {
            OverseasApply::whereIn('sid', $sids)
                ->update([
                    'pay_result' => $pay_result,
                    'updated_at' => DB::raw('updated_at'),
                ]);

            $this->dbCommit('관리자 - 국외학술대회지원 지급여부 일괄 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '저장 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

}
