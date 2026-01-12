<fieldset>
    <div class="write-wrap">
        <ul>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 공개상태</div>
                <div class="form-con">
                    <div class="radio-wrap cst">
                        @foreach($defaultConfig['hide'] as $key => $val)
                            <label for="hide_{{ $key }}" class="radio-group">
                                <input type="radio" name="hide" id="hide_{{ $key }}" value="{{ $key }}" {{ ($workshop->hide ?? '') == $key ? 'checked' : '' }}>
                                {{ $val }}
                            </label>
                        @endforeach
                    </div>
                    <p>
                        * 설정중 상태의 경우 관리자에게만 노출 됩니다. 설정 완료 후 꼭 공개로 변경해주세요.
                    </p>
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> 행사코드</div>
                <div class="form-con">
                    <input type="text" name="code" id="code" class="form-item w-20p" value="{{ $workshop->code ?? '' }}" onlyNumber @if(!empty($workshop)) readonly @endif>
                    <p>
                        * 예시) 202501처럼 숫자만 입력 가능하며, 한번 입력 후 저장 시 변경 불가능 합니다.
                    </p>
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> 행사명</div>
                <div class="form-con">
                    <input type="text" name="title" id="title" class="form-item" value="{{ $workshop->title ?? '' }}" >
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> 행사 기간</div>
                <div class="form-con">
                    <div class="radio-wrap cst">
                        @foreach($defaultConfig['date_type'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="date_type" id="date_type_{{ $key }}" value="{{ $key }}" {{ ($workshop->date_type ?? '') == $key ? 'checked' : '' }}>
                                <label for="date_type_{{ $key }}">{{ $val }}</label>
                            </div>
                        @endforeach
                    </div>
                    <p>
                        * 하루 행사의 경우 시작일만 입력 가능합니다.
                    </p>

                    <div class="form-group">
                        <div class="table-wrap scroll-x touch-help mt-10">
                            <table class="cst-table">
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="row">시작일</th>
                                    <th scope="row">
                                        <input type="text" name="event_sdate" id="event_sdate" class="form-item flatpickr flatpickr-input" value="{{ $workshop->event_sdate ?? '' }}" readonly datepicker>
                                    </th>
                                    <th scope="row">마감일</th>
                                    <th scope="row">
                                        <input type="text" name="event_edate" id="event_edate" class="form-item flatpickr flatpickr-input edate-display" value="{{ $workshop->event_edate ?? '' }}" readonly datepicker {{ ($workshop->date_type ?? '' ) == 'D' ? 'disabled' : '' }}>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> 행사장소</div>
                <div class="form-con">
                    <input type="text" name="place" id="place" class="form-item" value="{{ $workshop->place ?? '' }}" >
                </div>
            </li>

            <li>
                <div class="form-tit">
                    <strong class="required">*</strong> 종합안내
                </div>
                <div class="form-con">
                    <textarea name="total_info" id="total_info" class="tinymce">{{ $workshop->total_info ?? '' }}</textarea>
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> 사전등록 기간</div>
                <div class="form-con">
                    <div class="form-group">
                        <div class="table-wrap scroll-x touch-help mt-10">
                            <table class="cst-table">
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="row">시작일</th>
                                    <th scope="row">
                                        <input type="text" name="regist_sdate" id="regist_sdate" class="form-item flatpickr flatpickr-input" value="{{ $workshop->regist_sdate ?? '' }}" readonly datepicker>
                                    </th>
                                    <th scope="row">마감일</th>
                                    <th scope="row">
                                        <input type="text" name="regist_edate" id="regist_edate" class="form-item flatpickr flatpickr-input" value="{{ $workshop->regist_edate ?? '' }}" readonly datepicker>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="form-tit"> 사전등록 유예기간</div>
                <div class="form-con">
                    <div class="form-group">

                        <div class="checkbox-wrap cst mt-10">
                            <label for="grace_use" class="checkbox-group">
                                <input type="checkbox" name="grace_use" id="grace_use" value="Y" {{ ($workshop->grace_use ?? '') == 'Y' ? 'checked' : '' }}>
                                * 체크 시 결제 상태 > 미입금 상태인 등록자만 등록 가능한 날짜 선택 항목 활성화 (입금완료 사용자 or 신규 등록 불가)
                            </label>
                        </div>
                        <div class="table-wrap scroll-x touch-help mt-10">
                            <table class="cst-table">
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="row">시작일</th>
                                    <th scope="row">
                                        <input type="text" name="regist_grace_sdate" id="regist_grace_sdate" class="form-item flatpickr flatpickr-input" value="{{ $workshop->regist_grace_sdate ?? '' }}" readonly datepicker {{ ($workshop->grace_use ?? '') == 'Y' ? '' : 'disabled' }}>
                                    </th>
                                    <th scope="row">마감일</th>
                                    <th scope="row">
                                        <input type="text" name="regist_grace_edate" id="regist_grace_edate" class="form-item flatpickr flatpickr-input" value="{{ $workshop->regist_grace_edate ?? '' }}" readonly datepicker {{ ($workshop->grace_use ?? '') == 'Y' ? '' : 'disabled' }}>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="form-tit">
                    <strong class="required">*</strong> 등록비<br>(안내페이지 노출)
                </div>
                <div class="form-con">
                    <textarea name="fee_info" id="fee_info" class="tinymce">{{ $workshop->fee_info ?? '' }}</textarea>
                </div>
            </li>
            <li>
                <div class="form-tit">
                     <strong class="required">*</strong> 주의사항
                </div>
                <div class="form-con">
                    <textarea name="notice_info" id="notice_info" class="tinymce">{{ $workshop->notice_info ?? '' }}</textarea>
                </div>
            </li>
            <li>
                <div class="form-tit">
                     <strong class="required">*</strong> 결제안내
                </div>
                <div class="form-con">
                    <textarea name="pay_info" id="pay_info" class="tinymce">{{ $workshop->pay_info ?? '' }}</textarea>
                </div>
            </li>
            <li>
                <div class="form-tit">
                    <strong class="required">*</strong> 문의처
                </div>
                <div class="form-con">
                    <textarea name="inquire_info" id="inquire_info" class="tinymce">{{ $workshop->inquire_info ?? '' }}</textarea>
                </div>
            </li>

            <li>
                <div class="form-tit">
                    <strong class="required">*</strong> 등록구분
                </div>
                <div class="form-con">
                    <div class="table-wrap scroll-x touch-help mt-10">
                        <table class="cst-table">
                            <caption class="hide">회원구분</caption>
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 30%;">
                                <col style="width: 20%;">
                                <col style="width: 20%;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th scope="row">회원 구분</th>
                                <th scope="row">구분</th>
                                <th scope="row">등록비</th>
                                <th scope="row">관리</th>
                            </tr>
                            </thead>
                            <tbody >
                            @if(!empty($workshop) && $workshop['res_fee'])
                                @foreach($workshop['res_fee'] as $key => $val)
                                    <tr class="aff_div">
                                        <td class="text-left">
                                            <select name="member_gubun[]" class="form-item">
                                                <option value="">선택</option>
                                                @foreach($defaultConfig['member_gubun'] as $k => $v)
                                                    <option value="{{ $k }}" {{ ($val['member_gubun'] ?? '') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-left">
                                            <select name="gubun[]" class="form-item">
                                                <option value="">선택</option>
                                                @foreach($defaultConfig['gubun'] as $k => $v)
                                                    <option value="{{ $k }}" {{ ($val['gubun'] ?? '') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-left">
                                            <input type="text" name="amount[]" value="{{ $val['amount'] }}" id="" class="form-item" onlyNumber>
                                        </td>
                                        <td>
                                            <div class="btn-admin">
                                                <a href="javascript:;" onclick="change_tr(this,'add');" class="btn btn-tbl-inner color-type1">추가</a>
                                                <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-tbl-inner color-type9">삭제</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="aff_div">
                                    <td class="text-left">
                                        <select name="member_gubun[]" class="form-item">
                                            <option value="">선택</option>
                                            @foreach($defaultConfig['member_gubun'] as $k => $v)
                                                <option value="{{ $k }}" >{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-left">
                                        <select name="gubun[]" class="form-item">
                                            <option value="">선택</option>
                                            @foreach($defaultConfig['gubun'] as $k => $v)
                                                <option value="{{ $k }}" >{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-left">
                                        <input type="text" name="amount[]" value="" id="" class="form-item" onlyNumber>
                                    </td>
                                    <td>
                                        <div class="btn-admin">
                                            <a href="javascript:;" onclick="change_tr(this,'add');" class="btn btn-tbl-inner color-type1">추가</a>
                                            <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-tbl-inner color-type9">삭제</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</fieldset>
@section('reg-script')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('script/app/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>

    <script>
        $(document).on('change', 'input:radio[name=date_type]', function() {
            const target = $('.edate-display');

            if ($(this).val() === "L") {
                target.show();
            } else {
                target.hide();
                target.find('input').val('');
            }
        });

        $(document).on('change', 'input[name=grace_use]', function() {
            if ($(this).is(":checked") ) {
                $("#regist_grace_sdate").prop("disabled", false);
                $("#regist_grace_edate").prop("disabled", false);
            } else {
                $("#regist_grace_sdate").prop("disabled", true);
                $("#regist_grace_edate").prop("disabled", true);
            }
        });

        //등록비
        function change_tr(el, mode){
            const target = $('.aff_div');
            const length = target.length;

            if(mode == 'add'){

                callAjax(dataUrl, {
                    'case': 'add-affi',
                });

            }else{
                if(length < 2){
                    alert('최소 한개 이상은 입력해주세요.');
                    return false;
                }else{
                    $(el).parent().parent().parent().remove();
                }
            }
        }

        $(document).on('submit', form, function () {

            if ( $("input[name='hide']:checked").length < 1) {
                alert(`공개상태를 선택해주세요.`);
                $("input[name='hide']").focus();
                return false;
            }

            const code = $('#code');
            if (isEmpty(code.val())) {
                alert(`행사코드를 입력해주세요.`);
                code.focus();
                return false;
            }

            @if( masterIp() === false )
            const title = $('#title');
            if (isEmpty(title.val())) {
                alert(`행사명을 입력해주세요.`);
                title.focus();
                return false;
            }

            if ( $("input[name='date_type']:checked").length < 1) {
                alert(`행사기간 종류를 선택해주세요.`);
                $("input[name='date_type']").focus();
                return false;
            }

            const event_sdate = $('#event_sdate');
            if (isEmpty(event_sdate.val())) {
                alert(`행사시작일을 입력해주세요.`);
                event_sdate.focus();
                return false;
            }

            if ( $("input[name='date_type']:checked").val() == 'L') {
                const event_edate = $('#event_edate');
                if (isEmpty(event_edate.val())) {
                    alert(`행사종료일을 입력해주세요.`);
                    event_edate.focus();
                    return false;
                }
            }

            const place = $('#place');
            if (isEmpty(place.val())) {
                alert(`행사장소를 입력해주세요.`);
                place.focus();
                return false;
            }

            let total_infoVal = tinymce.get('total_info').getContent(); // 내용 가져오기
            // tinyVal = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
            total_infoVal = total_infoVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

            if (isEmpty(total_infoVal)) {
                alert('종합안내 내용을 입력해주세요.');
                return false;
            }

            const regist_sdate = $('#regist_sdate');
            if (isEmpty(regist_sdate.val())) {
                alert(`사전등록 시작일을 입력해주세요.`);
                regist_sdate.focus();
                return false;
            }

            const regist_edate = $('#regist_edate');
            if (isEmpty(regist_edate.val())) {
                alert(`사전등록 종료일을 입력해주세요.`);
                regist_edate.focus();
                return false;
            }

            if ( $("input[name='grace_use']").is(":checked")) {
                const regist_grace_sdate = $('#regist_grace_sdate');
                if (isEmpty(regist_grace_sdate.val())) {
                    alert(`사전등록 유예기간 시작일을 입력해주세요.`);
                    regist_grace_sdate.focus();
                    return false;
                }

                const regist_grace_edate = $('#regist_grace_edate');
                if (isEmpty(regist_grace_edate.val())) {
                    alert(`사전등록 유예기간 종료일을 입력해주세요.`);
                    regist_grace_edate.focus();
                    return false;
                }
            }

            let fee_infoVal = tinymce.get('fee_info').getContent(); // 내용 가져오기
            // tinyVal = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
            fee_infoVal = fee_infoVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

            if (isEmpty(fee_infoVal)) {
                alert('등록비 내용을 입력해주세요.');
                return false;
            }

            let notice_infoVal = tinymce.get('notice_info').getContent(); // 내용 가져오기
            // tinyVal = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
            notice_infoVal = notice_infoVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

            if (isEmpty(notice_infoVal)) {
                alert('주의사항 내용을 입력해주세요.');
                return false;
            }

            let pay_infoVal = tinymce.get('pay_info').getContent(); // 내용 가져오기
            // tinyVal = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
            pay_infoVal = pay_infoVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

            if (isEmpty(total_infoVal)) {
                alert('결제안내 내용을 입력해주세요.');
                return false;
            }

            let inquire_infoVal = tinymce.get('inquire_info').getContent(); // 내용 가져오기
            // tinyVal = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
            inquire_infoVal = inquire_infoVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

            if (isEmpty(inquire_infoVal)) {
                alert('문의처 내용을 입력해주세요.');
                return false;
            }

            let member_gubun_check = false;
            $("select[name='member_gubun[]']").each(function(key, item) {
                if(isEmpty($(item).val())) {
                    member_gubun_check = true;
                }
            });
            if(member_gubun_check){
                alert("회원구분을 선택해주세요.");
                return false;
            }

            let gubun_check = false;
            $("select[name='gubun[]']").each(function(key, item) {
                if(isEmpty($(item).val())) {
                    gubun_check = true;
                }
            });
            if(gubun_check){
                alert("구분을 선택해주세요.");
                return false;
            }

            let amount_check = false;
            $("input[name='amount[]']").each(function(key, item) {
                if(isEmpty($(item).val())) {
                    amount_check = true;
                }
            });
            if(amount_check){
                alert("등록비를 입력해주세요.");
                return false;
            }
            @endif

            boardSubmit();
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);
            ajaxData.append('total_info', tinymce.get('total_info').getContent());
            ajaxData.append('fee_info', tinymce.get('fee_info').getContent());
            ajaxData.append('pay_info', tinymce.get('pay_info').getContent());
            ajaxData.append('notice_info', tinymce.get('notice_info').getContent());
            ajaxData.append('inquire_info', tinymce.get('inquire_info').getContent());

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection