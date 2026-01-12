@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">행사 {{ empty($reg->sid) ? '등록' : '수정' }}</h3>
    </div>

    <form id="register-frm" method="post" data-sid="{{ $reg->sid ?? 0 }}" data-case="detail-{{ empty($reg->sid) ? 'create' : 'update' }}">
        <input type="hidden" name="wsid" id="wsid" value="{{ $wsid }}" readonly>

        <fieldset>
            <div class="write-wrap">
                <ul>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 이름</div>
                        <div class="form-con">
                            <input type="text" name="name_kr" id="name_kr" class="form-item" value="{{ $reg->name_kr ?? '' }}" >
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"> 근무처(소속)</div>
                        <div class="form-con">
                            <input type="text" name="addr" id="addr" class="form-item" value="{{ $reg->addr ?? '' }}" >
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"> 면허번호</div>
                        <div class="form-con">
                            <input type="text" name="license_number" id="license_number" class="form-item" value="{{ $reg->license_number ?? '' }}" >
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 등록비</div>
                        <div class="form-con">
                            <input type="text" name="amount" id="amount" class="form-item" value="{{ $reg->amount ?? '' }}" onlyNumber>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"> 결제방법</div>
                        <div class="form-con">
                            <select class="form-item" data-field="pay_method" name="pay_method">
                                <option value="" >선택</option>
                                <option value="C" {{ ($reg->pay_method ?? '') == 'C' ? 'selected' : '' }}>Credit Card</option>
                                <option value="B" {{ ($reg->pay_method ?? '') == 'B' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="B" {{ ($reg->pay_method ?? '') == 'M' ? 'selected' : '' }}>현금</option>
                                <option value="B" {{ ($reg->pay_method ?? '') == 'Z' ? 'selected' : '' }}>기타</option>
                                <option value="B" {{ ($reg->pay_method ?? '') == 'W' ? 'selected' : '' }}>면제</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="form-tit"> 결제상태</div>
                        <div class="form-con">
                            <select class="form-item db-change" data-field="pay_status" name="pay_status">
                                <option value="" >선택</option>
                                <option value="N" {{ ($reg->pay_status ?? '') == 'N' ? 'selected' : '' }}>미결제</option>
                                <option value="Y" {{ ($reg->pay_status ?? '') == 'Y' ? 'selected' : '' }}>결제완료</option>
                                <option value="F" {{ ($reg->pay_status ?? '') == 'F' ? 'selected' : '' }}>무료</option>
                            </select>
                        </div>
                    </li>

                </ul>
            </div>
        </fieldset>

        <div class="btn-wrap text-center">
            <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
            <button type="submit" class="btn btn-type1 color-type6">{{ empty($reg->sid) ? '등록' : '수정' }}</button>
        </div>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('detail.data',['wsid'=>request()->wsid]) }}';

        $(document).on('submit', form, function(e) {

            if ( isEmpty($("#name_kr").val())) {
                alert('이름을 입력해주세요.');
                $("#name_kr").focus();
                return false;
            }
            // if ( isEmpty($("#addr").val())) {
            //     alert('근무처를 입력해주세요.');
            //     $("#addr").focus();
            //     return false;
            // }
            // if ( isEmpty($("#license_number").val())) {
            //     alert('면허번호를 입력해주세요.');
            //     $("#license_number").focus();
            //     return false;
            // }
            if ( isEmpty($("#amount").val())) {
                alert('등록비를 입력해주세요.');
                $("#amount").focus();
                return false;
            }

            boardSubmit();
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);
            
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('reg-script')
@endsection
