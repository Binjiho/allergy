@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/gallery/assets/css/board.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:board -->
            <div id="board" class="board-wrap board-gallery-type2">

                <!-- mobile 2column class="n2" -->
                <ul class="gall-list">
                    @forelse($list as $row)
                        <li data-sid="{{ $row->sid ?? 0 }}">
                            <a href="{{ $row->link_url ?? 'javascript:;' }}" target="_blank">
                                <div class="gall-img">
                                    <img src="{{ empty($row->thumbnail_realfile) ? '/html/bbs/gallery/assets/image/board/no_image02.png' : asset($row->thumbnail_realfile) }}" alt="">
                                </div>
                                <div class="gall-text">
                                    <span class="gall-tit">{{ $row->subject ?? '' }}</span>
                                    <div class="gall-con">
                                        <ul>
                                            <li>
                                                <img src="/html/bbs/gallery/assets/image/board/ic_date.png" alt="">
                                                <div>
                                                    {{ $row->event_sDate->format('Y-m-d') }}
    
                                                    @if($row->date_type == 'L')
                                                        ~ {{ $row->event_eDate->format('Y-m-d') }}
                                                    @endif
                                                </div>
                                            </li>
                                            @if(!empty($row->place))
                                            <li>
                                                <img src="/html/bbs/gallery/assets/image/board/ic_venue.png" alt="">
                                                <div>{{ $row->place ?? '' }}</div>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </a>

                            @if(isAdmin())
                                <div class="bbs-admin">
                                    <select name="hide" class="form-item">
                                        @foreach($boardConfig['options']['hide'] as $key => $val)
                                            <option value="{{ $key }}" {{ $key == $row->hide ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <a href="{{ route('board.upsert', ['code' => $row->code, 'sid' => $row->sid]) }}" class="btn btn-modify">
                                        <span class="hide">수정</span>
                                    </a>

                                    <a href="javascript:void(0);" class="btn btn-delete">
                                        <span class="hide">삭제</span>
                                    </a>
                                </div>
                            @endif
                        </li>
                    @empty
                        <!-- no data -->
                        <li class="no-data">
                            <img src="/html/bbs/notice/assets/image/ic_nodata.png" alt=""> <br>
                            등록된 게시글이 없습니다.
                        </li>
                    @endforelse
                </ul>

                @if(isAdmin())
                    <div class="btn-wrap text-right">
                        <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-board btn-write">등록</a>
                    </div>
                @endif

                <div class="paging-wrap">
                    {{ $list->links('pagination::custom') }}
                </div>

            </div>
            <!-- board -->

        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    @if(isAdmin())
        <script>
            $(document).on('change', 'select[name=hide]', function() {
                const ajaxData = {
                    case: 'db-change',
                    sid: getPK(this),
                    column: 'hide',
                    value: $(this).val(),
                }

                callAjax(dataUrl, ajaxData);
            });

            $(document).on('click', '.btn-delete', function() {
                const ajaxData = {
                    case: 'board-delete',
                    sid: getPK(this),
                }

                if (confirm('삭제 하시겠습니까?')) {
                    callAjax(dataUrl, ajaxData);
                }
            });
        </script>
    @endif
@endsection
