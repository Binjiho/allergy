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
                    <li class="on">
                        <span class="icon"></span>
                        <span class="tit">03. 상세정보 입력</span>
                    </li>
                    <li class="on">
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
                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($user->sid) ? $user->sid : '' }}" data-case="join-step4">
                    <input type="hidden" name="step" value="{{ request()->step ?? '' }}" readonly>
                    <input type="hidden" name="create_status" id="create_status" value="{{ $user->create_status ?? '' }}" readonly>

                    @include('auth.join.form.form4')

                    <div class="sub-tit-wrap" style="margin-top: 30px;">
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
                        <button type="submit" class="btn btn-type1 color-type1 postClass">{{ ($user->create_status ?? '') == 'Y' ? '수정 완료' : '가입 완료' }}</button>
                        <!-- 수정 -->
                        <!-- <button type="submit" class="btn btn-type1 color-type1">수정 완료</button> -->
                    </div>
                </form>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
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

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
    @yield('form4-script')
@endsection