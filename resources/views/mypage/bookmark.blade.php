@extends('layouts.web-layout')

@section('addStyle')
    @if($code == 'notice')
    <link rel="stylesheet" href="{{ asset('html/bbs/notice/assets/css/board.css') }}">
    @endif
    @if($code == 'event-schedule')
    <link rel="stylesheet" href="{{ asset('html/bbs/schedule/assets/css/event.css') }}">
    @endif
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="like-menu-wrap">
                <button type="button" class="btn btn-arrow btn-prev js-prev"><span class="hide">이전</span></button>
                <div class="like-menu-list js-menu-rolling">
                    <a href="{{ route('mypage.bookmark',['code'=>'event-schedule']) }}" class="{{ ($code ?? '') == 'event-schedule' ? 'current' : '' }}">행사일정</a>
                    <a href="{{ route('mypage.bookmark',['code'=>'notice']) }}" class="{{ ($code ?? '') == 'notice' ? 'current' : '' }}">공지사항</a>
                </div>
                <button type="button" class="btn btn-arrow btn-next js-next"><span class="hide">다음</span></button>
            </div>

            <!-- s:행사일정일 경우 -->
            @include('board.'.$code.'.bookmark-form')
            <!-- //e:행사일정일 경우 -->

            <!-- s:일반 게시판일 경우 -->

            <!-- //e:일반 게시판일 경우 -->

            <!-- s:포토갤러리일 경우 -->

            <!-- //e:포토갤러리일 경우 -->
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('board.data', ['code' => $code]) }}';

        $(document).on('click', '.btn-like', function() {
            const ajaxData = {
                'sid': $(this).data('sid'),
                'case': 'change-heart',
                'target': $(this).hasClass('on') ? 'Y':'N',
            };
            callAjax(dataUrl, ajaxData);
        });
    </script>

    @if($code == 'event-schedule')
    <script>
        const year = {{ $year }};
        const month = '{{ $month }}';
        const gubun = '{{ $gubun }}';
        const defaultUrl = '{{ route('mypage.bookmark', ['code' => 'event-schedule']) }}';

        $(document).on('change', 'select[name=month]', function () {
            let locationUrl = defaultUrl;
            locationUrl += "&year=" + year;
            locationUrl += "&month=" + $(this).val();
            locationUrl += "&gubun=" + gubun;

            location.replace(locationUrl);
        });

        $(document).on('click', '.ev-contop .btn-ev-arrow', function () {
            const _this = $(this);
            const minYear = {{ $minYear }};
            const maxYear = {{ $maxYear }};
            let locationUrl = defaultUrl;

            if (_this.hasClass('btn-ev-first')) {
                locationUrl += "?year=" + minYear;
                location.replace(locationUrl);
            }

            if (_this.hasClass('btn-ev-prev')) {
                locationUrl += (year == minYear)
                    ? "?year=" + minYear
                    : "?year=" + (year - 1);

                location.replace(locationUrl);
            }

            if (_this.hasClass('btn-ev-next')) {
                locationUrl += (year == maxYear)
                    ? "?year=" + maxYear
                    : "?year=" + (year + 1);

                location.replace(locationUrl);
            }

            if (_this.hasClass('btn-ev-last')) {
                locationUrl += "?year=" + maxYear;
                location.replace(locationUrl);
            }
        });
    </script>
    @endif
@endsection
