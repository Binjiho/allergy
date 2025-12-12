@extends('layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popup-wrap" id="pop-textbook">
        <div class="popup-contents">
            <div class="popup-tit-wrap text-center">
                <h3 class="popup-tit">교과서 안내 {{ empty($publication->sid) ? '등록' : '수정' }}</h3>
            </div>

            <div class="popup-conbox">
                <div class="write-form-wrap">

                    <form id="member-frm" data-sid="{{ $publication->sid ?? 0 }}" data-case="publication-{{ empty($publication->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                        <fieldset>
                            <ul class="write-wrap">
                                <li>
                                    <div class="form-tit">제목 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="title" id="title" value="{{ $publication->title ?? '' }}" class="form-item">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">저자명 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="name_kr" id="name_kr" value="{{ $publication->name_kr ?? '' }}" class="form-item">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">발행일 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="publicated_at" id="publicated_at" value="{{ $publication->publicated_at ?? '' }}" class="form-item" datepicker>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">발행처 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="location" id="location" value="{{ $publication->location ?? '' }}" class="form-item">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">구매처 URL</div>
                                    <div class="form-con">
                                        <input type="text" name="url" id="url" value="{{ $publication->url ?? '' }}" class="form-item">
                                    </div>
                                </li>

                                <li>
                                    <div class="form-tit">썸네일 이미지</div>
                                    <div class="form-con">
                                        <div class="filebox">
                                            <input class="upload-name form-item" id="fileName" name="fileName" value="" placeholder="파일첨부" readonly="readonly">
                                            <label for="thumbfile">파일 첨부</label>
                                            <input type="file" id="thumbfile" name="thumbfile" class="file-upload" onchange="fileCheck(this,$('#fileName'))" data-accept="jpg|png|jpeg|gif">
                                            @if (!empty($publication->realfile))
                                                <div class="attach-file">
                                                    <a href="{{ $publication->downloadUrl() }}" class="link">{{ $publication->filename }}</a>
                                                    <a href="javascript:void(0);" class="btn-file-delete text-red" data-type="thumbfile" data-sid="{{ $publication->sid ?? '' }}">X</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </fieldset>

                        <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                            <a href="javascript:window.close();" class="btn btn-type1 color-type4">닫기</a>
                            <input class="btn btn-type1 color-type1" type="submit" value="{{ empty($publication->sid) ? '등록' : '수정' }}">
                        </div>
                    </form>

                </div>
            </div>
            <button type="button" class="btn btn-pop-close" onclick="window.close();"><span class="hide">팝업 닫기</span></button>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('journal.data') }}';
        const boardForm = '#member-frm';

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);
            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('click', '.btn-file-delete', function () {
            const sid = $(this).data('sid');

            if (confirm('파일을 삭제하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'publication-fileDelete',
                    'sid': sid,
                });
            }
        });


        defaultVaildation();

        $(boardForm).validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function() {
                if (isEmpty($("#title").val())) {
                    alert('제목을 입력해주세요.');
                    $("#title").focus();
                    return false;
                }
                if (isEmpty($("#name_kr").val())) {
                    alert('저자명을 입력해주세요.');
                    $("#name_kr").focus();
                    return false;
                }
                if (isEmpty($("#publicated_at").val())) {
                    alert('발행일을 입력해주세요.');
                    $("#publicated_at").focus();
                    return false;
                }
                if (isEmpty($("#location").val())) {
                    alert('발행처를 입력해주세요.');
                    $("#location").focus();
                    return false;
                }
                boardSubmit();
            }
        });
    </script>
@endsection
