<fieldset>
    <legend class="hide">결과보고서 제출</legend>
    <div class="sub-tit-wrap">
        <h4 class="sub-tit">신청자 정보</h4>
    </div>
    <ul class="write-wrap">
        <li>
            <div class="form-tit">학회 아이디</div>
            <div class="form-con"> {{ $overseas->user->id ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">성명 (한글)</div>
            <div class="form-con"> {{ $overseas->user->name_kr ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">성명 (영문)</div>
            <div class="form-con">{{ $overseas->user->first_name ?? '' }} {{ $overseas->user->last_name ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">의사면허번호</div>
            <div class="form-con"> {{ $overseas->user->license_number ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">생년월일</div>
            <div class="form-con">  {{ $overseas->user->birth_date ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">전공분야</div>
            <div class="form-con"> {{ $userConfig['major'][$overseas->user->major] ?? '' }} {{ $overseas->user->major == 'Z' ? $overseas->user->major_etc : '' }}</div>
        </li>
        <li>
            <div class="form-tit">근무처 정보(국문)</div>
            <div class="form-con"> {{ $overseas->sosok_kr ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">휴대전화번호</div>
            <div class="form-con">{{ $overseas->phone ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">E-mail</div>
            <div class="form-con">{{ $overseas->email ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">계좌정보</div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-tit">은행명</div>
                        <div class="form-con">{{ $overseas->bank_name ?? '' }}</div>
                    </li>
                    <li>
                        <div class="form-tit">계좌번호</div>
                        <div class="form-con">{{ $overseas->account_num ?? '' }}</div>
                    </li>
                    <li>
                        <div class="form-tit">예금주</div>
                        <div class="form-con">{{ $overseas->account_name ?? '' }}</div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    <div class="sub-tit-wrap">
        <h4 class="sub-tit">정산자료 정보</h4>
    </div>
    <ul class="write-wrap">
        <li>
            <div class="form-tit">학회명</div>
            <div class="form-con">{{ $overseas->overseasSetting->title ?? '' }}</div>
        </li>
        <li class="n2">
            <div class="form-tit">개최일자</div>
            <div class="form-con">{{ $overseas->overseasSetting->sdate ?? '' }} ~ {{ $overseas->overseasSetting->edate ?? '' }}</div>
            <div class="form-tit">개최장소</div>
            <div class="form-con">{{ $overseas->overseasSetting->place ?? '' }}</div>
        </li>
        <li>
            <div class="form-tit">참가역할</div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-tit">초록 발표자</div>
                        <div class="form-con">{{ $overseasConfig['presenter'][$overseas->presenter] ?? '' }}</div>
                    </li>
                    <li>
                        <div class="form-tit">강의</div>
                        <div class="form-con">{{ $overseasConfig['lecture'][$overseas->lecture] ?? '' }}</div>
                    </li>
                    <li>
                        <div class="form-tit">참석 형태</div>
                        <div class="form-con">{{ $overseasConfig['attend'][$overseas->attend] ?? '' }}</div>
                    </li>
                </ul>
            </div>
        </li>

        <li>
            <div class="form-tit">초록사본 <strong class="required">*</strong></div>
            <div class="form-con">
                <ul class="list-type list-type-check text-blue">
                    <li>초록집 내 발표 일정, 저자명(본인 이름 필수 노출), 초록 제목이 확인 가능한 페이지를 복사하여 함께 첨부해주시기 바랍니다.</li>
                    <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                </ul>
                <div class="filebox mt-10">
                    <input type="text" class="upload-name form-item" name="file3Name" id="file3Name" value="{{ $overseas->filename3 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                    <label for="file3">파일찾기</label>
                    <input type="file" name="file3" id="file3" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                    <input type="hidden" name="file3_del" id="file3_del" value="" readonly="">

                    @if (!empty($overseas->filename3))
                        <div class="attach-file">
                            <a href="{{ $overseas->downloadUrl(3) }}" target="_blank" class="link">
                                {{ $overseas->filename3 }}
                            </a>
                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                        </div>
                    @endif
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">초록채택메일 <strong class="required">*</strong></div>
            <div class="form-con">
                <ul class="list-type list-type-check text-blue">
                    <li>본인 이름이 명시된 내용을 캡처 또는 파일 형태로 업로드해주시기 바랍니다.</li>
                    <li>pdf, eml, msg 파일만 등록 가능합니다.</li>
                </ul>
                <div class="filebox mt-10">
                    <input type="text" class="upload-name form-item" name="file4Name" id="file4Name" value="{{ $overseas->filename4 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                    <label for="file4">파일찾기</label>
                    <input type="file" name="file4" id="file4" class="file-upload" accept=".pdf, .eml, .msg" data-accept="pdf|eml|msg" >
                    <input type="hidden" name="file4_del" id="file4_del" value="" readonly="">

                    @if (!empty($overseas->filename4))
                        <div class="attach-file">
                            <a href="{{ $overseas->downloadUrl(4) }}" target="_blank" class="link">
                                {{ $overseas->filename4 }}
                            </a>
                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                        </div>
                    @endif
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">
                <div class="title-wrap">
                    <p>지원경비 영수증 파일</p>
                    <span class="help-text text-blue">** “모든” 영수증 및 서류들을 각 카테고리별로 업로드 해주시길 부탁드립니다</span>
                </div>
                @if($overseas->assistant == 'A')
                    <a href="{{ $overseasSetting->downloadUrl(1) }}" target="_blank" class="btn btn-small color-type2">영수증 양식 다운로드</a>
                @else
                    <a href="{{ $overseasSetting->downloadUrl(4) }}" target="_blank" class="btn btn-small color-type2">영수증 양식 다운로드</a>
                @endif
            </div>
        </li>
        <li>
            <div class="form-tit">항공료</div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-con">
                            <div class="form-group-text">
                                <input type="text" name="pay1" id="pay1" value="{{ $overseas->pay1 ?? '' }}" onlyNumber maxlength="10" class="form-item w-40p" placeholder="">
                                <p class="text fw-500">원</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-con">
                            <ul class="list-type list-type-check blue text-blue mb-10">
                                <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                            </ul>
                            <div class="filebox mt-10">
                                <input type="text" class="upload-name form-item" name="file5Name" id="file5Name" value="{{ $overseas->filename5 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                <label for="file5">파일찾기</label>
                                <input type="file" name="file5" id="file5" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                                <input type="hidden" name="file5_del" id="file5_del" value="" readonly="">

                                @if (!empty($overseas->filename5))
                                    <div class="attach-file">
                                        <a href="{{ $overseas->downloadUrl(5) }}" target="_blank" class="link">
                                            {{ $overseas->filename5 }}
                                        </a>
                                        <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="form-tit">숙박비</div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-con">
                            <div class="form-group-text">
                                <input type="text" name="pay2" id="pay2" value="{{ $overseas->pay2 ?? '' }}" onlyNumber maxlength="10" class="form-item w-40p" placeholder="">
                                <p class="text fw-500">원</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-con">
                            <ul class="list-type list-type-check blue text-blue mb-10">
                                <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                            </ul>
                            <div class="filebox mt-10">
                                <input type="text" class="upload-name form-item" name="file6Name" id="file6Name" value="{{ $overseas->filename6 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                <label for="file6">파일찾기</label>
                                <input type="file" name="file6" id="file6" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                                <input type="hidden" name="file6_del" id="file6_del" value="" readonly="">

                                @if (!empty($overseas->filename6))
                                    <div class="attach-file">
                                        <a href="{{ $overseas->downloadUrl(6) }}" target="_blank" class="link">
                                            {{ $overseas->filename6 }}
                                        </a>
                                        <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="form-tit">등록비</div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-con">
                            <div class="form-group-text">
                                <input type="text" name="pay3" id="pay3" value="{{ $overseas->pay3 ?? '' }}" onlyNumber maxlength="10" class="form-item w-40p" placeholder="">
                                <p class="text fw-500">원</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-con">
                            <ul class="list-type list-type-check blue text-blue mb-10">
                                <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                            </ul>
                            <div class="filebox mt-10">
                                <input type="text" class="upload-name form-item" name="file7Name" id="file7Name" value="{{ $overseas->filename7 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                <label for="file7">파일찾기</label>
                                <input type="file" name="file7" id="file7" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                                <input type="hidden" name="file7_del" id="file7_del" value="" readonly="">

                                @if (!empty($overseas->filename7))
                                    <div class="attach-file">
                                        <a href="{{ $overseas->downloadUrl(7) }}" target="_blank" class="link">
                                            {{ $overseas->filename7 }}
                                        </a>
                                        <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="form-tit">식대</div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-con">
                            <div class="form-group-text">
                                <input type="text" name="pay4" id="pay4" value="{{ $overseas->pay4 ?? '' }}" onlyNumber maxlength="10" class="form-item w-40p" placeholder="">
                                <p class="text fw-500">원</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-con">
                            <ul class="list-type list-type-check blue text-blue mb-10">
                                <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                            </ul>
                            <div class="filebox mt-10">
                                <input type="text" class="upload-name form-item" name="file8Name" id="file8Name" value="{{ $overseas->filename8 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                <label for="file8">파일찾기</label>
                                <input type="file" name="file8" id="file8" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                                <input type="hidden" name="file8_del" id="file8_del" value="" readonly="">

                                @if (!empty($overseas->filename8))
                                    <div class="attach-file">
                                        <a href="{{ $overseas->downloadUrl(8) }}" target="_blank" class="link">
                                            {{ $overseas->filename8 }}
                                        </a>
                                        <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="form-tit">교통비</div>
            <div class="form-con">
                <ul class="write-wrap">
                    <li>
                        <div class="form-con">
                            <div class="form-group-text">
                                <input type="text" name="pay5" id="pay5" value="{{ $overseas->pay5 ?? '' }}" onlyNumber maxlength="10" class="form-item w-40p" placeholder="">
                                <p class="text fw-500">원</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-con">
                            <ul class="list-type list-type-check blue text-blue mb-10">
                                <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                            </ul>
                            <div class="filebox mt-10">
                                <input type="text" class="upload-name form-item" name="file9Name" id="file9Name" value="{{ $overseas->filename9 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                <label for="file9">파일찾기</label>
                                <input type="file" name="file9" id="file9" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                                <input type="hidden" name="file9_del" id="file9_del" value="" readonly="">

                                @if (!empty($overseas->filename9))
                                    <div class="attach-file">
                                        <a href="{{ $overseas->downloadUrl(9) }}" target="_blank" class="link">
                                            {{ $overseas->filename9 }}
                                        </a>
                                        <a href="javascript:;" class="btn-file-delete text-red">X</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="form-tit">기타 영수증</div>
            <div class="form-con">
                <ul class="list-type list-type-check blue text-blue mb-10">
                    <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                </ul>
                <div class="filebox mt-10">
                    <input type="text" class="upload-name form-item" name="file10Name" id="file10Name" value="{{ $overseas->filename10 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                    <label for="file10">파일찾기</label>
                    <input type="file" name="file10" id="file10" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                    <input type="hidden" name="file10_del" id="file10_del" value="" readonly="">

                    @if (!empty($overseas->filename10))
                        <div class="attach-file">
                            <a href="{{ $overseas->downloadUrl(10) }}" target="_blank" class="link">
                                {{ $overseas->filename10 }}
                            </a>
                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                        </div>
                    @endif
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">
                <p><strong class="required">*</strong> 결과보고서</p>
                @if($overseas->assistant == 'A')
                    <a href="{{ $overseasSetting->downloadUrl(2) }}" target="_blank" class="btn btn-small color-type2">결과보고서 양식 다운로드</a>
                @else
                    <a href="{{ $overseasSetting->downloadUrl(5) }}" target="_blank" class="btn btn-small color-type2">결과보고서 양식 다운로드</a>
                @endif

            </div>
            <div class="form-con">
                <ul class="list-type list-type-check blue text-blue mb-10">
                    <li>결과보고서(서명포함)는 정해진 양식을 다운 받아 업로드 해주시기 바랍니다. </li>
                    <li>pdf, doc, docx 파일만 업로드 가능합니다.</li>
                </ul>
                <div class="filebox mt-10">
                    <input type="text" class="upload-name form-item" name="file11Name" id="file11Name" value="{{ $overseas->filename11 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                    <label for="file11">파일찾기</label>
                    <input type="file" name="file11" id="file11" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                    <input type="hidden" name="file11_del" id="file11_del" value="" readonly="">

                    @if (!empty($overseas->filename11))
                        <div class="attach-file">
                            <a href="{{ $overseas->downloadUrl(11) }}" target="_blank" class="link">
                                {{ $overseas->filename11 }}
                            </a>
                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                        </div>
                    @endif
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">
                <p><strong class="required">*</strong> 지출내역서</p>
                @if($overseas->assistant == 'A')
                    <a href="{{ $overseasSetting->downloadUrl(3) }}" target="_blank" class="btn btn-small color-type2">지출내역서 양식 다운로드</a>
                @else
                    <a href="{{ $overseasSetting->downloadUrl(6) }}" target="_blank" class="btn btn-small color-type2">지출내역서 양식 다운로드</a>
                @endif

            </div>
            <div class="form-con">
                <ul class="list-type list-type-check blue text-blue mb-10">
                    <li>지출내역서(서명포함)는 정해진 양식을 다운 받아 업로드 해주시기 바랍니다.</li>
                    <li>pdf, doc, docx 파일만 업로드 가능합니다.</li>
                </ul>
                <div class="filebox mt-10">
                    <input type="text" class="upload-name form-item" name="file12Name" id="file12Name" value="{{ $overseas->filename12 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                    <label for="file12">파일찾기</label>
                    <input type="file" name="file12" id="file12" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                    <input type="hidden" name="file12_del" id="file12_del" value="" readonly="">

                    @if (!empty($overseas->filename12))
                        <div class="attach-file">
                            <a href="{{ $overseas->downloadUrl(12) }}" target="_blank" class="link">
                                {{ $overseas->filename12 }}
                            </a>
                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                        </div>
                    @endif
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">기타</div>
            <div class="form-con">
                <ul class="list-type list-type-check blue text-blue mb-10">
                    <li>ppt, pptx, pdf, jpg, png, gif 파일만 업로드 가능합니다.</li>
                </ul>
                <div class="filebox mt-10">
                    <input type="text" class="upload-name form-item" name="file13Name" id="file13Name" value="{{ $overseas->filename13 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                    <label for="file13">파일찾기</label>
                    <input type="file" name="file13" id="file13" class="file-upload" accept=".ppt, .pptx, .pdf, .jpg, .png, .gif" data-accept="ppt|pptx|pdf|jpg|png|gif" >
                    <input type="hidden" name="file13_del" id="file13_del" value="" readonly="">

                    @if (!empty($overseas->filename13))
                        <div class="attach-file">
                            <a href="{{ $overseas->downloadUrl(13) }}" target="_blank" class="link">
                                {{ $overseas->filename13 }}
                            </a>
                            <a href="javascript:;" class="btn-file-delete text-red">X</a>
                        </div>
                    @endif
                </div>
            </div>
        </li>
    </ul>

</fieldset>

@section('report-script')
    <script>
        //파일첨부
        $(document).on('click', '.btn-file-delete', function () {
            const name = $(this).closest('.filebox').find('input[type=file]').attr('name');
            const target = $(this).closest('.filebox').find('.attach-file');

            target.remove();
            $(`#${name}_del`).val('Y');
            $(`#${name}Name`).val('');
        });


        $(document).on('submit', form, function () {

            if (isEmpty( $("[name='file3Name']").val() )) {
                alert('초록사본을 첨부해주세요.');
                $("input[name='file3Name']").focus();
                return false;
            }

            if (isEmpty( $("[name='file4Name']").val() )) {
                alert('초록채택메일을 첨부해주세요.');
                $("input[name='file4Name']").focus();
                return false;
            }

            if (isEmpty( $("[name='file11Name']").val() )) {
                alert('결과보고서를 첨부해주세요.');
                $("input[name='file11Name']").focus();
                return false;
            }

            if (isEmpty( $("[name='file12Name']").val() )) {
                alert('지출내역서를 첨부해주세요.');
                $("input[name='file12Name']").focus();
                return false;
            }


            boardSubmit();
        });
    </script>
@endsection