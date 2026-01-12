@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="main-visual">
        <div class="main-visual-wrap js-main-visual cf">
            <div class="main-visual-con main-visual-con01">
                <div class="main-visual-text inner-layer">
                    <h2 class="main-visual-tit">
                        <span class="sub-title">Since 1972</span><br>
                        <span class="title">대한천식알레르기학회</span>는 <br class="m-show">국민보건 향상을 위해 천식,알레르기 및 <br class="m-show">임상면역학 분야의 학문발전에 기여합니다.
                    </h2>
                    <img src="/assets/image/main/img_mainvisual01.png" alt="" class="m-hide">
                    <img src="/assets/image/main/img_mainvisual01_m.png" alt="" class="m-show">
                </div>
            </div>
            <div class="main-visual-con">
                <a href="https://allergy3.pcocms.com/" target="_blank">
                    <picture>
                        <source srcset="/assets/image/main/img_mainvisual02_m.jpg" media="(max-width: 768px)">
                        <img src="/assets/image/main/img_mainvisual02.jpg" alt="">
                    </picture>
                </a>
            </div>
        </div>
        <div class="slider-attr">
            <div class="slick-dots-wrap"></div>
            <div class="slick-arrow-wrap">
            </div>
        </div>
    </article>

    <article class="main-contents inner-layer">
        <h3 class="hide">공지사항 | 유관기관 | 보험관련 | 보도자료 | 유튜브</h3>
        <div class="main-board-conbox">
            <div class="main-board-menu tab-drop-wrap js-tab-drop-wrap">
                <a href="#n" class="btn-drop-menu js-btn-tab-drop"></a>
                <ul>
                    <li class="{{ ( (request()->bcode ?? '') == 'notice' && (request()->category ?? '') == '1') || (empty(request()->bcode) && empty(request()->category)) ? 'on' : '' }}"><a href="{{ route('main',['bcode'=>'notice','category'=>1]) }}">
                            <span class="icon type1">아이콘</span> 공지사항
                        </a></li>
                    <li class="{{ ( (request()->bcode ?? '') == 'notice' && (request()->category ?? '') == '2') ? 'on' : '' }}"><a href="{{ route('main',['bcode'=>'notice','category'=>2]) }}">
                            <span class="icon type2">아이콘</span> 유관기관
                        </a></li>
                    <li class="{{ ( (request()->bcode ?? '') == 'notice' && (request()->category ?? '') == '3') ? 'on' : '' }}"><a href="{{ route('main',['bcode'=>'notice','category'=>3]) }}">
                            <span class="icon type3">아이콘</span> 보험관련
                        </a></li>
                    <li class="{{ ( (request()->bcode ?? '') == 'notice' && (request()->category ?? '') == '4') ? 'on' : '' }}"><a href="{{ route('main',['bcode'=>'notice','category'=>4]) }}">
                            <span class="icon type4">아이콘</span> 보도자료
                        </a></li>
                </ul>
            </div>
{{--     TODO : 서버 이동 우선 막기    --}}
            <ul class="main-board-con list-type list-type-dot">
                @forelse($notice_list as $row)
                    <li>
                        <a href="{{ route('board.view', ['code' => $row->code, 'sid' => $row->sid]) }}">
                            <p class="tit ellipsis">{{ $row->subject ?? '' }}</p>
                            <span class="date">{{ $row->created_at->format('Y.m.d') ?? '' }}</span>
                        </a>
                </li>
                @empty
                    <li class="no-data">
                        등록된 게시글이 없습니다.
                    </li>
                @endforelse
            </ul>

            <a href="javascript:moveBoard();" class="btn btn-more">
                More <span class="icon"><img src="/assets/image/main/ic_more_arrow.png" alt=""></span>
            </a>
        </div>
        <div class="main-video-conbox">
            <div class="video-wrap">
                <iframe src="https://www.youtube.com/embed/x20ku4Iry4Y?si=Sj5sxBNtZLiB2_mF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <a href="https://www.youtube.com/@Kaaaci_Allergy" target="_blank" class="btn btn-type1 color-type1 btn-round text-left">
                대한천식알레르기학회 유튜브 바로가기<span class="arrow"><img src="/assets/image/main/ico_link_arrow.png" alt=">"></span>
            </a>
        </div>
    </article>

    <article class="main-contents inner-layer">
        <h3 class="hide">뉴스레터 | 진료지침 | 포토갤러리</h3>
        <ul class="main-link-conbox">
            <li>
                <p class="title"><span>뉴스레터</span></p>
                <div class="img-wrap">
                    @if(!empty($newsletter))
                        <img src="{{ asset($newsletter->thumbnail_realfile) }}" alt="">
                    @else
{{--                        <img src="/assets/image/main/img_newsletter.png" alt="">--}}
                    @endif
                </div>
                <a href="{{ route('board', ['code' => "newsletter"]) }}" class="btn btn-type1 btn-round text-left">
                    뉴스레터 최근호 보기 <span class="arrow"><img src="/assets/image/main/ico_link_arrow.png" alt=">"></span>
                </a>
            </li>
            <li>
                <p class="title"><span>진료지침</span></p>
                <ul class="con-wrap">
                    <li>
                        <a href="https://allergy.or.kr/board/treatment/view/7821?gubun=1">
                            <p class="subject ellipsis2">중증 천식 환자 스테로이드 사용과 감량에 대한 전문가 의견서</p>
                            <p class="text-right">2025</p>
                        </a>
                    </li>
                    <li>
                        <a href="https://allergy.or.kr/board/treatment/view/7820?gubun=1">
                            <p class="subject ellipsis2">난치 아토피피부염 전신 치료에 관한 전문가 의견서 업데이트</p>
                            <p class="text-right">2024</p>
                        </a>
                    </li>
{{--     TODO : 서버 이동 우선 막기    --}}
                    @forelse($guideline as $row)
                        <li>
                            <a href="{{ route('board.view', ['code' => $row->code, 'sid' => $row->sid]) }}">
                                <p class="subject ellipsis2">{{ $row->subject ?? '' }}</p>
                                <p class="text-right">{{ $row->created_at->format('Y') ?? '' }}</p>
                            </a>
                        </li>
                    @empty
                    @endforelse
                </ul>
                <a href="{{ route('board', ['code' => "treatment",'gubun'=>'1']) }}" class="btn btn-type1 btn-round text-left">
                    진료지침 바로가기 <span class="arrow"><img src="/assets/image/main/ico_link_arrow.png" alt=">"></span>
                </a>
            </li>
            <li>
                <p class="title"><span>최신논문소식</span></p>
                <ul class="con-wrap">
{{--     TODO : 서버 이동 우선 막기    --}}
                    @forelse($absnews as $row)
                        <li>
                            <a href="{{ route('board.view', ['code' => $row->code, 'sid' => $row->sid]) }}">
                                <p class="subject ellipsis2">{{ $row->subject ?? '' }}</p>
                                <p class="text-right">{{ $row->created_at->format('Y') ?? '' }}</p>
                            </a>
                        </li>
                    @empty
                    @endforelse
                </ul>
                <a href="{{ route('board', ['code' => "abs-news"]) }}" class="btn btn-type1 btn-round text-left">
                    최신논문소식 바로가기 <span class="arrow"><img src="/assets/image/main/ico_link_arrow.png" alt=">"></span>
                </a>
            </li>
        </ul>
    </article>

    <article class="main-contents main-schedule-wrap">
        <div class="main-title-wrap inner-layer">
            <h3>행사일정</h3>
            <p>대한천식알레르기학회 및 연관학회의 <br class="m-show">행사일정을 안내 드립니다.</p>
            <a href="{{ route('board',['code'=>'event-schedule']) }}" class="plus"><span class="hide">more</span></a>
        </div>
        <div class="main-schedule-menu">
            <div class="inner-layer">
                <div class="main-year-menu">
                    <select name="year" id="year">
                        @foreach($yearList as $yearItem)
                        <option value="{{ $yearItem }}" {{ (request()->year ?? date('Y') ) == $yearItem ? 'selected' : '' }}>
                            {{ $yearItem }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="main-month-menu tab-drop-wrap js-tab-drop-wrap">
                    <a href="#n" class="btn-drop-menu js-btn-tab-drop"></a>
                    <ul class="month">
                        <li class="{{ (request()->month ?? date('m') ) == '1' ? 'on' : '' }}" data-month="1"><a href="javascript:;">1월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '2' ? 'on' : '' }}" data-month="2"><a href="javascript:;">2월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '3' ? 'on' : '' }}" data-month="3"><a href="javascript:;">3월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '4' ? 'on' : '' }}" data-month="4"><a href="javascript:;">4월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '5' ? 'on' : '' }}" data-month="5"><a href="javascript:;">5월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '6' ? 'on' : '' }}" data-month="6"><a href="javascript:;">6월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '7' ? 'on' : '' }}" data-month="7"><a href="javascript:;">7월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '8' ? 'on' : '' }}" data-month="8"><a href="javascript:;">8월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '9' ? 'on' : '' }}" data-month="9"><a href="javascript:;">9월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '10' ? 'on' : '' }}" data-month="10"><a href="javascript:;">10월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '11' ? 'on' : '' }}" data-month="11"><a href="javascript:;">11월</a></li>
                        <li class="{{ (request()->month ?? date('m') ) == '12' ? 'on' : '' }}" data-month="12"><a href="javascript:;">12월</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-schedule-con js-main-schedule inner-layer">
{{--     TODO : 서버 이동 우선 막기    --}}
            @forelse($event_list as $row)
            <div class="schedule-conbox">
                <a href="{{ route('board.view', ['code' => 'event-schedule', 'sid' => $row->sid]) }}">
                    <p class="title ellipsis2">{{ $row->subject }}</p>
                    <p class="ico date">{{ !empty($row->event_sDate) ? $row->event_sDate->format('Y.m.d') : $row->created_at->format('Y.m.d') }}</p>
                    <p class="ico place">{{ $row->place }}</p>
                </a>
            </div>
            @empty
            <div class="schedule-conbox no-data">
                등록된 일정이 없습니다.
            </div>
            @endforelse
        </div>
    </article>

    <article class="main-contents inner-layer">
        <h3 class="hide">AAIR | AARD | 알레르기 전문 병원 검색 | 아토피 천식 교육 정보센터 | 역대학술대회</h3>
        <ul class="main-quick-conbox">
            <li>
                <a href="https://www.e-aair.org/index.php" target="_blank">
                    <p>AAIR</p>
                    <img src="/assets/image/main/img_main_quick01.png" alt="">
                    <span class="arrow"><span class="hide">></span></span>
                </a>
            </li>
            <li>
                <a href="https://www.aard.or.kr/" target="_blank">
                    <p>AARD</p>
                    <img src="/assets/image/main/img_main_quick02.png" alt="">
                    <span class="arrow"><span class="hide">></span></span>
                </a>
            </li>
            <li>
                <a href="{{ route('general.hospitalSearch') }}">
                    <p>알레르기 전문 <br>병원 검색</p>
                    <img src="/assets/image/main/img_main_quick03.png" alt="">
                    <span class="arrow"><span class="hide">></span></span>
                </a>
            </li>
            <li>
                <a href="{{ route('general.center') }}">
                    <p>아토피 천식 <br>교육 정보센터</p>
                    <img src="/assets/image/main/img_main_quick04.png" alt="">
                    <span class="arrow"><span class="hide">></span></span>
                </a>
            </li>
            <li>
                <a href="{{ route('general.hospitalSearch') }}">
                    <p>일반인정보</p>
                    <img src="/assets/image/main/img_main_quick05.png" alt="">
                    <span class="arrow"><span class="hide">></span></span>
                </a>
            </li>
        </ul>
    </article>
@endsection

@section('addScript')
    <script>
        $(document).on('click', '.month li', function() {
            $('.month li').removeClass('on');
            // 클릭된 항목에 'on' 클래스 추가
            $(this).addClass('on');

            const _month = $(this).data('month');
            const _year = $("#year").val();
            location.href="/?month="+_month+"&year="+_year;
        });

        $(document).on('change', '#year', function() {
            const _month = $(".month li.on").data('month');
            const _year = $("#year").val();
            location.href="/?month="+_month+"&year="+_year;
        });

        const moveBoard = (_this) => {
            const _url = "{{ route('board', ['code' => "notice", 'category'=>request()->category ?? '1']) }}";
            location.href = _url;
        }
    </script>

    @isset($boardPopupList)
        @include('common.board.popup.rolling-popup')
        @include('common.board.popup.rolling-popup-script')
    @endisset

@endsection
