@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="history-conbox">

                <div class="sub-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">연혁</button>
                    <ul class="sub-tab-menu js-tab-menu">
                        <li class="{{ (request()->tab ?? '') == '' ? 'on' : '' }}"><a href="{{ route('intro.research') }}">현 임원진</a></li>
                        <li class="{{ (request()->tab ?? '') == '2' ? 'on' : '' }}"><a href="{{ route('intro.research',['tab'=>2]) }}">역대 임원진</a></li>
                        <li class=""><a href="{{ route('board',['code'=>'research-team']) }}">게시판</a></li>
                    </ul>
                </div>

                <div class="history-contents">
                    <div class="year-rolling-wrap">
                        <a href="#n" class="btn btn-year-arrow btn-year-prev js-prev"><span class="hide">이전</span></a>
                        <div class="year-rolling js-year">
                            <a href="#n" class="current"><span>난치성 아토피피부염</span></a>
                            <a href="#n"><span>약물알레르기</span></a>
                            <a href="#n"><span>면역요법/알레르겐</span></a>
                            <a href="#n"><span>중증천식</span></a>
                            <a href="#n"><span>두드러기/혈관부종/아나필락시스</span></a>
                            <a href="#n"><span>만성기침</span></a>
                            <a href="#n"><span>비염</span></a>
                            <a href="#n"><span>호산구/면역질환</span></a>
                        </div>
                        <a href="#n" class="btn btn-year-arrow btn-year-next js-next"><span class="hide">다음</span></a>
                    </div>

                    <div class="history-rolling-wrap js-history-rolling">
                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">난치성 아토피피부염</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2023. 06 ~ 2027. 12</td>
                                            <td>이동훈 (서울의대 피부과)</td>
                                            <td>이영수 (아주의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2021. 01 ~ 2022. 12</td>
                                            <td>김우경 (인제의대 소아청소년과)</td>
                                            <td>성명순 (순천향대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2018. 01 ~ 2020. 12</td>
                                            <td>최응호 (연세대학교 원주의대 피부과)</td>
                                            <td>성명순 (인제대학교 해운대백병원 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2014. 01 ~ 2017. 12</td>
                                            <td>염혜영 (서울의료원 소아청소년과)</td>
                                            <td>이동훈(서울의대 피부과)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">약물알레르기</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2026. 01 ~ 2027. 12</td>
                                            <td>김소리 (전북의대 내과)</td>
                                            <td>심다운 (전남의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2022. 01 ~ 2025. 12</td>
                                            <td>이재현 (연세의대 내과)</td>
                                            <td>심다운 (전남의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2020. 01 ~ 2021. 12</td>
                                            <td>강혜련 (서울의대 내과)</td>
                                            <td>김성렬 (연세의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2014. 01 ~ 2021. 12</td>
                                            <td>강혜련 (서울의대 내과)</td>
                                            <td>양민석 (보라매병원 내과)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">면역요법/알레르겐</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="3">1</td>
                                            <td rowspan="3">2026. 01 ~ 2027. 12</td>
                                            <td rowspan="3">정수지 (한림의대 내과)</td>
                                            <td>정수지 (한림의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>류광희 (성균관대 이비인후과)</td>
                                        </tr>
                                        <tr>
                                            <td>김주희 (차의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">2</td>
                                            <td rowspan="3">2024. 01 ~ 2025. 12</td>
                                            <td rowspan="3">최정희 (한림의대 내과)</td>
                                            <td>강성윤 (가천의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>류광희 (성균관대 이비인후과)</td>
                                        </tr>
                                        <tr>
                                            <td>지혜미(차의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">3</td>
                                            <td rowspan="2">2022. 01 ~ 2023. 12</td>
                                            <td rowspan="2">최정희 (한림의대 내과)</td>
                                            <td>이화영(가톨릭의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>지혜미(차의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2018. 01 ~ 2021. 12</td>
                                            <td>한만용 (차의대 소아청소년과)</td>
                                            <td>박경희 (연세의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>2014. 01 ~ 2017. 12</td>
                                            <td>김선태 (가천의대 이비인후과)</td>
                                            <td>신유섭 (아주의대 내과)</td>
                                        </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">중증천식</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2026. 01 ~ 2027. 12</td>
                                            <td>박흥우 (서울의대 내과)</td>
                                            <td>김주희 (한림의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2022. 01 ~ 2025. 12</td>
                                            <td>김상헌 (한양의대 내과)</td>
                                            <td>김주희 (한림의대 내과)</td>
                                        </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">두드러기/혈관부종/아나필락시스</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2025. 01 ~ 2027. 12</td>
                                            <td>최정희 (한림의대 내과)</td>
                                            <td>반가영 (한림의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2022. 01 ~ 2023. 12</td>
                                            <td>장윤석 (서울의대 내과)</td>
                                            <td>이정민 (연세원주의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2018. 01 ~ 2021. 12</td>
                                            <td>장광천 (NHIMC 일산병원 소아청소년과)</td>
                                            <td>김미애 (차의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2016. 01 ~ 2017. 12</td>
                                            <td>예영민(아주의대 내과)</td>
                                            <td>신미용(순천향의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">5</td>
                                            <td rowspan="2">2014. 01 ~ 2015. 12</td>
                                            <td rowspan="2">이수영 (아주의대 소아청소년과)</td>
                                            <td>예영민(아주의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>장광천(일산병원 소아청소년과)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">만성기침</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2024. 01 ~ 2027. 12</td>
                                            <td>송우정 (울산의대 내과)</td>
                                            <td>이화영 (가톨릭의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2020. 01 ~ 2023. 12</td>
                                            <td>김세훈 (분당서울대벼원 내과)</td>
                                            <td>김민혜 (이대서울병원 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2016. 01 ~ 2019. 12</td>
                                            <td>김상훈(을지의대 내과)</td>
                                            <td>송우정(서울의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2014. 01 ~ 2025. 12</td>
                                            <td>이병재(성균관의대 내과)</td>
                                            <td>김상훈(을지의대 내과)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">비염</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="3">1</td>
                                            <td rowspan="3">2026. 01 ~ 2027. 12</td>
                                            <td rowspan="3">이상민(단국의대 내과)</td>
                                            <td>김미애(차의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>이일환(한림의대 이비인후과)</td>
                                        </tr>
                                        <tr>
                                            <td>양송이(한림의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">2</td>
                                            <td rowspan="3">2024. 01 ~ 2025. 12</td>
                                            <td rowspan="3">이상민(단국의대 내과)</td>
                                            <td>김미애(차의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>박상철(한림의대 이비인후과)</td>
                                        </tr>
                                        <tr>
                                            <td>양송이(한림의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">3</td>
                                            <td rowspan="3">2022. 01 ~ 2023. 12</td>
                                            <td rowspan="3">양현종 (순천향의대 소아청소년과)</td>
                                            <td>이상민(가천의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>박상철(한림의대 이비인후과)</td>
                                        </tr>
                                        <tr>
                                            <td>양송이(한림의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">4</td>
                                            <td rowspan="3">2018. 01 ~ 2021. 12</td>
                                            <td rowspan="3">김수환(가톨릭의대 이비인후과)</td>
                                            <td>이상민(가천의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>양현종(순천향의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td>김동규(한림의대 이비인후과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">5</td>
                                            <td rowspan="3">2016. 01 ~ 2017. 12</td>
                                            <td rowspan="3">유영(고려의대 소아청소년과)</td>
                                            <td>최정희(한림의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>양현종(순천향의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td>김영효(인하의대 이비인후과)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">6</td>
                                            <td rowspan="3">2014. 01 ~ 2025. 12</td>
                                            <td rowspan="3">고영일(전남의대 내과)</td>
                                            <td>최정희(한림의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>유영(고려의대 소아청소년과)</td>
                                        </tr>
                                        <tr>
                                            <td>김영효(인하의대 이비인후과)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="history-wrap js-history-wrap">
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">호산구/면역질환</caption>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr class="active">
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">팀장</th>
                                            <th scope="col">간사</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">2025.10~ 2027.12</td>
                                            <td rowspan="2">양민석(보라매병원 내과)</td>
                                            <td>호산구간사: 강노을(성균관의대 내과)</td>
                                        </tr>
                                        <tr>
                                            <td>면역간사: 장재혁(아주의대 내과)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
