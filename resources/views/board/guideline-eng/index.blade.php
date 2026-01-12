@extends('eng.layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/english/assets/css/board_brochure.css') }}">
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:board -->
            <div id="board" class="board-wrap">

                <div class="sch-wrap ">
                    <form action="{{ route('board', ['code' => $code]) }}" method="get">
                        <fieldset>
                            <legend class="hide">검색</legend>
                            <div class="form-group">
                                <select name="search" class="form-item sch-cate">
                                    @foreach($boardConfig['search'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->search ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="keyword" class="form-item sch-key" value="{{ request()->keyword ?? '' }}">
                                <button type="submit" class="btn btn-sch"></button>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <!-- mobile 2column class="n2" -->
                <ul class="brochure-list">
                    @forelse($list as $row)
                        <li class="ef03" data-sid="{{ $row->sid ?? 0 }}">
                            <div class="list-con">
                                <div class="text-wrap">
                                    <div class="bbs-tit">
                                        <span class="years">{{ $row->year ?? '' }}</span>
                                        <p>{{ $row->subject ?? '' }}</p>
                                    </div>
                                    @if( !empty($row->realfile1) && file_exists( public_path($row->realfile1)) )
                                    <div class="btn-wrap mt-0">
                                        <a href="{{ $row->downloadUrl('1') }}" target="_blank" class="btn btn-file-down">Download</a>
                                    </div>
                                    @endif
                                </div>

                                <div class="img-wrap">
                                    @if( !empty($row->thumbnail_realfile) && file_exists( public_path($row->thumbnail_realfile)) )
                                        <img src="{{ asset($row->thumbnail_realfile) }}" alt="">
                                    @else
                                        <img src="/html/english/assets/image/board_brochure/no_image.png" alt="">
                                    @endif

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
                                </div>
                            </div>
                        </li>
                    @empty

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
