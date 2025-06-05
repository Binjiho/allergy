@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox signup-conbox inner-layer">
            <div class="bg-box signup-info-box">
                <strong>
                    대한천식알레르기학회 회원님의 개인정보보호를 위해 최선을 다하고 있습니다. <br>
                    회원님의 정보는 동의 없이 공개되지 않으며, 개인정보취급방침 가이드에 맞춰 보호 받고 있습니다.
                </strong>
            </div>

            <div class="step-list-wrap type2">
                <ol class="step-list">
                    <li class="on">
                        <span class="icon"></span>
                        <span class="tit">01. 약관동의</span>
                    </li>
                    <li class="on">
                        <span class="icon"></span>
                        <span class="tit">02. 기본정보 입력</span>
                    </li>
                    <li class="on">
                        <span class="icon"></span>
                        <span class="tit">03. 상세정보 입력</span>
                    </li>
                    <li class="on">
                        <span class="icon"></span>
                        <span class="tit">04. 부가정보 입력</span>
                    </li>
                    <li class="on">
                        <span class="icon"></span>
                        <span class="tit">05. 가입 완료</span>
                    </li>
                </ol>
            </div>

            <div class="signup-complete-wrap">
                <img src="/assets/image/sub/ic_signup_complete.png" alt="">
                <div class="tit">대한천식알레르기학회 <br>회원가입이 정상적으로 <span class="text-skyblue">완료</span>되었습니다.</div>
                <strong><span>{{ $user->name_kr ?? '' }}</span>님 회원가입을 축하드립니다.</strong>
                <p>
                    대기자로 우선 가입되시며, 대한천식알레르기학회 가입 승인 후 등급이 조정됩니다. <br>
                    <span class="text-pink">가입 승인은 최대 10일 이상 소요</span> 될 수 있는 점 양해 부탁 드리며, 승인 완료 후 회원가입 시 입력해 주셨던 아이디(이메일)로 승인 완료 메일이 자동 발송 됩니다. <br>
                    궁금한 부분이 있으시면 사무국으로 연락을 주시기 바랍니다. 감사합니다.
                </p>
                <div class="info">
                    <span><img src="/assets/image/sub/ic_inquiry.png" alt=""> 회원가입 관련 문의</span>
                    <ul>
                        <li>
                            <strong>TELㅣ</strong> <div><a href="tel:+82-2-747-0528" target="_blank">+82-2-747-0528</a></div>
                        </li>
                        <li>
                            <strong>E-MAILㅣ</strong> <div><a href="mailto:allergy@allergy.or.kr" target="_blank">allergy@allergy.or.kr</a>, <a href="mailto:kaaaci@naver.com" target="_blank">kaaaci@naver.com</a></div>
                        </li>
                    </ul>
                </div>
                <div class="btn-wrap text-center">
                    <a href="{{ route('login') }}" class="btn btn-type1 color-type1">로그인 하기 <span class="icon"><img src="/assets/image/sub/ic_btn_login.png" alt=""></span></a>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection