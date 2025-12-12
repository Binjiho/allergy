<fieldset>
    <legend class="hide">입력</legend>
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">상세정보 입력</h3>
    </div>
    <div class="help-text text-red mb-10">
        * 표시된 부분은 반드시 기입해주시기 바랍니다.
    </div>
    <ul class="write-wrap">
        <li>
            <div class="form-tit">의사면허번호 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    @if( ($user->create_status ?? '') == 'Y' )
                        {{ $user->license_number ?? ''}}
                    @else
                        <input type="text" name="license_number" id="license_number" class="form-item" data-chk="N" onlyNumber>
                        <button type="button" id="license_chk" class="btn btn-small color-type4">중복확인</button>
                    @endif
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">전공분야 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group n2">
                    <select name="major" id="major" class="form-item w-30p">
                        <option value="">선택</option>
                        @foreach($userConfig['major'] as $key => $val)
                            <option value="{{ $key }}" {{ ($user->major ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="major_etc" id="major_etc" value="{{ $user->major_etc ?? '' }}" class="form-item" {{ ($user->major ?? '') == 'Z' ? '' : 'disabled' }}>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">전문의 번호</div>
            <div class="form-con">
                <input type="text" name="special_number" id="special_number" value="{{ $user->special_number ?? '' }}" class="form-item" onlyNumber>
            </div>
        </li>
        <li>
            <div class="form-tit">분과 전문의 번호</div>
            <div class="form-con">
                <input type="text" name="bun_number" id="bun_number" value="{{ $user->bun_number ?? '' }}" class="form-item" onlyNumber>
            </div>
        </li>
        <li>
            <div class="form-tit">입회일</div>
            <div class="form-con">
                <input type="text" name="join_date" id="join_date" value="{{ $user->join_date ?? '' }}" class="form-item" placeholder="숫자 8자리만 입력해주세요." onlyNumber maxlength="8">
                <div class="help-text mt-10 text-blue">
                    예) 20250101
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">출신학교</div>
            <div class="form-con">
                <input type="text" name="school" id="school" value="{{ $user->school ?? '' }}" class="form-item">
            </div>
        </li>
        <li>
            <div class="form-tit">졸업일</div>
            <div class="form-con">
                <input type="text" name="graduate_date" id="graduate_date" value="{{ $user->graduate_date ?? '' }}" class="form-item" placeholder="숫자 8자리만 입력해주세요." onlyNumber maxlength="8">
                <div class="help-text mt-10 text-blue">
                    예) 20250101
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">근무처 정보 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group form-group-text n2">
                    <span class="text">국문 : </span>
                    <input type="text" name="company_kr" id="company_kr" value="{{ $user->company_kr ?? '' }}" class="form-item" noneEn>
                </div>
                <div class="form-group form-group-text n2 mt-10">
                    <span class="text">영문 : </span>
                    <input type="text" name="company_en" id="company_en" value="{{ $user->company_en ?? '' }}" class="form-item" noneKo>
                </div>
                <div class="form-group form-group-text n2 mt-10">
                    <span class="text">직위 : </span>
                    <input type="text" name="position" id="position" value="{{ $user->position ?? '' }}" class="form-item">
                </div>
                <div class="form-group form-group-text n2 mt-10">
                    <span class="text">번호 : </span>
                    @php
                        if($user->create_status == 'Y'){
                            $companyTelArr = explode('-',$user->companyTel);
                        }
                    @endphp
                    <select name="companyTel[]" id="companyTel1" class="form-item w-30p">
                        <option value="">선택</option>
                        @foreach($userConfig['areaNumber'] as $key => $val)
                            <option value="{{ $key }}" {{ ($companyTelArr[0] ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="companyTel[]" id="companyTel2" value="{{ $companyTelArr[1] ?? '' }}" class="form-item" onlyNumber>
                    -
                    <input type="text" name="companyTel[]" id="companyTel3" value="{{ $companyTelArr[2] ?? '' }}" class="form-item" onlyNumber>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">근무처 주소 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" name="company_zipcode" id="company_zipcode" value="{{ $user->company_zipcode ?? '' }}" readonly class="form-item">
                    <button type="button" onclick="openDaumPostcode('company'); return false;" class="btn btn-small color-type4">우편번호 검색</button>
                </div>
                <div class="form-group n2 mt-10">
                    <input type="text" name="company_address" id="company_address" value="{{ $user->company_address ?? '' }}" class="form-item" readonly>
                    <input type="text" name="company_address2" id="company_address2" value="{{ $user->company_address2 ?? '' }}" class="form-item">
                </div>
            </div>
        </li>
    </ul>
</fieldset>

@section('form3-script')
    <script>
        $(document).on('click', '#license_chk', function() {
            const _license = $('input[name=license_number]').val();
            const _create_status = $("#create_status").val;
            const _sid = $("#register-frm").data('sid');
            if(isEmpty(_license)) {
                alert('의사면허번호를 입력해주세요.');
                return;
            }
            callAjax(dataUrl, {
                'case': 'license-check',
                'license_number': _license,
                'create_status': _create_status,
                'sid': _sid,
            });
        });

        $(document).on('keyup', 'input[name=license_number]', function() {
            $(this).data('chk', 'N');
        });

        $(document).on('change', '#major', function() {
            if ( $(this).val() == 'Z'){
                $("#major_etc").prop('disabled', false);
            }else{
                $("#major_etc").val('');
                $("#major_etc").prop('disabled', true);
            }
        });

        $(document).on('click','.postClass', function(){
            if($("input[name='license_number']").is(":visible")){
                if (isEmpty($("input[name='license_number']").val())) {
                    alert('의사면허번호를 입력해주세요.');
                    $("input[name='license_number']").focus();
                    return false;
                }
                if ( $("input[name='license_number']").data('chk') == 'N' ) {
                    alert('의사면허번호 중복체크를 해주세요.');
                    $("input[name='license_number']").focus();
                    return false;
                }
            }
            if (isEmpty($("#major").val())) {
                alert('전공분야를 선택해주세요.');
                $("#major").focus();
                return false;
            }
            if ($("#major").val() == 'Z' && isEmpty($("#major_etc").val())) {
                alert('기타 전공분야를 입력해주세요.');
                $("#major_etc").focus();
                return false;
            }

            if (isEmpty($("#company_kr").val())) {
                alert('근무처 정보(국문)을 입력해주세요.');
                $("#company_kr").focus();
                return false;
            }
            if (isEmpty($("#company_en").val())) {
                alert('근무처 정보(영문)을 입력해주세요.');
                $("#company_en").focus();
                return false;
            }
            if (isEmpty($("#position").val())) {
                alert('근무처 정보(직위)를 입력해주세요.');
                $("#position").focus();
                return false;
            }
            if (isEmpty($("#companyTel1").val())) {
                alert('근무처 정보(번호)를 입력해주세요.');
                $("#companyTel1").focus();
                return false;
            }
            if (isEmpty($("#companyTel2").val())) {
                alert('근무처 정보(번호)를 입력해주세요.');
                $("#companyTel2").focus();
                return false;
            }
            if (isEmpty($("#companyTel3").val())) {
                alert('근무처 정보(번호)를 입력해주세요.');
                $("#companyTel3").focus();
                return false;
            }

            if (isEmpty($("#company_zipcode").val())) {
                alert('근무처 주소를 입력해주세요.');
                $("#company_zipcode").focus();
                return false;
            }
            if (isEmpty($("#company_address2").val())) {
                alert('근무처 주소를 입력해주세요.');
                $("#company_address2").focus();
                return false;
            }
            boardSubmit();
        });
    </script>
@endsection