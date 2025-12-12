@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/guide/assets/css/board.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/editor.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="journal-conbox guideline-conbox">
                <!-- s:board -->

                <div id="board" class="board-wrap">
                    <div class="board-view">
                        <div class="view-contop">
                            <h4 class="view-tit">
                                {{ $board->subject ?? '' }}
                            </h4>
                            <p class="name">
                                {{ $board->author ?? '' }}
                            </p>
                            <div class="view-info text-right">
                                <span><strong><img src="{{ asset('/html/bbs/guide/assets/image/board/ic_view.png') }}" alt=""></strong>{{ $board->ref ?? 0 }}</span>
                                <span><strong><img src="{{ asset('/html/bbs/guide/assets/image/board/ic_date.png') }}" alt=""></strong>{{ $board->created_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="write-wrap">
                            <ul>
                                <li>
                                    <div class="form-tit">영문 진료지침명</div>
                                    <div class="form-con">
                                        {{ $board->guideline ?? '' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">분야</div>
                                    <div class="form-con">
                                        @php
                                            $field_arr = $field_str = array();
                                            $field_arr = explode(',', $board->field);
                                            foreach ($field_arr as $val){
                                                $field_str[] = $boardConfig['field'][$val];
                                            }
                                        @endphp
                                        {{ implode(',', $field_str) }}
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">연도</div>
                                    <div class="form-con">
                                        {{ $board->year ?? '' }}
                                    </div>
                                </li>
                                @if(!empty($board->etc))
                                <li>
                                    <div class="form-tit">인용(Citation)</div>
                                    <div class="form-con">
                                        {{ $board->etc ?? '' }}
                                    </div>
                                </li>
                                @endif
                                @if(!empty($board->link_url))
                                <li>
                                    <div class="form-tit">링크</div>
                                    <div class="form-con">
                                        @if(!empty($board->link_url))
                                        <a href="{{ $board->link_url ?? '' }}" target="_blank" class="link">{{ $board->link_url ?? '' }}</a>
                                        @endif
                                    </div>
                                </li>
                                @endif
                                @if(!empty($board->filename1))
                                <li>
                                    <div class="form-tit">첨부파일</div>
                                    <div class="form-con">
                                        <a href="{{ $board->downloadUrl('1') }}" class="link" target="_blank" >{{ $board->filename1 }}</a>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            @if(!empty($board->thumbnail_realfile))
                                <div class="img-wrap">
                                    <img src="{{ $board->thumbnail_realfile }}" alt="">
                                </div>
                            @endif
                        </div>

                        <div class="view-contents editor-contents">
                            {!! $board->contents ?? '' !!}
                        </div>


                        <div class="btn-wrap text-right">
                            <a href="{{ route('board', ['code' => $code, 'gubun'=>$board->gubun ?? 1]) }}" class="btn btn-board btn-list">목록</a>
                            @if(isAdmin())
                            <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $board->sid]) }}" class="btn btn-board btn-modify">수정</a>
                            <a href="javascript:void(0);" class="btn btn-board btn-delete">삭제</a>
                            @endif
                        </div>

                        <!-- 이전글/다음글 type1 -->
                        <!-- <div class="view-move type1">
                            <div class="view-move-con view-prev">
                                <strong class="tit">이전글</strong>
                                <div class="con"><a href="#n" class="ellipsis">게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다.</a></div>
                            </div>
                            <div class="view-move-con view-next">
                                <strong class="tit">다음글</strong>
                                <div class="con"><a href="#n" class="ellipsis">게시글 다음글 입니다. 게시글 다음글 입니다. 게시글 다음글 입니다. 게시글 다음글 입니다.</a></div>
                            </div>
                        </div> -->

                        <!-- 이전글/다음글 type2 -->
                        <!-- <div class="view-move type2">
                            <div class="view-move-con view-prev">
                                <strong class="tit">이전글</strong>
                                <div class="con"><a href="#n" class="ellipsis">게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다. 게시글 이전글 입니다.</a></div>
                            </div>
                            <div class="view-move-con view-next">
                                <strong class="tit">다음글</strong>
                                <div class="con"><a href="#n" class="ellipsis">게시글 다음글 입니다. 게시글 다음글 입니다. 게시글 다음글 입니다. 게시글 다음글 입니다.</a></div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- //e:board -->
            </div>
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
