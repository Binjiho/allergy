<article class="sub-contents">
    <div class="sub-conbox inner-layer">

        <!-- s:행사일정 Typea B -->
        <link href="/html/bbs/schedule/assets/css/event.css" rel="stylesheet">

        <div class="ev-wrap type2">
            <div class="ev-contop">
                <a href="javascript:void(0);" class="btn btn-ev-arrow btn-ev-first"><span class="hide">처음</span></a>
                <a href="javascript:void(0);" class="btn btn-ev-arrow btn-ev-prev"><span class="hide">이전</span></a>
                <div class="ev-year">
                    @for($i = $minYear; $i <= $maxYear; $i++)
                        <a href="{{ route('mypage.bookmark', ['code' => 'event-schedule', 'year' => $i]) }}" class="{{ $year == $i ? 'active' : '' }}">
                            <span>{{ $i }}년</span>
                        </a>
                    @endfor
                </div>
                <a href="javascript:void(0);" class="btn btn-ev-arrow btn-ev-next"><span class="hide">다음</span></a>
                <a href="javascript:void(0);" class="btn btn-ev-arrow btn-ev-last"><span class="hide">마지막</span></a>
            </div>

            <div class="ev-btn-wrap">
                <select name="month" class="form-item">
                    <option value="">전체</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ addZero($i, 2) }}" {{ $month == addZero($i, 2) ? 'selected' : '' }}>{{ $i }}월</option>
                    @endfor
                </select>
                <div class="btn-wrap">
                    <a href="{{ route('mypage.bookmark', ['code' => 'event-schedule', 'year' => $year, 'month' => $month]) }}" class="btn btn-ev ev-cate {{ (request()->gubun ?? '') == '' ? 'on' : '' }}">전체</a>
                    @foreach($boardConfig['gubun']['item'] as $key => $val)
                        <a href="{{ route('mypage.bookmark', ['code' => 'event-schedule', 'year' => $year, 'month' => $month, 'gubun' => $key]) }}" class="btn btn-ev ev-cate0{{ $key }} {{ (request()->gubun ?? '') == $key ? 'on' : '' }}">{{ $val }}</a>
                    @endforeach

                </div>
            </div>

            <ul class="ev-list">
                @forelse($list as $row)
                    <li data-sid="{{ $row->sid }}">
                        <div class="cate">
                            <span class="btn-ev ev-cate0{{ $row->gubun ?? '' }}">{{ $row->gubunTxt() }}</span>
                        </div>

                        <div class="month">
                            {{ date('m', strtotime($row->event_sDate)) }}월
                        </div>

                        <div class="date">
                            {{ date('d', strtotime($row->event_sDate)) }}({{ getYoil($row->event_sDate) }})

                            @if($row->date_type == 'L')
                                ~ {{ date('d', strtotime($row->event_eDate)) }}({{ getYoil($row->event_eDate) }})
                            @endif
                        </div>

                        <div class="ev-list-con">
                            <div class="ev-con-wrap">
                                <div class="ev-con text-left">
                                    <p class="tit">{{ $row->subject ?? '' }}</p>
                                    @if(!empty($row->place))
                                        <p class="place">장소 : {{ $row->place }}</p>
                                    @endif

                                    {{--                                        {!! $row->isNew() !!}--}}
                                </div>

                                <div class="btn-wrap">

                                    @if($boardConfig['use']['heart'] && thisPK())
                                        <button type="button" class="btn-like {{ $row->isHeart(thisPK()) ? 'on' : '' }}" data-sid="{{ $row->sid }}"><img src="/assets/image/icon/ic_like.png" alt="책갈피"></button>
                                    @endif

                                    <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid]) }}" class="btn btn-ev-more"><span class="plus">+</span> 자세히 보기</a>

                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="no-data">
                        <img src="/html/bbs/schedule/assets/image/ic_nodata.png" alt=""> <br>
                        책갈피 설정된 일정이 없습니다.
                    </li>
                @endforelse
            </ul>

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
            </div>
        </div>
        <!-- //e:행사일정 Type B -->

    </div>
</article>