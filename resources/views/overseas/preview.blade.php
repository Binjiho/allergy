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
                    <div class="form-tit">발표 초록 Title</div>
                    <div class="form-con">
                        <ul class="write-wrap">
                            <li>
                                <div class="form-tit">국문</div>
                                <div class="form-con">{{ $overseas->title_kr ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">영문</div>
                                <div class="form-con">{{ $overseas->title_en ?? '' }}</div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="form-tit">발표 초록 File</div>
                    <div class="form-con">
                        @if (!empty($overseas->filename1))
                            <a href="{{ $overseas->downloadUrl(1) }}">{{ $overseas->filename1 }}</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="form-tit">초록채택메일 or 초청 메일</div>
                    <div class="form-con">
                        <ul class="write-wrap">
                            <li>
                                <div class="form-con">{{ $overseasConfig['submit_type'][$overseas->submit_type] ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-con">
                                    @if (!empty($overseas->filename2))
                                    <a href="{{ $overseas->downloadUrl(2) }}">{{ $overseas->filename2 }}</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <!-- 추후 제출 -->
                                <div class="form-con">{{ $overseasConfig['agree2'][$overseas->agree2 ?? 'Y'] ?? '' }}</div>
                                <!-- //추후제출 -->
                            </li>
                        </ul>
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
