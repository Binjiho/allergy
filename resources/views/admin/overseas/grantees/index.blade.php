@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
    </style>
@endsection

@section('contents')
    <div class="sub-contents">

        <h2>수혜명단 list</h2>

        <form id="searchF" name="searchF" action="{{ route('grantees') }}" class="sch-form-wrap">
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
                            <th scope="row">연도</th>
                            <td class="text-left">
                                <select name="year_sdate" class="form-item" style="width: 47%">
                                    <option value="">YYYY</option>
                                    @foreach($overseasConfig['year'] as $key => $val)
                                        <option value="{{ $val }}" {{ (request()->year_sdate ?? '') == $val ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>

                                <span>~</span>

                                <select name="year_edate" class="form-item" style="width: 47%">
                                    <option value="">YYYY</option>
                                    @foreach($overseasConfig['year'] as $key => $val)
                                        <option value="{{ $val }}" {{ (request()->year_edate ?? '') == $val ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <th scope="row">학회명</th>
                            <td class="text-left">
                                <input type="text" name="title" value="{{ request()->title ?? '' }}" class="form-item">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">이름</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">면허번호</th>
                            <td class="text-left">
                                <input type="text" name="license_number" value="{{ request()->license_number ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="li_page" value="{{ $li_page }}" readonly>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('grantees') }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('grantees.excel') }}" class="btn btn-type1 color-type19">데이터 백업</a>
                    <a href="{{ route('overseas') }}" class="btn btn-type1 color-type15">행사 목록 이동</a>
                </div>
            </fieldset>
        </form>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                <a href="{{ route('grantees.collective') }}" class="btn btn-small btn-type1 color-type10 call-popup" data-popup_name="executive-upsert-collective" data-width="1350" data-height="700">수혜명단 일괄등록</a>
                <a href="{{ route('grantees.upsert') }}" class="btn btn-small btn-type1 color-type8 call-popup" data-name="upsert-individual" data-width="800" data-height="900">수혜명단 단건등록</a>
            </span>


            @include('admin.layouts.include.li_page')
        </div>


        <div class="table-wrap" style="margin-top: 10px;">
            <table class="cst-table list-table">
                <caption class="hide">목록</caption>

                <colgroup>
                    <col style="width: 4%;">
                    <col style="width: 6%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">

                    <col style="width: 8%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">연도</th>
                    <th scope="col">학회명</th>
                    <th scope="col">개최일자</th>
                    <th scope="col">개최장소</th>

                    <th scope="col">이름</th>
                    <th scope="col">면허번호</th>
                    <th scope="col">메모</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>

                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>{{ $row->year ?? '' }}</td>
                        <td>{{ $row->title ?? '' }}</td>
                        <td>{{ $row->event_date ?? '' }}</td>
                        <td>{{ $row->place ?? '' }}</td>

                        <td>{{ $row->name_kr ?? '' }}</td>
                        <td>{{ $row->license_number ?? '' }}</td>
                        <td>
                            <a href="{{ route('grantees.memo',['sid'=>$row->sid]) }}" class="btn btn-small color-type18 call-popup" data-name="reg-memo" data-height="500">
                                메모
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('grantees.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="800" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">등록정보가 없습니다.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $list->links('pagination::custom') }}
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('grantees.data') }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-del', function () {
            if (confirm('데이터 삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'grantees-delete',
                    'sid': getPK(this),
                });
            }
        });

        $(document).on('change', '.db-change', function () {
            callAjax(dataUrl, {
                'case': 'db-change',
                'sid': getPK(this),
                'field': $(this).data('field'),
                'value': $(this).val(),
            });
        });

    </script>
@endsection
