@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')
    
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap type2">
                <ul class="sub-tab-menu">
                    <li class="{{ (request()->tab ?? '') == '' ? 'on' : '' }}"><a href="{{ route('intro.executive') }}">현 임원진</a></li>
                    <li class="{{ (request()->tab ?? '') == '2' ? 'on' : '' }}"><a href="{{ route('intro.executive',['tab'=>2]) }}">역대 임원진</a></li>

                </ul>
            </div>
            <div class="history-contents">
                <div class="year-rolling-wrap">
                    <a href="#n" class="btn btn-year-arrow btn-year-prev js-prev"><span class="hide">이전</span></a>
                    <div class="year-rolling js-year">
                        <a href="#n" class="current"><span>2020년 ~ 2025년</span></a>
                        <a href="#n"><span>2012년 ~ 2019년</span></a>
                        <a href="#n"><span>2001년 ~ 2011년</span></a>
                        <a href="#n"><span>1990년 ~ 2000년</span></a>
						<a href="#n"><span>1972년 ~ 1989년</span></a>
                    </div>
                    <a href="#n" class="btn btn-year-arrow btn-year-next js-next"><span class="hide">다음</span></a>
                </div>

                <div class="history-rolling-wrap js-history-rolling">
                    <div class="history-wrap js-history-wrap">
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">2020년 ~ 2023년 이사회 명단</caption>
                                <thead>
                                <tr class="active">
                                    <th scope="col">직책</th>
                                    <th scope="col">2020-2021</th>
                                    <th scope="col">2022-2023</th>
                                    <th scope="col">2024-2025</th>
                                </tr>
                                </thead>
                                <tbody>
								<tr>
                                    <th scope="row" rowspan="2">회장</th>
                                    <td>이종명 (2020)</td>
                                    <td>조영주 (2022)</td>
                                    <td>이재서 (2024)</td>
                                </tr>
								<tr>
                                    <td>권순석 (2021)</td>
                                    <td>이용철 (2023)</td>
                                    <td>이숙영 (2025)</td>
                                </tr>
                                <tr>
                                    <th scope="row">이사장</th>
                                    <td>오재원</td>
                                    <td>지영구</td>
                                    <td>장안수</td>
                                </tr>
                                <tr>
                                    <th scope="row">총무</th>
                                    <td>이병재</td>
                                    <td>장윤석</td>
                                    <td>김상헌</td>
                                </tr>
								<tr>
                                    <th scope="row">부총무</th>
                                    <td>이재현, 김경원</td>
                                    <td>김경원, 송우정</td>
                                    <td>양민석, 민택기, 박상철</td>
                                </tr>
                                <tr>
                                    <th scope="row">학술</th>
                                    <td>김현희</td>
                                    <td>임대현</td>
                                    <td>김경원, 김세훈</td>
                                </tr>
                                <tr>
                                    <th scope="row">재무</th>
                                    <td>김철우</td>
                                    <td>이재현</td>
                                    <td>이병재</td>
                                </tr>
                                <tr>
                                    <th scope="row">간행</th>
                                    <td>박흥우</td>
                                    <td>박흥우</td>
                                    <td>송우정</td>
                                </tr>
                                <tr>
                                    <th scope="row">보험</th>
                                    <td>정재원</td>
                                    <td>정재원</td>
                                    <td>정재원</td>
                                </tr>
                                <tr>
                                    <th scope="row">법제</th>
                                    <td>김상훈</td>
                                    <td>최정희</td>
                                    <td>박용민</td>
                                </tr>
                                <tr>
                                    <th scope="row">홍보</th>
                                    <td>유진호</td>
                                    <td>박용민</td>
                                    <td>권재우</td>
                                </tr>
                                <tr>
                                    <th scope="row">교육</th>
                                    <td>김상헌</td>
                                    <td>이소연</td>
                                    <td>김효빈</td>
                                </tr>
                                <tr>
                                    <th scope="row">수련</th>
                                    <td>이상표</td>
                                    <td>이상표</td>
                                    <td>예영민</td>
                                </tr>
                                <tr>
                                    <th scope="row">기획</th>
                                    <td>박용민</td>
                                    <td>송대진</td>
                                    <td>허규영</td>
                                </tr>
                                <tr>
                                    <th scope="row">국제</th>
                                    <td>김태범</td>
                                    <td>김태범</td>
                                    <td>김태범</td>
                                </tr>
                                <tr>
                                    <th scope="row">기술</th>
                                    <td>손명현</td>
                                    <td>김동영</td>
                                    <td>손명현</td>
                                </tr>
                                <tr>
                                    <th scope="row">정보</th>
                                    <td>김동영</td>
                                    <td>김세훈</td>
                                    <td>전산정보: 김민혜</td>
                                </tr>
                                <tr>
                                    <th scope="row">대외협력</th>
                                    <td><!-- 임대현 -->장윤석</td>
                                    <td>장안수</td>
                                    <td>이용원</td>
                                </tr>
                                <tr>
                                    <th scope="row">연구</th>
                                    <td>남동호</td>
                                    <td>손명현</td>
                                    <td>최정희</td>
                                </tr>
                                <tr>
                                    <th scope="row">윤리</th>
                                    <td></td>
                                    <td>김철우</td>
                                    <td>김철우</td>
                                </tr>
                                <tr>
                                    <th scope="row">진료지침</th>
                                    <td></td>
                                    <td>김상헌</td>
                                    <td>서동인</td>
                                </tr>
                                <tr>
                                    <th scope="row">개원</th>
                                    <td><!-- 대외협력: 장윤석 --></td>
                                    <td></td>
                                    <td>이영목</td>
                                </tr>
                                <tr>
                                    <th scope="row">지회발전</th>
                                    <td></td>
                                    <td></td>
                                    <td>남동호</td>
                                </tr>
                                <tr>
                                    <th scope="row">무임소</th>
                                    <td>장안수, 오연목, 고영일, 안강모</td>
                                    <td>오연목, 안강모, 고영일, 김상하</td>
                                    <td>고영일, 안강모, 장윤석, 이준혁, 정이영, 문지용, 신현우</td>
                                </tr>
                                <tr>
                                    <th scope="row">감사</th>
                                    <td>지영구, 이재서</td>
                                    <td>김성완, 이숙영</td>
                                    <td>이상표, 심정연</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">2011년 ~ 2019년 이사회 명단</caption>
                                <thead>
                                <tr class="active">
                                    <th scope="col">직책</th>
                                    <th scope="col">2012-2013</th>
                                    <th scope="col">2014-2015</th>
                                    <th scope="col">2016-2017</th>
                                    <th scope="col">2018-2019</th>
                                </tr>
                                </thead>
                                <tbody>
								<tr>
                                    <th scope="row" rowspan="2">회장</th>
                                    <td>민경업 (2012)</td>
                                    <td>박춘식 (2014)</td>
                                    <td>김규한 (2016)</td>
									<td>최동철 (2018)</td>
                                </tr>
								<tr>
                                    <td>최인선 (2013)</td>
                                    <td>문희범 (2015)</td>
                                    <td>동헌종 (2017)</td>
									<td>이종명 (2019)</td>
                                </tr>
                                <tr>
                                    <th scope="row">이사장</th>
                                    <td>최병휘</td>
                                    <td>이혜란</td>
                                    <td>조상헌</td>
                                    <td>윤호주</td>
                                </tr>
                                <tr>
                                    <th scope="row">총무</th>
                                    <td>조영주</td>
                                    <td>박중원</td>
                                    <td>지영구</td>
                                    <td>장안수</td>
                                </tr>
								<tr>
                                    <th scope="row">부총무</th>
                                    <td></td>
                                    <td></td>
                                    <td>김상헌, 이소연</td>
									<td>깅상헌, 김경원</td>
                                </tr>
                                <tr>
                                    <th scope="row">학술</th>
                                    <td>이수영</td>
                                    <td>김철우</td>
                                    <td>안강모</td>
                                    <td>손명현</td>
                                </tr>
                                <tr>
                                    <th scope="row">재무</th>
                                    <td>이숙영</td>
                                    <td>이재서</td>
                                    <td>이수영</td>
                                    <td>안강모</td>
                                </tr>
                                <tr>
                                    <th scope="row">간행</th>
                                    <td>지영구</td>
                                    <td>지영구</td>
                                    <td>김철우</td>
                                    <td>김철우</td>
                                </tr>
                                <tr>
                                    <th scope="row">보험</th>
                                    <td>남동호</td>
                                    <td>정재원</td>
                                    <td>정재원</td>
                                    <td>정재원</td>
                                </tr>
                                <tr>
                                    <th scope="row">법제</th>
                                    <td>김성완</td>
                                    <td>임대현</td>
                                    <td>김현희</td>
                                    <td>이병재</td>
                                </tr>
                                <tr>
                                    <th scope="row">홍보</th>
                                    <td>장안수</td>
                                    <td>유광하</td>
                                    <td>박용민</td>
                                    <td>한만용</td>
                                </tr>
                                <tr>
                                    <th scope="row">교육</th>
                                    <td>김현희</td>
                                    <td>이수영</td>
                                    <td>장안수</td>
                                    <td>박용민</td>
                                </tr>
                                <tr>
                                    <th scope="row">수련</th>
                                    <td>안강모</td>
                                    <td>장안수</td>
                                    <td>이상표</td>
                                    <td>이상표</td>
                                </tr>
                                <tr>
                                    <th scope="row">기획</th>
                                    <td>박중원</td>
                                    <td>이병재</td>
                                    <td>임대현</td>
                                    <td>임대현</td>
                                </tr>
                                <tr>
                                    <th scope="row">국제</th>
                                    <td>윤호주</td>
                                    <td>오재원</td>
                                    <td>장윤석</td>
                                    <td>장윤석</td>
                                </tr>
                                <tr>
                                    <th scope="row">기술</th>
                                    <td>한만용</td>
                                    <td rowspan="2">한만용(기술정보)</td>
                                    <td rowspan="2">이병재</td>
                                    <td>남동호</td>
                                </tr>
                                <tr>
                                    <th scope="row">정보</th>
                                    <td>김윤근</td>
                                    <td>고영일</td>
                                </tr>
                                <tr>
                                    <th scope="row">대외협력</th>
                                    <td>유광하</td>
                                    <td>이상표</td>
                                    <td>모지훈</td>
                                    <td>김동영, 김상훈</td>
                                </tr>
                                <tr>
                                    <th scope="row">연구</th>
                                    <td>최동철</td>
                                    <td>김윤근</td>
                                    <td>남동호</td>
                                    <td>조유숙</td>
                                </tr>
								<!-- <tr>
                                    <th scope="row">개원</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>대외협력: 김동영</td>
                                </tr> -->
                                <tr>
                                    <th scope="row">의료</th>
                                    <td>임대현</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">무임소</th>
                                    <td>이종명, 이애영</td>
                                    <td>박해심, 윤호주</td>
                                    <td>김창근, 이재서, 윤호주, 유광하</td>
                                    <td>이용철, 지영구, 유광하 김현희</td>
                                </tr>
                                <tr>
                                    <th scope="row">감사</th>
                                    <td>나영호, 장석일</td>
                                    <td>권순석, 홍수종</td>
                                    <td>오재원, 조영주</td>
                                    <td>박중원, 이수영</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">2001년 ~ 2009년 이사회 명단</caption>
                                <thead>
                                <tr class="active">
                                    <th scope="col">직책</th>
                                    <th scope="col">2001-2003</th>
                                    <th scope="col">2004-2005</th>
                                    <th scope="col">2006-2007</th>
                                    <th scope="col">2008-2009</th>
                                    <th scope="col">2010-2011</th>
                                </tr>
                                </thead>
                                <tbody>
								<tr>
                                    <th scope="row" rowspan="3">회장</th>
                                    <td>김정원 (2001)</td>
                                    <td>김능수 (2004)</td>
                                    <td>민양기 (2006)</td>
                                    <td>박상학 (2008)</td>
									<td>이하백 (2010)</td>
                                </tr>
								<tr>
									
                                    <td>정덕희 (2002)</td>
                                    <td>홍천수 (2005)</td>
									<td>이양근 (2007)</td>
                                    <td>조중생 (2009)</td>
									<td>은희철 (2011)</td>
								</tr>
								<tr>
									<td>김유영 (2003)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
                                <tr>
                                    <th scope="row">이사장</th>
                                    <td>민양기</td>
                                    <td>박성학</td>
                                    <td>이상일</td>
                                    <td>이준성</td>
                                    <td>문희범</td>
                                </tr>
                                <tr>
                                    <th scope="row">총무</th>
                                    <td>문희범</td>
                                    <td>박춘식</td>
                                    <td>최병휘</td>
                                    <td>조상헌</td>
                                    <td>윤호주</td>
                                </tr>
								<!-- <tr>
                                    <th scope="row">부총무</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
									<td></td>
                                </tr> -->
                                <tr>
                                    <th scope="row">학술</th>
                                    <td>조상헌</td>
                                    <td>조상헌</td>
                                    <td>이혜란</td>
                                    <td>오재원</td>
                                    <td>나영호</td>
                                </tr>
                                <tr>
                                    <th scope="row">재무</th>
                                    <td>장태영</td>
                                    <td>이혜란</td>
                                    <td>최동철</td>
                                    <td>권순석</td>
                                    <td>장석일</td>
                                </tr>
                                <tr>
                                    <th scope="row">간행</th>
                                    <td>박해심</td>
                                    <td>오재원</td>
                                    <td>오재원</td>
                                    <td>홍수종</td>
                                    <td>홍수종</td>
                                </tr>
                                <tr>
                                    <th scope="row">보험</th>
                                    <td>조영주</td>
                                    <td>권순석</td>
                                    <td>권순석</td>
                                    <td>박중원</td>
                                    <td>이숙영</td>
                                </tr>
                                <tr>
                                    <th scope="row">법제</th>
                                    <td></td>
                                    <td>김성완</td>
                                    <td>동헌종</td>
                                    <td>동헌종</td>
                                    <td>이종명</td>
                                </tr>
                                <tr>
                                    <th scope="row">홍보</th>
                                    <td>권순석</td>
                                    <td>이재서</td>
                                    <td>나영호</td>
                                    <td></td>
                                    <td>조영주</td>
                                </tr>
                                <tr>
                                    <th scope="row">교육</th>
                                    <td>정지태</td>
                                    <td>박해심</td>
                                    <td>조상헌</td>
                                    <td>윤호주</td>
                                    <td>최동철</td>
                                </tr>
                                <tr>
                                    <th scope="row">수련</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>이수영</td>
                                </tr>
                                <tr>
                                    <th scope="row">기획</th>
                                    <td>김규언</td>
                                    <td>고영률</td>
                                    <td>박해심</td>
                                    <td>이혜란</td>
                                    <td>지영구</td>
                                </tr>
                                <tr>
                                    <th scope="row">국제</th>
                                    <td>편복양</td>
                                    <td>문희범</td>
                                    <td>문희범</td>
                                    <td>박해심</td>
                                    <td>박해심</td>
                                </tr>
                                <tr>
                                    <th scope="row">기술</th>
                                    <td></td>
                                    <td></td>
                                    <td>이재서</td>
                                    <td>지영구</td>
                                    <td>장용주</td>
                                </tr>
                                <tr>
                                    <th scope="row">정보</th>
                                    <td>김명남</td>
                                    <td>윤호주</td>
                                    <td>윤호주</td>
                                    <td>나영호</td>
                                    <td>박중원</td>
                                </tr>
                                <tr>
                                    <th scope="row">대외협력</th>
                                    <td>양준모</td>
                                    <td>최동철</td>
                                    <td>정지태</td>
                                    <td>최병휘</td>
                                    <td>오재원</td>
                                </tr>
                                <tr>
                                    <th scope="row">연구</th>
                                    <td>조중생</td>
                                    <td>김명남</td>
                                    <td>홍수종</td>
                                    <td>이용철</td>
                                    <td>조상헌</td>
                                </tr>
                                <tr>
                                    <th scope="row">개원</th>
                                    <td>이혜란</td>
                                    <td>나영호</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">의료</th>
                                    <td>이명현</td>
                                    <td>동헌종</td>
                                    <td></td>
                                    <td></td>
                                    <td>김현희</td>
                                </tr>
                                <tr>
                                    <th scope="row">무임소</th>
                                    <td>이철희</td>
                                    <td>이양근, 최병휘</td>
                                    <td>양준모</td>
                                    <td>문희범, 편복양, 장석일</td>
                                    <td>최병휘, 정지태, 김명남</td>
                                </tr>
                                <tr>
                                    <th scope="row">감사</th>
                                    <td>은희철, 이양근</td>
                                    <td>손병관, 김규한</td>
                                    <td>박춘식, 이종명</td>
                                    <td>김명남, 정지태</td>
                                    <td>최인선, 편복양</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="history-wrap js-history-wrap">
                        <div class="table-wrap scroll-x touch-help">
                            <table class="cst-table">
                                <caption class="hide">1990년 ~ 2000년 이사회 명단</caption>
                                <thead>
                                <tr class="active">
                                    <th scope="col">직책</th>
                                    <th scope="col">1990-1992</th>
                                    <th scope="col">1993-1994</th>
                                    <th scope="col">1995-1997</th>
                                    <th scope="col">1998-2000</th>
                                </tr>
                                </thead>
                                <tbody>
								<tr>
                                    <th scope="row" rowspan="3">회장</th>
                                    <td rowspan="3">이상용</td>
                                    <td rowspan="3">이유신</td>
                                    <td>손근찬 (1995)</td>
                                    <td>이기영 (1998)</td>
                                </tr>
								<tr>
									
                                    <td>신동학 (1996)</td>
                                    <td>조중환 (1999)</td>
								</tr>
								<tr>
									
                                    <td>김영표 (1997)</td>
                                    <td>윤혜선 (2000)</td>
								</tr>
                                <tr>
                                    <th scope="row">이사장</th>
                                    <td>이기영</td>
                                    <td>김정원</td>
                                    <td>김유영</td>
                                    <td>홍천수</td>
                                </tr>
                                <tr>
                                    <th scope="row">총무</th>
                                    <td>홍천수</td>
                                    <td>박성학</td>
                                    <td>민경업</td>
                                    <td>김규언</td>
                                </tr>
								<!-- <tr>
                                    <th scope="row">부총무</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
									<td></td>
                                </tr> -->
                                <tr>
                                    <th scope="row">학술</th>
                                    <td>김유영</td>
                                    <td>민경업</td>
                                    <td>박춘식</td>
                                    <td>최병휘</td>
                                </tr>
                                <tr>
                                    <th scope="row">재무</th>
                                    <td>은희철</td>
                                    <td>김홍직→김계정</td>
                                    <td>김동수</td>
                                    <td>김규한</td>
                                </tr>
                                <tr>
                                    <th scope="row">간행</th>
                                    <td>이상일</td>
                                    <td>이준성</td>
                                    <td>문희범</td>
                                    <td>박해심</td>
                                </tr>
                                <tr>
                                    <th scope="row">보험</th>
                                    <td>김능수</td>
                                    <td>이양근</td>
                                    <td>김진우</td>
                                    <td>최인선</td>
                                </tr>
                                <tr>
                                    <th scope="row">홍보</th>
                                    <td></td>
                                    <td>정덕희</td>
                                    <td>이철희</td>
                                    <td>이봉재</td>
                                </tr>
                                <tr>
                                    <th scope="row">교육</th>
                                    <td></td>
                                    <td>박춘식</td>
                                    <td>최병휘</td>
                                    <td>이하백</td>
                                </tr>
                                <tr>
                                    <th scope="row">감사</th>
                                    <td>김정원, 정덕희</td>
                                    <td>신동학, 문희범</td>
                                    <td>윤혜선, 조중환</td>
                                    <td>윤혜선, 김정원</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

					
					<div class="history-wrap js-history-wrap">
						<div class="table-wrap scroll-x touch-help">
							<table class="cst-table">
								<caption class="hide">1972년 ~ 1989년 이사회 명단</caption>
								<thead>
									<tr class="active">
										<th scope="col">구분</th>
										<th scope="col">1972-1973</th>
										<th scope="col">1974-1977</th>
										<th scope="col">1978-1980</th>
										<th scope="col">1981-1983</th>
										<th scope="col">1984-1986</th>
										<th scope="col">1987-1989</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">회장</th>
										<td>윤일선</td>
										<td>강석영</td>
										<td>강석영</td>
										<td>강석영</td>
										<td>강석영</td>
										<td>강석영</td>
									</tr>
									<tr>
										<th scope="row">부회장</th>
										<td>강석영</td>
										<td>이상용</td>
										<td>이상용</td>
										<td>이상용</td>
										<td>이상용</td>
										<td>이상용</td>
									</tr>
									<tr>
										<th scope="row">총무부장</th>
										<td>윤원식</td>
										<td></td>
										<td>김유영</td>
										<td>김유영</td>
										<td>김유영</td>
										<td>김유영</td>
									</tr>
									<tr>
										<th scope="row">학술부장</th>
										<td>이유신</td>
										<td></td>
										<td>이유신</td>
										<td>이유신</td>
										<td>이유신</td>
										<td>이기영</td>
									</tr>
									<tr>
										<th scope="row">감사</th>
										<td>서병설, 백만기</td>
										<td>서병설, 백만기</td>
										<td>문형노, 장가용</td>
										<td>문형노, 장가용</td>
										<td>장가용, 은희철</td>
										<td>장가용, 은희철</td>
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
