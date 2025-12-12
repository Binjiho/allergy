@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/notice/assets/css/board.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
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


                                    @if($boardConfig['use']['gubun'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> {{ $boardConfig['gubun']['name'] }}</div>

                                            <div class="form-con">
                                                @switch($boardConfig['gubun']['type'])
                                                    @case('radio')
                                                        <div class="radio-wrap cst">
                                                            @foreach($boardConfig['gubun']['item'] as $key => $val)
                                                                <div class="radio-group">
                                                                    <input type="radio" name="gubun" id="gubun_{{ $key }}" value="{{ $key }}" {{ (($board->gubun ?? '') == $key) ? 'checked' : '' }}>
                                                                    <label for="gubun_{{ $key }}">{{ $val }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @break

                                                    @case('select')
                                                        <select name="gubun">
                                                            <option value="">선택</option>
                                                            @foreach($boardConfig['gubun']['item'] as $key => $val)
                                                                <option value="{{ $key }}" {{ (($board->gubun ?? '') == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                        @break
                                                @endswitch
                                            </div>
                                        </li>
                                    @endif

                                    <li>
                                        <div class="form-tit"><strong class="required">*</strong> 분야 </div>
                                        <div class="form-con">
                                            <div class="checkbox-wrap cst">
                                                <label for="field_ALL" class="checkbox-group"><input type="checkbox" name="field[]" id="field_ALL" value="ALL" {{ !empty($board->field) && strpos($board->field, implode(',',array_keys($boardConfig['field']) )) !== false ? 'checked' : '' }}>전체</label>

                                                @foreach($boardConfig['field'] as $key => $val)
                                                    <label for="field_{{ $key }}" class="checkbox-group">
                                                        <input type="checkbox" name="field[]" id="field_{{ $key }}" value="{{ $key }}" {{ !empty($board->field) && strpos($board->field, $key) !== false ? 'checked' : '' }}>{{ $val }}</label>
                                                @endforeach

                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="form-tit"><strong class="required">*</strong> 연도 </div>
                                        <div class="form-con">
                                            <select name="year" id="year" class="form-item">
                                                <option value="">연도</option>
                                                @foreach($boardConfig['year'] as $key => $val)
                                                <option value="{{ $key }}" {{ ($board->year ?? date('Y')) == $key ? 'selected' : '' }}>{{ $key }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-tit"><strong class="required">*</strong> 진료지침/전문가 의견서 </div>
                                        <div class="form-con">
                                            <input type="text" name="subject" id="subject" class="form-item" value="{{ $board->subject ?? '' }}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-tit">영문 진료지침명</div>
                                        <div class="form-con">
                                            <input type="text" name="guideline" id="guideline" value="{{ $board->guideline ?? '' }}" class="form-item">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-tit">저자</div>
                                        <div class="form-con">
                                            <input type="text" name="author" id="author" value="{{ $board->author ?? '' }}" class="form-item">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-tit">인용(Citation)</div>
                                        <div class="form-con">
                                            <input type="text" name="etc" id="etc" value="{{ $board->etc ?? '' }}" class="form-item">
                                        </div>
                                    </li>

                                    @if($boardConfig['use']['link'])
                                        <li>
                                            <div class="form-tit">링크</div>

                                            <div class="form-con">

                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['link_type'] as $key => $val)
                                                        <label for="link_type_{{ $key }}" class="radio-group">
                                                            <input type="radio" name="link_type" id="link_type_{{ $key }}" value="{{ $key }}" {{ ($board->link_type ?? '') == $key ? 'checked' : '' }}>{{ $val }}</label>
                                                    @endforeach
                                                </div>

                                                <input type="text" name="link_url" id="link_url" class="form-item" value="{{ $board->link_url ?? '' }}">
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['file'])
                                        @foreach($boardConfig['file'] as $key => $val)
                                            <li>
                                                <div class="form-tit">첨부파일</div>

                                                <div class="form-con">
                                                    <div class="filebox">
                                                        <input type="text" id="file{{ $key }}_name" class="upload-name form-item" placeholder="파일첨부" readonly>
                                                        <input type="hidden" name="file{{ $key }}_del" id="file{{ $key }}_del" value="" readonly>

                                                        <label for="file1">파일찾기</label>
                                                        <input type="file" name="file{{ $key }}" id="file{{ $key }}" class="file-upload">

                                                        @if (!empty($board->{"realfile{$key}"}))
                                                            <div class="attach-file" style="display: flex; align-items: center">
                                                                <input type="hidden" name="file{{ $key }}_del" id="file{{ $key }}_del" value="">
                                                                <a href="{{ $board->downloadUrl($key) }}">
                                                                    {{ $board->{"filename{$key}"} }}
                                                                </a>
{{--                                                                <label for="file{{ $key }}_del" class="btn-file-delete text-red"> X </label>--}}
                                                                <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif


                                    @if($boardConfig['use']['thumbnail'])
                                        <li>
                                            <div class="form-tit">대표 이미지</div>

                                            <div class="form-con">
                                                <div class="filebox">
                                                    <input type="hidden" name="thumbnail_del" id="thumbnail_del" value="" readonly>
                                                    <input type="text" id="thumbnail_name" class="upload-name form-item" placeholder="파일첨부" readonly>

                                                    <label for="thumbnail">파일찾기</label>
                                                    <input type="file" name="thumbnail" id="thumbnail" data-accept="jpg|jpeg|png|gif" >

                                                    @if (!empty($board->thumbnail_filename))
                                                        <div class="attach-file" style="display: flex; align-items: center">
                                                            <input type="hidden" name="thumbnail_del" id="thumbnail_del" value="">

                                                            <a href="{{ $board->downloadUrl('thumbnail') }}">
                                                                {{ $board->thumbnail_filename }}
                                                            </a>
                                                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
{{--                                                            <label for="thumbnail_del" style="margin-left: 0.3rem; margin-right: 0.5rem;"> X </label>--}}
                                                        </div>
                                                    @endif
                                                </div>
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


                                </ul>

                                <div class="btn-wrap text-center">
                                    <a href="{{ route('board', ['code' => $code]) }}" class="btn btn-board btn-cancel">취소</a>
                                    <button type="submit" class="btn btn-board btn-modify">{{ !empty($board->sid) ? '수정' : '등록' }}</button>

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
        $(document).on('change', '#field_ALL', function () {
            // "전체" 체크박스 클릭 시 나머지 전부 체크/해제
            const isChecked = $(this).is(':checked');
            $("input[name='field[]']").not('#field_ALL').prop('checked', isChecked);
        });

        $(document).on('change', "input[name='field[]']", function () {
            if ($(this).attr('id') === 'field_ALL') return;

            const total = $("input[name='field[]']").not('#field_ALL').length;
            const checked = $("input[name='field[]']:checked").not('#field_ALL').length;

            $('#field_ALL').prop('checked', total === checked);
        });
    </script>

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
            });
        }


        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            ignore: ['contents', 'popup_contents'],
            rules: {
                gubun: {
                    checkEmpty: true,
                },
                'field[]': {
                    isEmpty: true,
                },
                year: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },

                link_type: {
                    checkEmpty: {
                        depends: function(element) {
                            return $("input[name='link_url']").val().length > 0;
                        },
                    },
                },

                // contents: {
                //     isTinyEmpty: true,
                // },
            },
            messages: {
                gubun: {
                    checkEmpty: `구분을 선택해주세요.`,
                },
                'field[]': {
                    isEmpty: `분야를 선택해주세요.`,
                },
                year: {
                    isEmpty: '연도를 선택해주세요.',
                },
                subject: {
                    isEmpty: `진료지침/전문가 의견서를 입력해주세요.`,
                },

                link_type: {
                    checkEmpty: '링크 타입을 선택해주세요.',
                },
                link_url: {
                    isEmpty: '링크를 입력해주세요.',
                },

                contents: {
                    isTinyEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function() {
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);

            // 내용 사용시
            if(boardConfig.use.contents) {
                ajaxData.append('contents', tinymce.get('contents').getContent());
            }

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
