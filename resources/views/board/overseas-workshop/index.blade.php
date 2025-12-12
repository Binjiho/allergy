@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/schedule/assets/css/event.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="ev-past-wrap">
                <ul class="ev-past-list">
                    @forelse($list as $row)
                    <li data-sid="{{ $row->sid }}">
                        <div class="tit">
                            <span>{{ $row->subject ?? '' }}</span>
                        </div>
                        <ul class="info">
                            <li>
                                <span>일시 : </span>
                                <p>{{ $row->event_sDate->format('Y-m-d') ?? '' }} {{ ($row->date_type ?? '') == 'L' ? ' ~ '.$row->event_eDate->format('Y-m-d') : '' }}</p>
                            </li>
                            @if(!empty($row->place))
                            <li>
                                <span>장소 : </span>
                                <p>{{ $row->place ?? '' }}</p>
                            </li>
                            @endif
                        </ul>
                        <div class="btn-wrap text-right">
                            @if(!empty($row->link_url))
                            <a href="{{ $row->link_url ?? '' }}" class="btn" target="_blank"><span class="icon"><img src="/assets/image/sub/ic_btn_home.png" alt=""></span>홈페이지 바로가기</a>
                            @endif
                            @if(!empty($row->choice_type))
                                @if( $row->choice_type == 'A')
                                    <a href="{{ $row->downloadUrl('thumbnail') }}" class="btn" target="_blank"><span class="icon"><img src="/assets/image/sub/ic_btn_download02.png" alt=""></span>초록집 다운로드</a>
                                @else
                                    <a href="{{ $row->etc ?? '' }}" class="btn" target="_blank"><span class="icon"><img src="/assets/image/sub/ic_btn_download02.png" alt=""></span>초록집 다운로드</a>
                                @endif
                            @endif
                        </div>

                        @if(isAdmin())
                            <div class="bbs-admin">
                                <select name="hide" class="form-item">
                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                        <option value="{{ $key }}" {{ $key == $row->hide ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>

                                <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $row->sid]) }}" class="btn btn-modify">
                                    <span class="hide">수정</span>
                                </a>

                                <a href="javascript:void(0);" class="btn btn-delete">
                                    <span class="hide">삭제</span>
                                </a>
                            </div>
                        @endif
                    </li>
                    @empty
                        <li class="no-data">
                            <!-- <img src="/html/bbs/schedule/assets/image/ic_nodata.png" alt=""> <br> -->
                            등록된 일정이 없습니다.
                        </li>
                    @endforelse
                </ul>

                @if(isAdmin())
                    <div class="btn-wrap text-right">
                        <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-type1 color-type1">등록</a>
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
