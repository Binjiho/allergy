@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/handsontable/css/handsontable.full.min.css') }}"/>
    <style>
        .handson-headers {
            font-size: 1.2rem;
            color: #ea3737;
        }
    </style>
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">엑셀업로드</h3>
    </div>

    <div style="font-weight: bold; padding-bottom: 15px;">
        <p style="font-size: 1.5rem; padding: 3px;">* 아래 형식에 맞게 엑셀내용을 복사하여 붙여넣기 해주시기 바랍니다. (아래 한칸은 예시입니다.)</p>
        <p style="font-size: 1.5rem; padding: 3px;">* 개최일자 입력 예시 : 2025-01-01~2025-01-10 (하루 행사일 경우 2025-01-01만 입력)</p>
    </div>

    <form id="collective-frm" method="post" action="{{ route('grantees.data') }}" data-wsid="{{ request()->wsid ?? '' }}" data-case="collective-create">
        <div style="width:100%;" >
            <div id="handsontable" class="hot handsontable htRowHeaders htColumnHeaders" ></div>
        </div>

        <div class="btn-wrap text-center">
            <a href="javascript:window.close();" class="btn btn-type1 color-type6">취소</a>
            <button type="submit" class="btn btn-type1 color-type3" id="submit">등록</button>
        </div>
    </form>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/handsontable/js/handsontable.full.min.js') }}"></script>
    <script>
        const form = '#collective-frm';
        const dataUrl = $(form).attr('action');
        const rowHeader = "✚";
        const delimiter = '|::|';
        const hadsonHeaers = [
            '연도',
            '학회명',
            '개최일자',
            '개최장소',
            '이름',
            '면허번호',
        ];

        const handson = new Handsontable(document.getElementById('handsontable'), {
            colHeaders: hadsonHeaers,
            colWidths: [150, 200, 250, 200, 150, 150],
            data: [{
                name: '2026',
                name1: 'ISAF-RHINA 2026',
                name2: 'YYYY-MM-DD~YYYY-MM-DD',
                name3: '장소',
                name4: '홍길동',
                name5: '12345',
            }],
            licenseKey: 'non-commercial-and-evaluation',
            rowHeaders: "✚",
            contextMenu: true,
        });

        const exportPlugin = handson.getPlugin('exportFile');

        $(document).on('submit', form, function(e) {
            e.preventDefault();

            const resText = exportPlugin.exportAsString('csv', {
                exportHiddenRows: true,     // default false, exports the hidden rows
                exportHiddenColumns: true,  // default false, exports the hidden columns
                columnHeaders: false,        // default false, exports the column headers
                rowHeaders: true,           // default false, exports the row headers
                columnDelimiter: delimiter,       // default ',', the data delimiter
            });

            let obj = resText.split(rowHeader);
            obj.shift();

            let formData = [];
            let submitCheck = true;

            $.each(obj, function (key, data) {
                let excelData = data.split(delimiter);
                excelData.shift();

                excelData = {
                    year: excelData[0],
                    title: excelData[1],
                    event_date: excelData[2],
                    place: excelData[3],
                    name_kr: excelData[4],
                    license_number: excelData[5],
                }

                if(isEmpty(excelData.year)) {
                    submitCheck = false;
                    alert('연도를 입력해주세요.');
                    return false;
                }
                if(isEmpty(excelData.title)) {
                    submitCheck = false;
                    alert('학회명을 입력해주세요.');
                    return false;
                }
                if(isEmpty(excelData.event_date)) {
                    submitCheck = false;
                    alert('개최일자를 입력해주세요.');
                    return false;
                }
                if(isEmpty(excelData.place)) {
                    submitCheck = false;
                    alert('개최장소를 입력해주세요.');
                    return false;
                }
                if(isEmpty(excelData.name_kr)) {
                    submitCheck = false;
                    alert('이름을 입력해주세요.');
                    return false;
                }
                if(isEmpty(excelData.license_number)) {
                    submitCheck = false;
                    alert('면허번호를 입력해주세요.');
                    return false;
                }

                formData.push(excelData)
            });

            if(submitCheck) {
                let ajaxData = newFormData(form);
                // ajaxData.append('wsid', $(form).data('wsid'));
                ajaxData.append('data', JSON.stringify(formData));

                callMultiAjax(dataUrl, ajaxData);
            }
        });
    </script>
@endsection
