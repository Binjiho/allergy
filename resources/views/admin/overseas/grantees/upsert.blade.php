@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">수혜명단 단건 {{ empty($grantees->sid) ? '등록' : '수정' }}</h3>
    </div>

    <form id="register-frm" method="post" data-sid="{{ $grantees->sid ?? 0 }}" data-case="grantees-{{ empty($grantees->sid) ? 'create' : 'update' }}">
        <fieldset>
            <div class="write-wrap">
                <ul>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 연도</div>
                        <div class="form-con">
                            <input type="text" name="year" id="year" class="form-item" value="{{ $grantees->year ?? '' }}" onlyNumber>
                        </div>
                    </li>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 학회명</div>
                        <div class="form-con">
                            <input type="text" name="title" id="title" class="form-item" value="{{ $grantees->title ?? '' }}" >
                        </div>
                    </li>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 개최일자</div>
                        <div class="form-con">
                            <input type="text" name="event_date" id="event_date" class="form-item" value="{{ $grantees->event_date ?? '' }}" >
                            <p>* 개최일자 입력 예시 : 2025-01-01~2025-01-10 (하루 행사일 경우 2025-01-01만 입력)</p>
                        </div>
                    </li>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 개최장소</div>
                        <div class="form-con">
                            <input type="text" name="place" id="place" class="form-item" value="{{ $grantees->place ?? '' }}" >
                        </div>
                    </li>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 이름</div>
                        <div class="form-con">
                            <input type="text" name="name_kr" id="name_kr" class="form-item" value="{{ $grantees->name_kr ?? '' }}" >
                        </div>
                    </li>
                    <li>
                        <div class="form-tit"><strong class="required">*</strong> 면허번호</div>
                        <div class="form-con">
                            <input type="text" name="license_number" id="license_number" class="form-item" value="{{ $grantees->license_number ?? '' }}" onlyNumber>
                        </div>
                    </li>


                </ul>
            </div>
        </fieldset>

        <div class="btn-wrap text-center">
            <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
            <button type="submit" class="btn btn-type1 color-type6">{{ empty($grantees->sid) ? '등록' : '수정' }}</button>
        </div>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('grantees.data') }}';

        $(document).on('submit', form, function(e) {

            if ( isEmpty($("#year").val())) {
                alert('연도를 입력해주세요.');
                $("#year").focus();
                return false;
            }
            if ( isEmpty($("#title").val())) {
                alert('학회명을 입력해주세요.');
                $("#title").focus();
                return false;
            }
            if ( isEmpty($("#event_date").val())) {
                alert('개최일자를 입력해주세요.');
                $("#event_date").focus();
                return false;
            }
            if ( isEmpty($("#place").val())) {
                alert('개최장소를 입력해주세요.');
                $("#place").focus();
                return false;
            }
            if ( isEmpty($("#name_kr").val())) {
                alert('이름을 입력해주세요.');
                $("#name_kr").focus();
                return false;
            }
            if ( isEmpty($("#license_number").val())) {
                alert('면허번호를 입력해주세요.');
                $("#license_number").focus();
                return false;
            }


            boardSubmit();
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);
            
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

@endsection
