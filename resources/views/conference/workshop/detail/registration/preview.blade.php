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


                <div class="date-box">
                    <img src="/assets/image/sub/img_date.png" alt="">
                    <div class="text-wrap">
                        사전등록 마감일 : <span>~ {{ \Carbon\Carbon::parse($workshop->regist_edate)->format('Y') }}년 <strong>{{  \Carbon\Carbon::parse($workshop->regist_edate)->format('m') }}</strong>월 <strong>{{  \Carbon\Carbon::parse($workshop->regist_edate)->format('d') }}일</strong> {{ formatKoreanDate($workshop->regist_edate) }} 까지</span>
                    </div>
                </div>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">{{ $workshop->title ?? '' }} 온라인 사전등록</h3>
                </div>
                <div class="write-form-wrap">
                    <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-complete">
                        <input type="hidden" name="resCd" id="resCd" value="" readonly>
                        <input type="hidden" name="member_gubun" id="member_gubun" value="{{ $reg->member_gubun }}" readonly>

                        @include('conference.workshop.detail.registration.form.preview-frm')

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
                            <a href="{{ route('workshop.detail',['wsid'=>$workshop->sid]) }}" class="btn btn-type1 color-type4">취소</a>
                            <a href="{{ route('registration.upsert',['wsid'=>$workshop->sid, 'sid'=>$reg->sid, 'member_gubun'=>$reg->member_gubun, 'mode'=>'modify']) }}" class="btn btn-type1 color-type5">수정</a>
                            <button type="submit" class="btn btn-type1 color-type1">최종 완료</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('registration.data', ['wsid'=>$workshop->sid]) }}';

        //캡챠
        $(document).on('keyup', '#captcha_input', function() {
            const _captcha_input = $(this).val();
            callNoneSpinnerAjax(dataUrl, {
                'case': 'captcha-compare',
                'captcha_input': _captcha_input,
            });
        });

        const boardSubmit = () => {
            const pay_method = $("input[name='pay_method']:checked").val();
            let ajaxData = newFormData(form);

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


            if( isEmpty( $("#resCd").val() ) ) {
                callbackMultiAjax(dataUrl, ajaxData, function (data, error) {
                    if (error) {
                        console.log(error);
                        alert('ERROR');
                        // location.reload();
                        return false;
                    }

                    if (pay_method !== 'C') {
                        ajaxSuccessData(data);
                    } else {
                        if (data.status === 'fail') {
                            alert(data.msg);
                            location.reload();
                            return false;
                        }

                        const popupHeight = 700;
                        const popupWidth = 600;
                        const popName = 'easyPay';
                        const popupY = (window.screen.height / 2) - (popupHeight / 2);
                        const popupX = (window.screen.width / 2) - (popupWidth / 2);

                        window.open(data.url, popName, 'status=no, height=' + popupHeight + ', width=' + popupWidth + ', left=' + popupX + ', top=' + popupY);
                    }
                });
            }else{
                callMultiAjax(dataUrl, ajaxData);
            }

        }
    </script>

    @yield('reg-script')
@endsection
