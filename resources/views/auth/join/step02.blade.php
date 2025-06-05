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
                    <li class="on">
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

            <div class="write-form-wrap">
                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($user->sid) ? $user->sid : '' }}" data-case="join-step2">
                    <input type="hidden" name="step" value="{{ request()->step ?? '' }}" readonly>

                    @include('auth.join.form.form2')

                    <div class="btn-wrap text-center">
                        <a href="{{ route('main') }}" class="btn btn-type1 color-type4">취소</a>
                        <button type="button" class="btn btn-type1 color-type5 postClass">다음</button>
                    </div>

                </form>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('auth.data') }}';

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
    </script>

    @yield('form2-script')
@endsection