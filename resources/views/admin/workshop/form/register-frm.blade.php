<fieldset>
    <div class="write-wrap">
        <ul>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 행사명</div>
                <div class="form-con">
                    <input type="text" name="title" id="title" class="form-item" value="{{ $workshop->title ?? '' }}" >
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> 행사 기간</div>
                <div class="form-con">
                    <div class="radio-wrap cst">
                        @foreach($defaultConfig['date_type'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="date_type" id="date_type_{{ $key }}" value="{{ $key }}" {{ ($workshop->date_type ?? '') == $key ? 'checked' : '' }}>
                                <label for="date_type_{{ $key }}">{{ $val }}</label>
                            </div>
                        @endforeach
                    </div>
                    <p>
                        * 하루 행사의 경우 시작일만 입력 가능합니다.
                    </p>

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
                                        <input type="text" name="event_sdate" id="event_sdate" class="form-item flatpickr flatpickr-input" value="{{ $workshop->event_sdate ?? '' }}" readonly datepicker>
                                    </th>
                                    <th scope="row">마감일</th>
                                    <th scope="row">
                                        <input type="text" name="event_edate" id="event_edate" class="form-item flatpickr flatpickr-input edate-display" value="{{ $workshop->event_edate ?? '' }}" readonly datepicker {{ ($workshop->date_type ?? '' ) == 'D' ? 'disabled' : '' }}>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> 행사장소</div>
                <div class="form-con">
                    <input type="text" name="place" id="place" class="form-item" value="{{ $workshop->place ?? '' }}" >
                </div>
            </li>

            <li>
                <div class="form-tit"><strong class="required">*</strong> Program URL</div>
                <div class="form-con">
                    <input type="text" name="link_url" id="link_url" class="form-item" value="{{ $workshop->link_url ?? '' }}" >
                </div>
            </li>

        </ul>
    </div>
</fieldset>
@section('reg-script')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('script/app/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>

    <script>
        $(document).on('change', 'input:radio[name=date_type]', function() {
            const target = $('.edate-display');

            if ($(this).val() === "L") {
                target.show();
            } else {
                target.hide();
                target.find('input').val('');
            }
        });


        $(document).on('submit', form, function () {

            const title = $('#title');
            if (isEmpty(title.val())) {
                alert(`행사명을 입력해주세요.`);
                title.focus();
                return false;
            }

            if ( $("input[name='date_type']:checked").length < 1) {
                alert(`행사기간 종류를 선택해주세요.`);
                $("input[name='date_type']").focus();
                return false;
            }

            const event_sdate = $('#event_sdate');
            if (isEmpty(event_sdate.val())) {
                alert(`행사시작일을 입력해주세요.`);
                event_sdate.focus();
                return false;
            }

            if ( $("input[name='date_type']:checked").val() == 'L') {
                const event_edate = $('#event_edate');
                if (isEmpty(event_edate.val())) {
                    alert(`행사종료일을 입력해주세요.`);
                    event_edate.focus();
                    return false;
                }
            }

            const place = $('#place');
            if (isEmpty(place.val())) {
                alert(`행사장소를 입력해주세요.`);
                place.focus();
                return false;
            }

            const link_url = $('#link_url');
            if (isEmpty(link_url.val())) {
                alert(`Program URL을 입력해주세요.`);
                link_url.focus();
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