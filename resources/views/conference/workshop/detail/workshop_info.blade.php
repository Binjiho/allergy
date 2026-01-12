<div class="ev-view-box">
    <p class="tit">{{ $workshop->title ?? '' }}</p>
    <ul>
        <li>행사일 : {{ $workshop->event_sdate ?? '' }}{{ formatKoreanDate($workshop->event_sdate) }} {{ ($workshop->date_type ?? '') == 'L' ? ' ~ '.$workshop->event_edate.formatKoreanDate($workshop->event_edate) : '' }}</li>
        @if(!empty($workshop->place))
        <li>장소 : {{ $workshop->place ?? '' }}</li>
        @endif
    </ul>
</div>

<div class="sub-tab-wrap">
    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">사전등록</button>
    <ul class="sub-tab-menu">
        <li class="{{ strpos(request()->path(), 'detail') !== false ? 'on' : '' }}">
            <a href="{{ route('workshop.detail',['wsid'=>$workshop->sid]) }}">종합안내</a>
        </li>
        @if( ($workshop->regist_use ?? '') == 'Y')
        <li class="{{ strpos(request()->path(), 'upsert') !== false ? 'on' : '' }}">
            <a href="{{ route('registration',['wsid'=>$workshop->sid]) }}">사전등록</a>
        </li>
        <li class="{{ strpos(request()->path(), 'search') !== false ? 'on' : '' }}">
            <a href="{{ route('registration.search',['wsid'=>$workshop->sid]) }}">등록 조회 및 영수증 출력</a>
        </li>
        @endif
        <li class="{{ strpos(request()->path(), 'lecture') !== false ? 'on' : '' }}">
            <a href="{{ route('lecture',['wsid'=>$workshop->sid]) }}">강의원고 보기</a>
        </li>
    </ul>
</div>