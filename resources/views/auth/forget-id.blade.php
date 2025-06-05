@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:아이디/비밀번호 찾기 -->
            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu js-tab-menu2">
                    <li class="on"><a href="{{ route('findId') }}">아이디 찾기</a></li>
                    <li><a href="{{ route('findPw') }}">비밀번호 찾기</a></li>
                </ul>
            </div>

            <div class="find-wrap">
                <div class="find-form">
                    <form id="forget-frm" action="" method="post" data-case="forget-uid">
                        <fieldset>
                            <legend class="hide">아이디 찾기</legend>
                            <div class="find-tit-wrap">
                                <span class="icon">
                                    <img src="/assets/image/sub/ic_findid.png" alt="">
                                </span>
                                <div class="text-wrap">
                                    <h3 class="find-tit">아이디 찾기</h3>
                                    <p>
                                        회원가입 시 입력한 성명과 이메일을 입력해주시기 바랍니다. <br>
                                        입력하신 정보가 정확히 일치하면, 아래에 아이디가 출력 됩니다.
                                    </p>
                                </div>
                            </div>
                            <div class="input-box">
                                <input type="text" name="name_kr" id="name_kr" class="form-item" placeholder="이름을 입력하세요.">
                                <input type="text" name="email" id="email" class="form-item" placeholder="이메일을 입력하세요.">
                            </div>
                            <div class="btn-wrap">
                                <button type="submit" class="btn btn-find">아이디 찾기</button>
                            </div>

                            <div class="find-result-con" style="display: none;">

                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>


            <!-- //e:아이디/비밀번호 찾기 -->

        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const frm = '#forget-frm';
        const dataUrl = '{{ route('auth.data') }}';

        defaultVaildation();

        $(frm).validate({
            rules: {
                name_kr: {
                    isEmpty: true,
                },
                email: {
                    isEmpty: true,
                },
            },
            messages: {
                name_kr: {
                    isEmpty: '이름을 입력해주세요.',
                },
                email: {
                    isEmpty: '이메일을 입력해주세요.',
                },
            },
            submitHandler: function () {
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(frm);
            callMultiAjax(dataUrl, ajaxData);
        }

    </script>
@endsection
