@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('overseas.include.sub-tab-wrap')

            <div class="m-hide">
                <div class="step-list-wrap type2">
                    <ol class="step-list">
                        <li class="{{ (request()->step ?? '') == '1' ? 'on' : '' }}">
                            <span class="icon"></span>
                            <span class="tit">Step 1. 개인정보 활용 동의</span>
                        </li>
                        <li class="{{ (request()->step ?? '') == '2' ? 'on' : '' }}">
                            <span class="icon"></span>
                            <span class="tit">Step 2. 인적사항 확인</span>
                        </li>
                        <li class="{{ (request()->step ?? '') == '3' ? 'on' : '' }}">
                            <span class="icon"></span>
                            <span class="tit">Step 3. 지원자격 입력</span>
                        </li>
                        <li class="{{ (request()->step ?? '') == '4' ? 'on' : '' }}">
                            <span class="icon"></span>
                            <span class="tit">Step 4. 지원신청 완료</span>
                        </li>
                    </ol>
                </div>

                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($overseas->sid) ? $overseas->sid : '' }}" data-case="overseas-step{{ ($step) ?? '1' }}">
                    <input type="hidden" name="o_sid" id="o_sid" value="{{ request()->o_sid }}" readonly>
                    <input type="hidden" name="imsi" id="imsi" value="" readonly>
                    @include('overseas.form.step'.$step)

                    @if($step == '1')
                        <div class="btn-wrap text-center">
                            <a href="javascript:;" class="btn btn-type1 btn-cancle color-type4">취소</a>
                            <button type="submit" class="btn btn-type1 color-type5">다음</button>
                        </div>
                    @elseif($step == '2')
                        <div class="btn-wrap text-center">
                            <a href="javascript:;" class="btn btn-type1 btn-cancle color-type4">취소</a>
                            @if( ($overseas->complete ?? '') != 'Y')
                            <a href="javascript:imsiSave();" class="btn btn-type1 color-type5 btn-line">임시저장</a>
                            @endif
                            <button type="submit" class="btn btn-type1 color-type5">다음</button>
                        </div>
                    @elseif($step == '3')
                        <div class="btn-wrap text-center">
                            <a href="javascript:;" class="btn btn-type1 btn-cancle color-type4">취소</a>
                            @if( ($overseas->complete ?? '') != 'Y')
                                <a href="javascript:imsiSave();" class="btn btn-type1 color-type5 btn-line">임시저장</a>
                            @endif
                            <button type="submit" class="btn btn-type1 color-type5">최종제출</button>
                        </div>
                    @endif

                </form>
            </div>

            <div class="notice-box m-show">
                <img src="/assets/image/sub/img_notice.png" alt="">
                <p class="tit">국외학회 지원 신청은 <br><strong>PC에서 가능</strong>합니다.</p>
            </div>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('overseas.data') }}';


        $(document).on('click', '.btn-cancle', function() {

            if(confirm("페이지를 벗어날 경우 입력 내용이 모두 초기화 됩니다.")){
                location.href = '{{ route('overseas') }}';
            }else{
                return false;
            }

        });

        //캡챠
        $(document).on('keyup', '#captcha_input', function() {
            const _captcha_input = $(this).val();
            callNoneSpinnerAjax(dataUrl, {
                'case': 'captcha-compare',
                'captcha_input': _captcha_input,
            });
        });

        const imsiSave = () => {
            $("#imsi").val('Y');
            $("#register-frm").submit();
        }

        const boardSubmit = () => {

            let ajaxData = newFormData(form);

            if( $(".tinymce").length > 0 ){
                ajaxData.append('purpose', tinymce.get('purpose').getContent());
            }
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>


    @if($step == '1')
        @yield('step1-script')
    @elseif($step == '2')
        @yield('step2-script')
    @elseif($step == '3')
        @yield('step3-script')
    @endif
@endsection
