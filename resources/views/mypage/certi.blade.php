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
                @forelse($list as $row)
                    @if($row->workshop->kind == 'E')
                        @continue($row->pay_status == 'N')
                        <li>
                            <span class="conf-type">교육강좌</span>
                            <p class="tit">{{ $row->workshop->title ?? '' }}</p>
                            <div class="conf-info">
                                <p class="date">
                                    {{ $row->workshop->event_sdate }} {{ !empty($row->workshop->event_edate) ? ' ~ '.$row->workshop->event_edate : '' }}
                                </p>
                                <div class="btn-wrap">
                                    <a href="{{ route('mypage.certiReceipt',['sid'=>$row->sid ?? '']) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="700">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>

                                    <a href="{{ route('lecture',['wsid'=>$row->wsid]) }}" class="btn btn-small color-type10">강의원고 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="type2">
                            <span class="conf-type">학술대회</span>
                            <p class="tit">{{ $row->workshop->title ?? '' }}</p>
                            <div class="conf-info">
                                <p class="date">
                                    {{ $row->workshop->event_sdate }} {{ !empty($row->workshop->event_edate) ? ' ~ '.$row->workshop->event_edate : '' }}
                                </p>
                                <div class="btn-wrap">
                                    @if(!empty($row->workshop->link_url))
                                        <a href="{{ $row->workshop->link_url }}" class="btn btn-small color-type10" target="_blank">Program book <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                                    @endif
{{--                                @if($row->pay_status != 'N')--}}
                                    <a href="{{ route('mypage.certiReceipt',['sid'=>$row->sid ?? '']) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="700">영수증 출력 <span class="icon"><img src="/assets/image/sub/ic_print.png" alt=""></span></a>
{{--                                @endif--}}
                                </div>

                            </div>
                        </li>
                    @endif
                @empty
                @endforelse
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
