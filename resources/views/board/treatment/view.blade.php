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
                                <span>{{ $board->name ?? '' }}</span>
                                <span><strong><img src="{{ asset('/html/bbs/guide/assets/image/board/ic_view.png') }}" alt=""></strong>{{ $board->ref ?? 0 }}</span>
                                <span><strong><img src="{{ asset('/html/bbs/guide/assets/image/board/ic_date.png') }}" alt=""></strong>{{ $board->created_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="write-wrap">
                            <ul>
                                <li>
                                    <div class="form-tit">국문 진료지침명</div>
                                    <div class="form-con">
                                        {{ $board->guideline_kr ?? '' }}
                                    </div>
                                </li>
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
                                <li>
                                    <div class="form-tit">인용(Citation)</div>
                                    <div class="form-con">
                                        {{ $board->etc ?? '' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">링크</div>
                                    <div class="form-con">
                                        @if(!empty($board->link_url))
                                            <a href="{{ $board->link_url ?? '' }}" target="_blank" class="link">{{ $board->link_url ?? '' }}</a>
                                        @endif
                                    </div>
                                </li>
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
                            @if(isAdmin() || ( !empty(thisPK()) && thisPK() > 0 && $board->user_sid == thisPK()))
                            <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $board->sid]) }}" class="btn btn-board btn-modify">수정</a>
                            <a href="javascript:void(0);" class="btn btn-board btn-delete">삭제</a>
                            @endif
                        </div>

                        @if($boardConfig['use']['comment'])

                            <!-- 댓글 -->
                            <div class="comment-wrap">
                                <div class="tit">
                                    Comment
                                </div>

                                @if(thisAuth()->check())
                                <form id="comment-frm" method="post" data-case="comment-create">
                                    <fieldset>
                                        <legned class="hide">댓글 입력</legned>
                                        <div class="comment-write-wrap mb-10">
                                            <input type="hidden" name="comment_writer" id="comment_writer" class="form-item" placeholder="작성자 이름 또는 닉네임 입력" value="{{ thisUser()->name_kr ?? '' }}">
                                        </div>

                                        <div class="comment-write-wrap">
                                            <textarea name="comment" id="comment" class="form-item" placeholder="댓글을 입력해주세요."></textarea>
                                            <button type="submit" class="btn btn-submit">등록</button>
                                        </div>
                                    </fieldset>
                                </form>
                                @endif
                                
                                @include("board.{$code}.comment.list")
                            </div>

                        @endif

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

    @if($boardConfig['use']['comment'] /* 댓글 사용시 */)
    <script>

        const commentForm = '#comment-frm';

        $(document).on('submit', commentForm, function () {
            const writer = $('#comment_writer');
            if (isEmpty(writer.val())) {
                alert('작성자를 입력해주세요.');
                writer.focus();
                return false;
            }

            const comment = $('#comment');
            if (isEmpty(comment.val())) {
                alert('댓글을 입력해주세요.');
                comment.focus();
                return false;
            }

            let ajaxData = formSerialize(commentForm);
            ajaxData.b_sid = {{ $board->sid }};

            callAjax(dataUrl, ajaxData);
        });

        $(document).on('click', '.comment-btn-reply', function () {
            const _this = $(this).closest('li');
            let ajaxData = _this.data();
            ajaxData.case = 'comment-postform';
            ajaxData.action = 'create';

            callbackAjax(dataUrl, ajaxData, function (data, error) {
                if (error) {
                    ajaxErrorData(error);
                    return false;
                }

                _this.after(data.upsert);
            });
        });

        $(document).on('click', '.comment-btn-update', function () {
            const _this = $(this).closest('li');
            let ajaxData = _this.data();
            ajaxData.case = 'comment-postform';
            ajaxData.action = 'update';

            callbackAjax(dataUrl, ajaxData, function (data, error) {
                if (error) {
                    ajaxErrorData(error);
                    return false;
                }

                _this.find('.comment-contents').hide();
                _this.append(data.upsert);
            });
        });

        $(document).on('click', '.comment-btn-delete', function () {
            if (confirm('댓글을 삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'comment-delete',
                    'b_sid': {{ $board->sid }},
                    'sid': $(this).closest('li').data('sid'),
                });
            }
        });

        $(document).on('click', '#reply_comment_submit', function () {
            const writer = $('#reply_comment_writer');
            if (writer.length > 0 && isEmpty(writer.val())) {
                alert('작성자를 입력해주세요.');
                writer.focus();
                return false;
            }

            const comment = $('#reply_comment');
            if (isEmpty(comment.val())) {
                alert('댓글을 입력해주세요.');
                comment.focus();
                return false;
            }

            let ajaxData = $(this).closest('.comment-write-wrap').data();
            ajaxData.b_sid = {{ $board->sid }};
            ajaxData.comment_writer = writer.val();
            ajaxData.comment = comment.val();

            callAjax(dataUrl, ajaxData);
        });

        $(document).on('click', '#reply_comment_cancel', function () {
            const _this = $(this);
            const action = _this.closest('.comment-write-wrap').data('case');

            if (action === 'comment-create') {
                _this.closest('li').remove();
            } else {
                _this.closest('li').find('.comment-contents').show();
                _this.closest('.comment-write-wrap').remove();
            }
        });

    </script>
    @endif
@endsection
