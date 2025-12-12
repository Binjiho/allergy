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
                                        <td>김종진</td>
                                        <td>은희철</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1985.12-1988.12</td>
                                        <td>소진명</td>
                                        <td>홍천수</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1988.12-1991.12</td>
                                        <td>김정원</td>
                                        <td>박성학</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>1991.12-1994.12</td>
                                        <td>김기헌</td>
                                        <td>고영률</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>1994.12-1997.12</td>
                                        <td>윤혜선</td>
                                        <td>최동철</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>1997.12-2000.12</td>
                                        <td>은희철</td>
                                        <td>김규한</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2000.12-2002</td>
                                        <td>남송현</td>
                                        <td>김윤근</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>2003-2005</td>
                                        <td>남송현</td>
                                        <td>김윤근</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2005-2007</td>
                                        <td>문희범</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2007-2009</td>
                                        <td>홍천수</td>
                                        <td>안강모</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>2009-2011</td>
                                        <td>김규언</td>
                                        <td>이영목/이재영</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>2011-2013</td>
                                        <td>민경업</td>
                                        <td>유영</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>2013-2015</td>
                                        <td>고영률</td>
                                        <td>김상훈</td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>2015-2017</td>
                                        <td>최병휘</td>
                                        <td>박용민</td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>2017-2019</td>
                                        <td>정지태</td>
                                        <td>박흥우</td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>2019-2021</td>
                                        <td>박중원</td>
                                        <td>김경원</td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>2021-2023</td>
                                        <td>나영호</td>
                                        <td>손경희</td>
                                    </tr>
                                    <tr>
                                        <td>18</td>
                                        <td>2023-2025</td>
                                        <td>심정연</td>
                                        <td>이화영</td>
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
                                        <td>이세연</td>
                                        <td>이영상, 강문호</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1994-2003</td>
                                        <td>김병천</td>
                                        <td>강문호, 남귀현</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2003-2004</td>
                                        <td>김병천</td>
                                        <td>남귀현</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2004-2007</td>
                                        <td>손병관</td>
                                        <td>장안수</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2007-2010</td>
                                        <td>박춘식</td>
                                        <td>임대현, 이현희</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2010-2012</td>
                                        <td>이애영</td>
                                        <td>이상표</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>2012-2014</td>
                                        <td>박해심</td>
                                        <td>김정희, 장윤석</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2014-2016</td>
                                        <td>권순석</td>
                                        <td>김정희</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2016-2018</td>
                                        <td>이재서</td>
                                        <td>박성우</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>2018-2020</td>
                                        <td>김현희</td>
                                        <td>장윤석</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>2020-2022</td>
                                        <td>남동호</td>
                                        <td>장윤석</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>2022-2024</td>
                                        <td>김정희</td>
                                        <td>이용원</td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>2024-</td>
                                        <td>김선태</td>
                                        <td>이용원</td>
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
                                        <td>지영구</td>
                                        <td>이상민</td>
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
                                        <td>김종수</td>
                                        <td>신계철</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1994-1996</td>
                                        <td>김종수</td>
                                        <td>신계철</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1996-2006</td>
                                        <td>김종수</td>
                                        <td>신계철</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2007-2010</td>
                                        <td>신계철</td>
                                        <td>김상하</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2011-2018</td>
                                        <td>용석중</td>
                                        <td>김봉성</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2018-2022</td>
                                        <td>용석중</td>
                                        <td>김상하</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2022-2024</td>
                                        <td>김봉성</td>
                                        <td>이지호</td>
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
                                        <td>하대유</td>
                                        <td>위상양</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1989-1993</td>
                                        <td>하대유</td>
                                        <td>이양근</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1994-2008</td>
                                        <td>이동호</td>
                                        <td>이양근</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2009-2015</td>
                                        <td>이양근</td>
                                        <td>이용철</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2015-2020</td>
                                        <td>김귀완</td>
                                        <td>이용철</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2020-2023</td>
                                        <td>정은택</td>
                                        <td>박승용</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2024-</td>
                                        <td>이용철</td>
                                        <td>김소리</td>
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
                                        <td>김기창</td>
                                        <td>전인기</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1985-1990</td>
                                        <td>김기창</td>
                                        <td>박경옥</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1991-1995</td>
                                        <td>김영표</td>
                                        <td>원영호</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>1996-2012</td>
                                        <td>김영표</td>
                                        <td>최인선</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2012-2013</td>
                                        <td>김영표</td>
                                        <td>최인선</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2013-2014</td>
                                        <td>진헌성</td>
                                        <td>원영호</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2014-2016</td>
                                        <td>최인선</td>
                                        <td>원영호</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>2016-2018</td>
                                        <td>원영호</td>
                                        <td>양은석</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2018-2019</td>
                                        <td>원영호</td>
                                        <td>김원영</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2019-2021</td>
                                        <td>이승철</td>
                                        <td>김원영</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>2022-2024</td>
                                        <td>김원영</td>
                                        <td>고영일</td>
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
                                        <td>서순봉</td>
                                        <td>이강혁</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1984-1985</td>
                                        <td>송준영</td>
                                        <td>이강혁</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1986-1989</td>
                                        <td>성창섭</td>
                                        <td>이상흔</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>1990-1991</td>
                                        <td>정상립</td>
                                        <td>강임주</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>1992-1993</td>
                                        <td>신동학</td>
                                        <td>윤덕구</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>1994-1995</td>
                                        <td>김중광</td>
                                        <td>김영성</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>1996-1997</td>
                                        <td>김능수</td>
                                        <td>이종명</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>1998-2000</td>
                                        <td>이종명</td>
                                        <td>이병주</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2001-2004</td>
                                        <td>강임주</td>
                                        <td>이종명</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2005-2006</td>
                                        <td>윤덕구</td>
                                        <td>현명철</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>2007-2010</td>
                                        <td>김도원</td>
                                        <td>현명철</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>2011-2013</td>
                                        <td>정혜리</td>
                                        <td>박혜진</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>2013-2015</td>
                                        <td>정진홍</td>
                                        <td>진현정</td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>2015-2017</td>
                                        <td>이종명</td>
                                        <td>김수정</td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>2017-2019</td>
                                        <td>현명철</td>
                                        <td>김수정</td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>2019-2021</td>
                                        <td>최성민</td>
                                        <td>김수정</td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>2021-2022</td>
                                        <td>김용대</td>
                                        <td>김수정</td>
                                    </tr>
                                    <tr>
                                        <td>18</td>
                                        <td>2023-2024</td>
                                        <td>최귀애</td>
                                        <td>정창규</td>
                                    </tr>
									<tr>
                                        <td>18</td>
                                        <td>2025-2027</td>
                                        <td>서영익</td>
                                        <td>정지웅</td>
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
                                        <td>신종우</td>
                                        <td>고한진</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1984-1987</td>
                                        <td>신종우</td>
                                        <td>최양숙</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1987-1988</td>
                                        <td>신영기</td>
                                        <td>조병우</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>1988-1991</td>
                                        <td>이종담</td>
                                        <td>정상건</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>1991-1994</td>
                                        <td>조중환</td>
                                        <td>김도섭</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>1994-2000</td>
                                        <td>박순규</td>
                                        <td>오무영</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2000-2002</td>
                                        <td>유태현</td>
                                        <td>오무영</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>2003-2004</td>
                                        <td>고한진</td>
                                        <td>오무영</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2005-2006</td>
                                        <td>김도섭</td>
                                        <td>박희주</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2006-2009</td>
                                        <td>조병우</td>
                                        <td>이수걸, 박혜경</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>2010-2011</td>
                                        <td>오무영</td>
                                        <td>박혜경</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>2011-2013</td>
                                        <td>김성원</td>
                                        <td>이수걸</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>2013-2015</td>
                                        <td>김경이</td>
                                        <td>정이영</td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>2015-2017</td>
                                        <td>박희주</td>
                                        <td>정이영</td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>2017-2019</td>
                                        <td>구수권</td>
                                        <td>김희규</td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>2019-2022</td>
                                        <td>정이영</td>
                                        <td>남영희</td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>2022-2024</td>
                                        <td>정진아</td>
                                        <td>박찬선</td>
                                    </tr>
									<tr>
                                        <td>17</td>
                                        <td>2025-2027</td>
                                        <td>조규섭</td>
                                        <td>이승은</td>
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
