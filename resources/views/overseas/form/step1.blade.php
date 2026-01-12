
<fieldset>
    <legend class="hide">약관동의</legend>
    <div class="sub-tit-wrap">
        <h4 class="sub-tit">{{ $overseasSetting->title ?? '' }} 국외학회 지원 안내문</h4>
    </div>
    <div class="term-wrap scroll-y">
        <!-- editos.css -->
        <link rel="stylesheet" href="/assets/css/editor.css">
        <div class="term-conbox editor-contents">
{{--            {{ $overseasSetting->content ?? '' }}--}}
            {!! $overseasSetting->content ?? '' !!}
        </div>
    </div>

    <div class="sub-tit-wrap">
        <h3 class="sub-tit">개인정보 수집 및 활용 동의</h3>
    </div>
    <div class="term-wrap scroll-y">
        <div class="term-conbox">
            <ol class="list-type list-type-decimal">
                <li>
                    <strong>개인정보의 수집 및 이용목적</strong>
                    <p>
                        대한천식알레르기학회 국외학회 지원신청을 온라인으로 접수 받고 있습니다. 이때 제공해주신 개인정보를 바탕으로 회원님의 신청내용을 접수 받을 수
                        있고 확인하실 수 있습니다.
                    </p>
                </li>
                <li>
                    <strong>수집하는 개인정보의 항목</strong>
                    <p>
                        대한천식알레르기학회 국외학회 지원신청을 위해 아래와 같은 개인정보를 요구하고 있습니다. 이름(한글), 이름(영문), 의사면허번호, 소속, 연락처, 휴대전화번호, E-mail를 필수입력사항으로 수집하고 있습니다.
                    </p>
                </li>
                <li>
                    <strong>개인정보의 보유 및 이용기간</strong>
                    <p>
                        회원님의 개인정보는 대한천식알레르기학회에서 계속 보유하며 서비스 제공을 위해 이용하게 됩니다.
                    </p>
                </li>
            </ol>
        </div>
    </div>
    <div class="checkbox-wrap text-center cst">
        <label class="checkbox-group" for="chk1">
            <input type="checkbox" name="chk1" id="chk1" {{ !empty($overseas->sid) ? 'checked' : '' }}> 국외학회 지원 신청 규정 및 개인정보 수집·활용에 동의하며, 지원 안내문을 모두 확인하였습니다. <br>
            (동의하지 않을 경우 신청 불가한 점 양해 부탁 드립니다.)
        </label>
    </div>

</fieldset>

@section('step1-script')
    <script>
        $(document).on('submit', form, function () {
            if( $("input[name^='chk1']:visible").is(":checked") !== true ){
                alert('동의하지 않을 경우 신청 불가능합니다.');
                return false;
            }

            boardSubmit();
        });
    </script>
@endsection