@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <ul class="write-wrap">
                <li>
                    <div class="form-tit">회원 가입일</div>
                    <div class="form-con">{{ $user->created_at ?? '' }}</div>
                </li>
                <li>
                    <div class="form-tit">최종 회원정보 수정일</div>
                    <div class="form-con">{{ $user->updated_at ?? '' }}</div>
                </li>
                <li>
                    <div class="form-tit">회원등급</div>
                    <div class="form-con">{{ $userConfig['level'][$user->level ?? ''] ?? '' }}</div>
                </li>
            </ul>
            <div class="btn-wrap text-right mt-30">
                <a href="{{ route('mypage.fee') }}" class="btn btn-type1 color-type6">회비납부</a>
                <a href="{{ route('mypage.withdraw') }}" class="btn btn-type1 color-type7">회원탈퇴</a>
            </div>

            <!-- s:회원가입 Form -->
            <div class="write-form-wrap">
                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($user->sid) ? $user->sid : '' }}" data-case="user-modify">
                    <input type="hidden" name="gubun" value="{{ request()->gubun ?? '' }}" readonly>

                    <fieldset>
                        <legend class="hide">회원가입</legend>

                        @include('auth.join.form.form2')
                        <div class="mt-40"></div>
                        @include('auth.join.form.form3')
                        <div class="mt-40"></div>
                        @include('auth.join.form.form4')

                        <div class="sub-tit-wrap">
                            <h3 class="sub-tit">자동화 프로그램 입력 방지</h3>
                        </div>
                        <p class="help-text text-red mb-10">*정보 보안을 위해 아래 적힌 문자를 입력하신 후 등록 가능합니다.</p>
                        <ul class="write-wrap">
                            <li>
                                <div class="form-con">
                                    @include('components.captcha')
                                </div>
                            </li>
                        </ul>

                        <div class="btn-wrap text-center">
                            <a href="{{ route('main') }}" class="btn btn-type1 color-type4">취소</a>
                            <button type="button" class="btn btn-type1 color-type1 modifyClass">수정</button>
                        </div>

                    </fieldset>
                </form>
            </div>
            <!-- //e:회원가입 Form -->
        </div>
    </article>
@endsection

@section('addScript')
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('auth.data') }}';

        //캡챠
        $(document).on('keyup', '#captcha_input', function() {
            const _captcha_input = $(this).val();
            callNoneSpinnerAjax(dataUrl, {
                'case': 'captcha-compare',
                'captcha_input': _captcha_input,
            });
        });

        //이메일 수정체크
        $(document).on('click', '#emailModify', function() {
           $("#email").attr("readonly", false);
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }

        function openDaumPostcode(kind){
            if( kind == "company" ){
                var space = "company_";
            }else{
                var space = "home_";
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    $(":text[name='"+space+"zipcode']").val(data.zonecode);
                    $(":text[name='"+space+"address']").val(data.address).focus();
                }
            }).open();
        }

        $(document).on('click','.modifyClass', function(){

            if (isEmpty($("#first_name").val())) {
                alert('성명(영문)을 입력해주세요.');
                $("#first_name").focus();
                return false;
            }
            if (isEmpty($("#last_name").val())) {
                alert('성명(영문)을 입력해주세요.');
                $("#last_name").focus();
                return false;
            }
            if (isEmpty($("#name_han").val())) {
                alert('성명(한자)를 입력해주세요.');
                $("#name_han").focus();
                return false;
            }

            if ($("input[name='is_national']:checked").length < 1) {
                alert('외국 국적 회원 여부를 선택해주세요.');
                $("input[name='is_national']").focus();
                return false;
            }
            if (isEmpty($("#birth_date").val())) {
                alert('생년월일을 입력해주세요.');
                $("#birth_date").focus();
                return false;
            }
            if ( $("#birth_date").val().length < 10){
                alert('생년월일을 입력해주세요.');
                $("#birth_date").focus();
                return false;
            }
            if (isEmpty($("#phone").val())) {
                alert('휴대전화번호를 입력해주세요.');
                $("#phone").focus();
                return false;
            }
            if (isEmpty($("#email").val())) {
                alert('E-Mail을 입력해주세요.');
                $("#email").focus();
                return false;
            }
            if ( $("#email").data('chk') == 'N' ) {
                alert('E-Mail 중복체크를 해주세요.');
                $("#email").focus();
                return false;
            }
            if (isEmpty($("#home_zipcode").val())) {
                alert('자택주소를 입력해주세요.');
                $("#home_zipcode").focus();
                return false;
            }
            if (isEmpty($("#home_address2").val())) {
                alert('자택주소를 입력해주세요.');
                $("#home_address2").focus();
                return false;
            }

            //form3
            if($("input[name='license_number']").is(":visible")){
                if (isEmpty($("input[name='license_number']").val())) {
                    alert('의사면허번호를 입력해주세요.');
                    $("input[name='license_number']").focus();
                    return false;
                }
                if ( $("input[name='license_number']").data('chk') == 'N' ) {
                    alert('의사면허번호 중복체크를 해주세요.');
                    $("input[name='license_number']").focus();
                    return false;
                }
            }
            if (isEmpty($("#major").val())) {
                alert('전공분야를 선택해주세요.');
                $("#major").focus();
                return false;
            }
            if ($("#major").val() == 'Z' && isEmpty($("#major_etc").val())) {
                alert('기타 전공분야를 입력해주세요.');
                $("#major_etc").focus();
                return false;
            }

            if (isEmpty($("#company_kr").val())) {
                alert('근무처 정보(국문)을 입력해주세요.');
                $("#company_kr").focus();
                return false;
            }
            if (isEmpty($("#company_en").val())) {
                alert('근무처 정보(영문)을 입력해주세요.');
                $("#company_en").focus();
                return false;
            }
            if (isEmpty($("#position").val())) {
                alert('근무처 정보(직위)를 입력해주세요.');
                $("#position").focus();
                return false;
            }
            if (isEmpty($("#companyTel1").val())) {
                alert('근무처 정보(번호)를 입력해주세요.');
                $("#companyTel1").focus();
                return false;
            }
            if (isEmpty($("#companyTel2").val())) {
                alert('근무처 정보(번호)를 입력해주세요.');
                $("#companyTel2").focus();
                return false;
            }
            if (isEmpty($("#companyTel3").val())) {
                alert('근무처 정보(번호)를 입력해주세요.');
                $("#companyTel3").focus();
                return false;
            }

            if (isEmpty($("#company_zipcode").val())) {
                alert('근무처 주소를 입력해주세요.');
                $("#company_zipcode").focus();
                return false;
            }
            if (isEmpty($("#company_address2").val())) {
                alert('근무처 주소를 입력해주세요.');
                $("#company_address2").focus();
                return false;
            }

            //form4
            if ( $("input[name='emailReception']:checked").length < 1 ) {
                alert('Mailing 서비스 여부를 체크해주세요.');
                $("input[name='emailReception']").focus();
                return false;
            }
            if ( $("input[name='smsReception']:checked").length < 1 ) {
                alert('SMS 수신 여부를 체크해주세요.');
                $("input[name='smsReception']").focus();
                return false;
            }
            //캡챠
            if (isEmpty($("#captcha_input").val())) {
                alert('자동화 프로그램 입력 방지 코드를 입력 해주세요.');
                $("#captcha_input").focus();
                return false;
            }
            if ( $("#captcha_input").data('chk') == 'N' ) {
                alert('자동화 프로그램 입력 방지 코드를 확인 해주세요.');
                $("#captcha_input").focus();
                return false;
            }

            boardSubmit();
        });

    </script>

    @yield('form2-script')
    @yield('form3-script')
    @yield('form4-script')
@endsection