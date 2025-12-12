@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="/assets/css/editor.css">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="ev-conbox">

                @include('conference.workshop.detail.workshop_info')
                

                <div class="bg-img-box bg-box">
                    <div class="img-wrap">
                        <img src="/assets/image/sub/ic_confirm.png" alt="">
                    </div>
                    <div class="text-wrap">
                        <ul class="list-type list-type-check">
                            <li>
                                <span class="text-red">성함 + 이메일</span>로 등록 조회 가능합니다.
                            </li>
                            <li>
                                당사전등록 완료하였으나, 조회가 되지 않을 경우 사무국으로 연락 부탁 드립니다. (E-mail : <a href="mailto:allergy@allergy.or.kr" target="_blank">allergy@allergy.or.kr</a>, <a href="mailto:kaaaci@naver.com" target="_blank">kaaaci@naver.com</a> | TEL : <a href="tel:82-2-747-0528" target="_blank">82-2-747-0528</a>)
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="write-form-wrap">
                    <form id="forget-frm" action="" method="" data-case="registration-search">
                        <input type="hidden" name="wsid" id="wsid" value="{{ $wsid }}">
                        <fieldset>
                            <legend class="hide">등록 조회</legend>
                            <ul class="write-wrap">
                                <li>
                                    <div class="form-tit">성명 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="name_kr" id="name_kr" class="form-item">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">이메일 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="email" id="email" class="form-item emailOnly" >
                                    </div>
                                </li>
                            </ul>
                            <div class="btn-wrap text-center">
                                <button type="submit" class="btn btn-type1 color-type1">사전등록 조회하기</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const frm = '#forget-frm';
        const dataUrl = '{{ route('registration.data', ['wsid'=>$wsid]) }}';

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
                    isEmpty: '성함을 입력해주세요.',
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
