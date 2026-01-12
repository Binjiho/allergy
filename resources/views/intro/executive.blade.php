@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="history-conbox">

                <div class="sub-tab-wrap">
                    <ul class="sub-tab-menu js-tab-menu">
                        <li class="{{ (request()->tab ?? '') == '' ? 'on' : '' }}"><a href="{{ route('intro.executive') }}">현 임원진</a></li>
                        <li class="{{ (request()->tab ?? '') == '2' ? 'on' : '' }}"><a href="{{ route('intro.executive',['tab'=>2]) }}">역대 임원진</a></li>
                      
                    </ul>
                </div>

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
                                <th scope="col">성명</th>
                                <th scope="col">소속</th>
                                <th scope="col">전공과목</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
								<th scope="row">회장</th>
								<td>장석일</td>
								<td>성애병원</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">차기 회장</th>
								<td>박중원</td>
								<td>연세의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">이사장</th>
								<td>임대현</td>
								<td>인하의대</td>
								<td>소아청소년과</td>
							</tr>
							<tr>
								<th scope="row">총무이사</th>
								<td>김태범</td>
								<td>울산의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">학술이사</th>
								<td>유진호</td>
								<td>울산의대</td>
								<td>소아청소년과</td>
							</tr>
							<tr>
								<th scope="row">재무이사</th>
								<td>김상헌</td>
								<td>한양의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">간행이사</th>
								<td>최정희</td>
								<td>한림의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">교육이사</th>
								<td>서동인</td>
								<td>서울의대</td>
								<td>소아청소년과</td>
							</tr>
							<tr>
								<th scope="row">국제이사</th>
								<td>송우정</td>
								<td>울산의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">보험이사</th>
								<td>정재원</td>
								<td>인제의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">수련이사</th>
								<td>신유섭</td>
								<td>아주의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">연구이사</th>
								<td>이용원</td>
								<td>가톨릭관동의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">전산정보이사</th>
								<td>강혜련</td>
								<td>서울의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">법제이사</th>
								<td>민택기</td>
								<td>순천향의대</td>
								<td>소아청소년과</td>
							</tr>
							<tr>
								<th scope="row">홍보이사</th>
								<td>허규영</td>
								<td>고려의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">윤리이사</th>
								<td>한두희</td>
								<td>서울의대</td>
								<td>이비인후과</td>
							</tr>
							<tr>
								<th scope="row">진료지침이사</th>
								<td>김효빈</td>
								<td>인하의대</td>
								<td>소아청소년과</td>
							</tr>
							<tr>
								<th scope="row">기술이사</th>
								<td>김경원</td>
								<td>연세의대</td>
								<td>소아청소년과</td>
							</tr>
							<tr>
								<th scope="row">대외협력이사 / 부종무</th>
								<td>김세훈</td>
								<td>서울의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">기획이사</th>
								<td>정재우</td>
								<td>중앙의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">무임소이사</th>
								<td>이병재</td>
								<td>성균관의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">무임소이사</th>
								<td>김철우</td>
								<td>인하의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">무임소이사</th>
								<td>박용민</td>
								<td>건국의대</td>
								<td>소아청소년과</td>
							</tr>
							<tr>
								<th scope="row">무임소이사</th>
								<td>손명현</td>
								<td>연세의대</td>
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
								<td>문지용</td>
								<td>건국의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">감사</th>
								<td>김상훈</td>
								<td>을지의대</td>
								<td>내과</td>
							</tr>
							<tr>
								<th scope="row">감사</th>
								<td>김선태</td>
								<td>가천의대</td>
								<td>이비인후과</td>
							</tr>

                        </tbody>					
                    </table>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
