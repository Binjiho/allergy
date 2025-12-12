@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        @include('admin.layouts.include.sub-tit')

        <form id="searchF" name="searchF" action="{{ route('workshop') }}" class="sch-form-wrap">
            <fieldset>
                <legend class="hide">검색</legend>
                <div class="table-wrap">
                    <table class="cst-table">
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 30%;">
                            <col style="width: 20%;">
                            <col style="width: 30%;">

                        </colgroup>

                        <tbody>
                        <tr>
{{--                            <th scope="row">연도</th>--}}
{{--                            <td class="text-left">--}}
{{--                                <select name="year" class="form-item mr-5">--}}
{{--                                    <option value="">선택</option>--}}
{{--                                    @for($i = (int)date('Y'); $i >= 2016; $i--)--}}
{{--                                        <option value="{{ $i }}" {{ request()->input('year', '') === $i ? 'selected' : '' }}>{{ $i }}</option>--}}
{{--                                    @endfor--}}
{{--                                </select>--}}
{{--                            </td>--}}

                            <th scope="row">공개상태</th>
                            <td class="text-left">
                                <select name="hide" class="form-item mr-5">
                                    <option value="">선택</option>
                                    @foreach($defaultConfig['hide'] as $key => $val)
                                        <option value="{{ $key }}" {{ request()->input('hide', '') === $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">행사명</th>
                            <td class="text-left">
                                <input type="text" name="title" value="{{ request()->title ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('workshop') }}" class="btn btn-type1 color-type18">검색 초기화</a>
                </div>
            </fieldset>
        </form>

        <div class="btn-wrap text-left">
            <a href="{{ route('workshop.upsert') }}" class="btn btn-type1 color-type19 call-popup" data-popup_name="workshop-upsert" data-width="1200" data-height="900">신규 행사 등록</a>
        </div>

        <div class="table-wrap mb-50">
            <table class="cst-table abs-info-table">
                <colgroup>
                    <col style="width: 4%;">
                    <col style="width: 8%">
                    <col style="width: 15%">
                    <col style="width: 10%">

                    <col style="width: 10%">
                    <col style="width: 6%">
                    <col style="width: 6%">
                    <col style="width: 6%">
                </colgroup>
                <thead>
                <tr>
                    <th>번호</th>
                    <th>공개상태</th>
                    <th>행사명</th>
                    <th>행사일 / 장소</th>
                    <th>사전등록기간</th>

                    <th>명단관리</th>
                    <th>인원</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>{{ $defaultConfig['hide'][$row->hide] ?? '' }}</td>
                        <td>{{ $row->title ?? '' }}</td>
                        <td>
                            {{ $row->event_sdate ?? '' }} {{ !empty($row->event_edate) && ($row->event_sdate != $row->event_edate) ? ' ~ '.$row->event_edate : '' }}
                            <br>
                            {{ $row->place ?? '' }}
                        </td>
                        <td>{{ $row->regist_sdate ?? '' }} {{ !empty($row->regist_edate) && ($row->regist_sdate != $row->regist_edate) ? ' ~ '.$row->regist_edate : '' }}</td>

                        <td>
                            <a href="{{ route('registration', ['wsid' => $row->sid]) }}" class="btn btn-small color-type1">
                                명단
                            </a>
                        </td>
                        <td>
                            {{ number_format($row->regCnt() ?? 0) }}명
                        </td>
                        <td>
                            <a href="{{ route('workshop.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-name="workshop-upsert" data-width="1200" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">등록된 학술행사가 없습니다.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('workshop.data') }}';
        const thisPk = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-del', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'workshop-delete',
                    'sid': thisPk(this),
                });
            }
        });
    </script>
@endsection
