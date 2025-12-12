@extends('layouts.web-layout')

@section('addStyle')
{{--    <link rel="stylesheet" href="{{ asset('assets/board/css/board_brochure.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('html/bbs/brochure/assets/css/board.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">

        <div class="sub-conbox inner-layer">

        <div id="board" class="board-wrap">
            <div class="sch-wrap">
                <form action="{{ route('board', ['code' => $code]) }}" method="get">
                    <fieldset>
                        <legend class="hide">검색</legend>
                        <div class="form-group">
                            <select name="search" id="search" class="form-item sch-cate">
                                @foreach($boardConfig['search'] as $key => $val)
                                    <option value="{{ $key }}" {{ request()->input('search', '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="keyword" id="keyword" class="form-item sch-key" placeholder="검색하실 내용을 입력하세요." value="{{ request()->keyword ?? '' }}">
                            <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                            <button type="reset" class="btn btn-reset">검색 초기화</button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <ul class="brochure-list">
                @forelse($list ?? [] as $row)
                <li class="ef01" data-sid="{{ $row->sid }}">
                    <div class="list-con">
                        <div class="text-wrap">
                            <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid]) }}">
                                <p class="bbs-tit">{{ $row->year ?? '' }}</p>
                                <p class="bbs-des">
                                    {{ $row->subject ?? '' }}
                                </p>
                            </a>
                            <div class="btn-wrap">
                                @if(!empty($row->realfile1))
                                    <a href="{{ $row->downloadUrl(1) }}" target="_blank" class="btn btn-file-down">다운로드 <img src="{{ asset('html/bbs/brochure/assets/image/board/ic_download.png') }}" alt=""></a>
                                @endif
                                @if(!empty($row->realfile2))
                                    <a href="{{ $row->downloadUrl(2) }}" target="_blank" class="btn btn-file-down">카드뉴스 <img src="{{ asset('html/bbs/brochure/assets/image/board/ic_download.png') }}" alt=""></a>
                                @endif
                            </div>
                        </div>
                        <div class="img-wrap">
                            @if(!empty($row->thumbnail_realfile))
                                <img src="{{ $row->thumbnail_realfile ?? '' }}" alt="">
                            @else
                                <img src="{{ asset('html/bbs/brochure/assets/image/board/no_image.png') }}" alt="">
                            @endif

                            @if(isAdmin())
                                <div class="bbs-admin">
                                    <select class="form-item hide-select">
                                        @foreach($boardConfig['options']['hide'] as $key => $val)
                                            <option value="{{ $key }}" {{ $key == $row->hide ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $row->sid]) }}" class="btn btn-modify"><span class="hide">수정</span></a>
                                    <a href="javascript:void(0);" class="btn btn-delete board-delete"><span class="hide">삭제</span></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </li>
                @empty
                    <!-- no data -->
                    <li class="no-data text-center">
                        <img src="./assets/image/board/ic_nodata.png" alt=""> <br>
                        등록된 게시글이 없습니다.
                    </li>
                @endforelse

            </ul>

            @if( isAdmin() )
                <div class="btn-wrap text-right">
                    <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-board btn-write">등록</a>
                </div>
            @endif

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
            </div>
        </div>
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    @if(!isMobile() && isAdmin())
        <script>
            $(document).on('change', '.hide-select', function() {
                const ajaxData = {
                    case: 'db-change',
                    sid: getPK(this),
                    column: 'hide',
                    value: $(this).val(),
                }

                callAjax(dataUrl, ajaxData);
            });

            $(document).on('click', '.board-delete', function() {
                const ajaxData = {
                    case: 'board-delete',
                    sid: getPK(this),
                }

                if (confirm('정말로 삭제 하시겠습니까?')) {
                    callAjax(dataUrl, ajaxData);
                }
            });

            $(document).on('change', '.reply-hide-select', function() {
                const ajaxData = {
                    case: 'db-change',
                    sid: getPK(this),
                    b_sid: $(this).closest('li').data('b_sid'),
                    column: 'hide',
                    value: $(this).val(),
                }

                callAjax(dataReplyUrl, ajaxData);
            });

            $(document).on('click', '.reply-delete', function() {
                const ajaxData = {
                    case: 'reply-delete',
                    b_sid: $(this).closest('li').data('b_sid'),
                    sid: getPK(this),
                }

                if (confirm('정말로 삭제 하시겠습니까?')) {
                    callAjax(dataReplyUrl, ajaxData);
                }
            });
        </script>
    @endif
@endsection
