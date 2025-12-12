<fieldset>
    <legend class="hide">사전등록</legend>

    <ul class="write-wrap">
        <li>
            <div class="form-tit">회원등급 및 ID <strong class="required">*</strong></div>
            <div class="form-con">
                @if(($member_gubun ?? '') == 'N')
                    비회원
                @else
                    @if(!empty($reg->sid))
                        {{ $userConfig['level'][$reg->user->level] ?? '' }} / {{ $reg->user->id ?? '' }}
                    @else
                        {{ $userConfig['level'][thisUser()->level] }} / {{ thisUser()->id }}
                    @endif
                @endif
            </div>
        </li>

        <li>
            <div class="form-tit">등록구분 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="radio-wrap cst">
                    <input type="hidden" name="amount" id="amount" value="{{ $reg->amount ?? 0 }}" readonly>
                    @foreach($workshop['res_fee'] as $key => $val)
                        @if(empty(thisPK()) && thisPK() < 1)
                            @continue($val['member_gubun'] == 'Y')
                        @else
                            @continue($val['member_gubun'] == 'N')
                        @endif
                        <label for="gubun_{{ $val['gubun'] }}" class="radio-group">
                            <input type="radio" name="gubun" id="gubun_{{ $val['gubun'] }}" value="{{ $val['gubun'] }}" data-price="{{ $val['amount'] ?? 0 }}" {{ ($reg->gubun ?? '') == $val['gubun'] ? 'checked' : '' }}>{{ $defaultConfig['gubun'][$val['gubun']] }} -
                            {{ number_format($val['amount']) ?? 0 }}원
                        </label>
                    @endforeach
                </div>
            </div>
        </li>


        <li>
            <div class="form-tit">성명 <strong class="required">*</strong></div>
            <div class="form-con">
                @if((request()->mode ?? '') == 'modify')
                    {{ $reg->name_kr ?? '' }}
                @else
                    <input type="text" name="name_kr" id="name_kr" value="{{ $reg->name_kr ?? (thisUser()->name_kr ?? '') }}" class="form-item" @if(($member_gubun ?? '') == 'Y') readonly @endif>
                @endif
            </div>
        </li>

        <li class="gubun_li" style="{{ ($reg->gubun ?? '') == '5' ? 'display:none;' : '' }}">
            <div class="form-tit">의사면허번호 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    @if((request()->mode ?? '') == 'modify')
                        {{ $reg->license_number ?? '' }}
                    @else
                        <input type="text" name="license_number" id="license_number" value="{{ $reg->license_number ?? (thisUser()->license_number ?? '') }}" class="form-item" data-chk="{{ (request()->mode ?? '') == 'modify' ? 'Y':'N' }}" @if(($member_gubun ?? '') == 'Y') readonly @endif>
                            @if(checkUrl()!= 'admin')
                            <button type="button" class="btn btn-small color-type4" id="license_chk">중복확인</button>
                            @endif
                    @endif
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">소속의사회</div>
            <div class="form-con">
                <ul class="list-type list-type-dot help-text mb-10">
                    <li>
                        의사 회원인 경우에는 연수평점 카드 기록을 위해서 필요 합니다.
                    </li>
                    <li>
                        대한의사협회 16개 지부 중 근무지역을 기준으로 한 소속의사회를 의미하며 근무처가 없을 경우 거주 지역을 기준으로 합니다.
                    </li>
                </ul>
                <div class="form-group form-group-text">
                    <select name="region" id="region" class="form-item w-30p">
                        <option value="">지역 선택</option>
                        @foreach($defaultConfig['region'] as $key => $val)
                            <option value="{{ $key }}" {{ ($reg->region ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="sigu" id="sigu" value="{{ $reg->sigu ?? '' }}" class="form-item" placeholder="시/군/구 입력해주세요.">
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">근무처(소속) <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="hidden" name="office_sid" id="office_sid" value="{{ $reg->office_sid ?? '' }}" class="form-item" readonly>
                    <input type="text" name="office_name" id="office_name" value="{{ $reg->office_name ?? (thisUser()->company_kr ?? '') }}" class="form-item" {{ ($reg->office_use ?? '') == 'Y' ? '' : 'readonly' }}>

                    <a href="{{ route('registration.office_search',['wsid'=>$wsid]) }}" class="btn btn-small color-type4 call-popup" data-width="1100" data-height="700" data-popup_name="office-search">
                        소속 검색
                    </a>

                </div>
                <div class="checkbox-wrap cst mt-10">
                    <label for="office_use" class="checkbox-group">
                        <input type="checkbox" name="office_use" id="office_use" value="Y" {{ ($reg->office_use ?? '') == 'Y' ? 'checked' : '' }}>
                        직접 입력</label>
                    <span class="help-text text-blue">(소속 검색으로 근무처가 검색되지 않는 경우, '직접 입력' 항목을 체크하신 후 직접 입력해 주시기 바랍니다.)</span>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">근무처(소속) 주소 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" name="zipcode" id="zipcode" value="{{ $reg->zipcode ?? (thisUser()->company_zipcode ?? '') }}" class="form-item" readonly >
                    <button type="button" onclick="openDaumPostcode(); return false;" class="btn btn-small color-type4">우편번호 검색</button>
                </div>
                <div class="form-group n2 mt-10">
                    <input type="text" name="addr" id="addr" value="{{ $reg->addr ?? (thisUser()->company_address ?? '') }}" class="form-item" readonly >
                    <input type="text" name="addr_etc" id="addr_etc" value="{{ $reg->addr_etc ?? (thisUser()->company_address2 ?? '') }}" class="form-item" >
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">소속과 <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="department" id="department" value="{{ $reg->department ?? '' }}" class="form-item">
            </div>
        </li>
        <li>
            <div class="form-tit">근무처(소속) 전화번호</div>
            <div class="form-con">
                <div class="form-group form-group-text">
                    @php
                        if( empty($reg->sid) ){
                            if (($member_gubun ?? '') == 'Y'){
                                $com_tel = thisUser()->companyTel ?? '';
                                if(!empty($com_tel)){
                                    $com_tel_arr = explode('-',$com_tel);
                                    $reg['office_tel_first'] = $com_tel_arr[0];
                                    $reg['office_tel'] = $com_tel_arr[1].$com_tel_arr[2];
                                }
                            }
                        }
                    @endphp

                    <select name="office_tel_first" id="office_tel_first" class="form-item w-30p">
                        <option value="">지역 선택</option>
                        @foreach($userConfig['areaNumber'] as $key => $val)
                            <option value="{{ $key }}" {{ ($reg['office_tel_first'] ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="office_tel" id="office_tel" value="{{ $reg['office_tel'] ?? '' }}" class="form-item" placeholder="- 제외 숫자만 입력해주세요." onlyNumber>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">휴대전화번호 <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="phone" id="phone" value="{{ $reg->phone ?? '' }}" class="form-item" placeholder="- 제외 숫자만 입력해주세요." onlyNumber>
            </div>
        </li>
        <li>
            <div class="form-tit">E-Mail <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" name="email" id="email" value="{{ $reg->email ?? '' }}" data-chk="{{ (request()->mode ?? '') == 'modify' ? 'Y':'N' }}" class="form-item emailOnly">
                    @if(checkUrl()!= 'admin')
                    <button type="button" class="btn btn-small color-type4 " id="email_chk">중복확인</button>
                    @endif
                </div>
            </div>
        </li>
    </ul>

    <div class="price-con">
        <p class="tit">등록비 : <span class="highlights">{{ number_format($reg->amount ?? 0) }}원</span></p>
    </div>

</fieldset>
@section('reg-script')
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        function openDaumPostcode(){

            new daum.Postcode({
                oncomplete: function(data) {
                    $(":text[name='zipcode']").val(data.zonecode);
                    $(":text[name='addr']").val(data.address).focus();
                }
            }).open();
        }

        $(document).on('click', '[name=gubun]', function() {
            const _gubun = $(this).val();
            const _amount = $(this).data('price');

            if(_gubun == '5'){
                $(".gubun_li").hide();
            }else{
                $(".gubun_li").show();
            }

            $('#amount').val(_amount);

            let _html_amount = comma(_amount)+'원';
            $(".highlights").html(_html_amount);
        });

        $(document).on('click', '#license_chk', function() {
            const _license = $('input[name=license_number]').val();
            const _wsid = $("#wsid").val();

            if(isEmpty(_license)) {
                alert('의사면허번호를 입력해주세요.');
                return;
            }
            callAjax(dataUrl, {
                'case': 'license-check',
                'license_number': _license,
                'wsid': _wsid,
            });
        });

        $(document).on('click', '#office_use', function() {
            if( $(this).is(":checked") ) {
                $("#office_name").prop("readonly",false);
            }else{
                $("#office_name").prop("readonly",true);
            }
        });

        $(document).on('keyup', 'input[name=license_number]', function() {
            $(this).data('chk', 'N');
        });

        $(document).on('click', '#email_chk', function() {
            const _email = $('input[name=email]').val();
            const _wsid = $("#wsid").val();

            if(isEmpty(_email)) {
                alert('이메일을 입력해주세요.');
                return;
            }
            callAjax(dataUrl, {
                'case': 'email-check',
                'email': _email,
                'wsid': _wsid,
            });
        });

        $(document).on('keyup', 'input[name=email]', function() {
            $(this).data('chk', 'N');
        });


        $(document).on('submit', form, function(e) {

            if ( isEmpty($("#member_gubun").val())) {
                alert('회원 비회원을 다시 선택해주세요.');
                $("#member_gubun").focus();
                return false;
            }

            if ($("input[name='gubun']:checked").length < 1) {
                alert('등록구분을 선택해주세요.');
                $("input[name='gubun']").focus();
                return false;
            }

            @if((request()->mode ?? '') != 'modify')
                if ( isEmpty($("#name_kr").val())) {
                    alert('성함을 입력해주세요.');
                    $("#name_kr").focus();
                    return false;
                }

            if ($("input[name='gubun']:checked").val() != '5'/*간호사,연구원*/) {
                if (isEmpty($("input[name='license_number']").val())) {
                    alert('의사면허번호를 입력해주세요.');
                    $("input[name='license_number']").focus();
                    return false;
                }
                @if(checkUrl()!= 'admin')
                if ($("input[name='license_number']").data('chk') == 'N') {
                    alert('의사면허번호 중복체크를 해주세요.');
                    $("input[name='license_number']").focus();
                    return false;
                }
                @endif
            }
            @endif
            //근무처 직접입력
            if ( isEmpty($("#office_name").val())) {
                alert('근무처(소속)을 입력해주세요.');
                $("#office_name").focus();
                return false;
            }

            if ( isEmpty($("#zipcode").val())) {
                alert('근무처(소속) 주소를 입력해주세요.');
                $("#zipcode").focus();
                return false;
            }
            if ( isEmpty($("#addr").val())) {
                alert('근무처(소속) 주소를 입력해주세요.');
                $("#addr").focus();
                return false;
            }
            if ( isEmpty($("#addr_etc").val())) {
                alert('근무처(소속) 주소를 입력해주세요.');
                $("#addr_etc").focus();
                return false;
            }

            if ( isEmpty($("#department").val())) {
                alert('소속과를 입력해주세요.');
                $("#department").focus();
                return false;
            }
            if ( isEmpty($("#phone").val())) {
                alert('휴대전화번호를 입력해주세요.');
                $("#phone").focus();
                return false;
            }

            if ( isEmpty($("#email").val())) {
                alert('E-mail을 입력해주세요.');
                $("#email").focus();
                return false;
            }
            @if(checkUrl()!= 'admin')
            if ( $("#email").data('chk') == 'N' ) {
                alert('E-Mail 중복체크를 해주세요.');
                $("#email").focus();
                return false;
            }
            @endif


            //upsert 페이지에 위치
            // if ($("input[name='agree']:checked").length < 1) {
            //     alert('개인정보 수집 및 활용 동의를 체크해주세요.');
            //     $("input[name='agree']").focus();
            //     return false;
            // }

            //캡챠
            // if (isEmpty($("#captcha_input").val())) {
            //     alert('자동화 프로그램 입력 방지 코드를 입력 해주세요.');
            //     $("#captcha_input").focus();
            //     return false;
            // }
            // if ( $("#captcha_input").data('chk') == 'N' ) {
            //     alert('자동화 프로그램 입력 방지 코드를 확인 해주세요.');
            //     $("#captcha_input").focus();
            //     return false;
            // }

            //비회원 등록
            if($("member_gubun").val() == 'N'){

            }


            boardSubmit();
        });
    </script>
@endsection