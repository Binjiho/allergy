@extends('admin.layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="m-hide">

                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($overseas->sid) ? $overseas->sid : '' }}" data-case="overseas-step{{ ($step) ?? '1' }}">
                    <input type="hidden" name="o_sid" id="o_sid" value="{{ request()->o_sid }}" readonly>
                    <input type="hidden" name="imsi" id="imsi" value="" readonly>
                    <input type="hidden" name="modify" id="modify" value="Y" readonly>
                    @include('overseas.form.step'.$step)

                    @if($step == '1')
                        <div class="btn-wrap text-center">
                            <a href="javascript:;" class="btn btn-type1 btn-cancle color-type4">취소</a>
                            <button type="submit" class="btn btn-type1 color-type5">다음</button>
                        </div>
                    @elseif($step == '2')
                        <div class="btn-wrap text-center">
                            <a href="javascript:self.close();" class="btn btn-type1 btn-cancle color-type4">취소</a>
                            <button type="submit" class="btn btn-type1 color-type5">다음</button>
                        </div>
                    @elseif($step == '3')
                        <div class="btn-wrap text-center">
                            <a href="javascript:self.close();" class="btn btn-type1 btn-cancle color-type4">취소</a>
                            <button type="submit" class="btn btn-type1 color-type5">수정</button>
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
        const dataUrl = '{{ route('apply.data',['o_sid'=>$overseas->o_sid]) }}';


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
