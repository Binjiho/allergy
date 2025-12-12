<?php

namespace App\Services\Workshop;

use App\Services\AppServices;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\User;
use App\Models\QA;

use Illuminate\Http\Request;

/**
 * Class WorkshopServices
 * @package App\Services
 */
class WorkshopServices extends AppServices
{
    public function indexService(Request $request)
    {
        $today = date('Y-m-d'); // 오늘 날짜

        //진행중인 행사
        $ing_query = Workshop::orderByDesc('event_sdate')->where('del', 'N');

        if (!isAdmin()) {
            $ing_query->where('hide', 'N');
        }

        $ing_query->where(function($q) use ($today) {
            // event_edate가 NULL인 경우 → 시작일 ≤ 오늘 ≤ 종료일
            $q->where(function($sub) use ($today) {
                $sub->whereNotNull('event_edate')
                    ->whereDate('event_edate', '>=', $today);
            })
                // event_edate가 NULL이 아닌 경우 → 시작일 == 오늘
                ->orWhere(function($sub) use ($today) {
                    $sub->whereNull('event_edate')
                        ->whereDate('event_sdate', '>=', $today);
                });
        });

        $this->data['ing_list'] = $ing_query->limit(6)->get();

        //완료된 행사
        $query = Workshop::orderByDesc('event_sdate')->where('del', 'N');

        if (!isAdmin()) {
            $query->where('hide', 'N');
        }

        $query->where(function($q) use ($today) {
            $q->where(function($sub) use ($today) {
                $sub->whereNull('event_edate')
                    ->whereDate('event_sdate', '<', $today);
            })
                ->orWhere(function($sub) use ($today) {
                    $sub->whereNotNull('event_edate')
                        ->whereDate('event_edate', '<', $today);
                });
        });

        $list = $query->paginate(4)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        if($request->sid){
            $this->data['workshop'] = Workshop::findOrFail($request->sid);
        }
        return $this->data;
    }

    public function detailService(Request $request)
    {
        $this->data['workshop'] = Workshop::findOrFail($request->wsid);
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'workshop-create':
                return $this->workshopCreate($request);
            case 'workshop-update':
                return $this->workshopUpdate($request);
            case 'workshop-delete':
                return $this->workshopDelete($request);
            case 'add-affi':
                return $this->addAffiliationServices($request);
            case 'db-change':
                return $this->dbChange($request);
            default:
                return NotFoundRedirect();
        }
    }

    private function workshopCreate(Request $request)
    {
        $this->transaction();

        try {
            $workshop = new Workshop();

            $res_fee = array();
            $res_cnt = count($request->member_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                $res_fee[] = [
                    'member_gubun' => $request->member_gubun[$i],
                    'gubun' => $request->gubun[$i],
                    'amount' => $request->amount[$i],
                ];
            }
            $request->merge([ 'res_fee' => $res_fee ]);

            $codeExist = Workshop::where('code',$request->code)->exists();
            if($codeExist){
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '이미 등록되어 있는 코드가 있습니다.',
                    'location' => $this->ajaxActionLocation('reload',false),
                ]);
            }

            $workshop->setBydata($request);
            $workshop->save();

            $this->dbCommit('사용자 - 학술행사 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function workshopUpdate(Request $request)
    {
        $this->transaction();

        try {
            $workshop = Workshop::findOrFail($request->sid);

            $res_fee = array();
            $res_cnt = count($request->member_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                $res_fee[] = [
                    'member_gubun' => $request->member_gubun[$i],
                    'gubun' => $request->gubun[$i],
                    'amount' => $request->amount[$i],
                ];
            }
            $request->merge([ 'res_fee' => $res_fee ]);

            $workshop->setBydata($request);
            $workshop->update();

            $this->dbCommit('사용자 - 학술행사 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function workshopDelete(Request $request)
    {
        $this->transaction();

        try {
            $workshop = Workshop::findOrFail($request->sid);
            $workshop->del='Y';
            $workshop->update();

            $this->dbCommit('관리자 - 학술행사 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function addAffiliationServices(Request $request)
    {
        $this->data['defaultConfig'] = config('site.default-workshop');

        return $this->returnJsonData('after', [
            $this->ajaxActionHtml('.aff_div:last', view('admin.workshop.form.add-affi', $this->data)->render()),
        ]);
    }
    private function dbChange(Request $request)
    {
        $this->transaction();

        try {
            $workshop = Workshop::findOrFail($request->sid);
            $workshop->{$request->field}=$request->value;
            $workshop->update();

            $this->dbCommit('관리자 - 학술행사 부분변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }


}
