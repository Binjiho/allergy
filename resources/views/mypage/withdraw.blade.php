@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">

        <!-- s:회원탈퇴 -->
        <div class="sub-conbox inner-layer">
            <div class="write-form-wrap">
                <form action="{{ route('mypage.data') }}" id="register-frm" method="post" onsubmit="return false;" data-case="withdraw-create" data-sid="{{ $user->sid ?? 0 }}">
                    <fieldset>
                        <legend class="hide">회원탈퇴</legend>

                        <div class="bg-img-box bg-box">
                            <div class="img-wrap">
                                <img src="/assets/image/sub/img_resign.png" alt="">
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">탈퇴 신청 전 아래 사항을 반드시 확인해주세요.</strong>
                                <ul class="list-type list-type-dot">
                                    <li>
                                        회원탈퇴 시 대한천식알레르기학회의 모든 정보가 삭제되며, 탈퇴 후 복구가 불가능합니다.
                                    </li>
                                    <li>
                                        본인이 직접 신청하셔야 하며, 회원 DB에 있는 정보와 일치하여야만 탈퇴가 가능합니다.
                                    </li>
                                    <li>
                                        신청된 탈퇴 내역은 <span class="text-red">학회의 확인 후 신청일로부터 10일 이내 탈퇴 처</span>리 됩니다.
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <ul class="write-wrap">
                            <li>
                                <div class="form-tit">이름</div>
                                <div class="form-con">
                                    {{ $user->name_kr ?? '' }}
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">아이디</div>
                                <div class="form-con">
                                    {{ $user->id ?? '' }}
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">회원등급</div>
                                <div class="form-con">
                                    {{ $userConfig['level'][$user->level ?? ''] ?? '' }}
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">학회 가입일</div>
                                <div class="form-con">
                                    {{ !empty($user->created_at) ? $user->created_at->format('Y.m.d') : '' }}
                                </div>
                            </li>
                        </ul>
                        <div class="btn-wrap text-center">
                                <a href="{{ route('main') }}" class="btn btn-type1 color-type4">닫기</a>
                                <button type="submit" class="btn btn-type1 btn-line color-type7">회원탈퇴</button>
                            </div>

                    </fieldset>
                </form>
            </div>
            <!-- //e:회원탈퇴-->

        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('mypage.data') }}';

        defaultVaildation();

        $(form).validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function () {
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            if(confirm("회원탈퇴신청 버튼을 누르시면 모든 정보가 삭제되며,\n이후 복구가 어렵습니다. 회원탈퇴 신청을 하시겠습니까?")){
                let ajaxData = newFormData(form);
                callMultiAjax(dataUrl, ajaxData);
            }else{
                return false;
            }
        }
    </script>
@endsection