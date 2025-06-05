@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="bg-box text-center">
                <strong class="tit">{{ $user->name_kr ?? '' }}님</strong>
                <p>
                    현재까지의 학술대회, 교육강좌 등록 내역입니다. <br>
                    2016년 추계학술대회부터 등록데이터 확인 가능하며, 등록 시 의사면허번호 기재하신 회원분들만 확인 가능합니다. <br>
                    (춘,추계 학술대회의 경우 행사 종료 10일 후부터 데이터 확인 가능합니다.)
                </p>
            </div>
            <ul class="box-list conf-list js-more-list">
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
                            <a href="{{ route('mypage.certiReceipt',['tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="700">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>

                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="conf-type">교육강좌</span>
                    <p class="tit">2021 58차 알레르기 교육강좌</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">대한천식알레르기학회 2017 추계학술대회</p>
                    <div class="conf-info">
                        <p class="date">2017-11-04</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
                <li class="type2">
                    <span class="conf-type">학술대회</span>
                    <p class="tit">2017 대한천식알레르기학회 춘계학술대회 <br>(2017 KAAACI-WPAS-INTERASA Joint Congress)</p>
                    <div class="conf-info">
                        <p class="date">2021-07-19</p>
                        <div class="btn-wrap">
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>--}}
                            <a href="#n" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="btn-wrap">
                <button type="button" class="btn-more js-btn-more">
                    더보기 <img src="/assets/image/sub/ic_btn_more.png" alt="">
                </button>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
