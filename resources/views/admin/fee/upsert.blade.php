@extends('admin.layouts.popup-layout')

@section('addStyle')
    <style>
        .description-div {
            margin-bottom: 15px;
            font-size: 1.5rem;
            font-weight: 700;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">회비 {{ empty($fee->sid) ? '등록' : '수정' }}</h3>
    </div>

    <form id="fee-frm" method="post" data-sid="{{ $fee->sid ?? 0 }}" data-case="fee-{{ empty($fee->sid) ? 'create' : 'update' }}">
        <input type="hidden" name="user_sid" id="user_sid" class="form-item" value="{{ !empty($user->sid) ? $user->sid ?? '' : ($fee->user->sid ?? '') }}"  readonly>
        <input type="hidden" name="isAge50OrOlder" id="isAge50OrOlder" class="form-item" value="{{ !empty($user->sid) ? $user->isAge50OrOlder($user->birth_date ?? '') ?? 0 : (!empty($fee) ? $fee->user->isAge50OrOlder($fee->user->birth_date ?? '') ?? 0 : 0) }}" readonly>
        <input type="hidden" name="level" id="level" class="form-item" value="{{ !empty($user->sid) ? $user->level ?? '' : ($fee->user->level ?? '') }}" readonly>
        <fieldset>
            <div class="write-wrap">
                <ul>
                    @if(!empty($user->sid))
                        <li>
                            <div class="form-tit"><strong class="required">*</strong> 회원 아이디</div>
                            <div class="form-con">
                                <div class="form-group has-btn">
                                    <input type="text" id="id_span" class="form-item" value="{{ $user->id ?? '' }}" disabled>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-tit">회원등급</div>
                            <div class="form-con">
                                <span id="level_span">{{ $userConfig['level'][$user->level ?? ''] ?? '' }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-tit">이름</div>
                            <div class="form-con">
                                <span id="name_span">{{ $user->name_kr ?? '' }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-tit">근무처 정보</div>
                            <div class="form-con">
                                <span id="company_span">{{ $user->company_kr ?? ''  }}</span>
                            </div>
                        </li>
                    @else
                        <li>
                            <div class="form-tit"><strong class="required">*</strong> 회원 아이디</div>
                            <div class="form-con">
                                <div class="form-group has-btn">
                                    <input type="text" id="id_span" class="form-item" value="{{ $fee->user->id ?? '' }}" disabled>
                                    @if(empty($fee->sid))
                                        <a href="{{ route('member.popup.search') }}" class="btn btn-small color-type2 call-popup" data-width="1200" data-name="user-search">
                                            회원선택
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-tit">회원등급</div>
                            <div class="form-con">
                                <span id="level_span">{{ $userConfig['level'][$fee->user->level ?? ''] ?? '' }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-tit">이름</div>
                            <div class="form-con">
                                <span id="name_span">{{ $fee->user->name_kr ?? '' }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-tit">근무처 정보</div>
                            <div class="form-con">
                                <span id="company_span">{{ empty($fee) ? '' : $fee->user->company_kr }}</span>
                            </div>
                        </li>
                    @endif
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 회비 구분</div>
                        <div class="form-con">
                            <select name="category" id="category" class="form-item">
                                <option value="">선택</option>
                                @foreach($feeConfig['category'] as $key => $val)
                                    @php
                                        $disabled = '';
                                        if( !empty($user->sid) ){
                                            if ( ($user->level ?? '') == 'B' && $key == 'C' ) {
                                                $disabled = 'disabled';
                                            }
                                            if( ( ($user->level ?? '') == 'C') || ($user->level ?? '') == 'D') {
                                                $disabled = 'disabled';
                                            }
                                        }
                                    @endphp

                                    <option value="{{ $key }}" {{ ($fee->category ?? '') == $key ? 'selected' : '' }} {{ $disabled }}>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 회비 연도</div>
                        <div class="form-con">
                            <select name="year" id="year" class="form-item">
                                <option value="">선택</option>
                                @foreach($feeConfig['year'] as $key => $val)
                                    <option value="{{ $key }}" {{ ($fee->year ?? now()->format('Y')) == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit">회비금액</div>
                        <div class="form-con">
                            {{--                            <span id="price_span">{{ empty($fee) ? '' : number_format($fee->price) }}</span>--}}
                            <input type="text" name="price" id="price" class="form-item" value="{{ $fee->price ?? 0 }}" onlyNumber>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit">납부방법</div>
                        <div class="form-con">
                            <select name="payment_method" id="payment_method" class="form-item">
                                <option value="">선택</option>
                                @foreach($feeConfig['payment_method'] as $key => $val)
                                    <option value="{{ $key }}" {{ ($fee->payment_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>

                    <li class="bank_li">
                        <div class="form-tit">입금자명</div>
                        <div class="form-con">
                            <input type="text" name="depositor" id="depositor" class="form-item" value="{{ $fee->depositor ?? '' }}" >
                        </div>
                    </li>
                    <li class="bank_li">
                        <div class="form-tit">입금예정일</div>
                        <div class="form-con">
                            <input type="text" name="deposit_date" id="deposit_date" class="form-item" value="{{ !empty($fee->deposit_date) && isValidTimestamp($fee->deposit_date) ? $fee->deposit_date : '' }}" readonly datepicker>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit">납부상태</div>
                        <div class="form-con">
                            <select name="payment_status" id="payment_status" class="form-item">
                                <option value="">선택</option>
                                @foreach($feeConfig['payment_status'] as $key => $val)
                                    <option value="{{ $key }}" {{ ($fee->payment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit">납부일</div>
                        <div class="form-con">
                            <input type="text" name="payment_date" id="payment_date" class="form-item" value="{{ !empty($fee->payment_date) && isValidTimestamp($fee->payment_date) ? $fee->payment_date : '' }}" readonly datepicker>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit">메모</div>
                        <div class="form-con">
                            <textarea name="memo" id="memo" cols="30" rows="10" style="resize: none; padding: 5px; border: 1px solid #cbd3d9">{!! $fee->memo ?? '' !!}</textarea>
                        </div>
                    </li>
                </ul>
            </div>
        </fieldset>

        <div class="btn-wrap text-center">
            <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
            <button type="submit" class="btn btn-type1 color-type6">{{ empty($fee->sid) ? '등록' : '수정' }}</button>
        </div>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#fee-frm';
        const dataUrl = '{{ route('fee.data') }}';
        const feeConfig = @json($feeConfig);

        function setUserInfo(userInfo) {
            $('#user_sid').val(userInfo.sid);
            $('#isAge50OrOlder').val(Number(userInfo.isAge50OrOlder));
            $('#level').val(userInfo.level);

            $('#level_span').html(userInfo.getLevel);
            $('#id_span').val(userInfo.id);
            $('#name_span').html(userInfo.name_kr);
            $('#company_span').html(userInfo.company_kr);

            const cateArr = feeConfig['getCate'][userInfo.level];

            let html = "";
            html += "<option value=\"\">선택</option>";
            for (let key in cateArr) {
                html += `<option value="${key}">${cateArr[key]}</option>`;
            }
            $("#category").children().remove();
            $("#category").append(html);
        }

        $(document).on('change', '#category', function () {
            const _level = $("#level").val();
            let _price = 0;
            if(_level.length < 1){
                alert('회원을 먼저 선택해주세요.');
                return false;
            }
            let _value = $(this).val();
            if(_value.length < 1){
                alert('회비 구분을 먼저 선택해주세요.');
                // $('#price_span').html(0);
                $('#price').val(0);
                return false;
            }

            if( _level == 'B' /*준회원*/){
                if( _value == 'C' && $("#isAge50OrOlder").val() > 0){
                    _value = 'D' /*55세 이상 종신회비*/;
                }
                _price = feeConfig['price'][_level][_value];
            }else if (_level == 'A'){
                _price = feeConfig['price'][_level][_value];
            }

            // $('#price_span').html(comma(_price));
            $('#price').val(_price);
        });

        $(document).on('change', 'select[name=payment_method]', function () {
            const target = $('.deposit-li');

            if ($(this).val() == 'B') {
                target.show();
            } else {
                target.hide();
                target.find('input').val('');
            }
        });

        defaultVaildation();

        $(form).validate({

            rules: {
                user_sid: {
                    isEmpty: true,
                },
                category: {
                    isEmpty: true,
                },
                year: {
                    isEmpty: true,
                },
                payment_status: {
                    isEmpty: true,
                },
            },
            messages: {
                user_sid: {
                    isEmpty: '회원을 선택해주세요.',
                },
                category: {
                    isEmpty: '회비 구분을 선택해주세요.',
                },
                year: {
                    isEmpty: '회비 연도를 선택해주세요.',
                },
                payment_status: {
                    isEmpty: '납부상태를 선택해주세요.',
                },

            },
            submitHandler: function () {
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            const _fee_sid = $("#fee-frm").data('sid');

            if(_fee_sid > 0){
                if(confirm("회비 내역을 수정하시겠습니까?")){
                    callMultiAjax(dataUrl, ajaxData);
                }
            }else{
                if(confirm("회비 내역을 추가 등록 하시겠습니까?")){
                    callMultiAjax(dataUrl, ajaxData);
                }
            }


        }
    </script>
@endsection
