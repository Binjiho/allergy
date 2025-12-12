<?php

namespace App\Services\General;

use App\Models\Counter;
use App\Models\Referer;
use App\Models\User;
use App\Models\GeneralHospital;
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
            case 'btn-more':
                return $this->btnMore($request);
            case 'change-si':
                return $this->changeSi($request);

            default:
                return notFoundRedirect();
        }
    }

    private function searchHospital(Request $request){

        $this->userConfig = getConfig('user');

        $per_page = (int)($request->per_page ?? 30);
//        $limit = (int)($request->limit ?? 0);
        $limit = 0;

        $query = User::where(['del'=>'N'])->orderBy('name_kr');

        if($request->si){
            $query->where('si', $request->si);
        }
        if($request->gu){
            $query->where('gu', $request->gu);
        }

        if($request->jext){
            $query->where('jext', 'Y');
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

        $target_html = '';
        foreach ($hos as $key => $row) {
            $target_html .= "<li style=\"display: flex;\">";
            $target_html .= "<div class=\"name\">";
            $target_html .= "<p>";
            $target_html .= htmlspecialchars($row['name_kr']);
            $target_html .= "</p>";
            if($row['jext'] == 'Y'){
                $target_html .= "<span>Jext 처방병원</span>";
            }
            if( !empty($row['major']) ) {
                $target_html .= "<span class=\"major\">" . htmlspecialchars($this->userConfig['major'][$row['major']]) . "</span>";
            }
            $target_html .= "</div>";
            $target_html .= "<strong class=\"tit\">" . htmlspecialchars($row['company_kr']) . "</strong>";

            $target_html .= "<ul class=\"info-list\">";
            $target_html .= "<li >";
            $target_html .= "<span><img src=\"/assets/image/sub/ic_hos_addr02.png\" alt=\"\"></span>";
            $target_html .= "<p>" . htmlspecialchars($row['company_address']) . "</p>";
            $target_html .= "</li >";
            $target_html .= "<li >";
            $target_html .= "<span><img src=\"/assets/image/sub/ic_hos_tel02.png\" alt=\"\"></span>";
            $target_html .= "<p><a href=\"tel:02-599-5009\" target=\"_blank\">" . htmlspecialchars($row['phone']) . "</a>";
            $target_html .= "</li>";
            $target_html .= "</ul>";
            $target_html .= "</li>";
        }

        if($hos->count() < 1){
            $target_html = "<li class=\"no-data\"><img src=\"/assets/general/assets/image/map/ic_nodata.png\" alt=\"\">검색결과가 없습니다.</li>";
        }

        return $this->returnJsonData('html', [
            $this->ajaxActionHtml('#result_list', $target_html),
        ]);
    }

    private function btnMore(Request $request){

        $per_page = (int)($request->per_page ?? 3);
        $limit = (int)($request->limit ?? 0);

        $query = User::where(['del'=>'N'])->orderBy('name_kr');

        if($request->si){
            $query->where('si', $request->si);
        }
        if($request->gu){
            $query->where('gu', $request->gu);
        }
        if ($request->keyword) {
            $query->where('name', 'like',  "%{$request->keyword}%");
        }
        if ($request->filled('search_major')) {
            $search_majorArr = $request->search_major; // 배열
            $query->where(function($q) use ($search_majorArr) {
                foreach ($search_majorArr as $val) {
                    $q->orWhere('search_major', 'like', "%{$val}%");
                }
            });
        }

        $query->limit($per_page)->offset($limit);

        $hos = $query->get();

        $this->setJsonData('input', [
            $this->ajaxActionInput('#limit', $limit+$per_page),
        ]);

        $target_html = '';
        foreach ($hos as $key => $row) {
//            $target_html.="<li><div class=\"name\">이영목<span class=\"major\">이비인후과</span></div><strong class=\"tit\">GF내과의원</strong><ul class=\"info-list\"><li><span><img src=\"/assets/image/sub/ic_hos_addr02.png\" alt=\"\"></span><p>서울 서초구 방배4동 1549 예다인 프라자 3층</p></li><li><span><img src=\"/assets/image/sub/ic_hos_tel02.png\" alt=\"\"></span><p><a href=\"tel:02-599-5009\" target=\"_blank\">02-599-5009</a></p></li></ul></li>";
            $target_html .= "<li style=\"display: flex;\">";
            $target_html .= "<div class=\"name\">";
            $target_html .= htmlspecialchars($row['name_kr']);
            $target_html .= "<span class=\"major\">" . htmlspecialchars($row['position']) . "</span>";
            $target_html .= "</div>";
            $target_html .= "<strong class=\"tit\">" . htmlspecialchars($row['company_kr']) . "</strong>";

            $target_html .= "<ul class=\"info-list\">";
            $target_html .= "<li >";
            $target_html .= "<span><img src=\"/assets/image/sub/ic_hos_addr02.png\" alt=\"\"></span>";
            $target_html .= "<p>" . htmlspecialchars($row['company_address']) . "</p>";
            $target_html .= "</li >";
            $target_html .= "<li >";
            $target_html .= "<span><img src=\"/assets/image/sub/ic_hos_tel02.png\" alt=\"\"></span>";
            $target_html .= "<p><a href=\"tel:02-599-5009\" target=\"_blank\">" . htmlspecialchars($row['phone']) . "</a>";
            $target_html .= "</li>";
            $target_html .= "</ul>";
            $target_html .= "</li>";
        }

        if($hos->count() < 1){
            $target_html = "<li class=\"no-data\"><img src=\"/assets/general/assets/image/map/ic_nodata.png\" alt=\"\">검색결과가 없습니다.</li>";
        }

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('#result_list', $target_html),
        ]);
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
