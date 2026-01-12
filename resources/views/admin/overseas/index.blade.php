@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        @include('admin.layouts.include.sub-tit')

        <form id="searchF" name="searchF" action="{{ route('overseas') }}" class="sch-form-wrap">
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
                            <th scope="row">공개상태</th>
                            <td class="text-left">
                                <select name="hide" class="form-item">
                                    <option value="">전체</option>
                                    @foreach($overseasConfig['hide'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->hide ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
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
                    <a href="{{ route('overseas') }}" class="btn btn-type1 color-type18">검색 초기화</a>
                </div>
            </fieldset>
        </form>

        <div class="btn-wrap text-left">
            <a href="{{ route('overseas.upsert') }}" class="btn btn-type1 color-type19 call-popup" data-popup_name="overseas-upsert" data-width="1200" data-height="900">신규 등록</a>
            <a href="{{ route('grantees') }}" class="btn btn-type1 color-type20" >수혜명단 관리</a>
        </div>

        <div class="table-wrap mb-50">
            <table class="cst-table abs-info-table">
                <colgroup>
                    <col style="width: 3%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 10%;">
                    <col style="width: 5%;">
                    <col style="width: 10%;">

                    <col style="width: 10%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                </colgroup>
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">공개상태</th>
                    <th rowspan="2">학회명</th>
                    <th rowspan="2">개최일자/개최장소</th>
                    <th rowspan="2">선정인원</th>
                    <th rowspan="2">신청기간</th>

                    <th rowspan="2">결과발표일</th>
                    <th colspan="4">신청인원</th>
                    <th rowspan="2">신청상태</th>
                    <th rowspan="2">명단</th>
                    <th rowspan="2">관리</th>
                </tr>
                <tr>
                    <th style="border-left: 1px solid #d9e0eb !important;">작성중</th>
                    <th>선정</th>
                    <th>미선정</th>
                    <th>총인원</th>
                </tr>
                </thead>
                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>{{ $overseasConfig['hide'][$row->hide] ?? '' }}</td>
                        <td>{{ $row->title ?? '' }}</td>
                        <td>
                            {{ $row->sdate ?? '' }}{{ !empty($row->edate) && ($row->sdate != $row->edate) ? ' ~ '.$row->edate : '' }}<br>
                            {{ $row->place ?? '' }}
                        </td>
                        <td>{{ $row->limit_person ?? '' }}</td>
                        <td>
                            {{ $row->regist_sdate ?? '' }}{{ !empty($row->regist_edate) && ($row->regist_sdate != $row->regist_edate) ? ' ~ '.$row->regist_edate : '' }}<br>
                        </td>


                        <td>{{ $row->result_date ?? '' }}</td>
                        <td>{{ $row->regIngCnt() ?? 0 }}</td>
                        <td>{{ $row->regJudgeYCnt() ?? 0 }}</td>
                        <td>{{ $row->regJudgeNCnt() ?? 0 }}</td>
                        <td>{{ $row->regTotCnt() ?? 0 }}</td>

                        @php
                            $now = \Carbon\Carbon::now();
                            $sdate = \Carbon\Carbon::parse($row->regist_sdate);
                            $edate = \Carbon\Carbon::parse($row->regist_edate);
                        @endphp
                        <td>
                            @if($now->lessThan($sdate))
                                <span class="status-text">오픈 예정</span>
                            @elseif($now->greaterThanOrEqualTo($sdate) && $now->lessThanOrEqualTo($edate))
                                <a href="{{ env('APP_URL') }}/overseas/search" class="btn btn-small color-type1">
                                    바로가기
                                </a>
                            @else
                                <span class="status-text">신청마감</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('apply', ['o_sid' => $row->sid]) }}" class="btn btn-small color-type1">
                                명단
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('overseas.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-name="overseasSetting-upsert" data-width="1200" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14">등록된 국외학술행사가 없습니다.</td>
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
        const dataUrl = '{{ route('overseas.data') }}';
        const thisPk = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-del', function() {
            if (confirm('정말 삭제하시겠습니까? 삭제한 행사와 관련된 모든 정보는 복구가 불가능합니다?')) {
                callAjax(dataUrl, {
                    'case': 'overseasSetting-delete',
                    'sid': thisPk(this),
                });
            }
        });
    </script>
@endsection
