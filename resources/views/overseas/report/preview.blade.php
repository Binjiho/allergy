@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('overseas.include.sub-tab-wrap')

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
                <h4 class="sub-tit">신청 정보</h4>
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
                    <div class="form-tit">초록사본</div>
                    <div class="form-con">
                        @if (!empty($overseas->filename3))
                            <a href="{{ $overseas->downloadUrl(3) }}">{{ $overseas->filename3 }}</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="form-tit">초록채택메일</div>
                    <div class="form-con">
                        @if (!empty($overseas->filename4))
                            <a href="{{ $overseas->downloadUrl(4) }}">{{ $overseas->filename4 }}</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="form-tit">
                        <p>지원경비 영수증 파일</p>
                        <span class="help-text text-blue">* “모든” 영수증 및 서류들을 각 카테고리별로 업로드 해주시길 부탁드립니다</span>
                    </div>
                </li>
                <li>
                    <div class="form-tit">항공료</div>
                    <div class="form-con">
                        <ul class="write-wrap">
                            <li>
                                <div class="form-con">
                                    {{ number_format($overseas->pay1 ?? 0) ?? 0 }} 원
                                </div>
                            </li>
                            <li>
                                <div class="form-con">
                                    @if (!empty($overseas->filename5))
                                        <a href="{{ $overseas->downloadUrl(5) }}">{{ $overseas->filename5 }}</a>
                                    @endif
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
                                    {{ number_format($overseas->pay2 ?? 0) ?? 0 }} 원
                                </div>
                            </li>
                            <li>
                                <div class="form-con">
                                    @if (!empty($overseas->filename6))
                                        <a href="{{ $overseas->downloadUrl(6) }}">{{ $overseas->filename6 }}</a>
                                    @endif
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
                                    {{ number_format($overseas->pay3 ?? 0) ?? 0 }} 원
                                </div>
                            </li>
                            <li>
                                <div class="form-con">
                                    @if (!empty($overseas->filename7))
                                        <a href="{{ $overseas->downloadUrl(7) }}">{{ $overseas->filename7 }}</a>
                                    @endif
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
                                    {{ number_format($overseas->pay4 ?? 0) ?? 0 }} 원
                                </div>
                            </li>
                            <li>
                                <div class="form-con">
                                    @if (!empty($overseas->filename8))
                                        <a href="{{ $overseas->downloadUrl(8) }}">{{ $overseas->filename8 }}</a>
                                    @endif
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
                                    {{ number_format($overseas->pay5 ?? 0) ?? 0 }} 원
                                </div>
                            </li>
                            <li>
                                <div class="form-con">
                                    @if (!empty($overseas->filename9))
                                        <a href="{{ $overseas->downloadUrl(9) }}">{{ $overseas->filename9 }}</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="form-tit">기타 영수증</div>
                    <div class="form-con">
                        @if (!empty($overseas->filename10))
                            <a href="{{ $overseas->downloadUrl(10) }}">{{ $overseas->filename10 }}</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="form-tit">
                        <p>결과보고서</p>
                    </div>
                    <div class="form-con">
                        @if (!empty($overseas->filename11))
                            <a href="{{ $overseas->downloadUrl(11) }}">{{ $overseas->filename11 }}</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="form-tit">
                        <p>지출내역서</p>
                    </div>
                    <div class="form-con">
                        @if (!empty($overseas->filename12))
                            <a href="{{ $overseas->downloadUrl(12) }}">{{ $overseas->filename12 }}</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="form-tit">기타</div>
                    <div class="form-con">
                        @if (!empty($overseas->filename13))
                            <a href="{{ $overseas->downloadUrl(13) }}">{{ $overseas->filename13 }}</a>
                        @endif
                    </div>
                </li>
            </ul>
            <div class="btn-wrap text-center">
                <a href="{{ route('overseas.search') }}" class="btn btn-type1 color-type4 btn-line">목록 이동</a>
            </div>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('overseas.data') }}';
    </script>
@endsection
