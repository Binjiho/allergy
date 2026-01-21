@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
    </style>
@endsection

@section('contents')
    <div class="sub-contents">

        <h2>{{ $overseas->title ?? '' }} - {{ request()->case == 'elimination' ? '삭제' : '전체' }} list</h2>

        <div class="sub-tab-wrap">
            <ul class="sub-tab-menu cf">
                <li class="{{ empty($listCase) ? 'on' : '' }}">
                    <a href="{{ route('apply',['o_sid'=>$overseas->sid]) }}">전체 list</a>
                </li>

                <li class="{{ request()->case == 'elimination' ? 'on' : '' }}">
                    <a href="{{ route('apply',['o_sid'=>$overseas->sid, 'case'=>'elimination']) }}">삭제 list</a>
                </li>
            </ul>
        </div>

        <form id="searchF" name="searchF" action="{{ route('apply',['o_sid'=>$overseas->sid]) }}" class="sch-form-wrap">
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
                            <th scope="row">의사면허번호</th>
                            <td class="text-left">
                                <input type="text" name="license_number" value="{{ request()->license_number ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">이메일</th>
                            <td class="text-left">
                                <input type="text" name="email" value="{{ request()->email ?? '' }}" class="form-item">
                            </td>
                        </tr>
						{{--
                        <tr>
                            <th scope="row">신청상태</th>
                            <td class="text-left">
                                <select name="status" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($overseasConfig['status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <th scope="row">심사상태</th>
                            <td class="text-left">
                                <select name="judge" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($overseasConfig['judge'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->judge ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <th scope="row">지원협회</th>
                            <td class="text-left">
                                <select name="assistant" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($overseasConfig['assistant'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->assistant ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
						--}}
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="li_page" value="{{ $li_page }}" readonly>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('apply',['o_sid'=>$overseas->sid]) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('apply.excel',['o_sid'=>$overseas->sid]) }}" class="btn btn-type1 color-type19">데이터 백업</a>
                    <a href="{{ route('overseas') }}" class="btn btn-type1 color-type15">목록 이동</a>
                </div>
            </fieldset>
        </form>

        <div class="table-wrap mb-50 ">
            <table class="cst-table abs-info-table">
                <colgroup>
                    <col style="width: 20%;">
                    <col style="width: 80%;">

                </colgroup>

                <thead>
                <tr>
                    <th colspan="2">
                        통계현황 <a href="javascript:;" class="btn btn-small color-type1 trigger">닫기</a>
                    </th>
                </tr>
                </thead>

                <tbody class="toggleArea">
                <tr>
                    <td>신청상태</td>
                    <td style="text-align: left;">
                        @foreach($overseasConfig['complete'] as $key => $val)
                            {{ $val }} : {{ $statusCnt[$key] ?? 0 }}건 @unless($loop->last) | @endunless
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>심사상태</td>
                    <td style="text-align: left;">
                        @foreach($overseasConfig['judge'] as $key => $val)
                            {{ $val }} : {{ $judgeCnt[$key] ?? 0 }}건 @unless($loop->last) | @endunless
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>지원협회</td>
                    <td style="text-align: left;">
                        @foreach($overseasConfig['assistant'] as $key => $val)
                            {{ $val }} : {{ $assistantCnt[$key] ?? 0 }}건 @unless($loop->last) | @endunless
                        @endforeach
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

		<div class="list-contop full-left cf" style="margin-top: 10px;">
            <a href="{{ route('apply.all-judge-change', ['o_sid'=>$overseas->sid]) }}" class="btn btn-small btn-type1 color-type20 call-popup" data-name="all-judge-change" data-width="1550" data-height="900">
				심사상태 일괄변경
            </a>
            <a href="{{ route('apply.all-pay-change', ['o_sid'=>$overseas->sid]) }}" class="btn btn-small btn-type1 color-type20 call-popup" data-name="all-pay-change" data-width="1550" data-height="900">
                지급여부상태 일괄변경
            </a>

            <a href="{{ route('apply.completeZip',['o_sid'=>$overseas->sid]) }}" class="btn btn-small btn-type1 color-type11">
                신청자료 일괄 다운로드
            </a>
            <a href="{{ route('apply.reportZip',['o_sid'=>$overseas->sid]) }}" class="btn btn-small btn-type1 color-type14">
                결과보고서 자료 일괄 다운로드
            </a>
        </div>

        <div class="list-contop text-right cf">
            @include('admin.layouts.include.li_page')
        </div>


        <div class="table-wrap" style="margin-top: 10px;">
            <table class="cst-table list-table">
                <caption class="hide">목록</caption>

                <colgroup>
                    <col style="width: 4%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 4%;">
                    <col style="width: 6%;">

                    <col style="width: 4%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 4%;">
                    <col style="width: 10%;">

                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 10%;">

                    <col style="width: 4%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 5%;">
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">신청상태</th>
                    <th scope="col">학회ID</th>
                    <th scope="col">성명(한글)</th>
                    <th scope="col">소속</th>

                    <th scope="col">면허번호</th>
                    <th scope="col">이메일</th>
                    <th scope="col">휴대폰번호</th>
                    <th scope="col">지원자격</th>
                    <th scope="col">발표제목</th>

                    <th scope="col">심사상태</th>
                    <th scope="col">지원협회</th>
                    <th scope="col">결과보고<br>제출상태</th>
                    <th scope="col">결과보고자료</th>
                    <th scope="col">접수일</th>

                    <th scope="col">결과보고서<br>제출일</th>
                    <th scope="col">지급여부</th>
                    <th scope="col">메모</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>

                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>
                            <select class="form-item db-change" data-field="complete">
								@foreach($overseasConfig['complete'] as $tkey => $tval)
									<option value="{{ $tkey }}" {{ ($row->complete ?? '') == $tkey ? 'selected' : '' }}>{{ $tval }}</option>
								@endforeach
                            </select>
                        </td>
                        <td>{{ $row->user->id ?? '' }}</td>
                        <td>
                            <a href="{{ route('apply.modify', ['sid' => $row->sid, 'o_sid'=>$row->o_sid, 'step'=>'2']) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="1550" data-height="900">
                            {{ $row->user->name_kr ?? '' }}
                            </a>
                        </td>
                        <td>{{ $row->sosok_kr ?? '' }}</td>


                        <td>{{ $row->user->license_number ?? '' }}</td>
                        <td>{{ $row->email ?? '' }}</td>
                        <td>{{ $row->phone ?? '' }}</td>
                        <td>{{ $overseasConfig['presenter'][$row->presenter] ?? '' }}</td>
                        <td>{{ $row->title_kr ?? '' }}</td>


                        <td>
							<select class="form-item db-change" data-field="judge">
								@foreach($overseasConfig['judge'] as $tkey => $tval)
									<option value="{{ $tkey }}" {{ ($row->judge ?? '') == $tkey ? 'selected' : '' }}>{{ $tval }}</option>
								@endforeach
                            </select>
                        </td>
                        <td>
							<select class="form-item db-change" data-field="assistant">
								<option value="">선택</option>
								@foreach($overseasConfig['assistant'] as $tkey => $tval)
									<option value="{{ $tkey }}" {{ ($row->assistant ?? '') == $tkey ? 'selected' : '' }}>{{ $tval }}</option>
								@endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-item db-change" data-field="report">
                                <option value="">선택</option>
                                @foreach($overseasConfig['report'] as $tkey => $tval)
                                    <option value="{{ $tkey }}" {{ ($row->report ?? '') == $tkey ? 'selected' : '' }}>{{ $tval }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
							<a href="{{ route('apply.report_modify', ['sid' => $row->sid, 'o_sid'=>$row->o_sid]) }}" class="btn btn-small color-type18 call-popup" data-name="" data-width="1550" data-height="900">
								View
							</a>
                        </td>
						<td>{{ $row->created_at ?? '' }}</td>


                        <td>{{ $row->reported_at ?? '' }}</td>
                        <td>
                            <select class="form-item db-change" data-field="pay_result">
                                <option value="">선택</option>
                                @foreach($overseasConfig['pay_result'] as $tkey => $tval)
                                    <option value="{{ $tkey }}" {{ ($row->pay_result ?? '') == $tkey ? 'selected' : '' }}>{{ $tval }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
							@if($row->memo)
								@php
									$memoClass = 'color-type18';
								@endphp
							@else
								@php
									$memoClass = 'btn-line';
								@endphp
							@endif
							<a href="{{ route('apply.memo', ['sid' => $row->sid, 'o_sid'=>$row->o_sid]) }}" class="btn btn-small {{ $memoClass }} call-popup" data-name="apply-memo" data-height="500">
								메모
							</a>
                        </td>

                        @if(!empty($listCase) && $listCase['case'] == 'elimination')
                            <td>{{ $row->deleted_at ?? '' }}</td>
                        @else
                            <td>
                                <a href="{{ route('apply.modify', ['sid' => $row->sid, 'o_sid'=>$row->o_sid, 'step'=>'2']) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="1550" data-height="900">
                                    <img src="/assets/image/admin/ic_modify.png" alt="수정">
                                </a>
                                <a href="javascript:void(0);" class="btn-admin btn-del">
                                    <img src="/assets/image/admin/ic_del.png" alt="삭제">
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="19">등록정보가 없습니다.</td>
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
        const dataUrl = '{{ route('apply.data',['o_sid'=>request()->o_sid]) }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-del', function () {
            if (confirm('데이터 삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'overseas-delete',
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
