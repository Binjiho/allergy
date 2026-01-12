@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
			<div class="sub-tab-con js-tab-con committee-conbox" style="display: block;">
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
					<li><a href="#n">재무위원회</a></li>
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
                                <td>유진호</td>
                                <td>울산의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김주희</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>정경욱</td>
                                <td>아주의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김미애</td>
                                <td>차의대 분당</td>
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
                                <td>김정현</td>
                                <td>순천향의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>반가영</td>
                                <td>한림의대</td>
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
                                <td>이화영</td>
                                <td>가톨릭의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김경훈</td>
                                <td>서울의대 분당</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>윤지선</td>
                                <td>울산의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>류광희</td>
                                <td>성균관의대</td>
                                <td>이비인후과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이동훈</td>
                                <td>서울의대</td>
                                <td>피부과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">학술위원회 업무규정</h4>
                        <ol class="list-type list-type-decimal type2">
                            <li>
                                <strong>명칭</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        본 위원회는 대한천식알레르기학회 학술위원회(이하 위원회)라 칭한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>목적</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        본 위원회는 대한천식알레르기학회의 학술대회 운영과 관련된 업무를 관장하는데 있다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>구성</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        본 위원회는 다음과 같이 구성한다.
                                        <ul class="list-type list-type-text">
                                            <li>
                                                <span>1)</span>
                                                <div>위원장: 대한천식알레르기학회 학술이사는 본 위원회를 대표하여 위원장이 되며, 대한천식알레르기학회 이사장이 임명한다. 위원장의 임기는 2년이다.</div>
                                            </li>
                                            <li>
                                                <span>2)</span>
                                                <div>위원: 위원장이 위원회를 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.</div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>업무</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        본 위원회의 목적을 달성하기 위하여 다음과 같은 업무를 관장한다.
                                        <ul class="list-type list-type-text">
                                            <li>
                                                <span>1)</span>
                                                <div>대한천식알레르기학회의 춘계 및 추계학술대회 프로그램 구성 및 운영 (별첨1, 별첨2)</div>
                                            </li>
                                            <li>
                                                <span>2)</span>
                                                <div>대한천식알레르기학회가 참여하는 공동학술모임(예: Airway symposium) 의 프로그램 구성 및 운영</div>
                                            </li>
                                            <li>
                                                <span>3)</span>
                                                <div>외국학회(예: JSA) 혹은 국제공동학술대회 조직위원회(예: EAAS) 의 요청이 있을 경우 대한천식알레르기학회의 연자 추천</div>
                                            </li>
                                            <li>
                                                <span>4)</span>
                                                <div>소오 우수논문상 및 청산 우수논문상 선정</div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>위원장의 업무</strong>
                                <ul class="list-type list-type-bar">
                                    <li>위원장은 본 위원회를 대표하여 위원회를 소집하며, 위원의 추천권을 갖는다.</li>
                                </ul>
                            </li>
                            <li>
                                <strong>보고의무</strong>
                                <ul class="list-type list-type-bar">
                                    <li>위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.</li>
                                </ul>
                            </li>
                        </ol>

                        <strong class="term-tit fz-big">
                            별첨1. 춘계학술대회 관련 업무
                        </strong>
                        <ol class="list-type list-type-decimal type2">
                            <li>
                                <strong>형식</strong>
                                <ul class="list-type list-type-bar">
                                    <li>2017년부터 춘계학술대회는 매년 국제학술대회로 준비한다.</li>
                                    <li>
                                        국내 개최 국제학술대회
                                        <ul class="list-type list-type-square">
                                            <li>
                                                국제학술대회의 요건을 맞추기 위해서는 좌장, 연자 및 토론자를 제외한 참석자 중 외국인의 숫자가 최소한 5개국 이상의 국가에서 50명 이상이 되어야 한다. 
                                            </li>
                                            <li>
                                                국내 거주 외국인 연구원 및 외국으로부터의 young investigators 참석이 필수적이며, 이를 위    해서는 학술 프로그램의 조기 완성 및 홍보, travel grant 제공 등이 이루어져야 한다.
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>일시 및 장소</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        매년 5월에 서울에서 개최한다. 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>구성</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        춘계학술대회는 2일간 개최한다.
                                    </li>
                                    <li>
                                        춘계학술대회는 2년마다 KAAACI-WPAS-INTERASMA Joint Congress의 형식으로 준비하기로 하였으나 2019년부터는 이사장과 상의 하여 진행하기로 한다.
                                    </li>
                                    <li>
                                        춘계학술대회에는 3년마다 EAAS (East Asia Allergy Symposium)을 포함하여 준비하기로 하였으나 2019년부터는 이사장과 상의 하여 진행하기로 한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>프로그램 준비</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        학술프로그램은 학술위원회에서 준비하며, 늦어도 학술대회 개최 6개월 전에는 홍보를 시작할 수 있도록 한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>연자</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        성공적인 학술대회 개최를 위해 국내외 저명한 연자를 섭외한다.
                                    </li>
                                    <li>
                                        EAACI Speaker Support Program
                                        <ul class="list-type list-type-square">
                                            <li>
                                                EAACI와 KAAACI 간의 협약을 통해 EAACI Speaker Support Program 지원을 받을 수 있으며, 1년에 2명의 연자를 EAACI로 부터 초청할 수 있다.
                                            </li>
                                            <li>
                                                EAACI에 대한 연자 신청은 매년 9월까지는 해야 한다
                                            </li>
                                            <li>
                                                EAACI로부터 초청한 연자에 대해서는 EAACI가 항공료를 부담하며, 국내 숙박 및 여비, honorarium 등은 KAAACI에서 부담한다.
                                            </li>
                                            <li>
                                                EAACI로부터 초청한 연자는 2회 강의를 해야 하며, KAAACI는 인쇄물에 ‘The travel grant for the speaker was kindly provided by EAACI according to EAACI-KAAACI speaker support program.’라고 기록하고 연자의 강의 앞 혹은 뒤에 EAACI speaker support program을 소개하는 시간을 마련함으로써 EAACI에 감사의 뜻을 표한다.
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        연자 초청은 학술위원회에서 하며, EAACI 연자의 경우 국제이사와의 긴밀한 협조를 통해 초청한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>우수연제 선정</strong>
                                <ul class="list-type list-type-bar">
                                    <li>학술위원회는 발표된 초록 중 최우수연제(구연) 2편, 우수연제(구연) 4편, 우수연제(포스터) 4편을 선정하여 학술대회 둘째날 오후에 시상하도록 한다.  </li>
                                </ul>
                            </li>
                            <li>
                                <strong>춘계학술대회 기간 중 시상</strong>
                                <ul class="list-type list-type-bar">
                                    <li>소오 우수논문상</li>
                                </ul>
                            </li>
                            <li>
                                <strong>학술대회 운영 관련 지원 업무</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        사전 등록, 초록 접수, 연자 및 좌장 초청, 원고 접수 등은 학회 사무국에서 지원한다.
                                    </li>
                                    <li>
                                        2021년 현재 인쇄물, 배너, 팜플렛 등의 제작 및 학술대회 운영은 '씨엠스'에서 맡는다.
                                    </li>
                                    <li>
                                        2021년 현재 모바일 앱 제작 및 등록 업무는 '엠투 커뮤니티'에서 맡는다.
                                    </li>
                                </ul>
                            </li>
                        </ol>

                        <strong class="term-tit fz-big">
                            별첨 2. 추계학술대회 관련 업무
                        </strong>
                        <ol class="list-type list-type-decimal type2">
                            <li>
                                <strong>형식</strong>
                                <ul class="list-type list-type-bar">
                                    <li>추계학술대회는 매년 국내학술대회로 준비한다. </li>
                                </ul>
                            </li>
                            <li>
                                <strong>일시 및 장소</strong>
                                <ul class="list-type list-type-bar">
                                    <li>매년 11월에 지방에서 개최한다. </li>
                                </ul>
                            </li>
                            <li>
                                <strong>구성</strong>
                                <ul class="list-type list-type-bar">
                                    <li>추계학술대회는 1일간 개최한다.</li>
                                </ul>
                            </li>
                            <li>
                                <strong>프로그램 준비</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        학술프로그램은 학술위원회에서 준비하며, 늦어도 학술대회 개최 6개월 전에는 완성한다.
                                    </li>
                                    <li>
                                        추계학술대회 프로그램에는 정년퇴임 기념강연을 포함시킬 수 있다. (전임 이사장, 전임 회장, 전임AARD 편집위원장, 전임AAIR 편집위원장)
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>연자</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        성공적인 학술대회 개최를 위해 국내외 저명한 연자를 섭외한다.
                                    </li>
                                    <li>
                                        연자 초청은 학술위원회에서 한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>추계학술대회 기간 중 시상</strong>
                                <ul class="list-type list-type-bar">
                                    <li>청산 우수논문상</li>
                                </ul>
                            </li>
                            <li>
                                <strong>학술대회 운영 관련 지원 업무</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        사전 등록, 연자 및 좌장 초청, 원고 접수 등은 학회 사무국에서 지원한다.
                                    </li>
                                    <li>
                                        2021년 현재 인쇄물, 배너, 팜플렛 등의 제작 및 학술대회 운영은 '씨엠스'에서 맡는다.
                                    </li>
                                    <li>
                                        2021년 현재 모바일 앱 제작 및 등록 업무는 '엠투 커뮤니티'에서 맡는다.
                                    </li>
                                </ul>
                            </li>
                        </ol>

                        <strong class="term-tit fz-big">
                            별첨 3. Airway Symposium 관련 업무
                        </strong>
                        <ol class="list-type list-type-decimal type2">
                            <li>
                                <strong>형식</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        대한천식알레르기학회(KAAACI)와 대한결핵 및 호흡기학회(KATRD)가 공동주최하는 국내학술대회로서 매년 1회 개최한다. 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>일시 및 장소</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        2017년부터 양 학회의 정기 학술대회와는 별도의 일정으로 독립된 장소에서 학술대회를 개최한다.
                                    </li>
                                    <li>
                                        일시와 장소는 양 학회의 협의에 의해 결정한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>구성</strong>
                                <ul class="list-type list-type-bar">
                                    <li>Airway Symposium은 0.5일간 개최한다.</li>
                                </ul>
                            </li>
                            <li>
                                <strong>프로그램 준비</strong>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        학술프로그램은 양 학회가 2년마다 번갈아가며 주도적으로 기획한다.
                                    </li>
                                    <li>
                                        심포지엄 준비를 위해 양 학회 이사장, 총무이사, 학술이사가 준비모임을 가지며, 일정, 장소 및 프로그램 구성을 위한 합의를 한다.
                                    </li>
                                    <li>
                                        프로그램은 주관학회의 학술위원회에서 준비하며, 늦어도 학술대회 개최 6개월 전에는 완성한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strnog>연자</strnog>
                                <ul class="list-type list-type-bar">
                                    <li>
                                        성공적인 학술대회 개최를 위해 국내외 저명한 연자를 섭외한다.
                                    </li>
                                    <li>
                                        연자 초청은 주관학회의 학술위원회에서 한다.
                                    </li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:학술위원회 -->

            <!-- s:간행위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>최정희</td>
                                <td>한림의대 동탄</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>양송이</td>
                                <td>한림의대 성심</td>
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
                                <td>순천향의대 서울</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>심지수</td>
                                <td>이대서울병원</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이상민</td>
                                <td>단국의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>정지웅</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>정창규</td>
                                <td>계명의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김민지</td>
                                <td>세종충남대병원</td>
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

                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">간행위원회 업무규정</h4>
                
                        <strong class="term-tit fz-big">
                            AARD 편집위원회 업무규정
                        </strong>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            ‘Asthma, Allergy and Respiratory Disease (AARD)’은 대한 소아알레르기 호흡기학회와 대한천식알레르기학회의 공식 국문 학술지이다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                이 규정은 대한 소아알레르기 호흡기학회와 대한천식알레르기학회에서 공식적으로 발간하는 AARD의 간행과 관련된 운영기준을 제시한다.
                            </li>
                            <li>
                                AARD 편집위원회 (이하 편집위원회)는 학회지가 최고 수준의 학회지가 될 수 있도록 운영한다.
                            </li>
                            <li>
                                편집위원회는 투고논문의 심사 등 제반 업무에 있어 ‘AARD 투고규정’을 따른다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장: 대한소아알레르기호흡기학회와 대한천식알레르기학회의 두 이사장이 동의하에 선임한 검증된 양 학회의 회원으로 학회지 간행과 관련된 제반 업무를 수행하며, 임기는 2년으로 3회까지 연임할 수 있다.
                            </li>
                            <li>
                                부편집위원장: 양쪽 학회의 간행이사를 부편집위원장으로 임명한다. 간행이사의 임기동안 역할을 수행한다. 편집위원장을 도와 학회지 간행과 관련된 제반업무를 수행한다.
                            </li>
                            <li>
                                편집위원: 편집위원장과 부편집위원장을 도와 학회지 간행과 관련된 제반 업무를 수행한다.
                                <p>
                                    편집위원장이 양쪽 학회 이사회의 재가를 거쳐 임명하며, 임기를 2년으로 한다. 학회지 간행과 관련된 논문접수, 책임편집, 심사, 발간 등의 실무를 담당한다.
                                </p>
                                <p>
                                    편집위원은 20명을 넘지 않는다.
                                </p>
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (업무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                논문심사
                                <ul class="list-type list-type-bar">
                                    <li>
                                        투고된 논문이 천식, 알레르기학, 소아호흡기학 및 이에 관련된 면역학 분야의 임상과 기초분야의 원고인지 확인하여 접수 여부를 결정한다.
                                    </li>
                                    <li>
                                        투고된 논문이 타 잡지에 게재되었거나 게재될 예정인지 확인한다. 만일 재출간에 해당된다면 Uniform Requirements for Manuscripts Submitted to Biomedical Journals (N Engl J Med 336:309-15, 1997)에서 규정한 요건을 갖추었는지 확인한다.
                                    </li>
                                    <li>
                                        투고된 논문의 종류가 종설, 특별원고, 논평, 원저 및 증례 등 학회지에서 정하는 형식에 적합한지 결정한다.
                                    </li>
                                    <li>
                                        학회지의 성격에 맞지 않는 주제이거나, 논문 점검사항을 정확히 이행하지 못한 경우는 심사하지 않고 저자에게 돌려보내어, 저자가 투고규정에 따라 논문을 재작성한 후에 다시 접수할 수 있도록 한다.
                                    </li>
                                    <li>
                                        투고된 논문은 편집위원장이 책임편집위원 1인에게 심사업무를 의뢰하고, 책임편집위원은 논문 1편당 2명 이상의 심사위원을 선정하여 심사를 의뢰한다. 심사를 맡게 된 책임편집위원은 다른 심사위원과 달리 특히 투고된 논문이 '투고규정'에 합당 한지를 필수적으로 판단한다.
                                    </li>
                                    <li>
                                        투고된 논문의 게재여부를 심사한다. 논문의 게재여부는 2명 이상의 심사자의 의견을 참고하여 편집위원장과 부편집위원장이 결정하고 이를 편집위원회 회의에서 확정 한다.
                                    </li>
                                    <li>
                                        논문심사의 의견에 따라 필요시에는 논문원고의 개정을 권유할 수 있고, 원문에 영향을 미치지 않는 범위 내에서 자구와 체제를 편집방침에 따라 논문 내용의 일부를 정정, 보완, 삭제할 수 있다.
                                    </li>
                                    <li>
                                        게제논문의 전체 혹은 일부 내용을 ‘AARD’ 외의 출판물 (컴퓨터 출판 포함)에 이용하려고 하는 경우 게재여부를 판정한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                학회지발간
                                <ul class="list-type list-type-bar">
                                    <li>
                                        학회지는 1, 4, 7, 10월 총 4번 매월 30일에 발간한다. (공휴일일 경우에는 다음 근무 일)에 발간한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                편집위원회 회의
                                <ul class="list-type list-type-bar">
                                    <li>
                                        편집위원회 회의는 3개월에 1회 개최하는 것을 원칙으로 하고 경우에 따라 임시 회의를 소집한다.
                                    </li>
                                    <li>
                                        적절한 학회지 발간을 위하여 투고된 원고에 대한 현황을 파악하고 이에 따른 조치를 아래의 각항의 원칙에 준하여 시행한다.
                                    </li>
                                    <li>
                                        종설의 주제는 6개월 전에 편집위원회에서 결정하며, 원고는 학회지 발간 3개월 전에 원고를 접수받고 1개월 전에 수정 완료된 원고를 준비한다.
                                    </li>
                                    <li>
                                        원저 및 증례는 학회지 발간 2개월 전에 게재결정을 하고, 학회지 발간 1개월 전에 수정 완료된 형태로 준비한다.
                                    </li>
                                    <li>
                                        논평은 게재가 결정된 원저에 대한 것을 원칙으로 하며, 학회지 발간 2개월 전에 논평을 작성할 저자를 선정하고 의뢰한다. 학회지 발간 1개월 전에 수정완료된 형태로 준비한다.
                                    </li>
                                    <li>
                                        특별원고의 경우 간행위의 결정에 따라 수시로 준비할 수 있으며, 학회지 발간 1개월 전에 수정완료된 형태로 준비한다.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                교육과 홍보
                                <ul class="list-type list-type-bar">
                                    <li>
                                        편집위원회는 학회지 발간과 관련된 교육과 홍보에 관한 제반 문제를 논의하여 결정하고 집행할 수 있다.
                                    </li>
                                </ul>
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 5 조 (운영예산)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                AARD 발간과 편집위원회 운영에 필요한 예산은 한국과학기술단체총연합회 학술지 발행 지원금, AARD 학술지 광고비, AARD 홈페이지 배너 광고비 그리고 양 학회 지원금으로 충당한다.
                            </li>
                            <li>
                                운영비 사용에 관해서는 매년 결산 보고서를 작성하여 양 학회 이사장님께 보고하고 감사를 받는다.
                            </li>
                            <li>
                                회계연도는 당해 연도 1월부터 12월까지로 한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (보고)</strong>
                        <p>
                            편집위원회의 모든 활동은 이사회에 보고하여 이사회의 인준을 얻어서 진행한다.
                        </p>
                
                        <strong class="term-tit fz-big">
                            AAIR 관련 업무규정
                        </strong>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            ‘Allergy, Asthma and Immunology Research (AAIR)’는 소아알레르기 호흡기학회와 대한천식알레르기학회의 공식 영문 학술지이다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                이 규정은 대한 소아알레르기 호흡기학회와 대한천식알레르기학회에서 공식적으로 발간하는 AAIR 간행과 관련된 간행위원회 업무 기준을 제시한다.
                            </li>
                            <li>
                                간행위원회는 AAIR 학회지가 최고 수준의 영문 학술지가 될 수 있도록 조력한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <p>
                            상임이사 중 간행이사가 위원회 위원장을 겸임하고, 위원회는 15명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                        </p>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (업무)</strong>
                        <p>
                            간행위원회는 AAIR 출판물 관련 교육과 홍보에 관한 제반 문제를 논의하여 결정하고 집행할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 6 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">
                            공통 부칙
                        </strong>
                
                        <ol class="list-type list-type-decimal">
                            <li>
                                편집위원회의 업무 규정의 변경은 양 학회 이사들의 협의를 거처 승인하게 이루어져야 하며 개정 날짜를 업무 규정에 표시한다.
                            </li>
                            <li>
                                이 기준서는 대한천식알레르기학회와 대한소아호흡기알레르기학회의 이사회로부터 승인을 득한 날부터 시행한다.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:간행위원회 -->

            <!-- s:교육위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>서동인</td>
                                <td>서울의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>박지수</td>
                                <td>서울의대</td>
                                <td>소아청소년과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">교육위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 교육위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회의 알레르기 교육강좌와 관련된 업무를 관장하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 교육이사가 위원회의 위원장을 겸임하고 위원회는 12명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                            <li>
                                위원은 알레르기 교육강좌의 프로그램 구성 및 운영에 참여한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-bar">
                            <li>알레르기 교육강좌의 프로그램 구성 및 운영 (별첨 1)</li>
                            <li>알레르기 교육강좌의 진행</li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2024년 0월 0일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                
                        <strong class="term-tit fz-big">별첨 1. 알레르기 교육강좌 관련 업무</strong>
                        <ol class="list-type list-type-decimal type2">
                            <li>
                                개최 일시 및 장소
                                <ul class="list-type list-type-bar">
                                    <li>매년 3월과 9월에 서울 또는 온라인으로 개최하는 것을 원칙으로 한다.</li>
                                </ul>
                            </li>
                            <li>
                                등록 및 연수평점
                                <ul class="list-type list-type-bar">
                                    <li>사전등록 및 당일등록 접수, 연수평점 부여는 학회에서 한다.</li>
                                </ul>
                            </li>
                            <li>
                                프로그램
                                <ul class="list-type list-type-text">
                                    <li>
                                        <span>1)</span>
                                        <div>
                                            원칙<br>
                                            천식, 알레르기 질환과 관련된 강의 주제를 선정하되 개원의에게 도움이 될 수 있는 주제를 우선적으로 선정하고 내과, 소아청소년과, 이비인후과 및 피부과 연자들 중에서 주제에 맞게 구성하는 것을 원칙으로 한다.
                                        </div>
                                    </li>
                                    <li>
                                        <span>2)</span>
                                        <div>
                                            구성<br>
                                            약 오전 9시부터 오후 4시까지 개최하며 30분 또는 40분 강의 7~8개를 원칙으로 한다.<br>
                                            프로그램 준비는 교육위원회에서 한 후 이사회의 의결 후 확정한다. 온라인의 경우 토요일 오후 2시부터 시작하여 6시 30분까지 진행할 수 있으며 강의 시간은 오프라인 강의 시간과 동일하다.<br>
                                            필수 평점 강의는 필요에 따라 포함할 수 있다.
                                        </div>
                                    </li>
                                    <li>
                                        <span>3)</span>
                                        <div>
                                            연자 섭외<br>
                                            내과, 소아청소년과, 이비인후과, 피부과의 저명한 연자들 중에서 선정된 강의 주제에 가장 적합한 연자를 1순위에서 3순위까지 정한 후 초청하는 것을 원칙으로 한다.
                                        </div>
                                    </li>
                                    <li>
                                        <span>4)</span>
                                        <div>
                                            준비 Time table
                                            <div class="table-wrap scroll-x touch-help mt-20 mb-20">
                                                <table class="cst-table">
                                                    <caption class="hide">준비 Time table</caption>
                                                    <colgroup>
                                                        <col style="width: 18%;">
                                                        <col>
                                                        <col>
                                                        <col>
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">일정</th>
                                                            <th scope="col">제목</th>
                                                            <th scope="col">구체일정</th>
                                                            <th scope="col">담당</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>d-3개월</td>
                                                            <td>프로그램 주제 논의</td>
                                                            <td>큰 틀과 주제 논의</td>
                                                            <td>교육위원회</td>
                                                        </tr>
                                                        <tr>
                                                            <td>d-11주</td>
                                                            <td>프로그램 주제 및 연자 구체화</td>
                                                            <td>구체적 프로그램 결정</td>
                                                            <td>교육위원회</td>
                                                        </tr>
                                                        <tr>
                                                            <td>d-10주</td>
                                                            <td>프로그램 주제 연자 확정(이사회 후)</td>
                                                            <td>이사회 통과 후 확정됨</td>
                                                            <td>교육이사</td>
                                                        </tr>
                                                        <tr>
                                                            <td>d-9주</td>
                                                            <td>연자 공문발송</td>
                                                            <td>강의록 요청 공문</td>
                                                            <td>학회</td>
                                                        </tr>
                                                        <tr>
                                                            <td>d-3주</td>
                                                            <td>강의록 제작</td>
                                                            <td>강의록 취합 및 교정</td>
                                                            <td>교육위원회, 학회</td>
                                                        </tr>
                                                        <tr>
                                                            <td>d-2주</td>
                                                            <td>역할 분담 및 최종 점검</td>
                                                            <td>당일 역할 분담</td>
                                                            <td>교육이사, 학회</td>
                                                        </tr>
                                                        <tr>
                                                            <td>D-day</td>
                                                            <td>교육강좌</td>
                                                            <td>교육강좌 진행</td>
                                                            <td>교육이사, 학회</td>
                                                        </tr>
                                                        <tr>
                                                            <td>d+2주</td>
                                                            <td>교육강좌 후 정리</td>
                                                            <td>정리사항 토의</td>
                                                            <td>교육위원회, 학회</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <span>5)</span>
                                        <div>
                                            진행<br>
                                            교육강좌 진행은 교육이사가 하는 것을 원칙으로 한다.
                                        </div>
                                    </li>
                                    <li>
                                        <span>6)</span>
                                        <div>
                                            개최 장소<br>
                                            개최 장소는 참석자들의 접근성이 용이한 곳으로 하며 사정에 따라 온라인으로 개최할 수 있다.
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                기록의 보관
                                <ul class="list-type list-type-bar">
                                    <li>교육강좌 등록과 참석인원 등 기록 자료는 학회에서 보관한다.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:교육위원회 -->

            <!-- s:홍보위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>허규영</td>
                                <td>고려의대 구로</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>반가영</td>
                                <td>한림의대</td>
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
                                <td>정수지</td>
                                <td>한림의대</td>
                                <td>내과</td>
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
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">홍보위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 법제위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 학회와 관련된 대외적인 법적 및 제도적 업무와 학회 내부적인 제도 및 규정 관련 업무를 관장하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 홍보이사가 위원회의 위원장을 겸임하고 위원회는 15명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>학회 홍보</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>보도자료 작성 및 배포</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>학회 홍보 매체의 운영과 관리 (소식지, 유투브, SNS 등)</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>언론사 및 기자단 관리</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2024년 0월 0일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:홍보위원회 -->

            <!-- s:연구위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>이용원</td>
                                <td>가톨릭관동의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강노을</td>
                                <td>성균관의대</td>
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
                                <td>반가영</td>
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
                                <td>정수지</td>
                                <td>한림의대</td>
                                <td>내과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">연구위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 연구위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 학회의 연구팀과 연구비 관련 업무를 관장하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 연구이사가 위원회의 위원장을 겸임하고 위원회는 학회 산하 각 연구팀장과 간사, 총무이사, 학술이사로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>연구팀 운영과 활동비 지원</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>대한천식알레르기학회 연구팀/지회/개인 연구비 지원</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>연구팀 활동 보고서 검토</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>대한천식알레르기학회 연구비 연구결과보고서 검토</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>연구팀 신설과 폐지</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>연구팀 심포지엄</div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>연구팀 관련 대외 자문</div>
                            </li>
                            <li>
                                <span>6)</span>
                                <div>연구팀 업무규정/대한천식알레르기학회 연구활동지원비 규정 관련 검토</div>
                            </li>
                            <li>
                                <span>8)</span>
                                <div>기타 연구팀 운영관련 제반 업무</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                
                        <p class="text-right">
                            제정 2024년 1월 13일
                        </p>
                    </div>
                </div>
            </div>
            <!-- //e:연구위원회 -->

            <!-- s:수련위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <th scope="row">수련이사</th>
                                <td>신유섭</td>
                                <td>아주의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>우성대</td>
                                <td>충남의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강성윤</td>
                                <td>가천의대 길병원</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김미애</td>
                                <td>차의대 분당차병원</td>
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
                                <td>심지수</td>
                                <td>이대서울병원</td>
                                <td>내과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">수련위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 수련위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            이 위원회는 학회의 전공의 및 임상강사의 수련에 관한 업무를 담당하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 수련 이사가 위원회 위원장을 겸임하고 위원회는 12명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고 시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>전공의 대상 알레르기 교육강좌 개최 (1회/년)</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>알레르기 분과전문의 지원자 확대 방안 수립</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2023년 10월 18일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:수련위원회 -->

            <!-- s:법제위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>민택기</td>
                                <td>순천향의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김정현</td>
                                <td>순천향의대 서울</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강민규</td>
                                <td>충북의대</td>
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
                                <td>박한기</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>윤정은</td>
                                <td>중앙의대</td>
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
                                <td>장재혁</td>
                                <td>아주의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>정창규</td>
                                <td>계명의대</td>
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
                                <td>김경훈</td>
                                <td>서울의대 분당</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김민지</td>
                                <td>세종충남대병원</td>
                                <td>소아청소년과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">법제위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 법제위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 학회와 관련된 대외적인 법적 및 제도적 업무와 학회 내부적인 제도 및 규정 관련 업무를 관장하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 법제이사가 위원회의 위원장을 겸임하고 위원회는 12명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>학회 관련 제도적, 법적 자문</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>학회에 의뢰된 의료사안 감정 및 자문</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>학회의 제도, 정관 및 규정 신설과 개정 관련 검토</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>기타 이사회의 규정 관련 요청 사항</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2023년 0월 0일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:법제위원회 -->

            <!-- s:기술위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>김경원</td>
                                <td>연세의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김윤희</td>
                                <td>연세의대 강남</td>
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
                                <td>단국의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>나민석</td>
                                <td>연세의대</td>
                                <td>이비인후과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>신정우</td>
                                <td>차의대 분당차병원</td>
                                <td>피부과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">기술위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 기술위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회의 비전을 실현하기 위한 핵심전략과제로 제시된 “신의료 치료기술의 개발”을 달성하기 위한 전략과 개발 방향을 수립하고 이를 회원들에게 전달하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 기술이사가 위원회의 위원장을 겸임하고 위원회는 10명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>알레르기 관련 신의료기술 관련 사업 평가 및 신청</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>알레르기 최신 논문 정리</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>디지털 헬스 대응</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>알레르기 의학용어 관리 및 업데이트</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:기술위원회 -->

            <!-- s:전산정보위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>강혜련</td>
                                <td>서울의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김경훈</td>
                                <td>서울의대 분당</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김정현</td>
                                <td>순천향의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>오지현</td>
                                <td>고신의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>윤정은</td>
                                <td>중앙의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>연동건</td>
                                <td>경희의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김진엽</td>
                                <td>동국의대 일산</td>
                                <td>이비인후과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>홍종수</td>
                                <td>동국의대 일산</td>
                                <td>피부과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">전산정보위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 전산정보위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회 홈페이지의 관리, 유지 및 업데이트 관련 업무를 담당하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 전산정보이사 이사가 위원회 위원장을 겸임하고 위원회는 12명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>학회 홈페이지(<a href="http://www.allergy.or.kr" target="_blank" class="link">http://www.allergy.or.kr</a>) 관리 및 원활한 유지</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>학회 홈페이지 보수 및 업데이트</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>학회 전산 자료 관리</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>기타 이사회의 홈페이지 관련 요청 사항</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2024년 1월 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:전산정보위원회 -->

            <!-- s:기획위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>정재우</td>
                                <td>중앙의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>강동윤</td>
                                <td>서울의대</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김수정</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김성렬</td>
                                <td>연세의대 용인세브란스</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이화영</td>
                                <td>가톨릭의대</td>
                                <td>내과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">기획위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 기획위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 학회의 발전 방안과 관련된 여러 가지 심사와 평가, 제안 관련 업무를 관장하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 기획이사가 위원회의 위원장을 겸임하고 위원회는 12명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>학회 발전 방안 및 신규사업 제안</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>학회의 각종 심사 및 평가, 업무 제안</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>기타 이사회의 요청에 따른 특별활동</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2023년 0월 0일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:기획위원회 -->

            <!-- s:보험위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>이상민</td>
                                <td>단국의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이소연</td>
                                <td>울산의대 서울아산</td>
                                <td>소아청소년과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">보험위원회 업무규정</h4>
                
                        <strong class="term-tit">제1조. 명칭</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 보험위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제2조. 목적</strong>
                        <p>
                            본 위원회는 학회와 관련된 제반 보험업무를 관장하며 학회 회원의 이익을 도모하는 데 있다.
                        </p>
                
                        <strong class="term-tit">제3조. 구성</strong>
                        <p>
                            상임이사 중 보험이사가 위원장을 겸임하고 위원회는 10명 이하로 구성하여, 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                        </p>
                
                        <strong class="term-tit">제 4조 임기</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제5조. 임원의 임무</strong>
                        <p>
                            위원장은 의원의 추천권을 가지며, 위원회를 대표하여 위원회를 소집하고 이사회에 참여하여 제반 업무를 총괄한다.
                        </p>
                        <p>
                            2. 간사는 위원장을 보좌하여 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                        </p>
                
                        <strong class="term-tit">제6조. 업무</strong>
                        <p>
                            본 위원회 목적을 달성하기 위하여 다음과 같은 업무를 관장한다.
                        </p>
                        <p>
                            의료보험 및 의료수가와 관련된 심의 및 검토
                        </p>
                        <p>
                            상위학회(내과학회 포함) 또는 유관단체(병원협회, 건강보험심사평가원, 등)의 업무협조
                        </p>
                        <p>
                            기타 보험 관련 사항
                        </p>
                
                        <strong class="term-tit">제7조. 회의</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 판단할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.<br>
                                (임시회의)
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며, 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제8조. 보고</strong>
                        <p>
                            위원회의 의결사항은 학회 이상장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2023년 0월 0일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:보험위원회 -->

            <!-- s:윤리위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>한두희</td>
                                <td>서울의대</td>
                                <td>이비인후과</td>
                            </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">윤리위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            이 위원회는 대한천식알레르기학회(이하 학회)의 윤리위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            이 위원회는 학회 및 회원의 윤리성을 고양시키고 회원이 준수해야 하는 의료윤리, 연구윤리, 출판윤리 및 기타 윤리와 관련된 문제들에 대한 해결방안을 제시하여 학회 업무의 정당성을 확보하고, 회원의 권익을 증진하고 회원 간의 상호 이해와 협조를 이루도록 한다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <p>
                            위원회는 다음과 같이 구성한다.
                        </p>
                        <ul class="list-type list-type-bar">
                            <li>
                                위원장: 대한천식알레르기학회 윤리이사는 본 위원회를 대표하여 위원장이 되며 대한천식알레르기학회 이사장이 임명한다.
                            </li>
                            <li>
                                위원: 10여명 내외의 위원을 위원장의 제청으로 대한천식알레르기학회 이사장이 임명한다.
                            </li>
                            <li>
                                간사: 윤리위원 중 위원장이 임명한다.
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원회의 위원장의 임기는 2년으로 하고, 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                위원장은 위원회를 대표하여 필요하다고 판단될 경우 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                위원장은 위원의 추천권을 갖는다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고 시 임무를 대행한다.
                            </li>
                            <li>
                                위원은 위원회의 논의에 따라 학회와 관련된 윤리 관련 사안을 심의하고 후속조치를 의결한다.
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>
                                    의료윤리
                                    <ul class="list-type list-type-bar">
                                        <li>회원대상 의료윤리 교육 및 홍보</li>
                                        <li>부적절한 의료 행위의 종류, 범위에 대한 심사 및 예방 대책 강구</li>
                                        <li>기타 의료윤리와 관련된 사항</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>
                                    출판윤리 및 연구윤리
                                    <ul class="list-type list-type-bar">
                                        <li>간행위원회와 협조하여 회원대상 출판윤리 교육과 홍보</li>
                                        <li>학회 학술지에 게재되는 논문에 대하여 편집위원회 요청 사항에 대한 자문 또는 심의</li>
                                        <li>학회 및 연구회 운영의 투명성과 공정성 관련 사항</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>
                                    기타 윤리 관련 사항
                                    <ul class="list-type list-type-bar">
                                        <li>이해 충돌과 부정행위 방지와 관련된 활동</li>
                                    </ul>
                                    <p>이사회의 위촉 사항</p>
                                    <ul class="list-type list-type-bar">
                                        <li>학회 및 회원의 품위를 저하시키는 비윤리적 상황 등에 대한 자문 또는 심의</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                일년에 1회 정기적으로 회의를 개최하며, 필요에 따라 위원장이 회의를 소집할 수 있다.
                            </li>
                            <li>
                                위원회는 재적위원 과반수의 출석으로 성립하고, 출석위원 과반수의 찬성으로 의결하며 가부 동수인 경우에는 위원장이 결정한다.
                            </li>
                            <li>
                                대면 회의가 원칙이나 위원장의 요구나 제반 여건에 따라 비대면 또는 온라인 회의도 가능하다.
                            </li>
                            <li>
                                위원회에서 논의되고 결정된 사항은 학회 이사회에 보고하여 승인을 받아 시행한다.
                            </li>
                            <li>
                                위원회의 위원이 심의 대상과 직접적인 이해관계가 있을 때에는 심의절차에서 제척된다.
                            </li>
                            <li>
                                위원회에서 심의, 의결된 기록은 처리 종료 시점을 기준으로 3년간 보존한다.
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 8 조 (심의 절차)</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                이사회 및 학회 위원회, 회원 혹은 비회원은 회원의 윤리 관련 사항을 위원회에 조사, 자문 또는 심의를 요청할 수 있다.
                            </li>
                            <li>
                                요청된 사항의 접수일로부터 만 5년 이전의 비윤리 관련 문제는 심의대상에 포함하지 않음을 원칙으로 한다.
                            </li>
                            <li>
                                위원회는 윤리문제를 논의하기 위하여 당해 회원 혹은 참고인 등을 위원회에 참석하게 하여 경위를 진술하도록 하거나 자료 제출을 요구할 수 있다.
                            </li>
                            <li>
                                윤리 관련 문제로 심의 대상이 된 회원에게 충분한 소명 기회를 주어야 한다.
                            </li>
                            <li>
                                위원회는 심의 사안에 대해 접수일로부터 60일 이내에 심의 의결하며, 결과를 심의 대상 회원에게 즉시 통보하고, 징계나 후속 조치가 필요시 위원회 의결일로부터 15일 이내에 이사회에 보고한다.
                            </li>
                            <li>
                                위원회의 결정이 부당하다고 판단되는 경우에 대상 회원은 위원회의 결정을 통보 받은 날로부터 15일 이내 위원회에 재심을 청구 할 수 있다.
                            </li>
                            <li>
                                재심을 청구한 날로부터 재심이 종료될 때까지 위원회의 결정은 자동으로 유예된다.
                            </li>
                            <li>
                                위원회는 기존의 심의 자료와 필요하면 추가정보를 요청하여 검토 후 최종 결정하며 필요시 위원회 의결일로부터 15일 이내에 이사회에 보고한다.
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 9조 (비밀유지의무)</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                심의 대상 회원에 대한 조사 및 심의 결과 등 일체 사항은 비밀로 해야 한다.
                            </li>
                            <li>
                                위원회의 심의 결정전까지 심의 대상의 신원 및 내용을 외부에 공개해서는 안된다.
                            </li>
                            <li>
                                심의 또는 조사절차에 참여한 자는 직무수행 중 알게 된 개인의 사생활 또는 비밀 등을 누설해서는 아니된다.
                            </li>
                        </ul>
                        <p>
                            비밀유지 의무는 그 직을 그만둔 경우에도 동일하게 적용된다.
                        </p>
                
                        <strong class="term-tit">제 10 조 (부칙)</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                이 규정에 규정되지 않은 사항은 위원회의 결정에 따른다.
                            </li>
                            <li>
                                이 규정은 학회 이사회에서 통과된 날로부터 유효하다.
                            </li>
                            <li>
                                이 규정의 수정이 필요한 경우 위원회 의결을 거쳐 이사회 승인을 받아야 한다.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- //e:윤리위원회 -->

            <!-- s:진료지침위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>김효빈</td>
                                <td>인하의대</td>
                                <td>소아청소년과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>성명순</td>
                                <td>순천향의대 구미</td>
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
                                <td>김미애</td>
                                <td>차의대 분당차병원</td>
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
                                <td>심다운</td>
                                <td>전남의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김경훈</td>
                                <td>서울의대 분당</td>
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
                                <td>지혜미</td>
                                <td>차의대 분당차병원</td>
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
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">진료지침위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 진료지침위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 학회의 공식문건인 진료지침에 관한 전반적 업무를 담당하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 진료지침 이사가 위원회 위원장을 겸임하고 위원회는 12명 이하로 구성하여 이사장의 인준을 받으며 간사는 위원 중에서 임명한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (임원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>학회 단독 또는 공동 진료지침 개발 계획수립과 관리</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>진료지침 개발 제안서 심사와 평가</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>진료지침 개발팀(Task Force, TF) 지원</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>개발완료 진료지침과 보고서 심사와 평가</div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>개발완료 진료지침의 보급과 홍보</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2023년 10월 18일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:진료지침위원회 -->

            <!-- s:대외협력위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <td>김세훈</td>
                                <td>서울의대 분당</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">간사</th>
                                <td>김정현</td>
                                <td>순천향의대 서울</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김병근</td>
                                <td>고려의대 안암</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>손경희</td>
                                <td>경희의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김환수</td>
                                <td>가톨릭의대 부천성모</td>
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
                                <td>홍종수</td>
                                <td>동국의대</td>
                                <td>피부과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">대외협력위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 대외협력위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 학회 및 회원의 대외협력 지원업무를 수행하고 학회 유관 타 분야 학술단체 및 기관, 국회 및 정부기관 등에 대한 소통, 의료 정책변화 대응, 각종 교류 프로그램 구성 및 지원, 학회 저작물 외부기관 사용 등 대외협력 업무와 관련한 실무 및 기타 대외협력 관련 업무를 조정, 지원하여, 학회와 회원의 대외협력을 증진하고 타 분야 유관 단체, 기관 및 대정부 관련 각종 교류활동을 지원하여 학회 발전에 이바지한다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <p>
                            본 위원회는 다음과 같이 구성한다.
                        </p>
                        <ul class="list-type list-type-bar">
                            <li>
                                위원장: 학회 대외협력이사는 본 위원회를 대표하여 위원장이 되며 학회 이사장이 임명한다.
                            </li>
                            <li>
                                위원: 10여명 내외의 위원을 위원장의 제청으로 학회 이사장이 임명한다.
                            </li>
                            <li>
                                간사: 위원회 위원 중 위원장 추천에 의해 이사장이 임명한다.
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                본 위원회의 위원장의 임기는 2년으로 하고, 연임할 수 있다.
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 5 조 (구성원의 임무)</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                위원장은 위원회를 대표하여 필요하다고 판단될 경우 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                위원장은 위원의 추천권을 갖는다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원회의 회의록을 작성, 보관하고 위원장 유고 시 임무를 대행한다.
                            </li>
                            <li>
                                위원은 위원회의 논의에 따라 본 학회와 관련된 대외협력 관련 사안을 심의하고 후속조치를 의결한다.
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 학회 및 회원의 대외협력 활동에 대한 지원업무를 관장한다.
                        </p>
                        <ol class="list-type list-type-decimal">
                            <li>
                                학회 유관 타 분야 학술단체 및 기관과의 각종 교류 프로그램 구성 및 지원
                            </li>
                            <li>
                                국회 및 정부기관 등에 대한 소통, 의료 정책변화 관련 대외협력 활동 지원
                            </li>
                            <li>
                                학회 저작물 외부기관 사용 등에 대한 평가 등 학회 대외협력 업무 지원
                                <ul class="list-type list-type-bar">
                                    <li>
                                        법제위원회와 관련 규정검토, 평가 및 실무 과정 협의 및 협력
                                    </li>
                                </ul>
                            </li>
                            <li>
                                기타 학회의 대외협력 업무와 관련한 실무 및 기타 대외협력 관련 업무를 조정, 지원
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                매년 1회 이상 정기적으로 회의를 개최하며, 필요에 따라 위원장이 회의를 소집할 수 있다.
                            </li>
                            <li>
                                위원회는 재적위원 과반수의 출석으로 성립하고, 출석위원 과반수의 찬성으로 의결하며 가부 동수인 경우에는 위원장이 결정한다.
                            </li>
                            <li>
                                회의 방식은 위원장의 요청이나 개최 시 상황을 고려하여 대면 또는 비대면으로 진행할 수 있다.
                            </li>
                            <li>
                                위원회에서 논의되고 결정된 사항은 학회 이사회에 보고하여 승인을 받아 시행한다.
                            </li>
                            <li>
                                위원회의 위원이 평가 또는 심의 대상과 직접적인 이해관계가 있을 때에는 심의절차에서 제척된다.
                            </li>
                            <li>
                                위원회에서 심의, 의결된 기록은 처리 종료 시점을 기준으로 3년간 보존한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (심의 절차)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                이사회 및 학회 위원회, 회원, 또는 대외협력 활동이 필요한 비회원은 대외협력 관련 사항을 위원회에 의뢰하여 관련 평가, 자문 또는 심의를 요청할 수 있다.
                            </li>
                            <li>
                                위원회는 대외협력 활동, 유관 타분야 단체 교류프로그램 등의 구성 등 관련 문제를 논의하거나 평가, 심의하기 위해 관련 회원 혹은 유관 비회원 등을 위원회에 참석하게 하여 대외협력 활동을 논의하거나 관련 기획, 자료 공유 등을 시행할 수 있다.
                            </li>
                            <li>
                                위원회는 대외협력 활동 관련 사항이나 학회 저작물 외부기관 사용 등에 대한 평가 등 학회 대외협력 업무 지원을 위한 제안 및 심의 사안에 대해 접수일로부터 60일 이내에 심의 의결하며, 결과를 위원회 의결일로부터 15일 이내에 이사회에 보고한다.
                            </li>
                            <li>
                                위원회는 기존의 제안, 평가 및 심의 자료에 대해 필요시 추가정보를 요청하여 검토 후 최종 결정하며 필요시 위원회 의결일로부터 15일 이내에 이사회에 보고한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 9조 (비밀유지의무)</strong>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>
                                    위원회는 구성원은 대외협력 활동 및 관련 심의, 평가 과정에서 보안 유지가 필요한 관련 자료 및 심의 결과 등에 대한 사항에 대한 비밀을 유지해야 한다.
                                </div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>
                                    대외협력 관련 심의 및 평가 과정에 참여한 위원은 직무수행 중 알게 된 개인의 사생활 또는 비밀 등을 누설해서는 아니된다. 비밀유지 의무는 그 직을 그만둔 경우에도 동일하게 적용된다.
                                </div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">부칙</strong>
                        <ul class="list-type list-type-bar">
                            <li>
                                본 규정에 규정되지 않은 사항은 위원회의 결정에 따른다.
                            </li>
                            <li>
                                본 규정은 본 학회 이사회에서 통과된 날로부터 유효하다.
                            </li>
                            <li>
                                본 규정의 수정이 필요한 경우 위원회 의결을 거쳐 이사회 승인을 받아야 한다.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- //e:대외협력위원회 -->

            <!-- s:국제위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
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
                                <th scope="row">국제이사</th>
                                <td>송우정</td>
                                <td>울산의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김민혜</td>
                                <td>이화의대</td>
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
                                <td>김정현</td>
                                <td>순천향의대 서울</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>원하경</td>
                                <td>충북의대</td>
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
                                <td>정지웅</td>
                                <td>경북의대</td>
                                <td>내과</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- //e:국제위원회 -->

            <!-- s:재무위원회 -->
            <div class="inner-tab-con js-inner-tab-con" style="display: none;">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">재무위원회</h4>
                </div>
                <div class="table-wrap scroll-x touch-help">
                    <table class="cst-table">
                        <caption class="hide">재무위원회</caption>
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
                                <th scope="row">재무이사</th>
                                <td>김상헌</td>
                                <td>한양의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>김태범</td>
                                <td>울산의대</td>
                                <td>내과</td>
                            </tr>
                            <tr>
                                <th scope="row">위원</th>
                                <td>이병재</td>
                                <td>성균관의대</td>
                                <td>내과</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="term-wrap">
                    <div class="term-conbox">
                        <h4 class="tit">재무위원회 업무규정</h4>
                
                        <strong class="term-tit">제 1 조 (명칭)</strong>
                        <p>
                            본 위원회는 대한천식알레르기학회(이하 학회)의 재무위원회(이하 위원회)라 칭한다.
                        </p>
                
                        <strong class="term-tit">제 2 조 (목적)</strong>
                        <p>
                            본 위원회는 학회의 재무에 관한 전반적 업무를 담당하여 학회 안정과 발전을 도모하는데 있다.
                        </p>
                
                        <strong class="term-tit">제 3 조 (구성)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                상임이사 중 재무이사가 위원회 위원장을 겸임한다.
                            </li>
                            <li>
                                위원회 위원은 총무이사를 포함하여 5명 이하로 구성하여 이사장의 인준을 받는다.
                            </li>
                            <li>
                                간사는 위원 중에서 1인을 임명할 수 있다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 4 조 (임기)</strong>
                        <p>
                            위원장과 위원의 임기는 2년으로 하고 연임할 수 있다.
                        </p>
                
                        <strong class="term-tit">제 5 조 (위원의 임무)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원장은 위원회를 대표하여 위원회를 소집하고 이사회에 참여하며 제반 업무를 총괄한다.
                            </li>
                            <li>
                                간사는 위원장을 보좌하며 위원장 유고시 임무를 대행한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 6 조 (업무)</strong>
                        <p>
                            위원회는 다음과 같은 업무를 관장한다.
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>제반 수입에 관한 사항</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>학회 사업에 필요한 경비 지출에 관한 사항</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>예산, 결산서 작성에 관한 사항</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>기타 이사회의 위촉 사항</div>
                            </li>
                        </ul>
                
                        <strong class="term-tit">제 7 조 (회의)</strong>
                        <ol class="list-type list-type-decimal">
                            <li>
                                위원회는 위원장이 필요하다고 인정할 때 또는 위원 3분의 1 이상의 요구가 있을 때 위원장이 소집한다.
                            </li>
                            <li>
                                위원회는 위원 과반수의 출석으로 성원되며 출석위원 과반수의 찬성으로 의결한다. 단, 가부동수일 때는 위원장이 결정한다.
                            </li>
                        </ol>
                
                        <strong class="term-tit">제 8 조 (보고)</strong>
                        <p>
                            위원회의 의결사항은 대한천식알레르기학회 이사장에게 보고하여 승인을 받은 후 시행한다.
                        </p>
                
                        <strong class="term-tit">부칙</strong>
                        <ol class="list-type list-type-decimal">
                            <li>본 규정에 명시되지 않은 사항은 위원회의 결정에 따른다.</li>
                            <li>본 규정은 2024년 1월 11일 이사회의 인준을 받은 때부터 유효하다.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- //e:재무위원회 -->
            </div>
    </article>

@endsection

@section('addScript')
@endsection
