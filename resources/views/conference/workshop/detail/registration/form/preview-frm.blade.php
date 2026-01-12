<fieldset>
    <legend class="hide">사전등록</legend>

    <ul class="write-wrap">
        <li>
            <div class="form-tit">접수번호</div>
            <div class="form-con">
                {{ $reg->reg_num ?? '' }}
            </div>
        </li>
        <li>
            <div class="form-tit">회원등급 및 ID <strong class="required">*</strong></div>
            <div class="form-con">
                @if( ($reg->member_gubun ?? '') == 'Y' )
                    {{ $userConfig['level'][thisUser()->level] }} / {{ thisUser()->id }}
                @else
                    비회원
                @endif
            </div>
        </li>
        <li>
            <div class="form-tit">등록구분 <strong class="required">*</strong></div>
            <div class="form-con">
                {{ $defaultConfig['gubun'][$reg['gubun']] }} -
                {{ number_format($reg['amount']) ?? 0 }}원
            </div>
        </li>
        <li>
            <div class="form-tit">성명 <strong class="required">*</strong></div>
            <div class="form-con">
                {{ $reg->name_kr ?? '' }}
            </div>
        </li>
        @if( ($reg->gubun ?? '') != '5' )
        <li>
            <div class="form-tit">의사면허번호 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="form-group has-btn">
                    {{ $reg->license_number ?? '' }}
                </div>
            </div>
        </li>
        @endif
        @if(!empty($reg->region))
        <li>
            <div class="form-tit">소속의사회</div>
            <div class="form-con">
                {{ $defaultConfig['region'][$reg->region] ?? '' }} {{ $reg->sigu ?? '' }}
            </div>
        </li>
        @endif


        <li>
            <div class="form-tit">근무처(소속) <strong class="required">*</strong></div>
            <div class="form-con">
                {{ $reg->office_name ?? '' }}
            </div>
        </li>

        <li>
            <div class="form-tit">근무처(소속) 주소 <strong class="required">*</strong></div>
            <div class="form-con">
                ({{ $reg->zipcode ?? '' }}) {{ $reg->addr ?? '' }} {{ $reg->addr_etc ?? '' }}
            </div>
        </li>


        <li>
            <div class="form-tit">소속과 <strong class="required">*</strong></div>
            <div class="form-con">
                {{ $reg->department ?? '' }}
            </div>
        </li>
        <li>
            <div class="form-tit">근무처(소속) 전화번호</div>
            <div class="form-con">
                {{ $reg->office_tel ?? '' }}
            </div>
        </li>
        <li>
            <div class="form-tit">휴대전화번호 <strong class="required">*</strong></div>
            <div class="form-con">
                {{ $reg->phone ?? '' }}
            </div>
        </li>
        <li>
            <div class="form-tit">E-Mail <strong class="required">*</strong></div>
            <div class="form-con">
                {{ $reg->email ?? '' }}
            </div>
        </li>

        <li>
            <div class="form-tit">총 등록비</div>
            <div class="form-con">
                <strong class="text-red">{{ number_format($reg->amount ?? 0) }}원</strong>
            </div>
        </li>

        @if( ($reg->amount ?? 0) > 0 )
        <li>
            <div class="form-tit">결제 방법 <strong class="required">*</strong></div>
            <div class="form-con">
                <div class="radio-wrap cst">
                    @foreach($defaultConfig['pay_method'] as $key => $val)

                        @continue($key =='F')
                        <label for="chk3_{{ $key }}" class="radio-group">
                            <input type="radio" name="pay_method" id="chk3_{{ $key }}" value="{{ $key }}" {{ ($reg->pay_method ?? '')==$key ? 'checked' :'' }}>{{ $val }}
                        </label>
                    @endforeach
                </div>
            </div>
        </li>

        <li class="bank_li" style="{{ ($reg->pay_method ?? '') == 'B' ? '' : 'display:none;' }}">
            <div class="form-tit">입금자 명 <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="send_name" id="send_name" value="{{ $reg->send_name ?? '' }}" class="form-item">
            </div>
        </li>
        <li class="bank_li" style="{{ ($reg->pay_method ?? '') == 'B' ? '' : 'display:none;' }}">
            <div class="form-tit">입금 예정일 <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="send_date" id="send_date" value="{{ $reg->send_date ?? '' }}" class="form-item" readonly datepicker>
            </div>
        </li>
        <li class="bank_li" style="{{ ($reg->pay_method ?? '') == 'B' ? '' : 'display:none;' }}">
            <div class="form-tit">계좌정보</div>
            <div class="form-con">
                신한은행 / 100-012-958376 / 대한천식알레르기학회
            </div>
        </li>
        @else
            <input type="hidden" name="pay_method" id="pay_method" value="F" readonly>
        @endif
    </ul>

</fieldset>

@section('reg-script')
    <script>
        $(document).on('click', '[name=pay_method]', function() {
            const _val = $(this).val();

            if(_val == 'B'){
                $(".bank_li").show();
            }else{
                $(".bank_li").hide();
            }
        });


        $(document).on('submit', form, function(e) {

            if ($("input[name='pay_method']").is(":visible")) {

                if ($("input[name='pay_method']:checked").length < 1) {
                    alert('결제 방법을 선택해주세요.');
                    $("input[name='pay_method']").focus();
                    return false;
                }

                if ( $("input[name='pay_method']:checked").val() == 'B' ) {
                    if ( isEmpty($("#send_name").val())) {
                        alert('입금자 명을 입력해주세요.');
                        $("#send_name").focus();
                        return false;
                    }
                    if ( isEmpty($("#send_date").val())) {
                        alert('입금 예정일을 입력해주세요.');
                        $("#send_date").focus();
                        return false;
                    }
                }
            }

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

            boardSubmit();
        });
    </script>
@endsection