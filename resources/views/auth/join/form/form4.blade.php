<fieldset>
    <legend class="hide">입력</legend>
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">부가정보 입력</h3>
    </div>
    <div class="help-text text-red mb-10">
        * 표시된 부분은 반드시 기입해주시기 바랍니다.
    </div>
    <ul class="write-wrap">
        <li>
            <div class="form-tit">Mailing 서비스 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="radio-wrap cst">
                    <label for="chk1_1" class="radio-group"><input type="radio" name="emailReception" id="chk1_1" value="Y" {{ ($user->emailReception ?? '') == 'Y' ? 'checked' : '' }}>수신</label>
                    <label for="chk1_2" class="radio-group"><input type="radio" name="emailReception" id="chk1_2" value="N" {{ ($user->emailReception ?? '') == 'N' ? 'checked' : '' }}>미수신</label>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">SMS 수신 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="radio-wrap cst">
                    <label for="chk2_1" class="radio-group"><input type="radio" name="smsReception" id="chk2_1" value="Y" {{ ($user->smsReception ?? '') == 'Y' ? 'checked' : '' }}>수신</label>
                    <label for="chk2_2" class="radio-group"><input type="radio" name="smsReception" id="chk2_2" value="N" {{ ($user->smsReception ?? '') == 'N' ? 'checked' : '' }}>미수신</label>
                </div>
            </div>
        </li>
    </ul>
</fieldset>

@section('form4-script')
    <script>
        $(document).on('click','.postClass', function(){
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
@endsection