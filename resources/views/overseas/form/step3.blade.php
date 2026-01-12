<fieldset>
    <legend class="hide">지원자격 입력</legend>
    <div class="sub-tit-wrap">
        <h4 class="sub-tit">신청 정보</h4>
    </div>
    <ul class="write-wrap">
        <li>
            <div class="form-tit">학회명</div>
            <div class="form-con">{{ $overseasSetting->title ?? '' }}</div>
        </li>
        <li class="n2">
            <div class="form-tit">개최일자</div>
            <div class="form-con">{{ $overseasSetting->sdate ?? '' }} ~ {{ $overseasSetting->edate ?? '' }}</div>
            <div class="form-tit">개최장소</div>
            <div class="form-con">{{ $overseasSetting->place ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">참가역할 <strong class="required">*</strong></div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-tit">초록 발표자</div>
                        <div class="form-con">
                            <div class="radio-wrap cst">
                                @foreach($overseasConfig['presenter'] as $key => $val)
                                    <label for="presenter_{{ $key }}" class="radio-group">
                                        <input type="radio" name="presenter" id="presenter_{{ $key }}" value="{{ $key }}" {{ ($overseas->presenter ?? '' ) == $key ? 'checked' : '' }}>{{ $val }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">강의</div>
                        <div class="form-con">
                            <div class="radio-wrap cst">
                                @foreach($overseasConfig['lecture'] as $key => $val)
                                    <label for="lecture_{{ $key }}" class="radio-group">
                                        <input type="radio" name="lecture" id="lecture_{{ $key }}" value="{{ $key }}" {{ ($overseas->lecture ?? '' ) == $key ? 'checked' : '' }}>{{ $val }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">참석 형태</div>
                        <div class="form-con">
                            <div class="radio-wrap cst">
                                @foreach($overseasConfig['attend'] as $key => $val)
                                    <label for="attend_{{ $key }}" class="radio-group">
                                        <input type="radio" name="attend" id="attend_{{ $key }}" value="{{ $key }}" {{ ($overseas->attend ?? '' ) == $key ? 'checked' : '' }}>{{ $val }}
                                    </label>
                                @endforeach
                                <label for="" class="radio-group"><input type="radio" name="" id="" disabled>온라인 참석 (온라인 참석은 지원 불가합니다.)</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="form-tit">발표 초록 Title <strong class="required">*</strong></div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-tit">국문</div>
                        <div class="form-con">
                            <input type="text" name="title_kr" id="title_kr" value="{{ $overseas->title_kr ?? '' }}" class="form-item" onlyKo>
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">영문</div>
                        <div class="form-con">
                            <input type="text" name="title_en" id="title_en" value="{{ $overseas->title_en ?? '' }}" class="form-item" onlyEn>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="form-tit">발표 초록 File <strong class="required">*</strong></div>
            <div class="form-con">
                <ul class="list-type list-type-check text-blue">
                    <li>제목, 연자, 소속, 내용 모두 기재된 초록만 인정 가능</li>
                    <li>doc, docx, pdf, hwp, zip 파일만 업로드 가능합니다.</li>
                </ul>

                <div class="filebox mt-10">
                    <input type="text" class="upload-name form-item" name="file1Name" id="file1Name" value="{{ $overseas->filename1 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                    <label for="file1">파일찾기</label>
                    <input type="file" name="file1" id="file1" class="file-upload" accept=".doc, .docx, .pdf, .hwp, .zip" data-accept="doc|docx|pdf|hwp|zip" >
                    <input type="hidden" name="file1_del" id="file1_del" value="" readonly="">

                    @if (!empty($overseas->filename1))
                        <div class="attach-file">
                            <a href="{{ $overseas->downloadUrl(1) }}" target="_blank" class="link">
                                {{ $overseas->filename1 }}
                            </a>
                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                        </div>
                    @endif
                </div>

            </div>
        </li>
        <li>
            <div class="form-tit">초록채택메일 or 초청 메일 <strong class="required">*</strong></div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-con">
                            <div class="radio-wrap cst">
                                @foreach($overseasConfig['submit_type'] as $key => $val)
                                    <label for="submit_type_{{ $key }}" class="radio-group">
                                        <input type="radio" name="submit_type" id="submit_type_{{ $key }}" value="{{ $key }}" {{ ($overseas->submit_type ?? '' ) == $key ? 'checked' : '' }}>{{ $val }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li class="submit_A_li" style="{{ ($overseas->submit_type ?? '') == 'A' ? '' : 'display:none;'  }}">
                        <!-- 바로제출 -->
                        <div class="form-con">
                            <ul class="list-type list-type-check text-blue">
                                <li>참가학회에서 받은 채택메일 or 초청메일 원본 E-mail 파일</li>
                                <li>pdf, eml, msg 파일만 등록 가능합니다.</li>
                            </ul>
                            <div class="filebox mt-10">
                                <input type="text" class="upload-name form-item" name="file2Name" id="file2Name" value="{{ $overseas->filename2 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                <label for="file2">파일찾기</label>
                                <input type="file" name="file2" id="file2" class="file-upload" accept=".pdf, .eml, .msg" data-accept="pdf|eml|msg" >
                                <input type="hidden" name="file2_del" id="file2_del" value="" readonly="">

                                @if (!empty($overseas->filename2))
                                    <div class="attach-file">
                                        <a href="{{ $overseas->downloadUrl(2) }}" target="_blank" class="link">
                                            {{ $overseas->filename2 }}
                                        </a>
                                        <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- //바로제출 -->
                    </li>
                    <li class="submit_B_li" style="{{ ($overseas->submit_type ?? '') == 'B' ? '' : 'display:none;'  }}">
                        <!-- 추후 제출 -->
                        <div class="form-con">
                            <ul class="list-type list-type-dot mb-10">
                                <li>초록 채택 또는 초청 메일 수신 이후,학회 이메일을 통해 추후 제출해 주시기 바랍니다.</li>
                                <li>학회 참석 전까지 제출이 완료되지 않을 경우,신청이 취소될 수 있으니 유의해 주시기 바랍니다.</li>
                            </ul>
                            <div class="radio-wrap cst">
                                @foreach($overseasConfig['agree2'] as $key => $val)
                                    <label for="agree2_{{ $key }}" class="radio-group">
                                        <input type="radio" name="agree2" id="agree2_{{ $key }}" value="{{ $key }}" {{ ($overseas->agree2 ?? '' ) == $key ? 'checked' : '' }}>{{ $val }}
                                    </label>
                                @endforeach

                            </div>
                        </div>
                        <!-- //추후제출 -->
                    </li>
                </ul>
            </div>
        </li>
    </ul>

</fieldset>

@section('step3-script')
    <script>
        //파일첨부
        $(document).on('click', '.btn-file-delete', function () {
            const name = $(this).closest('.filebox').find('input[type=file]').attr('name');
            const target = $(this).closest('.filebox').find('.attach-file');

            target.remove();
            $(`#${name}_del`).val('Y');
            $(`#${name}Name`).val('');
        });

        $(document).on('click', "input[name='submit_type']", function () {
            const _val = $(this).val();
            if(_val == 'A'){
                $(".submit_A_li").show();
                $(".submit_B_li").hide();

                $("input[name='agree2']").prop("checked", false);
            }else{
                $(".submit_A_li").hide();
                $(".submit_B_li").show();

                $("#file2").val("");            // 파일 선택(input file) 초기화
                $("#file2Name").val("");        // 표시되는 파일명 텍스트 초기화
                $("#file2_del").val("Y");        // 표시되는 파일명 텍스트 초기화
            }
        });

        $(document).on('submit', form, function () {

            @if(checkUrl() != 'admin')
                if($("#imsi").val() != 'Y') {
                    if ($("[name='presenter']").is(":checked") == false) {
                        alert('초록 발표자를 입력해주세요.');
                        $("input[name='presenter']").focus();
                        return false;
                    }
                    if ($("[name='lecture']").is(":checked") == false) {
                        alert('강의를 입력해주세요.');
                        $("input[name='lecture']").focus();
                        return false;
                    }
                    if ($("[name='attend']").is(":checked") == false) {
                        alert('참석형태 입력해주세요.');
                        $("input[name='attend']").focus();
                        return false;
                    }
                    if (isEmpty($("[name='title_kr']").val())) {
                        alert('발표 초록 국문 제목을 입력해주세요.');
                        $("input[name='title_kr']").focus();
                        return false;
                    }
                    if (isEmpty($("[name='title_en']").val())) {
                        alert('발표 초록 영문 제목을 입력해주세요.');
                        $("input[name='title_en']").focus();
                        return false;
                    }
                    if (isEmpty($("[name='file1Name']").val())) {
                        alert('발표 초록 File을 첨부해주세요.');
                        $("input[name='file1Name']").focus();
                        return false;
                    }

                    if ($("[name='submit_type']").is(":checked") == false) {
                        alert('초록채택메일 or 초청메일 체크해주세요.');
                        $("input[name='submit_type']").focus();
                        return false;
                    }

                    if ($("[name='submit_type']:checked").val() == 'A') {
                        if (isEmpty($("[name='file2Name']").val())) {
                            alert('초록채택메일 or 초청 메일을 첨부해주세요.');
                            $("input[name='file2Name']").focus();
                            return false;
                        }
                    }
                    if ($("[name='submit_type']:checked").val() == 'B') {
                        if ($("[name='agree2']").is(":checked") == false) {
                            alert('유의사항에 동의해주세요.');
                            $("input[name='agree2']").focus();
                            return false;
                        }
                        if ($("[name='agree2']:checked").val() !== 'Y') {
                            alert('유의사항에 동의해주세요.');
                            $("input[name='agree2']").focus();
                            return false;
                        }
                    }
                }
            @endif


            boardSubmit();
        });
    </script>
@endsection