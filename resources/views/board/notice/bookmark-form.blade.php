<article class="sub-contents">
    <div class="sub-conbox inner-layer">

        <div id="board" class="board-wrap">
            {{-- 카테고리 --}}
            @if($boardConfig['use']['category'])
                <div class="board-cate-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">전체</button>
                    <ul class="board-cate-list sub-tab-menu">
                        <li class="{{ (request()->category ?? '') == '' ? 'on' : '' }}"><a href="{{ route('mypage.bookmark',['code'=>$code]) }}">전체</a></li>
                        @foreach($boardConfig['category']['item'] as $key => $val)
                            <li class="{{ (request()->category ?? '') == $key ? 'on' : '' }}"><a href="{{ route('mypage.bookmark',['code'=>$code, 'category'=>$key]) }}">{{ $val }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- //카테고리 --}}

            <div class="sch-wrap type2 font-pre">
                <form id="bbsSearch" action="{{ route('mypage.bookmark', ['code' => $code]) }}" method="get">
                    <input type="hidden" name="code" value="{{ request()->code ?? '' }}" readonly>
                    <fieldset>
                        <legend class="hide">검색</legend>
                        <div class="form-group">
                            <select name="search" id="search" class="form-item sch-cate">
                                @foreach($boardConfig['search'] as $key => $val)
                                    <option value="{{ $key }}" {{ ((request()->search ?? '') == $key) ? 'selected'  : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="keyword" id="keyword" class="form-item sch-key" placeholder="검색어를 입력하세요." value="{{ request()->keyword ?? '' }}">
                            <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                            <a href="{{ route('mypage.bookmark', ['code' => $code]) }}"  class="btn btn-reset" style="align-content:center;">검색 초기화</a>
                        </div>
                    </fieldset>
                </form>
            </div>
            <ul class="board-list">
                <!-- 공지 -->
                @foreach($notice_list ?? [] as $row)
                    <li class="ef01 active" data-sid="{{ $row->sid }}">
                        <div class="bbs-no">
                            <span class="ic-notice">공지</span>
                        </div>
                        <div class="list-con">
                            @if($boardConfig['use']['category'])
                                <div class="bbs-cate">
                                    <span class="cate0{{ $row->category ?? '1' }}">{{ $boardConfig['category']['item'][$row->category ?? '1'] ?? '' }}</span>
                                </div>
                            @endif
                            <div class="bbs-tit">
                                <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid]) }}" class="ellipsis2">
                                    {{ $row->subject }}
                                </a>
                                {!! $row->isNew() !!}
                            </div>
                            <span class="bbs-name">{{ $row->name ?? '' }}</span>
                            <span class="bbs-date">{{ $row->created_at->format('Y-m-d') }}</span>
                            <span class="bbs-hit">{{ number_format($row->ref ?? 0) }} Hit</span>
                            @if($row->files_count > 0)
                                <span class="bbs-file"><img src="/assets/image/board/ic_attach_file.png" alt=""></span>
                            @endif
                        </div>

                        <div>
                            @if($boardConfig['use']['heart'] && thisPK())
                                <div class="view-cnt">
                                    <button type="button" class="btn-like {{ $row->isHeart(thisPK()) ? 'on' : '' }}" data-sid="{{ $row->sid }}"><img src="/assets/image/icon/ic_like.png" alt="책갈피"></button>
                                </div>
                            @endif

                        </div>
                    </li>
                @endforeach

                @forelse($list as $row)
                    <li class="ef01" data-sid="{{ $row->sid }}">
                        <div class="list-con">
                            <div class="bbs-tit">
                                @if($boardConfig['use']['category'])
                                    <div class="bbs-cate">
                                        <span class="cate0{{ $row->category ?? '1' }}">{{ $boardConfig['category']['item'][$row->category ?? '1'] ?? '' }}</span>
                                    </div>
                                @endif
                                <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid]) }}" class="ellipsis2">
                                    {{ $row->subject ?? '' }}
                                </a>

                                {!! $row->isNew() !!}
                            </div>
                            <span class="bbs-name">{{ $row->name ?? '' }}</span>
                            <span class="bbs-date">{{ $row->created_at->format('Y-m-d') }}</span>
                            <span class="bbs-hit">{{ number_format($row->ref ?? 0) }} Hit</span>
                            @if($row->files_count > 0)
                                <span class="bbs-file"><img src="/assets/image/board/ic_attach_file.png" alt=""></span>
                            @endif

                        </div>


                        <div>
                            @if($boardConfig['use']['heart'] && thisPK())
                                <div class="view-cnt">
                                    <button type="button" class="btn-like {{ $row->isHeart(thisPK()) ? 'on' : '' }}" data-sid="{{ $row->sid }}"><img src="/assets/image/icon/ic_like.png" alt="책갈피"></button>
                                </div>
                            @endif


                        </div>
                    </li>
                @empty
                    <!-- no data -->
                    <li class="no-data text-center">
                        <img src="/html/bbs/notice/assets/image/ic_nodata.png" alt=""> <br>
                        등록된 게시글이 없습니다.
                    </li>
                @endforelse
            </ul>


            {{ $list->links('pagination::custom') }}
        </div>
        <!-- //e:board -->

    </div>
</article>