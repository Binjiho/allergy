<?php

namespace App\Services\General;

use App\Models\Counter;
use App\Models\Referer;
use App\Models\User;
use App\Models\Hospital;
//use App\Models\GeneralHospitalUser;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class MainServices
 * @package App\Services
 */
class GeneralServices extends AppServices
{
    public function searchListService(Request $request)
    {
        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'search-hospital':
                return $this->searchHospital($request);
            case 'change-si':
                return $this->changeSi($request);

            default:
                return notFoundRedirect();
        }
    }

    private function searchHospital(Request $request){

//        dd($request->all());
        $this->userConfig = getConfig('user');

        $target_perpage = isMobile() ? 10 : 12;
        $per_page = (int)($request->per_page ?? $target_perpage);
        $limit = (int)($request->limit ?? 0);

        $query = Hospital::where(['del'=>'N'])->orderBy('name_kr');

        if($request->si){
            $query->where('si', $request->si);
        }
        if($request->gu){
            $query->where('gu', $request->gu);
        }

        if($request->jext){
            $query->where('jext_yn', 'Y');
        }
        if ($request->filled('search_major')) {
            $search_majorArr = $request->search_major; // 배열
            $query->where(function($q) use ($search_majorArr) {
                foreach ($search_majorArr as $val) {
                    $q->orWhere('major', 'like', "%{$val}%");
                }
            });
        }

        if (!empty($request->search) && !empty($request->keyword)) {
            $query->where($request->search, 'like',  "%{$request->keyword}%");
        }

        $query->limit($per_page)->offset($limit);

        $hos = $query->get();

        $this->setJsonData('input', [
            $this->ajaxActionInput('#limit', $limit+$per_page),
        ]);

        $userConfig = config('site.user');

        $target_html = '';
        if($hos->count() > 0) {
            foreach ($hos as $key => $row) {
                $target_address = $userConfig['si'][$row->si];
                if(!empty($row->gu)){
                    $target_address .= ' '.$userConfig['gu'][$row->si][$row->gu];
                }
                $target_address .= ' '.$row->address;

                $target_html .= "<li style=\"display: flex;\">";
                $target_html .= "<div class=\"name\">";
                $target_html .= "<p>";
                $target_html .= htmlspecialchars($row['chief_name']);
                $target_html .= "</p>";
                if($row['jext_yn'] == 'Y'){
                    $target_html .= "<span>Jext 처방병원</span>";
                }
                if( !empty($row['major']) ) {
                    $target_html .= "<span class=\"major\">" . htmlspecialchars($this->userConfig['major'][$row['major']]) . "</span>";
                }
                $target_html .= "</div>";
                $target_html .= "<strong class=\"tit\">" . htmlspecialchars($row['name_kr']) . "</strong>";

                $target_html .= "<ul class=\"info-list\">";
                $target_html .= "<li >";
                $target_html .= "<span><img src=\"/assets/image/sub/ic_hos_addr02.png\" alt=\"\"></span>";
                $target_html .= "<p>" . htmlspecialchars($target_address) . "</p>";
                $target_html .= "</li >";
                $target_html .= "<li >";
                $target_html .= "<span><img src=\"/assets/image/sub/ic_hos_tel02.png\" alt=\"\"></span>";
                $target_html .= "<p><a href=\"tel:".htmlspecialchars($row['tel']).";\" target=\"_blank\">" . htmlspecialchars($row['tel']) . "</a>";
                $target_html .= "</li>";
                $target_html .= "</ul>";
                $target_html .= "</li>";
            }
        } else {
            // 결과가 없을 때 (검색 첫 시도 or 더보기 끝)
            if ($limit === 0) {
                // 첫 검색에 결과가 없음
                $target_html = "<li class=\"no-data\"><img src=\"/assets/general/assets/image/map/ic_nodata.png\" alt=\"\">검색결과가 없습니다.</li>";
            } else {
                // 더보기에 결과가 없음 (마지막 페이지)
                $target_html = ''; // 더이상 추가할 내용 없음
            }
        }

        // 💡 더보기 버튼 표시/숨김 처리
        // 리스트가 요청한 per_page 만큼 채워지지 않았으면 더보기 버튼 숨김
        if($hos->count() >= $per_page) {
            $this->setJsonData('addCss', [
                $this->ajaxActionCss('.btn-more', 'display', 'block'),
            ]);
        }else{
            $this->setJsonData('addCss', [
                $this->ajaxActionCss('.btn-more', 'display', 'none'),
            ]);
        }

        if($limit > 0){
            return $this->returnJsonData('append', [
                $this->ajaxActionHtml('#result_list', $target_html),
            ]);
        }else{

            return $this->returnJsonData('html', [
                $this->ajaxActionHtml('#result_list', $target_html),
            ]);
        }
    }
    
    private function changeSi(Request $request)
    {
        $this->userConfig = config('site.user');

        if($request->si == '' || empty($request->si)){
            return $this->returnJsonData('result', [
                'res' => 'NOT',
                'msg' => '지역을 선택해주세요.',
            ]);
        }

//        $data = $this->userConfig['gu'][$request->si];

        $data = [];
        foreach ($this->userConfig['gu'][$request->si] as $k => $v) {
            $data[] = ['key' => $k, 'name' => $v];
        }

        return $this->returnJsonData('result', [
            'res' => 'SUC',
            'msg' => 'gu결과가 있습니다',
            'items' => $data,
        ]);
    }


}
