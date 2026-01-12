@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')


    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('overseas.include.sub-tab-wrap')

            <div class="m-hide">
                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($overseas->sid) ? $overseas->sid : '' }}" data-case="report-create" >
                    <input type="hidden" name="o_sid" id="o_sid" value="{{ $overseas->o_sid }}" readonly>
                    <input type="hidden" name="imsi" id="imsi" value="" readonly>

                    @include('overseas.form.report-frm')

                    <div class="btn-wrap text-center">
                        <a href="{{ route('overseas.search') }}" class="btn btn-type1 color-type4">취소</a>
                        <a href="javascript:imsiSave()" class="btn btn-type1 color-type5 btn-line">임시저장</a>
                        <button type="submit" class="btn btn-type1 color-type5">제출하기</button>
                    </div>
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


    @yield('report-script')
@endsection
