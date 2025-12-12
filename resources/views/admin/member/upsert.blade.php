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
                        ID: {{ $user->id ?? '' }}
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

    <div class="table-wrap" style="margin-bottom: 20px;">
        <table class="cst-table">
            <caption class="hide">테이블</caption>
            <colgroup>
                <col style="width: 25%;">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row">회원 가입일</th>
                <td class="text-left">{{ $user->created_at ?? '' }}</td>
            </tr>
            <tr>
                <th scope="row">최종 회원정보 수정일</th>
                <td class="text-left">{{ $user->updated_at ?? '' }}</td>
            </tr>

            </tbody>
        </table>
    </div>

    <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($user->sid) ? $user->sid : '' }}" data-case="user-update">
        <input type="hidden" name="gubun" value="{{ $user->gubun ?? '' }}" readonly>

        <fieldset>
            <legend class="hide">회원가입</legend>

            @include('auth.join.form.form2')
            <div class="mt-40"></div>
            @include('auth.join.form.form3')
            <div class="mt-40"></div>
            @include('auth.join.form.form4')

            <div class="sub-tit-wrap">
                <h3 class="sub-tit">관리자 정보 입력</h3>
            </div>
            <ul class="write-wrap">
                <li>
                    <div class="form-tit">
                        승인여부
                    </div>
                    <div class="form-con">
                        <select class="form-item select-confirm" name="confirm">
                            @foreach($userConfig['confirm'] as $key => $val)
                                <option value="{{ $key }}" {{ ($user->confirm ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>
                <li>
                    <div class="form-tit">
                        회원등급
                    </div>
                    <div class="form-con">
                        <select class="form-item select-level" name="level">
                            @foreach($userConfig['level'] as $key => $val)
                                <option value="{{ $key }}" {{ ($user->level ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
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

                <li>
                    <div class="form-tit">
                        주소
                    </div>
                    <div class="form-con">
                        <div class="form-group n2">
                            <select name="si" id="si" class="form-item sch-cate">
                                <option value="">전체</option>
                                @foreach($userConfig['si'] as $key => $val)
                                    <option value="{{ $key }}" {{ ($user->si ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>

                            <select name="gu" id="gu" class="form-item sch-cate" style="{{ ($hos->si ?? '') == '17' ? 'display:none;' : '' }}">
                                <option value="">구/군</option>
                                @if(!empty($user->si))
                                    @foreach($userConfig['gu'][$user->si ?? ''] as $key => $val)
                                        <option value="{{ $key }}" {{ ($user->gu ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="form-tit">jext 처방 병원 <strong class="required">*</strong></div>
                    <div class="form-con">
                        <div class="radio-wrap cst">
                            <label for="jext_1" class="radio-group"><input type="radio" name="jext" id="jext_1" value="Y" {{ ($user->jext ?? '') == 'Y' ? 'checked' : '' }}>예</label>
                            <label for="jext_2" class="radio-group"><input type="radio" name="jext" id="jext_2" value="N" {{ ($user->jext ?? '') == 'N' ? 'checked' : '' }}>아니오</label>
                        </div>
                    </div>
                </li>
            </ul>

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
