@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="/assets/css/editor.css">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="ev-conbox">

                @include('conference.workshop.detail.workshop_info')

                <div class="write-form-wrap">
                    <form id="lecture-frm" data-sid="{{ $lecture->sid ?? 0 }}" data-case="lecture-{{ empty($lecture->sid) ? 'create' : 'update' }}" action="" method="">
                        <input type="hidden" name="wsid" id="wsid" value="{{ $workshop->sid }}" readonly>
                        <fieldset>
                            <legend class="hide">등록</legend>
                            <ul class="write-wrap">
                                <li>
                                    <div class="form-tit">강의 제목 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="title" id="title" value="{{ $lecture->title ?? '' }}" class="form-item">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">발표자 이름 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="name_kr" id="name_kr" value="{{ $lecture->name_kr ?? '' }}" class="form-item">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">소속 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <input type="text" name="sosok" id="sosok" value="{{ $lecture->sosok ?? '' }}" class="form-item">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-tit">강의원고 업로드 <strong class="required">*</strong></div>
                                    <div class="form-con">
                                        <div class="filebox">
                                            <input type="hidden" name="thumbfile_del" id="thumbfile_del" value="" readonly>
                                            <input class="upload-name form-item" id="thumbfile_name" name="thumbfile_name" value="{{ $lecture->filename ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                            <label for="thumbfile">파일 첨부</label>
                                            <input type="file" id="thumbfile" name="thumbfile" class="file-upload" onchange="fileCheck(this,$('#fileName'))" data-accept="jpg|png|jpeg|gif|pdf|ppt|pptx">
                                            @if (!empty($lecture->realfile))
                                                <div class="attach-file">
                                                    <a href="{{ $lecture->downloadUrl() }}" class="link">{{ $lecture->filename }}</a>
                                                    <a href="javascript:void(0);" class="btn-file-delete text-red" data-type="thumbfile" data-sid="{{ $lecture->sid ?? '' }}">X</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="btn-wrap text-center">
                                <a href="{{ route('lecture',['wsid'=>$workshop->sid]) }}" class="btn btn-type1 color-type4">취소</a>
                                <button type="submit" class="btn btn-type1 color-type1">{{ empty($lecture->sid) ? '등록' : '수정' }}</button>
                            </div>
                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('lecture.data',['wsid'=>$workshop->sid]) }}';
        const boardForm = '#lecture-frm';

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);
            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('click', '.btn-file-delete', function () {
            const name = $(this).closest('.filebox').find('input[type=file]').attr('name');
            const target = $(this).closest('.filebox').find('.attach-file');

            target.remove();
            $(`#${name}_del`).val('Y');
            $(`#${name}_name`).val('');
        });

        // $(document).on('click', '.btn-file-delete', function () {
        //     const sid = $(this).data('sid');
        //
        //     if (confirm('파일을 삭제하시겠습니까?')) {
        //         callAjax(dataUrl, {
        //             'case': 'file-delete',
        //             'sid': sid,
        //         });
        //     }
        // });


        defaultVaildation();

        $(boardForm).validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function() {
                if (isEmpty($("#title").val())) {
                    alert('강의제목을 입력해주세요.');
                    $("#title").focus();
                    return false;
                }
                if (isEmpty($("#name_kr").val())) {
                    alert('발표자 이름을 입력해주세요.');
                    $("#name_kr").focus();
                    return false;
                }
                if (isEmpty($("#sosok").val())) {
                    alert('소속을 입력해주세요.');
                    $("#sosok").focus();
                    return false;
                }
                if (isEmpty($("#thumbfile_name").val())) {
                    alert('강의원고를 업로드해주세요.');
                    $("#thumbfile_name").focus();
                    return false;
                }
                boardSubmit();
            }
        });
    </script>
@endsection
