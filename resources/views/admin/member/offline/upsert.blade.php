@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
    <link type="text/css" rel="stylesheet" href="/assets/css/slick.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/common.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/jquery-ui.min.css">
@endsection

@section('contents')
    <div class="write-wrap mb-30">
        <ul>
            <li class="write-wrap-tit">
                <div class="form-group form-group-text n3">
                    <div class="text-wrap">
                        이름: {{ $user->name_kr ?? '' }}
                    </div>

                    <span class="text">|</span>

                    <div class="text-wrap">
                        면허번호: {{ $user->license_number ?? '' }}
                    </div>

                    <span class="text">|</span>

                    <div class="text-wrap">
                        근무처: {{ $user->company_kr ?? '' }}
                    </div>
                </div>
            </li>
        </ul>
    </div>


    <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($user->sid) ? $user->sid : '' }}" data-case="useroff-update">
        <input type="hidden" name="gubun" value="{{ $user->gubun ?? '' }}" readonly>

        <fieldset>
            <legend class="hide">회원가입</legend>

            <fieldset>
                <legend class="hide">입력</legend>
                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">기본정보 입력</h3>
                </div>
                <div class="help-text text-red mb-10">
                    * 표시된 부분은 반드시 기입해주시기 바랍니다.
                </div>
                <ul class="write-wrap">
                    <li>
                        <div class="form-tit">성명 <strong class="required">*</strong></div>
                        <div class="form-con">
                            {{ $user->name_kr ?? '' }}
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
                                {{ $user->email ?? '' }}
                            </div>
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
            <div class="mt-40"></div>

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

                    <li>
                        <div class="form-tit">
                            관리자 메모
                        </div>
                        <div class="form-con">
                            <textarea name="memo" id="memo" cols="30" rows="10" style="border: 1px solid #cbd3d9; resize: none; padding: 10px;">{{ $user->memo ?? '' }}</textarea>
                        </div>
                    </li>
                </ul>
            </fieldset>
            <div class="mt-40"></div>


            <div class="btn-wrap text-center">
                <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
                <button type="button" class="btn btn-type1 color-type6 modifyClass">수정</button>
            </div>

        </fieldset>
    </form>
@endsection

@section('addScript')
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('member.data') }}';


        //이메일 수정체크
        $(document).on('click', '#emailModify', function() {
            $("#email").attr("readonly", false);
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }

        function openDaumPostcode(kind){
            if( kind == "company" ){
                var space = "company_";
            }else{
                var space = "home_";
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    $(":text[name='"+space+"zipcode']").val(data.zonecode);
                    $(":text[name='"+space+"address']").val(data.address).focus();
                }
            }).open();
        }

        $(document).on('change', '#si', function() {
            const _val = $(this).val();

            if (_val == "17") {
                $("#gu").val('').hide();
            } else {
                $("#gu").show();
            }

            // 구 옵션 동적 로드
            let ajaxData = {
                'case' : 'change-si',
                'si' : _val,
            };

            callbackAjax(dataUrl, ajaxData, function(data, error) {
                if (data && data.result['res'] != 'NOT') {
                    var items = data.result.items;
                    var $gu = $("[name='gu']");
                    $gu.empty();
                    $gu.append('<option value="">구/군</option>');
                    // for (var key in items) {
                    //     if (items.hasOwnProperty(key)) {
                    //         $gu.append('<option value="' + key + '">' + items[key] + '</option>');
                    //     }
                    // }
                    items.forEach(function(item) {
                        $gu.append('<option value="' + item.key + '">' + item.name + '</option>');
                    });
                } else if (data) {
                    alert(data.result['msg']);
                }
            }, true);
        });

        $(document).on('click','.modifyClass', function(){

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

            //form3
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

            //form4
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

            boardSubmit();
        });

    </script>

    @yield('form2-script')
    @yield('form3-script')
    @yield('form4-script')
@endsection
