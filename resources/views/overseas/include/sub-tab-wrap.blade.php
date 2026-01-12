<div class="sub-tab-wrap">
    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">국외학회 스케줄 및 진행상황</button>
    <ul class="sub-tab-menu">
        <li class="{{ strpos(request()->url(), 'list') !== false ? 'on' : '' }}"><a href="{{ route('overseas') }}">국외학회 스케줄 및 진행상황</a></li>
        <li class="{{ strpos(request()->url(), 'guide') !== false ? 'on' : '' }}"><a href="{{ route('overseas.guide') }}">지원 규정 및 선정 규정</a></li>
        @if(!empty($overseasSetting))
        <li class="{{ strpos(request()->url(), 'upsert') !== false ? 'on' : '' }}"><a href="{{ route('overseas.upsert',['o_sid'=>$overseasSetting->sid, 'step'=>1]) }}">지원신청</a></li>
        @endif
        <li class="{{ strpos(request()->url(), 'search') !== false ? 'on' : '' }}"><a href="{{ route('overseas.search') }}">신청내역 확인 및 결과보고</a></li>
        @if(!empty($overseasSetting))
        <li><a href="{{ route('board',['code'=>'overseas-notice','o_sid'=>$overseasSetting->sid]) }}">공지사항</a></li>
        @else
        <li><a href="{{ route('board',['code'=>'overseas-notice']) }}">공지사항</a></li>
        @endif
    </ul>
</div>