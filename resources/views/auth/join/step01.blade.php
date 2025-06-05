@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox signup-conbox inner-layer">
            <div class="bg-box signup-info-box">
                <strong>
                    대한천식알레르기학회 회원님의 개인정보보호를 위해 최선을 다하고 있습니다. <br>
                    회원님의 정보는 동의 없이 공개되지 않으며, 개인정보취급방침 가이드에 맞춰 보호 받고 있습니다.
                </strong>
            </div>

            <div class="step-list-wrap type2">
                <ol class="step-list">
                    <li class="on">
                        <span class="icon"></span>
                        <span class="tit">01. 약관동의</span>
                    </li>
                    <li>
                        <span class="icon"></span>
                        <span class="tit">02. 기본정보 입력</span>
                    </li>
                    <li>
                        <span class="icon"></span>
                        <span class="tit">03. 상세정보 입력</span>
                    </li>
                    <li>
                        <span class="icon"></span>
                        <span class="tit">04. 부가정보 입력</span>
                    </li>
                    <li>
                        <span class="icon"></span>
                        <span class="tit">05. 가입 완료</span>
                    </li>
                </ol>
            </div>

            <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($sid) ? $sid : '' }}" data-case="join-step1">
                <input type="hidden" name="step" value="{{ request()->step ?? '' }}" readonly>

                <fieldset>
                    <legend class="hide">약관동의</legend>
                    <div class="sub-tit-wrap">
                        <h3 class="sub-tit">개인정보취급방침</h3>
                    </div>
                    <div class="term-wrap scroll-y">
                        <div class="term-conbox">
                            <ol class="list-type list-type-decimal">
                                <li>
                                    <strong>수집하는 개인정보의 항목 및 수집방법</strong>
                                    <p>
                                        대한천식알레르기학회는 고객센터, 고객상담 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>이름, 근무처명, 이메일, 전화번호, 팩스번호, 로그인ID, 비밀번호 또한 서비스 이용과정이나 사업 처리 과정에서 아래와 같은 정보들이 생성되어 수집될 수 있습니다.</li>
                                        <li>서비스 이용기록, 접속 로그, 접속 IP 정보, 쿠키</li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>개인정보의 수집 및 이용목적</strong>
                                    <p>
                                        대한천식알레르기학회는 다음과 같은 방법으로 개인정보를 수집합니다.
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>고객센터, 고객상담 게시판</li>
                                    </ul>
                                    <p>
                                        대한천식알레르기학회는 수집한 개인정보를 다음의 목적을 위해 활용합니다.
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>서비스 요청 내역에 대한 처리 및 보고, 고객상담에 대한 답변</li>
                                        <li>마케팅 및 광고에 활용
                                            <ul class="list-type list-type-bar">
                                                <li>고객상담 이용에 대한 신규 서비스(제품) 개발 정보 전달</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>개인정보 제공 및 공유</strong>
                                    <p>
                                        대한천식알레르기학회는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우</li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>수집한 개인정보의 취급위탁</strong>
                                    <p>
                                        대한천식알레르기학회는 고객님의 동의없이 고객님의 개인정보 취급을 외부 업체에 위탁하지 않습니다. 향후 그러한 필요가 생길 경우, 위탁 대상자와 위탁 업무 내용에 대해 고객님에게 통지하고 필요한 경우 사전 동의를 받도록 하겠습니다.
                                    </p>
                                </li>
                                <li>
                                    <strong>개인정보의 보유 및 이용기간</strong>
                                    <p>
                                        원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다. <br>
                                        &lt;내부 방침에 의한 정보보유 사유&gt;
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>
                                            로그인ID, 비밀번호, 근무처명, 이름, 이메일, 전화번호, 팩스번호
                                            <ul class="list-type list-type-bar">
                                                <li>보존 이유 : 고객 요청 작업에 대한 처리 및 보고 및 운영보고서 발송</li>
                                                <li>보존 기간 : 운영 계약 파기 시</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>개인정보 파기절차 및 방법</strong>
                                    <p>
                                        대한천식알레르기학회는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다. 파기절차 및 방법은 다음과 같습니다.
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>
                                            파기절차
                                            <ul class="list-type list-type-bar">
                                                <li>
                                                    회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어집니다. 동 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다.
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            파기방법
                                            <ul class="list-type list-type-bar">
                                                <li>
                                                    종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기하고
                                                </li>
                                                <li>
                                                    전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>이용자 및 법정대리인의 권리와 그 행사방법</strong>
                                    <p>
                                        이용자 및 법정 대리인은 언제든지 등록되어 있는 자신 혹은 당해 만14세 미만 아동의 개인정보를 조회하거나 수정할 수 있으며 가입해지를 요청할 수도 있습니다. <br><br>
                                        이용자 혹은 만 14세 미만 아동의 개인정보 조회·수정을 위해서는 ‘개인정보변경’(또는 ‘회원정보수정’ 등)을, 가입해지(동의철회)를 위해서는 “회원탈퇴”를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다. <br><br>
                                        혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체없이 조치하겠습니다. <br><br>
                                        귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체없이 통지하여 정정이 이루어지도록 하겠습니다. <br><br>
                                        혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체없이 조치하겠습니다. <br><br>
                                        대한천식알레르기학회는 이용자 혹은 법정 대리인의 요청에 의해 해지 또는 삭제된 개인정보는 “대한천식알레르기학회 이(가) 수집하는 개인정보의 보유 및 이용기간”에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <strong>개인정보 자동 수집 장치의 설치•운영 및 그 거부에 관한 사항</strong>
                                    <p>
                                        대한천식알레르기학회는 귀하의 정보를 수시로 저장하고 찾아내는 ‘쿠키(cookie)’, ‘세션(session)’ 등 개인정보를 자동으로 수집하는 장치를 설치·운용합니다. 쿠키란 대한천식알레르기학회 의 웹사이트를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 아주 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다. <br>
                                        대한천식알레르기학회는 다음과 같은 목적을 위해 쿠키 등을 사용합니다.
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>
                                            쿠키 등 사용 목적
                                            <ul class="list-type list-type-bar">
                                                <li>
                                                    회원과 비회원의 접속 빈도나 방문 시간 등을 분석, 이용자의 취향과 관심분야를 파악 및 자취 추적, 방문 회수 파악 등을 통한 개인 맞춤 서비스 제공
                                                    귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 귀하는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            쿠키 설정 거부 방법 <br>
                                            예: 쿠키 설정을 거부하는 방법으로는 회원님이 사용하시는 웹 브라우저의 옵션을 선택함으로써 모든 쿠키를 허용하거나 쿠키를 저장할 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수 있습니다. <br><br>
                                            설정방법 예(인터넷 익스플로어의 경우) <br>
                                            : 웹 브라우저 상단의 도구 &gt; 인터넷 옵션 &gt; 개인정보 <br>
                                            단, 귀하께서 쿠키 설치를 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    개인정보관리책임자
                                    <p>
                                        대한천식알레르기학회는 고객의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 관련 부서 및 개인정보관리책임자를 지정하고 있습니다.
                                    </p>
                                    <ul class="list-type list-type-dot">
                                        <li>
                                            개인정보관리책임자 <br>
                                            성명: 정춘희 <br>
                                            전화번호: <a href="tel:02-747-0528" target="_blank">02-747-0528</a> <br>
                                            이메일: <a href="mailto:korall@chol.com" targeet="_blank">korall@chol.com</a> <br>
                                            또는
                                        </li>
                                        <li>
                                            개인정보담당부서 <br>
                                            성명: 대한천식알레르기학회 사무국 <br>
                                            전화번호: <a href="tel:02-747-0528" target="_blank">02-747-0528</a> <br>
                                            이메일: <a href="mailto:korall@chol.com" target="_blank">korall@chol.com</a>
                                        </li>
                                    </ul>
                                    <p>
                                        귀하께서는 대한천식알레르기학회 의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자 혹은 담당부서로 신고하실 수 있습니다. 회사는 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다. <br><br>
                                        공고일자 : 2009년 07월 09일 <br>
                                        시행일자 : 2009년 07월 09일
                                    </p>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="checkbox-wrap cst">
                        <label class="checkbox-group" for="chk1">
                            <input type="checkbox" name="chk1" id="chk1"> 위 내용에 동의합니다.
                        </label>
                    </div>

                    <div class="sub-tit-wrap">
                        <h3 class="sub-tit">정관(定款)</h3>
                        <p class="text-help mt-10">* 회원 가입전에 아래 정관을 확인하시기 바랍니다.</p>
                    </div>
                    <div class="term-wrap scroll-y">
                        <div class="term-conbox">
                            <p class="tit">제 2장 회원</p>
                            <strong class="term-tit mt-0">제6조 (구성)</strong>
                            <p>
                                학회 회원은 정회원, 특별회원, 명예회원 및 준회원으로 구성한다.
                            </p>
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>①</span> <div>정회원은 천식, 알레르기 및 임상면역학 연구에 종사하고 있는 의사 또는 기초과학자로서 학회 정회원 1인 이상의 추천을 받아 평의원회의 심사, 승인을 받은 자로 한다.</div>
                                </li>
                                <li>
                                    <span>②</span> <div>특별회원은 학회의 발전을 위해 현저한 공헌을 한 단체로서 평의원회에서 심사, 승인받은 자로 한다.</div>
                                </li>
                                <li>
                                    <span>③</span> <div>명예회원은 학회의 발전을 위해 현저한 공헌을 한 개인으로서 평의원회에서 심사, 승인받은 자로 한다.</div>
                                </li>
                                <li>
                                    <span>④</span> <div>준회원은 천식, 알레르기 및 임상면역학 연구, 진료에 종사하고 있는 비의사로서 학회 평의원 1인 이상의 추천을 받아 평의원회의 심사, 승인을 받은 자로 한다.</div>
                                </li>
                            </ul>

                            <strong class="term-tit">제7조 (입회)</strong>
                            <p>
                                정회원과 준회원으로 입회를 원하는 자는 입회원서를 제출하고 입회비를 납부한 후 평의원회의 승인을 얻음으로써 회원의 자격을 획득한다.
                            </p>

                            <strong class="term-tit">제8조 (의무)</strong>
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>①</span> <div>회원은 학회의 회칙, 제 규정 및 제반 의결사항을 준수하여야 하며, 회비 또는 기타 부담금을 납부하여야 한다.</div>
                                </li>
                                <li>
                                    <span>②</span> <div>특별회원, 명예회원, 65세 이상 회원은 회비 납부를 면제받는다.</div>
                                </li>
                            </ul>

                            <strong class="term-tit">제9조 (권리)</strong>
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>①</span> <div>모든 회원은 학회에서 발행되는 학술지 및 공문을 받을 권리가 있다.</div>
                                </li>
                                <li>
                                    <span>②</span> <div>정회원은 총회의 의결권과 피선거권을 가진다.</div>
                                </li>
                            </ul>

                            <strong class="term-tit">제10조 (자격상실)</strong>
                            <p>
                                회원 중 탈퇴를 원하는 자, 학회의 목적에 위배되는 행위를 하는 자, 또는 회원으로서의 의무를 이행치 않은 자는 평의원회의 의결에 의하여 자격을 상실할 수 있다.
                            </p>
                        </div>
                    </div>
                    <div class="checkbox-wrap cst">
                        <label class="checkbox-group" for="chk2">
                            <input type="checkbox" name="chk2" id="chk2"> 위 내용에 동의합니다.
                        </label>
                    </div>

                    <div class="bg-box signup-info-box bg-blue">
                        <p class="tit">현재 학회 회원이 아니신 분은 회원서를 받아서 <span class="highlights">오프라인으로 입회를 한 후에</span> 온라인 회원 가입을 할 수 있습니다.</p>
                        위 정관을 참조하시어 아래 양식 중 알맞은 입회원서를 작성하셔서 입회신청을 해주시기 바랍니다.

                        <div class="btn-wrap text-center">
                            <a href="/assets/file/Membership_form_01.hwp" class="btn btn-type1 color-type2" download target="_blank">정회원 입회원서 다운로드 <span class="icon"><img src="/assets/image/sub/ic_btn_download.png" alt=""></span></a>
                            <a href="/assets/file/Membership_form_02.hwp" class="btn btn-type1 color-type3" download target="_blank">준회원 입회원서 다운로드 <span class="icon"><img src="/assets/image/sub/ic_btn_download.png" alt=""></span></a>
                        </div>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:;" onclick="$('#register-frm').submit();" class="btn btn-type1 color-type1">회원가입 <span class="icon"><img src="/assets/image/sub/ic_btn_join.png" alt=""></span></a>
                    </div>
                </fieldset>
            </form>
        </div>
</article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('auth.data') }}';

        defaultVaildation();

        $(form).validate({

            rules: {
                chk1: {
                    checkEmpty: true,
                },
                chk2: {
                    checkEmpty: true,
                },
            },
            messages: {
                chk1: {
                    checkEmpty: '개인정보취급방침에 동의해주세요.',
                },
                chk2: {
                    checkEmpty: '정관에 동의해주세요.',
                },
            },
            submitHandler: function () {

                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection