@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/schedule/assets/css/event.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/editor.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:행사일정 Typea B -->
            <div class="ev-wrap ">
                <div class="ev-view-wrap">
                    <div class="ev-view-contop">
                        <h3 class="ev-view-tit">
                            <span class="btn-ev ev-cate0{{ $board->gubun ?? '1' }}">{{ $board->gubunTxt() }}</span>
                            <strong>{{ $board->subject }}</strong>
                        </h3>
                        <div class="ev-view-info">
                            <ul>
                                <li>행사 일자 : {{ $board->eventPeriod() }}</li>
                                @if(!empty($board->place))
                                    <li>행사 장소 : {{ $board->place ?? '' }}</li>
                                @endif
                            </ul>
                            @if(!empty($board->link_url))
                                <p class="text-right">
                                    Homepage : <a href="{{ $board->link_url }}" target="_blank">{{ $board->link_url }}</a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="ev-view-contents editor-contents">{!! $board->contents !!}</div>

                    @if($boardConfig['use']['plupload'] && $board->files_count > 0)
                        <div class="ev-view-attach">
                            <div class="view-attach-con">
                                <div class="tit">첨부파일</div>
                                <div class="con">
                                    @foreach($board->files as $file)
                                        <a href="{{ $file->downloadUrl() }}">
                                            {{ $file->filename }}  (다운 {{ number_format($file->download) }}회) <img src="/html/bbs/schedule/assets/image/ic_ev_file.png" alt="">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="btn-wrap text-right">
                        <a href="{{ route('board', ['code' => $code]) }}" class="btn btn-type1 btn-line color-type1 full-left">목록</a>

                        @if(isAdmin() || (thisPk() != 0 && thisPk() == $board->user_sid))
                            <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $board->sid]) }}" class="btn btn-type1 color-type5">수정</a>
                            <a href="javascript:;" class="btn btn-type1 color-type7 btn-delete">삭제</a>
                        @endif
                    </div>

                </div>
            </div>
            <!-- // e:행사일정 Typea B -->

        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    @if(isAdmin() || thisPK() == $board->user_sid)
        <script>
            $(document).on('click', '.btn-delete', function() {
                if (confirm('삭제 하시겠습니까?')) {
                    callAjax(dataUrl, { case: 'board-delete', sid: {{ $board->sid }} });
                }
            });
        </script>
    @endif
@endsection
