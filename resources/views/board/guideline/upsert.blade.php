@extends('layouts.web-layout')

@section('addStyle')
{{--    <link rel="stylesheet" href="{{ asset('html/bbs/brochure/assets/css/board.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('html/bbs/notice/assets/css/board.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />

    <style>
        .eDate-display {
            display: {{ ($board->date_type ?? '') == 'L' ? 'inline-block' : 'none' }}
        }
    </style>
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">

        <div class="sub-conbox inner-layer">

            <div id="board" class="board-wrap ">
                <div class="board-write">
                    <div class="write-form-wrap">

                        <form id="board-frm" method="post" data-sid="{{ $board->sid ?? 0 }}" data-case="board-{{ empty($board->sid) ? 'create' : 'update' }}">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>

                                <div class="write-contop text-right">
                                    <div class="help-text"><strong class="required">*</strong> 표시는 필수입력 항목입니다.</div>
                                </div>

                                <ul class="write-wrap">
                                    @if($boardConfig['use']['writer'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 작성자</div>
                                            <div class="form-con">
                                                <input type="text" name="writer" id="writer" class="form-item" value="{{ env("APP_NAME") }}" readonly>
                                            </div>
                                        </li>
                                    @endif


                                    <li>
                                        <div class="form-tit"><strong class="required">*</strong> 연도</div>
                                        <div class="form-con">
                                            <select name="year" id="year" class="form-item">
                                                <option value="">선택</option>
                                                @for( $i=date('Y'); $i>=1999; $i-- )
                                                    <option value="{{ $i }}" {{ (($board->year ?? '') == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </li>

                                    @if($boardConfig['use']['subject'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 진료지침명</div>
                                            <div class="form-con">
                                                <input type="text" name="subject" id="subject" class="form-item" value="{{ $board->subject ?? '' }}">
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['hide'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 노출 여부</div>
                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                                        <label for="hide_{{ $key }}" class="radio-group">
                                                            <input type="radio" name="hide" id="hide_{{ $key }}" value="{{ $key }}" {{ (($board->hide ?? '') == $key) ? 'checked' : '' }}>
                                                            {{ $val }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['thumbnail'])
                                            <li>
                                                <div class="form-tit">{{ $boardConfig['thumbnail']['name'] }}</div>
                                                <div class="form-con">
                                                    <div class="filebox">
                                                        <input class="upload-name form-item" id="thumbnail_name" placeholder="파일첨부" readonly="readonly">
                                                        <label for="thumbnail">파일찾기</label>
                                                        <input type="file" name="thumbnail" id="thumbnail" class="file-upload" accept=".jpg, .png, .gif" data-accept="jpg|png|gif">

                                                        @if (!empty($board->thumbnail_filename))
                                                            <div class="attach-file">
                                                                <a href="{{ $board->downloadUrl('thumbnail') }}" class="link">
                                                                    {{ $board->thumbnail_filename }}
                                                                </a>

                                                                <a href="javascript:void(0);" class="btn-file-delete text-red">X</a>
                                                            </div>

                                                            <input type="hidden" name="thumbnail_del" id="thumbnail_del">
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endif

                                        <li>
                                            <div class="form-tit">파일</div>
                                            <div class="form-con">
                                                <div class="filebox">
                                                    <input class="upload-name form-item" id="file1_name" placeholder="파일첨부" readonly="readonly">
                                                    <label for="file1">파일찾기</label>
                                                    <input type="file" name="file1" id="file1" class="file-upload" accept=".jpg, .png, .gif, .pdf, .docx, .doc" data-accept="jpg|png|gif|pdf|docx|doc">
                                                    <input type="hidden" id="file1_del" name="file1_del" value="" readonly>

                                                    @if (!empty($board->{"realfile1"}))
                                                        <div class="attach-file">
                                                            <a href="{{ $board->downloadUrl(1) }}" class="link">
                                                                {{ $board->{"filename1"} }}
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn-file-delete text-red">X</a>
                                                        </div>

                                                        <input type="hidden" name="file1" id="file1">
                                                    @endif
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-tit">카드뉴스</div>
                                            <div class="form-con">
                                                <div class="filebox">
                                                    <input class="upload-name form-item" id="file2_name" placeholder="파일첨부" readonly="readonly">
                                                    <label for="file2">파일찾기</label>
                                                    <input type="file" name="file2" id="file2" class="file-upload" accept=".jpg, .png, .gif, .pdf, .docx, .doc, .zip" data-accept="jpg|png|gif|pdf|docx|doc|zip">
                                                    <input type="hidden" id="file2_del" name="file2_del" value="" readonly>

                                                    @if (!empty($board->{"realfile2"}))
                                                        <div class="attach-file">
                                                            <a href="{{ $board->downloadUrl(2) }}" class="link">
                                                                {{ $board->{"filename2"} }}
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn-file-delete text-red">X</a>
                                                        </div>

                                                        <input type="hidden" name="file2" id="file2">
                                                    @endif
                                                </div>
                                            </div>
                                        </li>



                                    @if($boardConfig['use']['plupload'] && ($board->files_count ?? 0) > 0)
                                        <li>
                                            <div class="form-tit">첨부파일</div>
                                            <div class="form-con">
                                                <div class="checkbox-wrap cst">
                                                    @foreach($board->files as $key => $file)
                                                        <div class="checkbox-group" style="width: 100%;">
                                                            <input type="checkbox" name="plupload_file_del[]" id="plupload_file_del{{ $key }}" value="{{ $file->sid }}">
                                                            <label for="plupload_file_del{{ $key }}" style="margin-left: 0.3rem; margin-right: 0.5rem;"> <span style="color: red;"> 삭제</span> - </label>

                                                            <a href="{{ $file->downloadUrl() }}">
                                                                {{ $file->filename }}
                                                            </a>

                                                            <span style="margin-left: 0.3rem;">(다운 : {{ number_format($file->download) }})</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['contents'])
                                        <li>
                                            <div class="form-con">
                                                <textarea name="contents" id="contents" class="tinymce">{{ $board->content ?? '' }}</textarea>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['plupload'])
                                        <li>
                                            <div class="form-con">
                                                <div id="plupload"></div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>

                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-board btn-cancel">취소</a>

                                    <button type="submit" class="btn btn-board btn-write">
                                        {{ empty($board->sid) ? '등록' : '수정' }}
                                    </button>

                                    <a href="{{ route('board', ['code' => $code]) }}" class="btn btn-board btn-list">목록</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <!-- //e:board -->
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    <script>
        // 게시글 작성 취소
        $(document).on('click', '.btn-cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                location.replace('{{ route('board', ['code' => $code]) }}');
            }
        });


        // 첨부파일 (plupload) 사용시
        if(boardConfig.use.plupload) {
            pluploadInit({
                multipart_params: {
                    directory: boardConfig.directory,
                },
                filters: {
                    max_file_size: '20mb'
                },
            });
        }

        // 첨부파일 (단일파일) or 썸네일 사용시
        if(boardConfig.use.file || boardConfig.use.thumbnail) {
            $(document).on('click', 'input[type=file]', function (e) {
                const target = $(this).closest('.filebox').find('.attach-file');

                if (!fileDelCheck(target)) {
                    e.preventDefault();
                }
            });

            $(document).on('change', 'input[type=file]', function () {
                const name = $(this).attr('name');
                fileCheck(this, `#${name}_name`);
            });

            $(document).on('click', '.btn-file-delete', function () {
                const name = $(this).closest('.filebox').find('input[type=file]').attr('name');
                const target = $(this).closest('.filebox').find('.attach-file');

                target.remove();
                $(`#${name}_del`).val('Y');
            });
        }

        $(document).on('submit', boardForm, function () {

            const year = $('#year');
            if (isEmpty(year.val())) {
                alert(`연도를 선택해주세요.`);
                year.focus();
                return false;
            }

            const subject = $('#subject');
            if (isEmpty(subject.val())) {
                alert(`진료지침명을 입력해주세요.`);
                subject.focus();
                return false;
            }

            const hide = $('input[name=hide]');
            if (!hide.is(':checked')) {
                alert('노출여부를 선택해주세요.');
                hide.focus();
                return false;
            }


            boardSubmit();
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

@endsection
