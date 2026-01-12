<fieldset>
    @if(checkUrl() != 'admin')
    <div class="overseas-text-wrap">
        <ul class="list-type list-type-check">
            <li>학회 가입 시 등록된 회원 정보를 불러옵니다.</li>
            <li>정보 수정이 필요한 경우, 아래 <span class="text-skyblue">[회원정보 수정하기]</span> 버튼을 클릭하여 수정 요청을 진행해 주세요.</li>
            <li>회원정보 수정이 완료된 후에는 반드시 본 페이지로 다시 돌아와 <span class="text-green">[회원정보 업데이트]</span> 버튼을 클릭해 주셔야 정상적으로 등록이 완료됩니다.</li>
        </ul>
        <div class="btn-wrap text-center">

            <a href="{{ route('mypage.pwCheck') }}" class="btn btn-type1 color-type2">회원정보 수정하기</a>
            <a href="javascript:getMyInfo();" class="btn btn-type1 color-type3">최신 회원정보 불러오기</a>
        </div>
    </div>
    @endif

    <legend class="hide">인적사항 확인</legend>
    <div class="sub-tit-wrap">
        <h4 class="sub-tit">신청자 정보</h4>
    </div>

    <ul class="write-wrap">
        <li>
            <div class="form-tit">학회 아이디</div>
            <div class="form-con">{{ $overseas->user->id ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">성명 (한글)</div>
            <div class="form-con">{{ $overseas->user->name_kr ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">성명 (영문)</div>
            <div class="form-con">{{ $overseas->user->first_name ?? '' }} {{ $overseas->user->last_name ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">의사면허번호</div>
            <div class="form-con">{{ $overseas->user->license_number ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">생년월일</div>
            <div class="form-con">{{ $overseas->user->birth_date ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">전공분야</div>
            <div class="form-con">{{ $userConfig['major'][$overseas->user->major ?? ''] ?? '' }} {{ $overseas->user->major == 'Z' ? ($overseas->user->major_etc ?? '') : '' }}</div>
        </li>
        <li>
            <div class="form-tit">근무처 정보(국문) <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="sosok_kr" id="sosok_kr" value="{{ $overseas->sosok_kr ?? '' }}" class="form-item">
            </div>
        </li>
        <li>
            <div class="form-tit">휴대전화번호 <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="phone" id="phone" value="{{ $overseas->phone ?? '' }}" class="form-item" placeholder="숫자만 입력해주세요." onlyNumber>
            </div>
        </li>
        <li>
            <div class="form-tit">E-mail <strong class="required">*</strong></div>
            <div class="form-con">
                <input type="text" name="email" id="email" value="{{ $overseas->email ?? '' }}" class="form-item" emailOnly>
            </div>
        </li>
        <li>
            <div class="form-tit">계좌정보 <strong class="required">*</strong></div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-tit">은행명</div>
                        <div class="form-con">
                            <input type="text" name="bank_name" id="bank_name" value="{{ $overseas->bank_name ?? '' }}" class="form-item">
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">계좌번호</div>
                        <div class="form-con">
                            <input type="text" name="account_num" id="account_num" value="{{ $overseas->account_num ?? '' }}" class="form-item">
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">예금주</div>
                        <div class="form-con">
                            <input type="text" name="account_name" id="account_name" value="{{ $overseas->account_name ?? '' }}" class="form-item">
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

</fieldset>

@section('step2-script')
    <script>
        const getMyInfo = () => {
            callAjax(dataUrl, {
                'case': 'get-myInfo',
                'user_sid': '{{ $overseas->user_sid }}',
            });
        }

        $(document).on('submit', form, function () {

        @if(checkUrl() != 'admin')
            if($("#imsi").val() != 'Y'){
                if (isEmpty( $("[name='sosok_kr']").val() )) {
                    alert('근무처 정보를 입력해주세요.');
                    $("input[name='sosok_kr']").focus();
                    return false;
                }
                if (isEmpty( $("[name='phone']").val() )) {
                    alert('휴대전화번호를 입력해주세요.');
                    $("input[name='phone']").focus();
                    return false;
                }
                if (isEmpty( $("[name='email']").val() )) {
                    alert('E-mail을 입력해주세요.');
                    $("input[name='email']").focus();
                    return false;
                }
                if (isEmpty( $("[name='bank_name']").val() )) {
                    alert('은행명을 입력해주세요.');
                    $("input[name='bank_name']").focus();
                    return false;
                }
                if (isEmpty( $("[name='account_num']").val() )) {
                    alert('계좌번호를 입력해주세요.');
                    $("input[name='account_num']").focus();
                    return false;
                }
                if (isEmpty( $("[name='account_name']").val() )) {
                    alert('예금주를 입력해주세요.');
                    $("input[name='account_name']").focus();
                    return false;
                }
            }
        @endif


            boardSubmit();
        });
    </script>
@endsection