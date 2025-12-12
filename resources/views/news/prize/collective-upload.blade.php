@extends('layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/handsontable/css/handsontable.full.min.css') }}"/>
@endsection

@section('contents')
    <div class="popup-wrap">
        <div class="popup-contents">
            <div class="popup-tit-wrap text-center">
                <h3 class="popup-tit">연구비 수상내역 다건 등록</h3>
            </div>
            <div class="popup-conbox">
                <p class="mb-20">
                    * 아래 형식에 맞게 엑셀내용을 복사하여 붙여넣기 해주시기 바랍니다.
                </p>
                <div class="write-form-wrap">

                    <form method="post" action="{{ route('news.data') }}" id="collective-upload" data-case="prize-collective-create" onsubmit="return false;">
                        <input type="hidden" name="tab" value="{{ request()->tab ?? '1' }}">
                        <div style="width:100%;" >
                            <div id="handsontable" class="hot handsontable htRowHeaders htColumnHeaders" ></div>
                        </div>


                        <div class="btn-wrap text-center" style="margin-top: 0px;">
                            <input type="submit" value="등록" class="btn btn-type1 color-type1">
                            <input type="button" value="취소" class="btn btn-type1 color-type4" onclick="window.close();">
                        </div>
                    </form>

                </div>
            </div>

            <button type="button" class="btn btn-pop-close" onclick="window.close();"><span class="hide">팝업 닫기</span></button>
        </div>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/handsontable/js/handsontable.full.min.js') }}"></script>
    <script>
        const form = '#collective-upload';
        const rowHeader = "✚";
        const delimiter = '|::|';

        const handson = new Handsontable(document.getElementById('handsontable'), {
            colHeaders: ['연도', '학술상명' , '수상자', '소속'],
            colWidths: [100, 100, 100, 100],
            data: [{
                name: '',
                name2: '',
                name3: '',
                name4: '',
            }],
            licenseKey: 'non-commercial-and-evaluation',
            rowHeaders: "✚",
            contextMenu: true,
        });

        const exportPlugin = handson.getPlugin('exportFile');

        $(document).on('click', '#collective-upload input[type=submit]', function(e) {
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
            let ajaxData = new FormData();
            let submitCheck = true;

            $.each(obj, function (key, data) {
                let excelData = data.split(delimiter);
                excelData.shift();

                excelData = {
                    'year': excelData[0],
                    'gubun': excelData[1],
                    'name_kr': excelData[2],
                    'sosok': excelData[3],
                }

                if(isEmpty(excelData.year)) {
                    submitCheck = false;
                    actionAlert({'msg': '연도를 입력해주세요.'});
                    return false;
                }
                if(isEmpty(excelData.gubun)) {
                    submitCheck = false;
                    actionAlert({'msg': '구분을 입력해주세요.'});
                    return false;
                }
                if(isEmpty(excelData.name_kr)) {
                    submitCheck = false;
                    actionAlert({'msg': '연구책임자를 입력해주세요.'});
                    return false;
                }
                if(isEmpty(excelData.sosok)) {
                    submitCheck = false;
                    actionAlert({'msg': '소속을 입력해주세요.'});
                    return false;
                }

                formData.push(excelData);
            });

            if(submitCheck) {
                ajaxData.append('case', $(form).data('case'));
                ajaxData.append('data', JSON.stringify(formData));
                callMultiAjax($(form).attr('action'), ajaxData);
            }
        });
    </script>
@endsection
