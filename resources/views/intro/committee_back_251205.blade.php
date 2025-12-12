@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
        <div class="sub-tab-con js-tab-con" style="display: block;">
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
                                    <td></td>
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
        </div>
    </article>

@endsection

@section('addScript')
@endsection
