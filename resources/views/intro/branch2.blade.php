@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap type2">
                <button type="button" class="btn btn-tab-menu js-btn-tab-menu">역대 임원진</button>
                <ul class="sub-tab-menu">
                    <li class="{{ (request()->tab ?? '') == '' ? 'on' : '' }}"><a href="{{ route('intro.branch') }}">현 임원진</a></li>
                    <li class="{{ (request()->tab ?? '') == '2' ? 'on' : '' }}"><a href="{{ route('intro.branch',['tab'=>2]) }}">역대 임원진</a></li>
                    <li class=""><a href="{{ route('board',['code'=>'branch']) }}">게시판</a></li>
                </ul>
            </div>
            <div class="history-contents">
                <div class="year-rolling-wrap">
                    <a href="#n" class="btn btn-year-arrow btn-year-prev js-prev"><span class="hide">이전</span></a>
                    <div class="year-rolling js-year">
                        <a href="#n" class="current"><span>서울지회</span></a>
                        <a href="#n"><span>경인지회</span></a>
                        <a href="#n"><span>충청지회</span></a>
                        <a href="#n"><span>강원지회</span></a>
                        <a href="#n"><span>전북지회</span></a>
                        <a href="#n"><span>광주전남지회</span></a>
                        <a href="#n"><span>대구경북지회</span></a>
                        <a href="#n"><span>부산경남지회</span></a>
                    </div>
                    <a href="#n" class="btn btn-year-arrow btn-year-next js-next"><span class="hide">다음</span></a>
                </div>

                <div class="history-rolling-wrap js-history-rolling">
                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">서울지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">서울지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td>1</td>
										<td>1981.4-1985.12</td>
										<td>김종진 (김종진 내과)</td>
										<td>은희철 (서울의대 피부과)</td>
									</tr>
									<tr>
										<td>2</td>
										<td>1985.12-1988.12</td>
										<td>소진명 (소이비인후과)</td>
										<td>홍천수 (연세의대 내과)</td>
									</tr>
									<tr>
										<td>3</td>
										<td>1988.12-1991.12</td>
										<td>김정원 (가톨릭의대 피부과)</td>
										<td>박성학 (가톨릭의대 내과)</td>
									</tr>
									<tr>
										<td>4</td>
										<td>1991.12-1994.12</td>
										<td>김기헌 (김기헌 이비인후과)</td>
										<td>고영률 (서울의대 소아과)</td>
									</tr>
									<tr>
										<td>5</td>
										<td>1994.12-1997.12</td>
										<td>윤혜선 (한림의대 소아과)</td>
										<td>최동철 (성균관의대 내과)</td>
									</tr>
									<tr>
										<td>6</td>
										<td>1997.12-2000.12</td>
										<td>은희철 (서울의대 피부과)</td>
										<td>김규한 (서울의대 피부과)</td>
									</tr>
									<tr>
										<td>7</td>
										<td>2000.12-2002</td>
										<td>남송현 (남송현 내과)</td>
										<td>김윤근 (서울의대 내과)</td>
									</tr>
									<tr>
										<td>8</td>
										<td>2003-2005</td>
										<td>남송현 (남송현 내과)</td>
										<td>김윤근 (서울의대 내과)</td>
									</tr>
									<tr>
										<td>9</td>
										<td>2005-2007</td>
										<td>문희범 (울산의대 내과)</td>
										<td></td>
									</tr>
									<tr>
										<td>10</td>
										<td>2007-2009</td>
										<td>홍천수 (연세의대 내과)</td>
										<td>안강모 (성균관의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>11</td>
										<td>2009-2011</td>
										<td>김규언 (연세의대 소아청소년과)</td>
										<td>이영목 (순천향의대 내과) / 이재영</td>
									</tr>
									<tr>
										<td>12</td>
										<td>2011-2013</td>
										<td>민경업 (서울의대 내과)</td>
										<td>유영 (고려의대 소아청소년과), 강혜련 (서울의대 내과)</td>
									</tr>
									<tr>
										<td>13</td>
										<td>2013-2015</td>
										<td>고영률 (서울의대 소아청소년과)</td>
										<td>김상훈 (을지의대 내과)</td>
									</tr>
									<tr>
										<td>14</td>
										<td>2015-2017</td>
										<td>최병휘 (중앙의대 내과)</td>
										<td>박용민 (건국의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>15</td>
										<td>2017-2019</td>
										<td>정지태 (고려의대 소아청소년과)</td>
										<td>박흥우 (서울의대 내과)</td>
									</tr>
									<tr>
										<td>16</td>
										<td>2019-2021</td>
										<td>박중원 (연세의대 내과)</td>
										<td>김경원 (연세의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>17</td>
										<td>2021-2023</td>
										<td>나영호 (경희의대 소아청소년과)</td>
										<td>손경희 (경희의대 내과)</td>
									</tr>
									<tr>
										<td>18</td>
										<td>2023-2025</td>
										<td>이숙영 (가톨릭의대 내과)</td>
										<td>한주희 (가톨릭의대 피부과)</td>
									</tr>
									<tr>
										<td>19</td>
										<td>2025-</td>
										<td>심정연 (성균관의대 소아청소년과)</td>
										<td>이화영 (가톨릭의대 내과)</td>
									</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">경인지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">경인지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td>1</td>
										<td>1975-1985</td>
										<td>김려성</td>
										<td>박동수</td>
									</tr>
									<tr>
										<td>2</td>
										<td>1985-1994</td>
										<td>이세연 (이내과)</td>
										<td>이영상, 강문호 (강문호 내과)</td>
									</tr>
									<tr>
										<td>3</td>
										<td>1994-2003</td>
										<td>김병천 (김병천 내과)</td>
										<td>강문호(강문호 내과), 남귀현(함춘내과의원)</td>
									</tr>
									<tr>
										<td>4</td>
										<td>2003-2004</td>
										<td>김병천 (김병천 내과)</td>
										<td>남귀현 (함춘내과의원)</td>
									</tr>
									<tr>
										<td>5</td>
										<td>2004-2007</td>
										<td>손병관 (인하의대 소아청소년과)</td>
										<td>장안수 (순천향의대 내과)</td>
									</tr>
									<tr>
										<td>6</td>
										<td>2007-2010</td>
										<td>박춘식 (순천향의대 내과)</td>
										<td>임대현 (인하의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>7</td>
										<td>2010-2012</td>
										<td>이애영 (동국의대 피부과)</td>
										<td>이상표 (가천의대 내과)</td>
									</tr>
									<tr>
										<td>8</td>
										<td>2012-2014</td>
										<td>박해심 (아주의대 내과)</td>
										<td>김정희(인하의대 소아청소년과), 장윤석(서울의대 내과)</td>
									</tr>
									<tr>
										<td>9</td>
										<td>2014-2016</td>
										<td>권순석 (가톨릭의대 내과)</td>
										<td>김정희 (인하의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>10</td>
										<td>2016-2018</td>
										<td>이재서 (서울의대 이비인후과)</td>
										<td>박성우 (순천향의대 내과)</td>
									</tr>
									<tr>
										<td>11</td>
										<td>2018-2020</td>
										<td>김현희 (가톨릭의대 소아청소년과)</td>
										<td>장윤석 (서울의대 내과)</td>
									</tr>
									<tr>
										<td>12</td>
										<td>2020-2022</td>
										<td>남동호 (아주의대 내과)</td>
										<td>장윤석 (서울의대 내과)</td>
									</tr>
									<tr>
										<td>13</td>
										<td>2022-2024</td>
										<td>김정희 (인하의대 소아청소년과)</td>
										<td>이용원 (가톨릭관동의대 내과)</td>
									</tr>
									<tr>
										<td>14</td>
										<td>2024-</td>
										<td>김선태 (가천의대 이비인후과)</td>
										<td>이용원 (가톨릭관동의대 내과)</td>
									</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">충청지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">충청지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2024-</td>
                                        <td>지영구 (단국의대 내과)</td>
                                        <td>이상민 (단국의대 내과)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">강원지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">강원지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td>1</td>
										<td>1992-1994</td>
										<td>김종수 (연세원주의대 소아과)</td>
										<td>신계철 (연세원주의대 내과)</td>
									</tr>
									<tr>
										<td>2</td>
										<td>1994-1996</td>
										<td>김종수 (연세원주의대 소아과)</td>
										<td>신계철 (연세원주의대 내과)</td>
									</tr>
									<tr>
										<td>3</td>
										<td>1996-2006</td>
										<td>김종수 (연세원주의대 소아과)</td>
										<td>신계철 (연세원주의대 내과)</td>
									</tr>
									<tr>
										<td>4</td>
										<td>2007-2010</td>
										<td>신계철 (연세원주의대 내과)</td>
										<td>김상하 (연세원주의대 내과)</td>
									</tr>
									<tr>
										<td>5</td>
										<td>2011-2018</td>
										<td>용석중 (연세원주의대 내과)</td>
										<td>김봉성 (강릉아산병원 소아청소년과)</td>
									</tr>
									<tr>
										<td>6</td>
										<td>2018-2022</td>
										<td>용석중 (연세원주의대 내과)</td>
										<td>김상하 (연세원주의대 내과)</td>
									</tr>
									<tr>
										<td>7</td>
										<td>2022-2024</td>
										<td>김봉성 (강릉아산병원 소아청소년과)</td>
										<td>이지호 (연세원주의대 내과)</td>
									</tr>
									<tr>
										<td>8</td>
										<td>2025-</td>
										<td>김봉성 (강릉아산병원 소아청소년과)</td>
										<td>유영상 (강릉아산병원 내과)</td>
									</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">전북지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">전북지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td>1</td>
										<td>1981-1988</td>
										<td>하대유 (전북의대 미생물학과)</td>
										<td>위상양 (전북의대 내과)</td>
									</tr>
									<tr>
										<td>2</td>
										<td>1989-1993</td>
										<td>하대유 (전북의대 미생물학과)</td>
										<td>이양근 (전북의대 내과)</td>
									</tr>
									<tr>
										<td>3</td>
										<td>1994-2008</td>
										<td>이동호 (이동호 내과의원)</td>
										<td>이양근 (전북의대 내과)</td>
									</tr>
									<tr>
										<td>4</td>
										<td>2009-2015</td>
										<td>이양근 (전북의대 내과)</td>
										<td>이용철 (전북의대 내과)</td>
									</tr>
									<tr>
										<td>5</td>
										<td>2015-2020</td>
										<td>김귀완 (김귀완내과)</td>
										<td>이용철 (전북의대 내과)</td>
									</tr>
									<tr>
										<td>6</td>
										<td>2020-2023</td>
										<td>정은택 (원광의대 내과)</td>
										<td>박승용 (전북의대 내과)</td>
									</tr>
									<tr>
										<td>7</td>
										<td>2024-</td>
										<td>이용철 (전북의대 미생물학과)</td>
										<td>김소리 (전북의대 내과)</td>
									</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">광주전남지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">광주전남지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td>1</td>
										<td>1978-1984</td>
										<td>김기창 (김기창내과)</td>
										<td>전인기 (전남의대 피부과)</td>
									</tr>
									<tr>
										<td>2</td>
										<td>1985-1990</td>
										<td>김기창 (김기창내과)</td>
										<td>박경옥 (전남의대 내과)</td>
									</tr>
									<tr>
										<td>3</td>
										<td>1991-1995</td>
										<td>김영표 (전남의대 피부과)</td>
										<td>원영호 (전남의대 피부과)</td>
									</tr>
									<tr>
										<td>4</td>
										<td>1996-2012</td>
										<td>김영표 (전남의대 피부과)</td>
										<td>최인선 (전남의대 내과)</td>
									</tr>
									<tr>
										<td>5</td>
										<td>2012-2013</td>
										<td>김영표 (전남의대 피부과)</td>
										<td>최인선 (전남의대 내과)</td>
									</tr>
									<tr>
										<td>6</td>
										<td>2013-2014</td>
										<td>진헌성 (전남의대 내과)</td>
										<td>원영호 (전남의대 피부과)</td>
									</tr>
									<tr>
										<td>7</td>
										<td>2014-2016</td>
										<td>최인선 (전남의대 내과)</td>
										<td>원영호 (전남의대 피부과)</td>
									</tr>
									<tr>
										<td>8</td>
										<td>2016-2018</td>
										<td>원영호 (전남의대 피부과)</td>
										<td>양은석 (조선의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>9</td>
										<td>2018-2019</td>
										<td>원영호 (전남의대 피부과)</td>
										<td>김원영 (우리들 내과)</td>
									</tr>
									<tr>
										<td>10</td>
										<td>2019-2021</td>
										<td>이승철 (전남의대 피부과)</td>
										<td>김원영 (우리들 내과)</td>
									</tr>
									<tr>
										<td>11</td>
										<td>2022-2024</td>
										<td>김원영 (우리들 내과)</td>
										<td>고영일 (전남의대 내과)</td>
									</tr>
									<tr>
										<td>12</td>
										<td>2025-</td>
										<td>김원영 (우리들 내과)</td>
										<td>고영일 (전남의대 내과)</td>
									</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">대구경북지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">대구경북지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td>1</td>
										<td>1983</td>
										<td>서순봉 (가톨릭 피부과의원)</td>
										<td>이강혁 (경북의대 이비인후과)</td>
									</tr>
									<tr>
										<td>2</td>
										<td>1984-1985</td>
										<td>송준영 (계명의대 피부과)</td>
										<td>이강혁 (경북의대 이비인후과)</td>
									</tr>
									<tr>
										<td>3</td>
										<td>1986-1989</td>
										<td>성창섭 (계명의대 피부과)</td>
										<td>이상흔 (경북의대 이비인후과)</td>
									</tr>
									<tr>
										<td>4</td>
										<td>1990-1991</td>
										<td>정상립 (계명의대 피부과)</td>
										<td>강임주 (파티마병원 소아과)</td>
									</tr>
									<tr>
										<td>5</td>
										<td>1992-1993</td>
										<td>신동학 (계명의대 소아과)</td>
										<td>윤덕구 (계명의대 내과)</td>
									</tr>
									<tr>
										<td>6</td>
										<td>1994-1995</td>
										<td>김중강 (계명의대 이비인후과)</td>
										<td>김영성 (아이꿈터아동병원 소아과)</td>
									</tr>
									<tr>
										<td>7</td>
										<td>1996-1997</td>
										<td>김능수 (경북의대 내과)</td>
										<td>이종명 (경북의대 내과)</td>
									</tr>
									<tr>
										<td>8</td>
										<td>1998-2000</td>
										<td>이종명 (경북의대 내과)</td>
										<td>이병기</td>
									</tr>
									<tr>
										<td>9</td>
										<td>2001-2004</td>
										<td>강임주 (파티마병원 소아과)</td>
										<td>이종명 (경북의대 내과)</td>
									</tr>
									<tr>
										<td>10</td>
										<td>2005-2006</td>
										<td>윤덕구 (윤덕구 내과)</td>
										<td>현명철 (경북의대 소아과)</td>
									</tr>
									<tr>
										<td>11</td>
										<td>2007-2010</td>
										<td>김도원 (경북의대 피부과)</td>
										<td>현명철 (경북의대 소아과)</td>
									</tr>
									<tr>
										<td>12</td>
										<td>2011-2013</td>
										<td>정혜리 (대구가톨릭의대 소아청소년과)</td>
										<td>박혜진 (대구가톨릭의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>13</td>
										<td>2013-2015</td>
										<td>정진홍 (영남의대 내과)</td>
										<td>진현정 (영남의대 내과)</td>
									</tr>
									<tr>
										<td>14</td>
										<td>2015-2017</td>
										<td>이종명 (경북의대 내과)</td>
										<td>김수정 (경북의대 내과)</td>
									</tr>
									<tr>
										<td>15</td>
										<td>2017-2019</td>
										<td>현명철 (경북의대 소아과)</td>
										<td>김수정 (경북의대 내과)</td>
									</tr>
									<tr>
										<td>16</td>
										<td>2019-2021</td>
										<td>최성민 (최성민 내과)</td>
										<td>김수정 (경북의대 내과)</td>
									</tr>
									<tr>
										<td>17</td>
										<td>2021-2022</td>
										<td>김용대 (영남의대 이비인후과)</td>
										<td>김수정 (경북의대 내과)</td>
									</tr>
									<tr>
										<td>18</td>
										<td>2023-2024</td>
										<td>최귀애 (상인 내과의원)</td>
										<td>정창규 (계명의대 내과)</td>
									</tr>
									<tr>
										<td>19</td>
										<td>2025-2027</td>
										<td>서영익 (성누가종합내과외과의원)</td>
										<td>정지웅 (겅북의대 내과)</td>
									</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="sub-contit-wrap">
                            <h4 class="sub-contit">부산경남지회</h4>
                        </div>
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">부산경남지회 임원진 명단</caption>
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
                                        <th scope="col">지회장</th>
                                        <th scope="col">총무</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
										<td>1</td>
										<td>1982-1984</td>
										<td>신종우 (부산의대 소아과)</td>
										<td>고한진 (부산의대 이비인후과)</td>
									</tr>
									<tr>
										<td>2</td>
										<td>1984-1987</td>
										<td>신종우 (부산의대 소아과)</td>
										<td>최양숙</td>
									</tr>
									<tr>
										<td>3</td>
										<td>1987-1988</td>
										<td>신영기 (부산의대 소아과)</td>
										<td>조병우 (조병우 이비인후과의원)</td>
									</tr>
									<tr>
										<td>4</td>
										<td>1988-1991</td>
										<td>이종담 (부산의대 이비인후과)</td>
										<td>정상건 (정상건 소아과의원)</td>
									</tr>
									<tr>
										<td>5</td>
										<td>1991-1994</td>
										<td>조중환 (메리놀병원 이비인후과)</td>
										<td>김도섭 (부산성모병원 내과)</td>
									</tr>
									<tr>
										<td>6</td>
										<td>1994-2000</td>
										<td>박순규 (부산의대 내과)</td>
										<td>오무영 (인제의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>7</td>
										<td>2000-2002</td>
										<td>유태현 (고신의료원 이비인후과)</td>
										<td>오무영 (인제의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>8</td>
										<td>2003-2004</td>
										<td>고한진 (부산의대 이비인후과)</td>
										<td>오무영 (인제의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>9</td>
										<td>2005-2006</td>
										<td>김도섭 (부산성모병원 내과)</td>
										<td>박희주 (부산의대 소아청소년과)</td>
									</tr>
									<tr>
										<td>10</td>
										<td>2006-2009</td>
										<td>조병우 (조병우 이비인후과의원)</td>
										<td>이수걸, 박혜경 (동아의대 내과, 부산의대 내과)</td>
									</tr>
									<tr>
										<td>11</td>
										<td>2010-2011</td>
										<td>오무영 (인제의대 소아청소년과)</td>
										<td>박혜경 (부산의대 내과)</td>
									</tr>
									<tr>
										<td>12</td>
										<td>2011-2013</td>
										<td>김성원 (부산성모병원 소아청소년과)</td>
										<td>이수걸 (동아의대 내과)</td>
									</tr>
									<tr>
										<td>13</td>
										<td>2013-2015</td>
										<td>김경이 (김경이 이비인후과)</td>
										<td>정이영 (경상의대 내과)</td>
									</tr>
									<tr>
										<td>14</td>
										<td>2015-2017</td>
										<td>박희주 (부산의대 소아청소년과)</td>
										<td>정이영 (경상의대 내과)</td>
									</tr>
									<tr>
										<td>15</td>
										<td>2017-2019</td>
										<td>구수권 (부산성모병원 이비인후과)</td>
										<td>김희규 (고신의대 내과)</td>
									</tr>
									<tr>
										<td>16</td>
										<td>2019-2022</td>
										<td>정이영 (경상의대 내과)</td>
										<td>남영희 (동아의대 내과)</td>
									</tr>
									<tr>
										<td>17</td>
										<td>2022-2024</td>
										<td>정진아 (동아의대 소아청소년과)</td>
										<td>박찬선 (인제의대 내과)</td>
									</tr>
									<tr>
										<td>18</td>
										<td>2025-2027</td>
										<td>조규섭 (부산의대 이비인후과)</td>
										<td>이승은 (부산의대 내과)</td>
									</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
