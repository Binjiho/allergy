@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">해외학술 행사 {{ empty($overseasSetting->sid) ? '등록' : '수정' }}</h3>
    </div>

    <form id="register-frm" method="post" data-sid="{{ $overseasSetting->sid ?? 0 }}" data-case="overseasSetting-{{ empty($overseasSetting->sid) ? 'create' : 'update' }}">
        <fieldset>
            <div class="write-wrap">
                <ul>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 공개상태</div>
                        <div class="form-con">
                            <div class="radio-wrap cst">
                                @foreach($overseasConfig['hide'] as $key => $val)
                                    <div class="radio-group">
                                        <input type="radio" name="hide" id="hide_{{ $key }}" value="{{ $key }}" {{ ($overseasSetting->hide ?? '') == $key ? 'checked' : '' }}>
                                        <label for="hide_{{ $key }}">{{ $val }}</label>
                                    </div>
                                @endforeach
                            </div>
                            * 비공개 상태의 경우 관리자에게만 노출 됩니다. 설정 완료 후 꼭 공개로 변경해주세요
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 학회명</div>
                        <div class="form-con">
                            <input type="text" name="title" id="title" class="form-item" value="{{ $overseasSetting->title ?? '' }}" >
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 개최일자</div>
                        <div class="form-con">
                            <div class="form-group">
                                <div class="table-wrap scroll-x touch-help mt-10">
                                    <table class="cst-table">
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="row">시작일</th>
                                            <th scope="row">
                                                <input type="text" name="sdate" id="sdate" class="form-item flatpickr flatpickr-input" value="{{ $overseasSetting->sdate ?? '' }}" readonly datepicker>
                                            </th>
                                            <th scope="row">마감일</th>
                                            <th scope="row">
                                                <input type="text" name="edate" id="edate" class="form-item flatpickr flatpickr-input edate-display" value="{{ $overseasSetting->edate ?? '' }}" readonly datepicker >
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 개최장소</div>
                        <div class="form-con">
                            <input type="text" name="place" id="place" class="form-item" value="{{ $overseasSetting->place ?? '' }}" >
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 선정인원</div>
                        <div class="form-con">
                            <div class="form-group n2">
                            <input type="text" name="limit_person" id="limit_person" class="form-item" value="{{ $overseasSetting->limit_person ?? '' }}" onlyNumber>명
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 신청일자</div>
                        <div class="form-con">
                            <div class="form-group">
                                <div class="table-wrap scroll-x touch-help mt-10">
                                    <table class="cst-table">
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="row">시작일</th>
                                            <th scope="row">
                                                <input type="text" name="regist_sdate" id="regist_sdate" class="form-item flatpickr flatpickr-input" value="{{ $overseasSetting->regist_sdate ?? '' }}" readonly datetimepicker>
                                            </th>
                                            <th scope="row">마감일</th>
                                            <th scope="row">
                                                <input type="text" name="regist_edate" id="regist_edate" class="form-item flatpickr flatpickr-input edate-display" value="{{ $overseasSetting->regist_edate ?? '' }}" readonly datetimepicker >
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 결과보고 제출일</div>
                        <div class="form-con">
                            <div class="form-group">
                                <div class="table-wrap scroll-x touch-help mt-10">
                                    <table class="cst-table">
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="row">시작일</th>
                                            <th scope="row">
                                                <input type="text" name="report_sdate" id="report_sdate" class="form-item flatpickr flatpickr-input" value="{{ $overseasSetting->report_sdate ?? '' }}" readonly datetimepicker>
                                            </th>
                                            <th scope="row">마감일</th>
                                            <th scope="row">
                                                <input type="text" name="report_edate" id="report_edate" class="form-item flatpickr flatpickr-input edate-display" value="{{ $overseasSetting->report_edate ?? '' }}" readonly datetimepicker >
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 결과발표일</div>
                        <div class="form-con">
                            <div class="form-group n2">
                                <input type="text" name="result_date" id="result_date" class="form-item" value="{{ $overseasSetting->result_date ?? '' }}" datepicker>
                            </div>
                        </div>
                    </li>

                    <li type="text">
                        <div class="form-tit"><strong class="required">*</strong> 한국제약바이오협회 (KPBMA) 정산자료 양식
                        </div>
                        <div class="form-con">
                            <div class="form-group">
                                <div class="table-wrap scroll-x touch-help mt-10">
                                    <table class="cst-table">
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="row">영수증 양식 업로드</th>
                                            <td>
                                                <div class="filebox mt-10">
                                                    <input type="text" class="upload-name form-item" name="file1Name" id="file1Name" value="{{ $overseasSetting->filename1 ?? '' }}" placeholder="Select File" readonly="readonly">
                                                    <label for="file1">파일첨부</label>
                                                    <input type="file" name="file1" id="file1" class="file-upload" >
                                                    <input type="hidden" name="file1_del" id="file1_del" value="" readonly="">

                                                    @if (!empty($overseasSetting->filename1))
                                                        <div class="attach-file">
                                                            <a href="{{ $overseasSetting->downloadUrl(1) }}" target="_blank" class="link">
                                                                {{ $overseasSetting->filename1 }}
                                                            </a>
                                                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">결과보고서 양식 업로드</th>
                                            <td>
                                                <div class="filebox mt-10">
                                                    <input type="text" class="upload-name form-item" name="file2Name" id="file2Name" value="{{ $overseasSetting->filename2 ?? '' }}" placeholder="Select File" readonly="readonly">
                                                    <label for="file2">파일첨부</label>
                                                    <input type="file" name="file2" id="file2" class="file-upload" >
                                                    <input type="hidden" name="file2_del" id="file2_del" value="" readonly="">

                                                    @if (!empty($overseasSetting->filename2))
                                                        <div class="attach-file">
                                                            <a href="{{ $overseasSetting->downloadUrl(2) }}" target="_blank" class="link">
                                                                {{ $overseasSetting->filename2 }}
                                                            </a>
                                                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">지출내역서 양식 업로드</th>
                                            <td>
                                                <div class="filebox mt-10">
                                                    <input type="text" class="upload-name form-item" name="file3Name" id="file3Name" value="{{ $overseasSetting->filename3 ?? '' }}" placeholder="Select File" readonly="readonly">
                                                    <label for="file3">파일첨부</label>
                                                    <input type="file" name="file3" id="file3" class="file-upload" >
                                                    <input type="hidden" name="file3_del" id="file3_del" value="" readonly="">

                                                    @if (!empty($overseasSetting->filename3))
                                                        <div class="attach-file">
                                                            <a href="{{ $overseasSetting->downloadUrl(3) }}" target="_blank" class="link">
                                                                {{ $overseasSetting->filename3 }}
                                                            </a>
                                                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 한국글로벌의약산업협회 (KRPIA) 정산자료 양식
                        </div>
                        <div class="form-con">
                            <div class="form-group">
                                <div class="table-wrap scroll-x touch-help mt-10">
                                    <table class="cst-table">
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="row">영수증 양식 업로드</th>
                                            <td>
                                                <div class="filebox mt-10">
                                                    <input class="upload-name form-item" name="file4Name" id="file4Name" value="{{ $overseasSetting->filename4 ?? '' }}" placeholder="Select File" readonly="readonly">
                                                    <label for="file4">파일첨부</label>
                                                    <input type="file" name="file4" id="file4" class="file-upload" >
                                                    <input type="hidden" name="file4_del" id="file4_del" value="" readonly="">

                                                    @if (!empty($overseasSetting->filename4))
                                                        <div class="attach-file">
                                                            <a href="{{ $overseasSetting->downloadUrl(4) }}" target="_blank" class="link">
                                                                {{ $overseasSetting->filename4 }}
                                                            </a>
                                                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">결과보고서 양식 업로드</th>
                                            <td>
                                                <div class="filebox mt-10">
                                                    <input class="upload-name form-item" name="file5Name" id="file5Name" value="{{ $overseasSetting->filename5 ?? '' }}" placeholder="Select File" readonly="readonly">
                                                    <label for="file5">파일첨부</label>
                                                    <input type="file" name="file5" id="file5" class="file-upload" >
                                                    <input type="hidden" name="file5_del" id="file5_del" value="" readonly="">

                                                    @if (!empty($overseasSetting->filename5))
                                                        <div class="attach-file">
                                                            <a href="{{ $overseasSetting->downloadUrl(5) }}" target="_blank" class="link">
                                                                {{ $overseasSetting->filename5 }}
                                                            </a>
                                                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">지출내역서 양식 업로드</th>
                                            <td>
                                                <div class="filebox mt-10">
                                                    <input type="text" class="upload-name form-item" name="file6Name" id="file6Name" value="{{ $overseasSetting->filename6 ?? '' }}" placeholder="Select File" readonly="readonly">
                                                    <label for="file6">파일첨부</label>
                                                    <input type="file" name="file6" id="file6" class="file-upload" >
                                                    <input type="hidden" name="file6_del" id="file6_del" value="" readonly="">

                                                    @if (!empty($overseasSetting->filename6))
                                                        <div class="attach-file">
                                                            <a href="{{ $overseasSetting->downloadUrl(6) }}" target="_blank" class="link">
                                                                {{ $overseasSetting->filename6 }}
                                                            </a>
                                                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="form-tit bg-white"><strong class="required">*</strong> 해외학회 지원 안내문</div>
                        <div class="form-con">
                            <textarea name="content" id="content" class="form-item tinymce">{!! $overseasSetting->content ?? '' !!}</textarea>
                        </div>
                    </li>

                </ul>
            </div>
        </fieldset>


        <div class="btn-wrap text-center">
            <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
            <button type="submit" class="btn btn-type1 color-type6">{{ empty($overseasSetting->sid) ? '등록' : '수정' }}</button>
        </div>
    </form>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('script/app/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>

    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('overseas.data') }}';

        $(document).on('change', 'input[type=file]', function () {
            const name = $(this).attr('name');
            fileCheck(this, `#${name}Name`);
        });


        $(document).on('click', '.btn-file-delete', function () {
            const name = $(this).closest('.filebox').find('input[type=file]').attr('name');
            const target = $(this).closest('.filebox').find('.attach-file');

            $(this).closest('.filebox').find('input[type=text]').val('');
            target.remove();
            $(`#${name}_del`).val('Y');
        });


        $(document).on('submit', form, function () {

            if ( $("[name='hide']").is(":checked") === false ) {
                alert(`공개상태를 체크해주세요.`);
                $("[name='hide']").focus();
                return false;
            }

            const title = $('#title');
            if (isEmpty(title.val())) {
                alert(`학회명을 입력해주세요.`);
                title.focus();
                return false;
            }
            const sdate = $('#sdate');
            if (isEmpty(sdate.val())) {
                alert(`개최일자 시작일을 입력해주세요.`);
                sdate.focus();
                return false;
            }
            const edate = $('#edate');
            if (isEmpty(edate.val())) {
                alert(`개최일자 마감일을 입력해주세요.`);
                edate.focus();
                return false;
            }
            const place = $('#place');
            if (isEmpty(place.val())) {
                alert(`개최장소를 입력해주세요.`);
                place.focus();
                return false;
            }
            const limit_person = $('#limit_person');
            if (isEmpty(limit_person.val())) {
                alert(`선정인원을 입력해주세요.`);
                limit_person.focus();
                return false;
            }

            const regist_sdate = $('#regist_sdate');
            if (isEmpty(regist_sdate.val())) {
                alert(`신청일자 시작일을 입력해주세요.`);
                regist_sdate.focus();
                return false;
            }
            const regist_edate = $('#regist_edate');
            if (isEmpty(regist_edate.val())) {
                alert(`신청일자 마감일을 입력해주세요.`);
                regist_edate.focus();
                return false;
            }

            const report_sdate = $('#report_sdate');
            if (isEmpty(report_sdate.val())) {
                alert(`결과보고 제출 시작일을 입력해주세요.`);
                report_sdate.focus();
                return false;
            }
            const report_edate = $('#report_edate');
            if (isEmpty(report_edate.val())) {
                alert(`결과보고 제출 마감일을 입력해주세요.`);
                report_edate.focus();
                return false;
            }

            const result_date = $('#result_date');
            if (isEmpty(result_date.val())) {
                alert(`결과발표일을 입력해주세요.`);
                result_date.focus();
                return false;
            }

            if ( isEmpty($("[name='file1Name']").val()) ) {
                alert('영수증 양식을 업로드해주세요.');
                $("[name='file1Name']").focus();
                return false;
            }
            if ( isEmpty($("[name='file2Name']").val()) ) {
                alert('결과보고서 양식을 업로드해주세요.');
                $("[name='file2Name']").focus();
                return false;
            }
            if ( isEmpty($("[name='file3Name']").val()) ) {
                alert('지출내역서 양식을 업로드해주세요.');
                $("[name='file3Name']").focus();
                return false;
            }
            if ( isEmpty($("[name='file4Name']").val()) ) {
                alert('영수증 양식을 업로드해주세요.');
                $("[name='file4Name']").focus();
                return false;
            }
            if ( isEmpty($("[name='file5Name']").val()) ) {
                alert('결과보고서 양식을 업로드해주세요.');
                $("[name='file5Name']").focus();
                return false;
            }
            if ( isEmpty($("[name='file6Name']").val()) ) {
                alert('지출내역서 양식을 업로드해주세요.');
                $("[name='file6Name']").focus();
                return false;
            }

            let tinyVal = tinymce.get('content').getContent(); // 내용 가져오기
            // tinyVal = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
            tinyVal = tinyVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

            if (isEmpty(tinyVal)) {
                alert('해외학회 지원 안내문을 입력해주세요.');
                return false;
            }

            boardSubmit();
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);
            ajaxData.append('content', tinymce.get('content').getContent());

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
