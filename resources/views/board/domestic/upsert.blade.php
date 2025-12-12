@extends('layouts.web-layout')

@section('addStyle')
    {{--    <link rel="stylesheet" href="{{ asset('html/bbs/notice/assets/css/board.css') }}">--}}
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
            <!-- s:board -->
            <div id="board" class="board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" onsubmit="return false;" data-sid="{{ $board->sid ?? 0 }}" data-case="board-{{ empty($board->sid) ? 'create' : 'update' }}">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-contop text-right">
                                    <div class="help-text"><strong class="required">*</strong> 표시는 필수입력 항목입니다.</div>
                                </div>

                                <ul class="write-wrap">

                                    @if($boardConfig['use']['writer'])
                                        <li>
                                            <div class="form-tit">작성자</div>
                                            <div class="form-con">{{ env('APP_NAME') }}</div>
                                            <input type="hidden" name="name" value="{{ env('APP_NAME') }}" readonly>
                                        </li>
                                    @endif

                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 행사명</div>

                                            <div class="form-con">
                                                <input type="text" name="subject" id="subject" class="form-item" value="{{ $board->subject ?? '' }}">
                                            </div>
                                        </li>

                                        @if($boardConfig['use']['date'])
                                            <li>
                                                <div class="form-tit"><strong class="required">*</strong> 행사기간</div>
                                                <div class="form-con">
                                                    <div class="radio-wrap cst">
                                                        @foreach($boardConfig['options']['date_type'] as $key => $val)
                                                            <div class="radio-group">
                                                                <input type="radio" name="date_type" id="date_type_{{ $key }}" value="{{ $key }}" {{ ($board->date_type ?? '') == $key ? 'checked' : '' }}>
                                                                <label for="date_type_{{ $key }}">{{ $val }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-tit"><strong class="required">*</strong> {{ $boardConfig['date']['name'] }}</div>
                                                <div class="form-con">
                                                    <div class="form-group form-group-text n4">
                                                        <input type="text" name="event_sDate" id="event_sDate" class="form-item" value="{{ $board->event_sDate ?? '' }}" readonly datepicker>
                                                        <input type="time" name="event_sTime" id="event_sTime" class="form-item" value="{{ $board->event_sTime ?? '' }}">
                                                        <span class="text eDate-display">~</span>
                                                        <input type="text" name="event_eDate" id="event_eDate" class="form-item eDate-display" value="{{ $board->event_eDate ?? '' }}" readonly datepicker>
                                                        <input type="time" name="event_eTime" id="event_eTime" class="form-item eDate-display" value="{{ $board->event_eTime ?? '' }}">
                                                    </div>
                                                </div>
                                            </li>
                                        @endif

                                        <li>
                                            <div class="form-tit"> 장소</div>

                                            <div class="form-con">
                                                <input type="text" name="place" id="place" class="form-item" value="{{ $board->place ?? '' }}">
                                            </div>
                                        </li>

                                    <li>
                                        <div class="form-tit">썸네일</div>
                                        <div class="form-con">
                                            <div class="filebox mt-10">
                                                <input class="upload-name form-item" id="thumbnail_name" name="thumbnail_name" value="{{ $board->thumbnail_filename ?? '' }}" placeholder="파일첨부" readonly="readonly" >
                                                <label for="thumbnail">파일찾기</label>
                                                <input type="file" name="thumbnail" id="thumbnail" class="">
                                                <input type="hidden" name="thumbnail_del" id="thumbnail_del" value="" readonly>
                                                @if (!empty($board->thumbnail_filename))
                                                    <div class="attach-file">
                                                        <a href="{{ $board->downloadUrl('thumbnail') }}" target="_blank" class="link">{{ $board->thumbnail_filename }}</a>
                                                        <a href="#n" id="thumbnail_del" class="btn-file-delete text-red">X</a>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </li>

                                    @if($boardConfig['use']['link'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 학술대회 URL</div>

                                            <div class="form-con">
                                                <input type="text" name="link_url" id="link_url" class="form-item" value="{{ $board->link_url ?? '' }}">
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['hide'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 게시글 공개 여부</div>

                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="hide" id="hide_{{ $key }}" value="{{ $key }}" {{ (($board->hide ?? '') == $key) ? 'checked' : '' }}>
                                                            <label for="hide_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['plupload'] && ($board->files_count ?? 0) > 0)
                                        <li>
                                            <div class="form-tit">첨부파일</div>

                                            <div class="form-con">
                                                @foreach($board->files as $key => $file)
                                                    <div style="display: flex; align-items: center">
                                                        <input type="checkbox" name="plupload_file_del[]" id="plupload_file_del{{ $key }}" value="{{ $file->sid }}">
                                                        <label for="plupload_file_del{{ $key }}" style="margin-left: 0.3rem; margin-right: 0.5rem;"> 삭제 - </label>

                                                        <a href="{{ $file->downloadUrl() }}">
                                                            {{ $file->filename }}
                                                        </a>

                                                        <span style="margin-left: 0.3rem;">(다운 : {{ number_format($file->download) }})</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['popup'])
                                        @php
                                            $popupDisplay = (($board->popup ?? 'N') === 'Y') ? '' : 'none';
                                            $popupDetailDisplay = (($popup->popup_detail ?? 'N') === 'Y') ? '' : 'none';
                                            $popupContentDisplay = (($popup->popup_select ?? '1') == '2') ? '' : 'none';
                                        @endphp

                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 팝업 설정</div>

                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_yn'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup" id="popup_{{ $key }}" value="{{ $key }}" {{ (($board->popup ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>

                                        <li class="popupBox" style="display: {{ $popupDisplay }}">
                                            <div class="form-tit">팝업 템플릿</div>

                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_skin'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup_skin" id="popup_skin_{{ $key }}" value="{{ $key }}" {{ (($popup->popup_skin ?? 'none') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_skin_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach

                                                    <a href="javascript:;" id="popup_preview" class="btn btn-small color-type4">미리보기</a>
                                                </div>

                                            </div>
                                        </li>

                                        <li class="popupBox" style="display: {{ $popupDisplay }}">
                                            <div class="form-tit">팝업 내용 선택</div>

                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_contents'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup_select" id="popup_select_{{ $key }}" value="{{ $key }}" {{ (($popup->popup_select ?? '1') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_select_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>

                                        <li class="popupBox" style="display: {{ $popupDisplay }}">
                                            <div class="form-tit">팝업 사이즈</div>

                                            <div class="form-con">
                                                <div class="form-group-text">
                                                    <span class="text">사이즈 :</span>
                                                    <input type="text" name="width" id="width" class="form-item w-10p" value="{{ $popup->width ?? '600' }}" maxlength="4" onlyNumber>
                                                    <span class="text">X</span>
                                                    <input type="text" name="height" id="height" class="form-item w-10p" value="{{ $popup->height ?? '500' }}" maxlength="4" onlyNumber>
                                                </div>
                                                <div class="form-group-text mt-10">
                                                    <span class="text">위치 : 위에서</span>
                                                    <input type="text" name="position_y" id="position_y" class="form-item w-10p" value="{{ $popup->position_y ?? '0' }}" maxlength="4" onlyNumber>
                                                    <span class="text">px, 왼쪽에서</span>
                                                    <input type="text" name="position_x" id="position_x" class="form-item w-10p" value="{{ $popup->position_x ?? '0' }}" maxlength="4" onlyNumber>
                                                    <span class="text">px</span>
                                                </div>

                                            </div>
                                        </li>

                                        <li class="popupBox" style="display: {{ $popupDisplay }}">
                                            <div class="form-tit">팝업 자세히 보기</div>

                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_detail'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup_detail" id="popup_detail_{{ $key }}" value="{{ $key }}" {{ (($popup->popup_detail ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_detail_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                        <li class="popupDetailBox" style="display: {{ $popupDetailDisplay }}">
                                            <div class="form-tit">팝업 LINK</div>

                                            <div class="form-con">
                                                <input type="text" name="popup_link" id="popup_link" class="form-item" value="{{ $popup->popup_link ?? '' }}" >
                                            </div>
                                        </li>

                                        <li class="popupBox" style="display: {{ $popupDisplay }}">
                                            <div class="form-tit">팝업 시작 / 종료일</div>

                                            <div class="form-con">
                                                <div class="form-group-text">
                                                    <input type="text" name="popup_sDate" id="popup_sDate" class="form-item w-20p" value="{{ $popup->popup_sDate ?? '' }}" readonly datepicker>
                                                    ~
                                                    <input type="text" name="popup_eDate" id="popup_eDate" class="form-item w-20p" value="{{ $popup->popup_eDate ?? '' }}" readonly datepicker>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="popupContentBox" style="display: {{ $popupContentDisplay }}">
                                            <div class="form-con">
                                                <textarea name="popup_contents" id="popup_contents" class="tinymce">{{ $board->popup_contents ?? '' }}</textarea>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['contents'])
                                        <li>
                                            <div class="form-con">
                                                <textarea name="contents" id="contents" class="tinymce">{{ $board->contents ?? '' }}</textarea>
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
                                    <a href="{{ route('board', ['code' => $code]) }}" class="btn btn-type1 color-type4">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type1">{{ !empty($board->sid) ? '수정' : '등록' }}</button>
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

        $(document).on('click', '[name=choice_type]', function() {
            const _type = $(this).val();

            if(_type == 'A'){
                $("#etc").prop('disabled',true);
                $("#thumbnail_name").prop('disabled',false);
                $("#etc").val('');

            }else{
                $("#etc").prop('disabled',false);
                $("#thumbnail_name").prop('disabled',true);
                $("#thumbnail_name").val('');
                $('#thumbnail').val('');
            }

        });


        // 기간설정 사용시
        if(boardConfig.use.date) {
            $(document).on('click', 'input:radio[name=date_type]', function() {
                if ($(this).val() === "L") {
                    $('.eDate-display').show();
                } else {
                    $('.eDate-display').hide();
                    $('input[name=event_eDate]').val('');
                    $('input[name=event_eTime]').val('');
                }
            });

            // 행사기간 날짜 체크
            $.validator.addMethod('isEventDateEmpty', function(value, element) {
                if (element.name == 'event_eDate') {
                    return $('input:radio[name=date_type]:checked').val() == 'D' ? true : !isEmpty(value);
                }

                return !isEmpty(value);
            });
        }

        // 구분 or 카테고리 사용시
        if(boardConfig.use.category || boardConfig.use.gubun) {
            $.validator.addMethod('isCategoryEmpty', function(value, element) {
                const name = element.name;

                if ($(`input:radio[name='${name}']`).length > 0) {
                    return $(`input:radio[name='${name}']:checked`).length > 0;
                }

                if ($(`select[name='${name}']`).length > 0) {
                    return !isEmpty($(`select[name='${name}']`).val());
                }
            });
        }

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
                // $("#thumbnail_name").val('');
            });
        }

        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            ignore: ['contents', 'popup_contents'],
            rules: {
                subject: {
                    isEmpty: true,
                },
                date_type: {
                    checkEmpty: true,
                },
                event_sDate: {
                    isEventDateEmpty: true,
                },
                event_eDate: {
                    isEventDateEmpty: true,
                },
                link_url: {
                    isEmpty: true,
                },

                hide: {
                    checkEmpty: true,
                },
            },
            messages: {
                subject: {
                    isEmpty: '행사명을 입력해주세요.',
                },
                date_type: {
                    checkEmpty: '행사기간을 설정 해주세요.',
                },
                event_sDate: {
                    isEventDateEmpty: '행사일정 시작일을 선택해주세요.',
                },
                event_eDate: {
                    isEventDateEmpty: '행사일정 종료일을 선택해주세요.',
                },
                link_url: {
                    isEmpty: '학술대회 URL을 입력해주세요.',
                },
                hide: {
                    checkEmpty: '공개여부를 체크해주세요.',
                },
            },
            submitHandler: function() {
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
