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
        <p style="font-size: 1.5rem; padding: 3px;">* 빨간색으로 표기된 부분은 필수 값이니 꼭 입력해 주세요.</p>
    </div>

    <form id="collective-frm" method="post" action="{{ route('registration.data',['wsid'=>request()->wsid]) }}" data-ex_sid="{{ request()->ex_sid }}" data-case="collective-create">
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
            '<b class="handson-headers">직위</b>',
            '세부직위',
            '<b class="handson-headers">이름</b>',
            '소속',
            'address',
        ];

        const handson = new Handsontable(document.getElementById('handsontable'), {
            colHeaders: hadsonHeaers,
            colWidths: [150, 150, 150, 150, 150],
            data: [{
                name: 'name_kr',
                name1: 'chief_name',
                name2: 'si',
                name3: 'gu',
                name4: 'address',
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
                    name_kr: excelData[0],
                    chief_name: excelData[1],
                    si: excelData[2],
                    gu: excelData[3],
                    address: excelData[4],
                }

                // if(isEmpty(excelData.degree)) {
                //     submitCheck = false;
                //     alert('직위를 입력해주세요.');
                //     return false;
                // }
                //
                // if(isEmpty(excelData.name)) {
                //     submitCheck = false;
                //     alert('이름을 입력해주세요.');
                //     return false;
                // }

                formData.push(excelData)
            });

            if(submitCheck) {
                let ajaxData = newFormData(form);
                ajaxData.append('ex_sid', $(form).data('ex_sid'));
                ajaxData.append('data', JSON.stringify(formData));

                callMultiAjax(dataUrl, ajaxData);
            }
        });
    </script>
@endsection
