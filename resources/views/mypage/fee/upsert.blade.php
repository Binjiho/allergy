@extends('layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popup-wrap win-popup-wrap">
{{--        @if(!empty($registration->resultCode))--}}
{{--            @include('common.inicis.resultMap', ['resultMap' => $registration])--}}
{{--        @endif--}}

        <div class="popup-contents">
            <div class="popup-tit-wrap text-center">
                <h2 class="popup-tit">{{ implode(',',$title_arr) ?? '' }} 납부</h2>
            </div>
            <div class="popup-conbox">
                <div class="write-form-wrap">
                    <form id="regFrm" method="post" data-sid="{{ request()->sid ?? 0 }}" action="{{ route('fee.data') }}" data-case="payment-create" onsubmit="return false;">
                        <input type="hidden" name="price" value="{{ $tot_price ?? 0 }}" readonly>
{{--                        <input type="hidden" name="category" value="{{ $target_category ?? 0 }}" readonly>--}}
                        <fieldset>
                            <legend class="hide">연회비 납부</legend>
                            <ul class="write-wrap">
                                <li>
                                    <div class="form-tit">이름</div>
                                    <div class="form-con">{{ $user->name_kr ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">아이디</div>
                                    <div class="form-con">{{ $user->id ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">근무처정보</div>
                                    <div class="form-con">{{ $user->company_kr ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">납부 회비 항목</div>
                                    <div class="form-con">
                                        {{ implode(',',$title_arr ?? '') }}
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">
                                        결제방법
                                    </div>
                                    <div class="form-con">
                                        <div class="radio-wrap cst">
                                            @foreach($feeConfig['payment_method'] as $key => $val)
                                                <label class="radio-group"><input type="radio" name="payment_method" id="payment_method_{{ $key }}" value="{{ $key }}">{{ $val }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>

                                {{--  쿠통장입금  --}}
                                <div class="bank_div" style="display: none;">
                                    <li>
                                        <div class="form-tit text-center">입금 정보</div>
                                    </li>
                                    <li>
                                        <div class="form-tit">학회 계좌 정보</div>
                                        <div class="form-con">신한은행 / 100-012-958376 / 대한천식알레르기학회</div>
                                    </li>
                                    <li>
                                        <div class="form-tit">입금자명 <strong class="required">*</strong></div>
                                        <div class="form-con">
                                            <input type="text" name="depositor" id="depositor" class="form-item">
                                            <div class="help-text text-red mt-10">
                                                입금자 성명을 적어주세요.(실제 입금자 성명과 동일해야 합니다.)
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-tit">입금예정일 <strong class="required">*</strong></div>
                                        <div class="form-con">
                                            <input type="text" name="deposit_date" id="deposit_date" class="form-item" dateminpicker>
                                        </div>
                                    </li>
                                </div>
                                {{--  //쿠통장입금  --}}
                            </ul>

                            <div class="price-con">
                                <p class="tit">납부금액 : <span class="highlights">{{ number_format($tot_price) ?? 0 }}원</span></p>

                                <ul>
                                    @foreach($title_arr as $key => $val)
                                    <li>
                                        {{ $val }} : {{ number_format($price_arr[$key] ?? 0) ?? 0 }}원
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="btn-wrap text-center">
                                <a href="javascript:self.close();" class="btn btn-type1 color-type4">닫기</a>
                                <button type="submit" class="btn btn-type1 color-type1">결제</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <button type="button" class="btn btn-pop-close" onclick="self.close();"><span class="hide">팝업 닫기</span></button>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#regFrm';
        const dataUrl = '{{ route('fee.data') }}';


        $(document).on('click',"input[name='payment_method']", function(){
            if ( $(this).val() == 'B' ){
                $(".bank_div").show();
            }else{
                $(".bank_div").hide();
            }
        });

        $(form).on('submit', function(e) {
            if ($("input[name='payment_method']:checked").length < 1) {
                alert('결제방법을 선택해주세요.');
                $("input[name='payment_method']").focus();
                return false;
            }

            if ($("input[name='payment_method']:checked").val() == 'B') {

                if ($("#depositor").val().length < 1) {
                    alert('입금자명을 입력해주세요.');
                    $("#depositor").focus();
                    return false;
                }
                if ($("#deposit_date").val().length < 1) {
                    alert('입금예정일을 입력해주세요.');
                    $("#deposit_date").focus();
                    return false;
                }
            }

            boardSubmit(); // 이 함수에서 ajax로 처리하거나, 그냥 form 전송이면 생략
            // e.preventDefault(); // boardSubmit()에서 ajax 처리라면 여기서도 preventDefault 필요
        });

        const boardSubmit = () => {
            const _price = $("input[name='tot_price']").val();
            if(_price == 0) {
                $("#payment_method").val('F');
            }

            // 'payment_method'가 'B'가 아니라면, 은행 관련 정보 비우기
            if ($("input[name='payment_method']:checked").val() !== 'B') {
                $("#depositor").val('');
                $("#deposit_date").val('');
            }

            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }

    </script>

@endsection