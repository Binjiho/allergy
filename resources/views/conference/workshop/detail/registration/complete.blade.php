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

                <div class="signup-complete-wrap">
                    <img src="/assets/image/sub/ic_signup_complete.png" alt="">
                    <div class="tit">{{ $workshop->title ?? '' }} <br>사전등록 <span class="text-skyblue">완료</span>되었습니다.</div>
                    <p class="mt-0">
                        접수하신 내용은 이메일로 발송되며, 영수증은 사전등록 조회 페이지를 통해 직접 출력 가능합니다. <br>
                        혹시 등록 확인 메일을 받지 못하신 경우, 먼저 <span class="text-pink">사전등록 조회를 통해 접수 여부</span>를 확인해 주시길 부탁드립니다. <br>
                        추가 문의사항은 학회사무국으로 연락 주시기 바랍니다.
                    </p>
                    <div class="info">
                        <ul>
                            <li>
                                <span><img src="/assets/image/sub/ic_inquiry.png" alt=""></span>
                                <strong>E-MAILㅣ</strong> <div><a href="mailto:allergy@allergy.or.kr" target="_blank">allergy@allergy.or.kr</a>, <a href="mailto:kaaaci@naver.com" target="_blank">kaaaci@naver.com</a></div>
                            </li>
                            <li>
                                <strong>TELㅣ</strong> <div><a href="tel:+82-2-747-0528" target="_blank">+82-2-747-0528</a></div>
                            </li>
                            <li>
                                <strong>FAXㅣ</strong> <div>+82-2-3676-2847</div>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-wrap text-center">
                        <a href="{{ route('registration.search',['wsid'=>$workshop->sid]) }}" class="btn btn-type1 color-type1">사전등록 조회 및 영수증 출력 바로가기</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
