@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="revision">
                <img src="/assets/image/sub/img_revision.png" alt="">
                <div class="text-wrap">
                    <span>
                        1973년 11월 30일 제정
                    </span>
                    <span>
                        1987년 11월 28일 개정
                    </span>
                    <span>
                        1990년 12월 8일 개정
                    </span>
                    <span>
                        1992년 11월 13일 개정
                    </span>
                    <span>
                        1998년 11월 일 개정
                    </span>
                    <span>
                        1999년 11월 6일 개정
                    </span>
                    <span>
                        2002년 10월 12일 개정
                    </span><br>
                    <span>
                        2003년 11월 8일 개정
                    </span>
                    <span>
                        2005년 10월 29일 개정
                    </span>
                    <span>
                        2007년 11월 3일 개정
                    </span>
                    <span>
                        010년 11월 20일 개정
                    </span>
                    <span>
                        2012년 11월 15일 개정
                    </span>
                    <span>
                        2022년 11월 05일 개정
                    </span>
					<span class="active">
						2025년 11월 08일 개정
					</span>
                </div>
            </div>

            <div class="rule-move-wrap js-scroll-fixed">
                <button type="button" class="btn btn-arrow btn-first js-prev2"><span class="hide">처음</span></button>
                <button type="button" class="btn btn-arrow btn-prev js-prev"><span class="hide">이전</span></button>
                <div class="rule-move js-rule">
                    <a href="#rule01" class="current"><span>제 1장 총칙</span></a>
                    <a href="#rule02"><span>제 2장 회원</span></a>
                    <a href="#rule03"><span>제 3장 임원</span></a>
                    <a href="#rule04"><span>제 4장 회의</span></a>
                    <a href="#rule05"><span>제 5장 이사회</span></a>
                    <a href="#rule06"><span>제 6장 재정과 회계</span></a>
                    <a href="#rule07"><span>제 7장 사무기구</span></a>
                    <a href="#rule08"><span>제 8장 보칙</span></a>
                    <a href="#rule09"><span>제 9장 부칙</span></a>
                </div>
                <button type="button" class="btn btn-arrow btn-next js-next"><span class="hide">다음</span></button>
                <button type="button" class="btn btn-arrow btn-last js-next2"><span class="hide">마지막</span></button>
            </div>

            <div class="rule-wrap" id="rule01">
                <div class="term-tit-wrap">
                    <strong class="tit">제 1장 총칙</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제1조 (명칭)</strong>
                    <div class="rule-con">
                        <p>학회의 명칭은 대한천식알레르기학회(The Korean Academy of Asthma, Allergy and Clinical Immunology, KAAACI)라고 한다. 이하 '학회'라 칭한다.</p>
                    </div>

                    <strong class="rule-tit">제2조 (목적)</strong>
                    <div class="rule-con">
                        <p>학회의 목적은 국민보건 향상을 위해 천식, 알레르기 및 임상면역학 분야의 학문발전에 기여하는 데 있다.</p>
                    </div>

                    <strong class="rule-tit">제3조 (조직)</strong>
                    <div class="rule-con">
                        <p>학회의 본부는 서울에 두며, 지방에 지회를 둔다.</p>
                    </div>

                    <strong class="rule-tit">제4조 (사업)</strong>
                    <div class="rule-con">
                        <p>학회의 목적을 달성하기 위하여 다음과 같은 사업을 시행한다.</p>
                        <ol class="list-type list-type-decimal">
                            <li>
                                학술대회 개최
                            </li>
                            <li>
                                세미나, 심포지엄, 워크숍, 교육강좌 등 학술 집회 주관 또는 지원
                            </li>
                            <li>
                                학회지, 진료지침서 등 간행물 발간
                            </li>
                            <li>
                                연구사업 주관 또는 지원
                            </li>
                            <li>
                                국민 보건향상과 사회봉사에 관한 사업 주관 또는 지원
                            </li>
                            <li>
                                국내외 학술단체 교류 및 지원
                            </li>
                            <li>
                                회원 상호간의 친목, 경조 및 권익옹호에 관한 사항
                            </li>
                            <li>
                                기타 본 학회의 목적 달성에 부합한 사항
                            </li>
                        </ol>
                    </div>

                    <strong class="rule-tit">제5조 (학술대회)</strong>
                    <div class="rule-con">
                        <p>학술대회는 연 2회 춘계, 추계로 나누어 개최한다. 대면 학술대회 개최가 불가할 경우는 비대면 학술대회로 진행할 수 있다.</p>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule02">
                <div class="term-tit-wrap">
                    <strong class="tit">제2장 회원</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제6조 (구성)</strong>
                    <div class="rule-con">
                        <p>학회 회원은 정회원, 특별회원, 명예회원 및 준회원으로 구성한다.</p>
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    정회원은 천식, 알레르기 및 임상면역학 연구에 종사하고 있는 의사 또는 기초과학자로서 학회 정회원 1인 이상의 추천을 받아 평의원회의 심사, 승인을 받은 자로 한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    특별회원은 학회의 발전을 위해 현저한 공헌을 한 단체로서 평의원회에서 심사, 승인받은 자로 한다.
                                </div>
                            </li>
                            <li>
                                <span>③</span>
                                <div>
                                    명예회원은 학회의 발전을 위해 현저한 공헌을 한 개인으로서 평의원회에서 심사, 승인받은 자로 한다.
                                </div>
                            </li>
                            <li>
                                <span>④</span>
                                <div>
                                    준회원은 천식, 알레르기 및 임상면역학 연구, 진료에 종사하고 있는 비의사로서 학회 평의원 1인 이상의 추천을 받아 평의원회의 심사, 승인을 받은 자로 한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                    <strong class="rule-tit">제7조 (입회)</strong>
                    <div class="rule-con">
                        <p>정회원과 준회원으로 입회를 원하는 자는 입회원서를 제출하고 입회비를 납부한 후 평의원회의 승인을 얻음으로써 회원의 자격을 획득한다.</p>
                    </div>
                    <strong class="rule-tit">제8조 (의무)</strong>
                    <div class="rule-con">
                        <ul class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    회원은 학회의 회칙, 제 규정 및 제반 의결사항을 준수하여야 하며, 회비 또는 기타 부담금을 납부하여야 한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    특별회원, 명예회원, 65세 이상 회원은 회비 납부를 면제받는다.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <strong class="rule-tit">제9조 (권리)</strong>
                    <div class="rule-con">
                        <ul class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    모든 회원은 학회에서 발행되는 학술지 및 공문을 받을 권리가 있다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    정회원은 총회의 의결권과 피선거권을 가진다.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <strong class="rule-tit">제10조 (자격상실)</strong>
                    <div class="rule-con">
                        <p>
                            회원 중 탈퇴를 원하는 자, 학회의 목적에 위배되는 행위를 하는 자, 또는 회원으로서의 의무를 이행치 않은 자는 평의원회의 의결에 의하여 자격을 상실할 수 있다.
                        </p>
                    </div>
                    <strong class="rule-tit">제11조 (포상)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    학회는 회원으로서 회원의 의무를 다하고 학술활동, 학회발전, 사회봉사 등에 탁월한 업적을 이룬 회원을 포상할 수 있다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    포상의 종류와 내용은 별도의 규정을 두어 시행한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule03">
                <div class="term-tit-wrap">
                    <strong class="tit">제3장 임원</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제12조 (구성)</strong>
                    <div class="rule-con">
                        <p>학회는 다음과 같이 임원을 둔다.</p>
                        <ol class="list-type list-type-decimal">
                            <li>
                                회장
                            </li>
                            <li>
                                차기회장
                            </li>
                            <li>
                                이사장
                            </li>
                            <li>
                                차기이사장
                            </li>
                            <li>
                                이사
                            </li>
                            <li>
                                감사
                            </li>
                        </ol>
                    </div>
                    <strong class="rule-tit">제13조 (선출)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    회장, 차기 회장, 이사장, 차기 이사장과 감사는 평의원회에서 선출하여 총회의 인준을 받는다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    차기 회장과 차기 이사장은 임기 시작 1년 전에 선출한다.
                                </div>
                            </li>
                            <li>
                                <span>③</span>
                                <div>
                                    이사는 이사장이 추천하며, 이사장 임기 시작 전 평의원회의 승인을 받는다.
                                </div>
                            </li>
                        </ol>
                    </div>
                    <strong class="rule-tit">제14조 (임기 및 승계, 대행)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    회장의 임기는 1년, 이사장 및 감사의 임기는 2년으로 하며, 연임할 수 없다. 이사의 임기는 2년으로 한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    차기 회장과 차기 이사장은 회장 및 이사장 유고시에 그 직을 승계한다.
                                </div>
                            </li>
                            <li>
                                <span>③</span>
                                <div>
                                    임기 시작 1년 내 이사장의 유고시에는 차기 이사장 선출 전까지 총무이사가 그 직을 대행한다.
                                </div>
                            </li>
                            <li>
                                <span>④</span>
                                <div>
                                    임원의 임기는 당해 연도 1월 1일부터 시작한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                    <strong class="rule-tit">제15조 (임무)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    회장은 총회와 평의원회의 의장이 된다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    이사장은 학회 회무를 총괄하며 이사회를 주관한다.
                                </div>
                            </li>
                            <li>
                                <span>③</span>
                                <div>
                                    감사는 학회 회무 및 재무를 감사하고 평의원회와 총회에 보고한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule04">
                <div class="term-tit-wrap">
                    <strong class="tit">제 4장 평의원회</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제16조 (평의원의 자격 및 선출)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    대학 부교수 이상 또는 이에 상응하는 자격을 가진 정회원 중 이사장의 추천으로 평의원회에서 선출한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    지회장은 임기 동안 당연직 평의원이 된다.
                                </div>
                            </li>
                            <li>
                                <span>③</span>
                                <div>
									정당한 이유 없이 평의원회에 연속 5년 불참하면 자동적으로 평의원직을 상실한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                    <strong class="rule-tit">제17조 (회의 소집)</strong>
                    <div class="rule-con">
                        <p>
                            정기 평의원회는 정기총회 전에 회장이 소집하며, 임시 평의원회는 회장이 필요하다고 인정할 때, 또는 평의원 1/3 이상의 요구가 있을 때 회장이 소집한다.
                        </p>
                    </div>

                    <strong class="rule-tit">제18조 (임무)</strong>
                    <div class="rule-con">
                        <p>평의원회에서는 다음 사항을 심의, 의결한다.</p>
                        <ol class="list-type list-type-decimal">
                            <li>
                                회원 승인
                            </li>
                            <li>
                                임원 선출
                            </li>
                            <li>
                                평의원 선출
                            </li>
                            <li>
                                학회 사업계획 및 예결산 심의
                            </li>
                            <li>
                                총회에 제출할 사항
                            </li>
                            <li>
                                총회에서 위임된 사항
                            </li>
							<li>
								회칙 개정
							</li>
                            <li>
                                기타 필요한 사항
                            </li>
                        </ol>
                    </div>

                    <strong class="rule-tit">제19조 (의결)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    재적 평의원 과반수의 출석과 출석 평의원 과반수의 찬성으로 의결하며, 가부 동수일 때에는 의장이 결정한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    대면회의 개최가 불가할 경우는 비대면회의 개회로 결의하거나 서면결의로 진행할 수 있다.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule05">
                <div class="term-tit-wrap">
                    <strong class="tit">제 5장 총회</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제20조 (회의 소집)</strong>
                    <div class="rule-con">
                        <p>정기총회는 연 1회 소집하며, 임시총회는 회장이 필요하다고 인정할 때, 또는 평의원의 1/3 이상의 요구가 있을 때 회장이 소집한다.</p>
                    </div>

                    <strong class="rule-tit">제21조 (임무)</strong>
                    <div class="rule-con">
                        <p>
                            총회는 다음 사항을 의결 또는 인준한다.
                        </p>
                        <ol class="list-type list-type-decimal">
                            <li>
                                회칙 개정
                            </li>
                            <li>
                                평의원회 의결사항 인준
                            </li>
                            <li>
                                기타 평의원회에서 제출된 사항
                            </li>
                        </ol>
                    </div>

                    <strong class="rule-tit">제22조 (총회 의결)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
									총회는 출석 회원 과반수의 찬성으로 인준하며, 가부 동수일 때에는 의장이 결정한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    대면회의 개최가 불가할 경우는 비대면회의 개회로 결의하거나 서면결의로 진행할 수 있다.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule06">
                <div class="term-tit-wrap">
                    <strong class="tit">제 6장 이사회</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제23조 (구성)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    이사회는 이사장, 차기 이사장 및 이사로 구성한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    이사는 총무이사, 학술이사, 간행이사, 재무이사를 포함하여 25인 내외로 한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                    <strong class="rule-tit">제24조 (회의 소집)</strong>
                    <div class="rule-con">
                        <p>정기 이사회는 격월로 소집하며, 임시 이사회는 이사장이 필요하다고 인정할 때, 또는 이사 과반수의 요구가 있을 때 이사장이 소집한다.</p>
                    </div>
                    <strong class="rule-tit">제25조 (임무)</strong>
                    <div class="rule-con">
                        <p>이사회는 학회의 사업계획 및 예산을 집행한다.</p>
                    </div>
                    <strong class="rule-tit">제26조 (의결)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    재적이사 과반수의 출석과 출석이사 과반수의 찬성으로 의결한다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    대면회의 개최가 불가할 경우는 비대면회의 개회로 결의하거나 서면결의로 진행할 수 있다.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule07">
                <div class="term-tit-wrap">
                    <strong class="tit">제 7장 위원회 및 연구팀</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제27조 (위원회)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    이사회의 의결을 거쳐 상설 위원회와 임시위원회를 구성할 수 있다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    위원회의 위원장은 이사장이 임명하며, 임기는 2년으로 하고, 연임할 수 있다. 단, 임시위원회의 임기는 임무완료까지로 한다.
                                </div>
                            </li>
                            <li>
                                <span>③</span>
                                <div>
                                    위원회의 운영에 관한 사항은 따로 정한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                    <strong class="rule-tit">제28조 (연구팀)</strong>
                    <div class="rule-con">
                        <ol class="list-type list-type-text">
                            <li>
                                <span>①</span>
                                <div>
                                    이사회의 의결을 거쳐 학회 산하에 연구팀을 둘 수 있다.
                                </div>
                            </li>
                            <li>
                                <span>②</span>
                                <div>
                                    연구팀의 팀장은 이사장이 임명하며, 임기는 2년으로 하고, 연임할 수 있다.
                                </div>
                            </li>
                            <li>
                                <span>③</span>
                                <div>
                                    연구팀의 운영에 관한 사항은 따로 정한다.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule08">
                <div class="term-tit-wrap">
                    <strong class="tit">제 8장 재정</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제29조 (재정)</strong>
                    <div class="rule-con">
                        <p>학회의 재정은 회비 및 기타 수입금으로 충당한다.</p>
                    </div>
                    <strong class="rule-tit">제30조 (회계연도)</strong>
                    <div class="rule-con">
                        <p>학회의 회계연도는 총회일 익일로부터 차기 년도 총회일까지로 한다.</p>
                    </div>
                </div>
            </div>

            <div class="rule-wrap" id="rule09">
                <div class="term-tit-wrap">
                    <strong class="tit">제 9장 부칙</strong>
                </div>
                <div class="rule-conbox">
                    <strong class="rule-tit">제31조 (회칙변경)</strong>
                    <div class="rule-con">
                        <p>회칙은 평의원회의 의결 및 총회의 인준을 거쳐 변경할 수 있다.</p>
                    </div>
                    <strong class="rule-tit">제32조 (관례)</strong>
                    <div class="rule-con">
                        <p>회칙에 규정되어 있지 않은 사항은 일반 관례에 준한다.</p>
                    </div>
                    <strong class="rule-tit">제33조 (경과)</strong>
                    <div class="rule-con">
                        <p>개정된 임원의 임기는 회칙 개정 이후에 선출된 임원부터 적용한다.</p>
                    </div>
                    
                    <strong class="rule-tit">제34조</strong>
                    <div class="rule-con">
                        <p>회칙은 공표일로부터 시행한다.</p>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
