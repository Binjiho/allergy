@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="/assets/css/editor.css">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="ev-conbox">

                @include('conference.workshop.detail.workshop_info')
                
                <div class="date-box">
                    <img src="/assets/image/sub/img_date.png" alt="">
                    <div class="text-wrap">
                        사전등록 마감일 : <span>~ {{ \Carbon\Carbon::parse($workshop->regist_edate)->format('Y') }}년 <strong>{{  \Carbon\Carbon::parse($workshop->regist_edate)->format('m') }}</strong>월 <strong>{{  \Carbon\Carbon::parse($workshop->regist_edate)->format('d') }}일</strong> {{ formatKoreanDate($workshop->regist_edate) }} 까지</span>
                    </div>
                </div>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">{{ $workshop->title ?? '' }} 온라인 사전등록</h3>
                </div>
                <div class="write-form-wrap">
                    <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-{{ !empty($reg->sid) ? 'update' : 'create' }}">
                        <input type="hidden" name="member_gubun" id="member_gubun" value="{{ $member_gubun ?? 'N' }}" readonly>
                        <input type="hidden" name="wsid" id="wsid" value="{{ $wsid }}" readonly>
                        <input type="hidden" name="mode" id="mode" value="{{ request()->mode ?? '' }}" readonly>

                        @include('conference.workshop.detail.registration.form.regist-frm')

                        <div class="sub-tit-wrap">
                            <h3 class="sub-tit">개인정보 수집 및 활용 동의</h3>
                        </div>
                        <div class="term-wrap scroll-y">
                            <div class="term-conbox">
                                <ol class="list-type list-type-decimal">
                                    <li>
                                        이용항목 : 국문 이름, 등록자 구분, 근무처(소속)명, 의사면허번호, 휴대전화번호, 개인 E-mail 등.
                                    </li>
                                    <li>
                                        보유 및 이용기간 : 대한천식알레르기학회 사전등록 일시부터 본 학회 폐업시까지. 단, 학회가 새로운 조직을 개설 또는 변경 후 개인정보의 파기를 하지 않고 개설자가 보유 용할 수 있고, 개설자가 개설 또는 변경한 조직으로 개인정보를 이관하여 이용할 수 있습니다.
                                    </li>
                                    <li>
                                        학회는 개인정보를 포함한 학회내 데이터베이스의 변환 및 복구, 회원관리업무 등 일부 업무를 위탁할 수 있으며, 위탁한 업무의 수행을 위하여 필요한 최소한의 개인정보를 당업체나 기관에 제공할 수 있습니다.
                                    </li>
                                    <li>
                                        본 수집 및 활용동의에 미동의 하실 경우 사전등록을 하실 수 없습니다.
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="checkbox-wrap cst">
                            <label class="checkbox-group" for="agree">
                                <input type="checkbox" name="agree" id="agree" value="Y"  {{ ($reg->agree ?? '') == 'Y' ? 'checked' : '' }}> 본인은 개인정보 수집 및 활용에 동의합니다.
                            </label>
                        </div>

                        <div class="sub-tit-wrap" style="margin-top: 30px;">
                            <h3 class="sub-tit">자동화 프로그램 입력 방지</h3>
                        </div>
                        <p class="help-text text-red mb-10">*정보 보안을 위해 아래 적힌 문자를 입력하신 후 등록 가능합니다.</p>
                        <ul class="write-wrap">
                            <li>
                                <div class="form-con">
                                    @include('components.captcha')
                                </div>
                            </li>
                        </ul>

                        <div class="btn-wrap text-center">
                            <a href="{{ route('workshop.detail',['wsid'=>$workshop->sid]) }}" class="btn btn-type1 color-type4">취소</a>
                            <button type="submit" class="btn btn-type1 color-type1">미리보기</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('registration.data', ['wsid'=>$workshop->sid]) }}';

        //캡챠
        $(document).on('keyup', '#captcha_input', function() {
            const _captcha_input = $(this).val();
            callNoneSpinnerAjax(dataUrl, {
                'case': 'captcha-compare',
                'captcha_input': _captcha_input,
            });
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            if($("#agree").is(':checked') == false){
                alert("개인정보 수집 및 활용동의를 체크해주세요.");
                return false;
            }

            //캡챠
            if (isEmpty($("#captcha_input").val())) {
                alert('자동화 프로그램 입력 방지 코드를 입력 해주세요.');
                $("#captcha_input").focus();
                return false;
            }
            if ( $("#captcha_input").data('chk') == 'N' ) {
                alert('자동화 프로그램 입력 방지 코드를 확인 해주세요.');
                $("#captcha_input").focus();
                return false;
            }

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('reg-script')
@endsection
