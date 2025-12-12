@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap">
                <button type="button" class="btn btn-tab-menu js-btn-tab-menu">임원명단</button>
                <ul class="sub-tab-menu js-tab-menu">
                    <li class="on"><a href="#n">임원명단</a></li>
                    <li><a href="#n">연구팀</a></li>
                    <li><a href="#n">지회</a></li>
                    <li><a href="#n">평의원</a></li>
                    <li><a href="#n">위원회</a></li>
                </ul>
            </div>

            <!-- s:임원명단 -->
            <div class="sub-tab-con js-tab-con" style="display: block;">
                <div class="table-wrap scroll-x touch-help">
                    <table class="cst-table">
                        <caption class="hide">임원명단</caption>
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 20%;">
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <tr class="active">
                            <th scope="col">직책</th>
                            <th scope="col">이름</th>
                            <th scope="col">소속</th>
                            <th scope="col">전공과목</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">회장</th>
                            <td>이숙영</td>
                            <td>가톨릭의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">차기 회장</th>
                            <td>장석일</td>
                            <td>성애병원</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">이사장</th>
                            <td>장안수</td>
                            <td>순천향의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">차기 이사장</th>
                            <td>임대현</td>
                            <td>인하의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        <tr>
                            <th scope="row">총무이사</th>
                            <td>김상헌</td>
                            <td>한양의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">재무이사</th>
                            <td>이병재</td>
                            <td>성균관의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">학술이사</th>
                            <td>김경원</td>
                            <td>연세의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        <tr>
                            <th scope="row">학술이사</th>
                            <td>김세훈</td>
                            <td>서울의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">간행이사</th>
                            <td>송우정</td>
                            <td>울산의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">교육이사</th>
                            <td>김효빈</td>
                            <td>인제의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        <tr>
                            <th scope="row">진료지침이사</th>
                            <td>서동인</td>
                            <td>서울의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        <tr>
                            <th scope="row">보험이사</th>
                            <td>정재원</td>
                            <td>인제의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">법제이사</th>
                            <td>박용민</td>
                            <td>건국의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        <tr>
                            <th scope="row">윤리이사</th>
                            <td>김철우</td>
                            <td>인하의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">홍보이사</th>
                            <td>권재우</td>
                            <td>강원의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">수련이사</th>
                            <td>예영민</td>
                            <td>아주의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">기획이사</th>
                            <td>허규영</td>
                            <td>고려의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">국제이사</th>
                            <td>김태범</td>
                            <td>울산의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">기술이사</th>
                            <td>손명현</td>
                            <td>연세의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        <tr>
                            <th scope="row">연구이사</th>
                            <td>최정희</td>
                            <td>한림의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">전산정보이사</th>
                            <td>김민혜</td>
                            <td>이화의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">대외협력이사</th>
                            <td>이용원</td>
                            <td>가톨릭관동의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">지회발전이사</th>
                            <td>남동호</td>
                            <td>아주의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">개원이사</th>
                            <td>이영목</td>
                            <td>GF내과</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">무임소이사</th>
                            <td>고영일</td>
                            <td>전남의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">무임소이사</th>
                            <td>안강모</td>
                            <td>성균관의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        <tr>
                            <th scope="row">무임소이사</th>
                            <td>장윤석</td>
                            <td>서울의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">무임소이사</th>
                            <td>이준혁</td>
                            <td>순천향의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">무임소이사</th>
                            <td>정이영</td>
                            <td>경상의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">무임소이사</th>
                            <td>문지용</td>
                            <td>한양의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">무임소이사</th>
                            <td>신현우</td>
                            <td>서울의대</td>
                            <td>이비인후과</td>
                        </tr>
                        <tr>
                            <th scope="row">감사</th>
                            <td>이상표</td>
                            <td>가천의대</td>
                            <td>내과</td>
                        </tr>
                        <tr>
                            <th scope="row">감사</th>
                            <td>심정연</td>
                            <td>성균관의대</td>
                            <td>소아청소년과</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- //e:임원명단 -->

            <!-- s:연구팀 -->
            <div class="sub-tab-con js-tab-con">
                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">연구팀</caption>
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 20%;">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th scope="row" rowspan="2">난치성 아토피피부염</th>
                            <td>팀장</td>
                            <td class="text-left">이동훈 (서울의대 피부과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">이영수 (아주의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="2">약물알레르기</th>
                            <td>팀장</td>
                            <td class="text-left">이재현 (연세의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">심다운 (전남의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="4">면역요법/알레르겐</th>
                            <td>팀장</td>
                            <td class="text-left">최정희 (한림의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">강성윤 (가천의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">류광희 (성균관대 이비인후과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">지혜미 (차의대 소아청소년과)</td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="2">중증천식</th>
                            <td>팀장</td>
                            <td class="text-left">김상헌 (한양의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">김주희 (한림의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="2">두드러기/혈관부종/아나필락시스</th>
                            <td>팀장</td>
                            <td class="text-left">장윤석 (서울의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">이정민 (연세원주의대 소아청소년과)</td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="2">만성 기침</th>
                            <td>팀장</td>
                            <td class="text-left">송우정 (울산의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">이화영 (가톨릭의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="4">비염</th>
                            <td>팀장</td>
                            <td class="text-left">이상민 (단국의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">김미애 (차의대 내과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">박상철 (한림의대 이비인후과)</td>
                        </tr>
                        <tr>
                            <td>간사</td>
                            <td class="text-left">양송이 (한림의대 소아청소년과)</td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="3">호산구/면역질환</th>
                            <td>팀장</td>
                            <td class="text-left">양민석 (서울의대 내과)</td>
                        </tr>
                        <tr>
                            <td>호산구 간사</td>
                            <td class="text-left">이지향 (서울의대 내과)</td>
                        </tr>
                        <tr>
                            <td>면역 간사</td>
                            <td class="text-left">장재혁 (아주의대 내과)</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- //e:연구팀 -->

            <!-- s:지회 -->
            <div class="sub-tab-con js-tab-con">
                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">지회</caption>
                        <colgroup>
                            <col style="width: 25%">
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <tr class="active">
                            <th scope="col">지회</th>
                            <th scope="col">지회장</th>
                            <th scope="col">총무</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">서울</th>
                            <td>심정연 (성균관의대 소아청소년과)</td>
                            <td>이화영 (가톨릭의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row">경기, 인천</th>
                            <td>김선태 (가천의대 이비인후과)</td>
                            <td>이용원 (가톨릭관동의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row">강원</th>
                            <td>김봉성 (울산의대 소아청소년과)</td>
                            <td>이지호 (연세원주의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row">부산, 경남</th>
                            <td>조규섭 (부산의대 이비인후과)</td>
                            <td>이승은 (부산의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row">대구, 경북</th>
                            <td>서영익 (성누가종합내과외과의원)</td>
                            <td>정지웅 (경북의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row">전북</th>
                            <td>이용철 (전북의대 내과)</td>
                            <td>김소리 (전북의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row">광주, 전남</th>
                            <td>김원영 (우리들내과의원)</td>
                            <td>고영일 (전남의대 내과)</td>
                        </tr>
                        <tr>
                            <th scope="row">충청</th>
                            <td>지영구 (단국의대 내과)</td>
                            <td>이상민 (단국의대 내과)</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- //e:지회 -->

            <!-- s:평의원 -->
            <div class="sub-tab-con js-tab-con">
                <ul class="history-list committee-list">
                    <li>
                        <strong class="tit">강혜련</strong>
                        <p class="affiliation text-right">서울의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">고영일</strong>
                        <p class="affiliation text-right">전남의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">권순석</strong>
                        <p class="affiliation text-right">가톨릭의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">김규언</strong>
                        <p class="affiliation text-right">소화아동병원 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">김규한</strong>
                        <p class="affiliation text-right">서울의대 피부과</p>
                    </li>
                    <li>
                        <strong class="tit">김동영</strong>
                        <p class="affiliation text-right">서울의대 이비인후과</p>
                    </li>
                    <li>
                        <strong class="tit">김미경</strong>
                        <p class="affiliation text-right">충북의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">김봉성</strong>
                        <p class="affiliation text-right">강릉아산병원 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">김상헌</strong>
                        <p class="affiliation text-right">한양의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">김상훈</strong>
                        <p class="affiliation text-right">을지의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">김선태</strong>
                        <p class="affiliation text-right">가천의대 이비인후과</p>
                    </li>
                    <li>
                        <strong class="tit">김성완</strong>
                        <p class="affiliation text-right">경희의대 이비인후과</p>
                    </li>
                    <li>
                        <strong class="tit">김유영</strong>
                        <p class="affiliation text-right">MD헬스케어</p>
                    </li>
                    <li>
                        <strong class="tit">김정희</strong>
                        <p class="affiliation text-right">인하의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">김철우</strong>
                        <p class="affiliation text-right">인하의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">김태범</strong>
                        <p class="affiliation text-right">울산의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">김현희</strong>
                        <p class="affiliation text-right">가톨릭의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">나영호</strong>
                        <p class="affiliation text-right">성북 우리아이들병원 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">남동호</strong>
                        <p class="affiliation text-right">아주의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">동헌종</strong>
                        <p class="affiliation text-right">하나이비인후과병원 이비인후과</p>
                    </li>
                    <li>
                        <strong class="tit">문희범</strong>
                        <p class="affiliation text-right">울산의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">민양기</strong>
                        <p class="affiliation text-right">경찰병원 이비인후과</p>
                    </li>
                    <li>
                        <strong class="tit">박성학</strong>
                        <p class="affiliation text-right">가톨릭의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">박용민</strong>
                        <p class="affiliation text-right">건국의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">박중원</strong>
                        <p class="affiliation text-right">연세의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">박춘식</strong>
                        <p class="affiliation text-right">순천향의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">박해심</strong>
                        <p class="affiliation text-right">아주의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">박흥우</strong>
                        <p class="affiliation text-right">서울의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">손명현</strong>
                        <p class="affiliation text-right">연세의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">신동학</strong>
                        <p class="affiliation text-right">계명의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">심정연</strong>
                        <p class="affiliation text-right">성균관의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">안강모</strong>
                        <p class="affiliation text-right">성균관의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">양현종</strong>
                        <p class="affiliation text-right">순천향의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">염혜영</strong>
                        <p class="affiliation text-right">서울의료원 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">오무영</strong>
                        <p class="affiliation text-right">온종합병원 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">오재원</strong>
                        <p class="affiliation text-right">한양의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">유광하</strong>
                        <p class="affiliation text-right">건국의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">유영</strong>
                        <p class="affiliation text-right">고려의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">유진호</strong>
                        <p class="affiliation text-right">울산의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">윤혜선</strong>
                        <p class="affiliation text-right">한림의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">윤호주</strong>
                        <p class="affiliation text-right">한양의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이병재</strong>
                        <p class="affiliation text-right">성균관의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이상표</strong>
                        <p class="affiliation text-right">가천의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이수영</strong>
                        <p class="affiliation text-right">아주의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">이숙영</strong>
                        <p class="affiliation text-right">가톨릭의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이애영</strong>
                        <p class="affiliation text-right">동국의대 피부과</p>
                    </li>
                    <li>
                        <strong class="tit">이영목</strong>
                        <p class="affiliation text-right">GF내과 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이용철</strong>
                        <p class="affiliation text-right">전북의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이재서</strong>
                        <p class="affiliation text-right">서울의대 이비인후과</p>
                    </li>
                    <li>
                        <strong class="tit">이종명</strong>
                        <p class="affiliation text-right">경북의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이준혁</strong>
                        <p class="affiliation text-right">순천향의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">이하백</strong>
                        <p class="affiliation text-right">한양의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">이혜란</strong>
                        <p class="affiliation text-right">한림의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">임대현</strong>
                        <p class="affiliation text-right">인하의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">장광천</strong>
                        <p class="affiliation text-right">국민건강보험 일산병원 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">장석일</strong>
                        <p class="affiliation text-right">성애병원 내과</p>
                    </li>
                    <li>
                        <strong class="tit">장안수</strong>
                        <p class="affiliation text-right">순천향의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">장윤석</strong>
                        <p class="affiliation text-right">서울의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">정이영</strong>
                        <p class="affiliation text-right">경상의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">정재원</strong>
                        <p class="affiliation text-right">인제의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">조상헌</strong>
                        <p class="affiliation text-right">서울의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">조영주</strong>
                        <p class="affiliation text-right">이화의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">조유숙</strong>
                        <p class="affiliation text-right">울산의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">지영구</strong>
                        <p class="affiliation text-right">단국의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">최동철</strong>
                        <p class="affiliation text-right">성균관의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">최병휘</strong>
                        <p class="affiliation text-right">중앙의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">최정희</strong>
                        <p class="affiliation text-right">한림의대 내과</p>
                    </li>
                    <li>
                        <strong class="tit">편복양</strong>
                        <p class="affiliation text-right">순천향의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">한만용</strong>
                        <p class="affiliation text-right">차의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">홍수종</strong>
                        <p class="affiliation text-right">울산의대 소아청소년과</p>
                    </li>
                    <li>
                        <strong class="tit">홍천수</strong>
                        <p class="affiliation text-right">연세의대 내과</p>
                    </li>
                </ul>
            </div>
            <!-- //e:평의원 -->

            <!-- s:위원회 -->
            <div class="sub-tab-con js-tab-con">
                <div class="sub-tab-wrap inner-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">학술위원회</button>
                    <ul class="sub-tab-menu js-inner-tab-menu type2">
                        <li class="on"><a href="#n">학술위원회</a></li>
                        <li><a href="#n">간행위원회</a></li>
                        <li><a href="#n">교육위원회</a></li>
                        <li><a href="#n">홍보위원회</a></li>
                        <li><a href="#n">연구위원회</a></li>
                        <li><a href="#n">수련위원회</a></li>
                        <li><a href="#n">법제위원회</a></li>
                        <li><a href="#n">기술위원회</a></li>
                        <li><a href="#n">전산정보위원회</a></li>
                        <li><a href="#n">기획위원회</a></li>
                        <li><a href="#n">보험위원회</a></li>
                        <li><a href="#n">윤리위원회</a></li>
                        <li><a href="#n">진료지침위원회</a></li>
                        <li><a href="#n">대외협력위원회</a></li>
                        <li><a href="#n">국제위원회</a></li>
                    </ul>
                </div>

                <!-- s:학술위원회 -->
                <div class="inner-tab-con js-inner-tab-con" style="display: block;">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">학술위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">학술위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">학술이사</th>
                                <td>김세훈</td>
                                <td>서울의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">학술이사</th>
                                <td>김경원</td>
                                <td>연세의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김미애</td>
                                <td>차의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>지혜미</td>
                                <td>차의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이화영</td>
                                <td>가톨릭의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>양민석</td>
                                <td>서울의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김주희</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>심다운</td>
                                <td>전남의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김소리</td>
                                <td>전북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>민택기</td>
                                <td>순천향의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이정민</td>
                                <td>연세원주의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이동훈</td>
                                <td>서울의대 </td>
                                <td>피부과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박상철</td>
                                <td>한림의대</td>
                                <td>이비인후과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:학술위원회 -->

                <!-- s:간행위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">간행위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">간행위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">간행이사</th>
                                <td>송우정</td>
                                <td>울산의대 </td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>양송이</td>
                                <td>한림의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강노을</td>
                                <td>성균관의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>권재우</td>
                                <td>강원의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김민지</td>
                                <td>충남의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김소리</td>
                                <td>전북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김영찬</td>
                                <td>서울의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김정현</td>
                                <td>순천향의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>류광희</td>
                                <td>성균관의대</td>
                                <td>이비인후과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>심지수</td>
                                <td>이화의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이상민</td>
                                <td>단국의대 </td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이은</td>
                                <td>전남의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이준혁</td>
                                <td>순천향의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>정지웅</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:간행위원회 -->

                <!-- s:교육위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">교육위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">교육위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">교육이사</th>
                                <td>김효빈</td>
                                <td>인제의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>이혜진</td>
                                <td>가톨릭의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강성윤</td>
                                <td>가천의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원 </th>
                                <td>김미애</td>
                                <td>차의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>류광희</td>
                                <td>성균관의대</td>
                                <td>이비인후과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박소영</td>
                                <td>중앙의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박창욱</td>
                                <td>연세의대</td>
                                <td>피부과 </td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이지영</td>
                                <td>중앙의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>전유훈</td>
                                <td>한림의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:교육위원회 -->

                <!-- s:홍보위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">홍보위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">홍보위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">홍보이사</th>
                                <td>권재우</td>
                                <td>강원의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김소리</td>
                                <td>전북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강성윤</td>
                                <td>가천의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>권혁수</td>
                                <td>울산의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김건우</td>
                                <td>성가롤로병원</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김미영</td>
                                <td>인제의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김소리</td>
                                <td>전북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>남영희</td>
                                <td>동아의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이지호</td>
                                <td>연세원주의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이태훈</td>
                                <td>울산의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>정지웅</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:홍보위원회 -->

                <!-- s:연구위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">연구위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">연구위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">연구이사</th>
                                <td>최정희</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>정수지</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김주희</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>심다운</td>
                                <td>전남의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이영수</td>
                                <td>아주의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이화영</td>
                                <td>가톨릭의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이정민</td>
                                <td>연세원주의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>류광희</td>
                                <td>성균관의대</td>
                                <td>이비인후과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:연구위원회 -->

                <!-- s:수련위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">수련위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">수련위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">위원장</th>
                                <td>예영민</td>
                                <td>아주의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>우성대</td>
                                <td>충남의대</td>
                                <td>내과 </td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>허규영</td>
                                <td>고려의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>심다운</td>
                                <td>전남의대</td>
                                <td>내과 </td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>남영희</td>
                                <td>동아의대</td>
                                <td>내과 </td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박한기</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김주희</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:수련위원회 -->

                <!-- s:법제위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">법제위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">법제위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">법제이사</th>
                                <td>박용민</td>
                                <td>건국의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>박진성</td>
                                <td>강원의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강민규</td>
                                <td>충북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>권재우</td>
                                <td>강원의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김상훈</td>
                                <td>을지의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박한기</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>백혜성</td>
                                <td>한림의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>서동인</td>
                                <td>서울의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>정재원</td>
                                <td>인제의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>진현정</td>
                                <td>영남의대 </td>
                                <td>내과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:법제위원회 -->

                <!-- s:기술위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">기술위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">기술위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">기술이사</th>
                                <td>손명현</td>
                                <td>연세의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김윤희</td>
                                <td>연세의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>반가영</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이상민</td>
                                <td>단국의대 </td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>나정임</td>
                                <td>서울의대</td>
                                <td>피부과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>신현우</td>
                                <td>서울의대</td>
                                <td>이비인후과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:기술위원회 -->

                <!-- s:전산정보위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">전산정보위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">전산정보위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">전산정보이사</th>
                                <td>김민혜</td>
                                <td>이화의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김정현</td>
                                <td>순천향의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김병근</td>
                                <td>고려의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박소영</td>
                                <td>중앙의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>심지수</td>
                                <td>이화의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김경훈</td>
                                <td>서울의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>연동건</td>
                                <td>경희의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>홍종수</td>
                                <td>동국의대</td>
                                <td>피부과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김진엽</td>
                                <td>동국의대</td>
                                <td>이비인후과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:전산정보위원회 -->

                <!-- s:기획위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">기획위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">기획위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">기획이사</th>
                                <td>허규영</td>
                                <td>고려의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김주희</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이영수</td>
                                <td>아주의대</td>
                                <td>내과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:기획위원회 -->

                <!-- s:보험위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">보험위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">보험위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">보험이사</th>
                                <td>정재원</td>
                                <td>인제의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>손경희</td>
                                <td>경희의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이상민</td>
                                <td>단국의대 </td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박창한</td>
                                <td>성애병원</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>양현종</td>
                                <td>순천향의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이갑석</td>
                                <td>중앙의대</td>
                                <td>피부과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이소연</td>
                                <td>파이디지털헬스케어</td>
                                <td>소아청소년과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:보험위원회 -->

                <!-- s:윤리위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">윤리위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">윤리위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">윤리이사</th>
                                <td>김철우</td>
                                <td>인하의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>강성윤</td>
                                <td>가천의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김상훈</td>
                                <td>을지의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>조유숙</td>
                                <td>울산의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이용원</td>
                                <td>가톨릭관동의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>유영</td>
                                <td>고려의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김정희</td>
                                <td>인하의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>양현종</td>
                                <td>순천향의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이용주</td>
                                <td>연세의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김민지</td>
                                <td>충남의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>모지훈</td>
                                <td>단국의대</td>
                                <td>이비인후과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:윤리위원회 -->

                <!-- s:진료지침위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">진료지침위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">진료지침위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">진료지침이사</th>
                                <td>서동인</td>
                                <td>서울의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>심다운</td>
                                <td>전남의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김미애</td>
                                <td>차의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박지수</td>
                                <td>서울의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>양송이</td>
                                <td>한림의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>양은애</td>
                                <td>가톨릭의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이영수</td>
                                <td>아주의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이정민</td>
                                <td>연세원주의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이화영</td>
                                <td>가톨릭의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>양현종</td>
                                <td>순천향의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:진료지침위원회 -->

                <!-- s:대외협력위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">대외협력위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">대외협력위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">대외협력이사</th>
                                <td>이용원</td>
                                <td>가톨릭관동의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>지혜미</td>
                                <td>차의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>민진영</td>
                                <td>경희의대</td>
                                <td>이비인후과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이진영</td>
                                <td>성균관의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>박경희</td>
                                <td>연세의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>방철환</td>
                                <td>가톨릭의대</td>
                                <td>피부과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>오지윤</td>
                                <td>서울의료원</td>
                                <td>내과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:대외협력위원회 -->

                <!-- s:국제위원회 -->
                <div class="inner-tab-con js-inner-tab-con">
                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">국제위원회</h4>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">국제위원회</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr class="active">
                                <th scope="col">구분</th>
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">위원장</th>
                                <td>김태범</td>
                                <td>울산의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이지향</td>
                                <td>서울의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이영수</td>
                                <td>아주의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>지혜미</td>
                                <td>차의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //e:국제위원회 -->
            </div>
            <!-- //e:위원회 -->
        </div>
    </article>

@endsection

@section('addScript')
@endsection
