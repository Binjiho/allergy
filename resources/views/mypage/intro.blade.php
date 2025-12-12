@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:인트로 -->
            <ul class="mypage-menu">

                <li class="mem-sch">
                    <a href="{{ route('mypage.member_search') }}">
                        <p class="tit">회원검색 <img src="/assets/image/sub/ic_mypage_sch.png" alt=""></p>
                    </a>
                </li>

                <li><a href="{{ route('mypage.pwCheck') }}">
                         <span class="icon">
                            <img src="/assets/image/sub/ic_mypage01.png" alt="">
                        </span>
                        <p class="tit">개인정보 수정</p>
                    </a>
                </li>
                <li><a href="{{ route('mypage.password') }}">
                        <span class="icon">
                            <img src="/assets/image/sub/ic_mypage02.png" alt="">
                        </span>
                        <p class="tit">비밀번호 변경</p>
                    </a>
                </li>
                <li><a href="{{ route('mypage.fee') }}">
                         <span class="icon">
                            <img src="/assets/image/sub/ic_mypage03.png" alt="">
                        </span>
                        <p class="tit">회비납부현황조회</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mypage.certi') }}">
                        <span class="icon">
                            <img src="/assets/image/sub/ic_mypage04.png" alt="">
                        </span>
                        <p class="tit">학술대회 참석현황</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mypage.bookmark',['code'=>'notice']) }}">
                        <span class="icon">
                            <img src="/assets/image/sub/ic_mypage05.png" alt="">
                        </span>
                        <p class="tit">책갈피</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mypage.withdraw') }}">
                        <span class="icon">
                            <img src="/assets/image/sub/ic_mypage06.png" alt="">
                        </span>
                        <p class="tit">회원탈퇴</p>
                    </a>
                </li>
            </ul>
            <!-- //e:인트로-->

        </div>
    </article>
@endsection

@section('addScript')

@endsection
