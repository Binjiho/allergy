@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:아이디/비밀번호 찾기 -->
            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu">
                    <li ><a href="{{ route('findId') }}">아이디 찾기</a></li>
                    <li class="on"><a href="{{ route('findPw') }}">비밀번호 찾기</a></li>
                </ul>
            </div>

            <div class="find-wrap">
                <div class="find-form">
                    <form id="forget-frm" action="" method="post" data-case="forget-password">
                        <fieldset>
                            <legend class="hide">비밀번호 찾기</legend>
                            <div class="find-tit-wrap">
                                <span class="icon">
                                    <img src="/assets/image/sub/ic_findid.png" alt="">
                                </span>
                                <div class="text-wrap">
                                    <h3 class="find-tit">비밀번호 찾기</h3>
                                    <p>
                                        아이디와 이름을 입력해 주세요. <br>
                                        입력하신 정보가 정확히 일치하면, 가입 당시 기재 하셨던 이메일로 초기화된 비밀번호를 보내드립니다.
                                    </p>
                                </div>
                            </div>
                            <div class="input-box">
                                <input type="text" name="user_id" id="user_id" class="form-item" placeholder="아이디를 입력하세요.">
                                <input type="text" name="name_kr" id="name_kr" class="form-item" placeholder="이름을 입력하세요.">
                            </div>
                            <div class="btn-wrap">
                                <button type="submit" class="btn btn-find">비밀번호 찾기</button>
                            </div>

                            {{-- 비밀번호 카운팅 메세지 --}}
                            <div class="find-result-con suc-con" style="display: none;">
                                <p id="suc_msg" class="tit">ooo님의 초기화된 비밀번호는 <strong class="text-pink">****</strong>입니다.</p><br>
                                <p class="mt-10"><small>노출되는 비밀번호는 5분 후 사라집니다. (00:05:00)</small></p>
                            </div>

                            {{-- 텍스트 메세지 --}}
                            <div class="find-result-con not-con" style="display: none;">
                                <p class="tit">일치하는 정보가 없습니다. <br>가입 정보를 다시 확인 해주세요.</p>
                                <div class="btn-wrap">
                                    <a href="{{ route('join',['step'=>'1']) }}" class="btn btn-type1 color-type1">회원가입<span class="icon"><img src="/assets/image/sub/ic_btn_join.png" alt=""></span></a>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- //e:아이디/비밀번호 찾기 -->

        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const frm = '#forget-frm';
        const dataUrl = '{{ route('auth.data') }}';

        defaultVaildation();

        $(frm).validate({
            rules: {
                user_id: {
                    isEmpty: true,
                },
                name_kr: {
                    isEmpty: true,
                },
            },
            messages: {
                user_id: {
                    isEmpty: '아이디를 입력해주세요.',
                },
                name_kr: {
                    isEmpty: '이름을 입력해주세요.',
                },
            },
            submitHandler: function () {
                boardSubmit();
            }
        });

        const boardSubmit = () => {

            let ajaxData = {
                'user_id': $("#user_id").val(),
                'name_kr': $("#name_kr").val(),
                'case': 'forget-password',
            };

            callbackAjax(dataUrl, ajaxData, function(data, error) {
                if (data) {
                    $(".not-con").hide();
                    $(".suc-con").hide();

                    if (data.result['res'] == 'NOT') {
                        $(".not-con").show();
                        return false;
                    }else{
                        alert("회원님의 이메일로 임시비밀번호가 발송되었습니다.");

                        $(".suc-con").show();
                        $("#suc_msg").html(data.result['msg']);

                        timeCountStart();

                        $("small").text(`노출되는 비밀번호는 5분 후 사라집니다.(00:05:00)`);
                    }

                }

            }, true);
        }

        function timeCountStart() {
            let timeText = $("small").text().match(/\d{2}:\d{2}:\d{2}/)[0]; // 00:05:00 가져오기
            let timeParts = timeText.split(":").map(Number); // [0, 5, 0]

            let totalSeconds = timeParts[0] * 3600 + timeParts[1] * 60 + timeParts[2]; // 전체 초 계산

            let interval = setInterval(function () {
                if (totalSeconds <= 0) {
                    clearInterval(interval);
                    $(".suc-con").fadeOut(); // 시간 종료 후 숨기기
                    return;
                }

                totalSeconds--; // 1초 감소

                let h = String(Math.floor(totalSeconds / 3600)).padStart(2, "0");
                let m = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, "0");
                let s = String(totalSeconds % 60).padStart(2, "0");

                $("small").text(`노출되는 비밀번호는 5분 후 사라집니다.(${h}:${m}:${s})`);
            }, 1000);
        }

    </script>
@endsection
