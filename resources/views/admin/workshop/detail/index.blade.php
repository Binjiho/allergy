@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
    </style>
@endsection

@section('contents')
    <div class="sub-contents">

        <h2>{{ $workshop->title ?? '' }} - 상세 list</h2>

        <form id="searchF" name="searchF" action="{{ route('detail',['wsid'=>$workshop->sid]) }}" class="sch-form-wrap">
            <fieldset>
                <legend class="hide">검색</legend>
                <div class="table-wrap">
                    <table class="cst-table">
                        <colgroup>
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                        </colgroup>

                        <tbody>
                        <tr>
                            <th scope="row">성명</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">근무처(소속)</th>
                            <td class="text-left">
                                <input type="text" name="addr" value="{{ request()->addr ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">의사면허번호</th>
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
                    <a href="{{ route('detail', ['wsid'=>request()->wsid]) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('workshop') }}" class="btn btn-type1 color-type15">목록 이동</a>
                </div>
            </fieldset>
        </form>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                <a href="{{ route('detail.upsert',['wsid'=>request()->wsid ?? '']) }}" class="btn btn-small btn-type1 color-type8 call-popup" data-name="upsert-individual" data-width="1550" data-height="900">명단 단건등록</a>
                <a href="{{ route('detail.collective', ['wsid' => request()->wsid]) }}" class="btn btn-small btn-type1 color-type10 call-popup" data-popup_name="executive-upsert-collective" data-width="1350" data-height="700">명단 일괄등록</a>
            </span>


            @include('admin.layouts.include.li_page')
        </div>


        <div class="table-wrap" style="margin-top: 10px;">
            <table class="cst-table list-table">
                <caption class="hide">목록</caption>

                <colgroup>
                    <col style="width: 4%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 10%;">

                    <col style="width: 10%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">이름</th>
                    <th scope="col">근무처<br>(소속)</th>
                    <th scope="col">면허번호</th>
                    <th scope="col">등록비</th>

                    <th scope="col">결제방법</th>
                    <th scope="col">결제상태</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>

                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>{{ $row->name_kr ?? '' }}</td>
                        <td>{{ $row->addr ?? '' }}</td>
                        <td>{{ $row->license_number ?? '' }}</td>
                        <td>{{ number_format($row->amount ?? 0) ?? 0 }}</td>

                        <td>
                            <select class="form-item db-change" data-field="pay_method">
                                {{--  어드민용 이어서 config 사용X  --}}
                                <option value="" >선택</option>
                                <option value="C" {{ ($row->pay_method ?? '') == 'C' ? 'selected' : '' }}>Credit Card</option>
                                <option value="B" {{ ($row->pay_method ?? '') == 'B' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="M" {{ ($row->pay_method ?? '') == 'M' ? 'selected' : '' }}>현금</option>
                                <option value="Z" {{ ($row->pay_method ?? '') == 'Z' ? 'selected' : '' }}>기타</option>
                                <option value="W" {{ ($row->pay_method ?? '') == 'W' ? 'selected' : '' }}>면제</option>
                            </select>
                        </td>
                        <td>
                            {{--  어드민용 이어서 config 사용X  --}}
                            <select class="form-item db-change" data-field="pay_status">
                                <option value="" >선택</option>
                                <option value="N" {{ ($row->pay_status ?? '') == 'N' ? 'selected' : '' }}>미결제</option>
                                <option value="Y" {{ ($row->pay_status ?? '') == 'Y' ? 'selected' : '' }}>결제완료</option>
                                <option value="F" {{ ($row->pay_status ?? '') == 'F' ? 'selected' : '' }}>무료</option>
                            </select>
                        </td>


                        <td>
                            <a href="{{ route('detail.upsert', ['sid' => $row->sid, 'wsid'=>$row->wsid]) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="1550" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">등록정보가 없습니다.</td>
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
        const dataUrl = '{{ route('detail.data',['wsid'=>request()->wsid]) }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-del', function () {
            if (confirm('데이터 삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'detail-delete',
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
