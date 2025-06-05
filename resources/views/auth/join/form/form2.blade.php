<fieldset>
    <legend class="hide">입력</legend>
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">기본정보 입력</h3>
    </div>
    <div class="help-text text-red mb-10">
        * 표시된 부분은 반드시 기입해주시기 바랍니다.
    </div>
    <ul class="write-wrap">
        @if( isset($user) )
            <li>
                <div class="form-tit">
                    <strong class="required">*</strong> 아이디
                </div>
                <div class="form-con">{{ $user->id ?? ''}}</div>
            </li>
        @else
            <li>
                <div class="form-tit">아이디 <strong class="required">*</strong></div>
                <div class="form-con">
                    <div class="form-group has-btn">
                        <input type="text" name="id" id="id" class="form-item" maxlength="12" data-chk="N" onlySmallEnNum>
                        <button type="button" id="uid_chk" class="btn btn-small color-type4">중복확인</button>
                    </div>
                    <div class="help-text mt-10 text-blue">
                        * 영문소문자, 숫자만 입력 가능. 최소 6~12자이상 입력하세요.
                    </div>
                </div>
            </li>
            <li>
                <div class="form-tit">비밀번호 <strong class="required">*</strong></div>
                <div class="form-con">
                    <input type="password" name="password" id="password" class="form-item" onlyEnNum>
                    <div class="help-text mt-10 text-blue">
                        * 비밀번호는 4~12자 영문, 숫자를 조합하여 입력하세요.
                    </div>
                </div>
            </li>
            <li>
                <div class="form-tit">비밀번호 확인<strong class="required">*</strong></div>
                <div class="form-con">
                    <input type="password" name="repassword" id="repassword" class="form-item" onlyEnNum>
                </div>
            </li>
        @endif

        <li>
            <div class="form-tit">성명 <strong class="required">*</strong></div>
            <div class="form-con">
                @if( isset($user) )
                    <div class="form-group form-group-text n2">
                        <span class="text">국문 : {{ $user->name_kr ?? '' }} </span>
                    </div>
                @else
                    <div class="form-group form-group-text n2">
                        <span class="text">국문 : </span>
                        <input type="text" name="name_kr" id="name_kr" class="form-item" onlyKo>
                    </div>
                @endif
                <div class="form-group form-group-text n2 mt-10">
                    <span class="text">영문 : </span>
                    <input type="text" name="first_name" id="first_name" class="form-item" placeholder="First Name" value="{{ $user->first_name ?? '' }}" enname>
                    <input type="text" name="last_name" id="last_name" class="form-item" placeholder="Last Name" value="{{ $user->last_name ?? '' }}" enname>
                </div>
                <div class="form-group form-group-text n2 mt-10">
                    <span class="text">한자 : </span>
                    <input type="text" name="name_han" id="name_han" class="form-item" value="{{ $user->name_han ?? '' }}">
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">외국 국적 회원 여부 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="radio-wrap cst">
                    <label for="is_national_Y" class="radio-group"><input type="radio" name="is_national" id="is_national_Y" value="Y" {{ ($user->is_national ?? '') == 'Y' ? 'checked':'' }}>Yes</label>
                    <label for="in_national_N" class="radio-group"><input type="radio" name="is_national" id="in_national_N" value="N" {{ ($user->is_national ?? '') == 'N' ? 'checked':'' }}>No</label>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">생년월일 <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="birth_date" id="birth_date" class="form-item" placeholder="숫자 8자리만 입력해주세요." value="{{ $user->birth_date ?? '' }}" maxlength="10" birthHyphen>
                <div class="help-text mt-10 text-blue">
                    예) 20250101
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">휴대전화번호 <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="phone" id="phone" class="form-item" placeholder="숫자만 입력해주세요." value="{{ $user->phone ?? '' }}" onlyNumber>
            </div>
        </li>
        <li>
            <div class="form-tit">E-Mail <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" name="email" id="email" value="{{ $user->email ?? '' }}" class="form-item emailOnly" data-chk="{{ isset($user) ? 'Y' : 'N' }}" {{ isset($user) ? 'readonly' : 'N' }}>
                    <button type="button" id="email_chk" class="btn btn-small color-type4">중복확인</button>
                </div>

                @if( isset($user) )
                    <div class="checkbox-wrap cst mt-10">
                        <label for="emailModify" class="checkbox-group"><input type="checkbox" name="" id="emailModify">이메일 수정 시 체크</label>
                    </div>
                @endif
            </div>
        </li>
        <li>
            <div class="form-tit">자택주소 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" name="home_zipcode" id="home_zipcode" value="{{ $user->home_zipcode ?? '' }}" readonly class="form-item">
                    <button type="button" onclick="openDaumPostcode('home'); return false;" class="btn btn-small color-type4">우편번호 검색</button>
                </div>
                <div class="form-group n2 mt-10">
                    <input type="text" name="home_address" id="home_address" value="{{ $user->home_address ?? '' }}"  class="form-item" readonly>
                    <input type="text" name="home_address2" id="home_address2" value="{{ $user->home_address2 ?? '' }}"  class="form-item">
                </div>
            </div>
        </li>
    </ul>
</fieldset>

@section('form2-script')
<script>
    $(document).on('click', '#uid_chk', function() {
        const uid = $('input[name=id]').val();
        if(isEmpty(uid)) {
            alert('아이디를 입력해주세요.');
            return;
        }
        callAjax(dataUrl, {
            'case': 'uid-check',
            'id': uid,
        });
    });

    $(document).on('keyup', 'input[name=id]', function() {
        $(this).data('chk', 'N');
    });

    $(document).on('click', '#email_chk', function() {
        const _email = $('#email').val();
        const _sid = $("#register-frm").data('sid');
        if(isEmpty(_email)) {
            alert('이메일을 입력해주세요.');
            return;
        }
        callAjax(dataUrl, {
            'case': 'email-check',
            'email': _email,
            'sid': _sid,
        });
    });

    $(document).on('keyup', 'input[name=email]', function() {
        $(this).data('chk', 'N');
    });

    $(document).on('click','.postClass', function(){
        if (isEmpty($("input[name='id']").val())) {
            alert('아이디를 입력해주세요.');
            $("input[name='id']").focus();
            return false;
        }
        if ( $("input[name='id']").val().length < 6 ) {
            alert('아이디는 최소 6자 글자로 입력해주세요.');
            $("input[name='id']").focus();
            return false;
        }
        if ( $("input[name='id']").data('chk') == 'N' ) {
            alert('아이디 중복체크를 해주세요.');
            $("input[name='id']").focus();
            return false;
        }

        if (isEmpty($("#password").val())) {
            alert('비밀번호를 입력해주세요.');
            $("#password").focus();
            return false;
        }
        if (isValidPassword($("#password").val()) === false) {
            alert("비밀번호는 영문, 숫자를 조합하여 입력하세요.");
            $("#password").focus();
            return false;
        }
        if ( $("#password").val().length < 4 ) {
            alert('비밀번호는 최소 4자로 입력해주세요.');
            $("#password").focus();
            return false;
        }
        if (isEmpty($("#repassword").val())) {
            alert('비밀번호 확인을 입력해주세요.');
            $("#repassword").focus();
            return false;
        }
        if ( $("#password").val() != $("#repassword").val()) {
            alert('입력하신 비밀번호와 동일하게 입력해주세요.');
            $("#repassword").focus();
            return false;
        }


        if (isEmpty($("#name_kr").val())) {
            alert('성명(국문)을 입력해주세요.');
            $("#name_kr").focus();
            return false;
        }
        if (isEmpty($("#first_name").val())) {
            alert('성명(영문)을 입력해주세요.');
            $("#first_name").focus();
            return false;
        }
        if (isEmpty($("#last_name").val())) {
            alert('성명(영문)을 입력해주세요.');
            $("#last_name").focus();
            return false;
        }
        if (isEmpty($("#name_han").val())) {
            alert('성명(한자)를 입력해주세요.');
            $("#name_han").focus();
            return false;
        }

        if ($("input[name='is_national']:checked").length < 1) {
            alert('외국 국적 회원 여부를 선택해주세요.');
            $("input[name='is_national']").focus();
            return false;
        }
        if (isEmpty($("#birth_date").val())) {
            alert('생년월일을 입력해주세요.');
            $("#birth_date").focus();
            return false;
        }
        if ( $("#birth_date").val().length < 10){
            alert('생년월일을 입력해주세요.');
            $("#birth_date").focus();
            return false;
        }
        if (isEmpty($("#phone").val())) {
            alert('휴대전화번호를 입력해주세요.');
            $("#phone").focus();
            return false;
        }
        if (isEmpty($("#email").val())) {
            alert('E-Mail을 입력해주세요.');
            $("#email").focus();
            return false;
        }
        if ( $("#email").data('chk') == 'N' ) {
            alert('E-Mail 중복체크를 해주세요.');
            $("#email").focus();
            return false;
        }
        if (isEmpty($("#home_zipcode").val())) {
            alert('자택주소를 입력해주세요.');
            $("#home_zipcode").focus();
            return false;
        }
        if (isEmpty($("#home_address2").val())) {
            alert('자택주소를 입력해주세요.');
            $("#home_address2").focus();
            return false;
        }
        boardSubmit();
    });
</script>
@endsection