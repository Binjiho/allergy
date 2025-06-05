@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="sub-contents">

        @include('admin.layouts.include.sub-tit')

        <div class="sub-tab-wrap">
            <ul class="sub-tab-menu cf">
                <li class="{{ empty($feeCase) ? 'on' : '' }}">
                    <a href="{{ route('fee') }}">전체 list ({{ $caseCnt['total'] ?? 0 }}명)</a>
                </li>

                <li class="{{ request()->case == 'full' ? 'on' : '' }}">
                    <a href="{{ route('fee', ['case' => 'full']) }}">완납회원 ({{ $caseCnt['Y'] ?? 0 }}명)</a>
                </li>

                <li class="{{ request()->case == 'unpaid' ? 'on' : '' }}">
                    <a href="{{ route('fee', ['case' => 'unpaid']) }}">미납회원 ({{ $caseCnt['N'] ?? 0 }}명)</a>
                </li>
            </ul>
        </div>

        <form id="searchF" name="searchF" action="{{ route('fee', $feeCase) }}" class="sch-form-wrap">
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
                            <th scope="row">회원등급</th>
                            <td class="text-left" >
                                <select name="level" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($userConfig['level'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->level ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">이름</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>

                        </tr>

                        <tr>
                            <th scope="row">회원 ID</th>
                            <td class="text-left">
                                <input type="text" name="id" value="{{ request()->id ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">면허번호</th>
                            <td class="text-left">
                                <input type="text" name="license_number" value="{{ request()->license_number ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">회비 구분</th>
                            <td class="text-left">
                                <select name="category" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($feeConfig['category'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->category ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">납부 상태</th>
                            <td class="text-left">
                                <select name="payment_status" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($feeConfig['payment_status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->payment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>


                        </tr>

                        <tr>
                            <th scope="row">납부방법</th>
                            <td class="text-left">
                                <select name="payment_method" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($feeConfig['payment_method'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->payment_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">회비 셋팅 연도</th>
                            <td class="text-left">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <select name="sYear" class="form-item n2">
                                        <option value="">전체</option>

                                        @foreach($feeConfig['year'] as $key => $val)
                                            <option value="{{ $key }}" {{ (request()->sYear ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <span>~</span>
                                    <select name="eYear" class="form-item n2">
                                        <option value="">전체</option>

                                        @foreach($feeConfig['year'] as $key => $val)
                                            <option value="{{ $key }}" {{ (request()->eYear ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="li_page" value="{{ $li_page }}" readonly>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('fee', $feeCase) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('fee.excel', request()->except(['page']) + $feeCase) }}" class="btn btn-type1 color-type19">데이터 엑셀 백업</a>
                </div>
            </fieldset>
        </form>

        <!-- 관리자 추가 작업 -->
        <div class="toggle-wrap">
            <div class="toggle-tit text-center">
                <button type="button" class="btn btn-small color-type5  js-btn-toggle">펼치기</button>
            </div>
            <div class="toggle-con js-toggle-con" style="display: none;">
                <table class="cst-table">
                    <cpation class="hide">안내</cpation>
                    <colgroup>
                        <col style="width: 50%;">
                        <col style="width: 50%;">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <div class="info-tit">
                                <img src="/assets/image/admin/ic_info.png" alt="" class="ic-info">
                                회비 등록 전, 회원 등급 및 상태가 정확히 설정되어 있는지 반드시 확인해 주세요.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left vat">
                            <strong class="tit">[회비 등록] 버튼</strong>
                            <ul class="list-type list-type-dot">
                                <li>
                                    개별 회원의 회비를 단건으로 수동 등록할 수 있는 기능입니다.
                                </li>
                                <li>
                                    회원별로 연회비 또는 입회비를 직접 지정하여 등록할 경우 사용해 주세요.
                                </li>
                            </ul>
                        </td>
                        <td class="text-left vat">
                            <strong class="tit">[회비 자동 셋팅] 버튼</strong>
                            <ul class="list-type list-type-dot">
                                <li>
                                    클릭 시 차기연도 회비가 일괄 자동 등록됩니다.
                                </li>
                                <li>
                                    회비 자동 셋팅 기능은 매년 12월 1일부터 차기연도 1월 31일까지 사용 가능합니다.
                                </li>
                                <li>
                                    해당 기간 외(즉, 12월 1일 이전 또는 1월 31일 이후)에는 기능이 비활성화되며, 사용이 제한됩니다.
                                </li>
                                <li>
                                    자동 셋팅 기능은 한 번만 적용되며, 중복 클릭 시 추가 등록되지 않습니다.
                                </li>
                                <li>
                                    정해진 기간 내에만 자동 셋팅이 가능하므로, 설정 시점을 반드시 확인해 주세요. 해당 기간 외에는 회비 등록 버튼을 클릭 하시어 개별 등록 해주세요.
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- //관리자 추가 작업 -->

        <div class="list-contop text-left cf">
            <a href="{{ route('fee.upsert') }}" class="btn btn-small btn-type1 color-type20 call-popup" data-width="850" data-name="fee-upsert">
                회비 등록
            </a>

            <a href="javascript:void(0);" class="btn btn-small btn-type1 color-type20" id="renew-btn">
                {{ date('Y')+1 }}년도 회비 자동 셋팅
            </a>
        </div>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                [총 <strong>{{ number_format($list->total()) }}</strong>개]
            </span>

            @include('admin.layouts.include.li_page')
        </div>

        <div class="table-wrap" style="margin-top: 10px;">
            <table class="cst-table list-table">
                <caption class="hide">목록</caption>

                <colgroup>
                    <col style="width: 3%;">
                    <col style="width: 4%;">
                    <col style="width: 4%;">
                    <col style="width: 5%;">
                    <col style="width: 4%;">

                    <col style="width: 7%;">
                    <col style="width: 4%;">
                    <col style="width: 7%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">

                    <col style="width: 6%;">
                    <col style="width: 6%;">
                    <col style="width: 5%;">
                    <col style="width: 6%;">
                    <col style="width: 4%;">

                </colgroup>

                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">
                        <a href="{{ route('fee', array_merge(request()->all(), ['sort_by' => 'year', 'order' => request()->order == 'asc' ? 'desc' : 'asc'])) }}">
                            회비 셋팅<br>연도▲▼
                        </a>
                    </th>
                    <th scope="col">회비 구분</th>
                    <th scope="col">회비 금액</th>
                    <th scope="col">이름</th>

                    <th scope="col">아이디</th>
                    <th scope="col">면허번호</th>
                    <th scope="col">근무처</th>
                    <th scope="col">납부방법</th>
                    <th scope="col">납부상태</th>

                    <th scope="col">납부일자</th>
                    <th scope="col">메일발송</th>
                    <th scope="col">영수증</th>
                    <th scope="col">회비내역</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>

                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>{{ $row->year ?? '' }}</td>
                        <td>{{ $feeConfig['category'][$row->category ?? ''] ?? '' }}</td>
                        <td>{{ number_format($row->price ?? 0) ?? 0 }}</td>
                        <td>{{ $row->user->name_kr ?? '' }}</td>

                        <td>{{ $row->user->id ?? '' }}</td>
                        <td>{{ $row->user->license_number ?? '' }}</td>
                        <td>{{ $row->user->company_kr ?? '' }}</td>
                        <td>
                            <select class="form-item payment-method">
                                @foreach($feeConfig['payment_method'] as $key => $val)
                                    <option value="{{ $key }}" {{ $row->payment_method == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-item payment-status">
                                @foreach($feeConfig['payment_status'] as $key => $val)
                                    <option value="{{ $key }}" {{ $row->payment_status == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            @if(!empty($row->payment_date) && isValidTimestamp($row->payment_date))
                                {{ $row->payment_date ?? '' }}
                            @endif
                        </td>

                        @php
                            $type = 'ok';
                            if( ($row->payment_method ?? '') == 'B' && ($row->payment_status ?? '') == 'N' ){
                                $type = 'request';
                            }
                        @endphp

                        <td>
                            <a href="{{ route('fee.remail',['sid'=>$row->sid ?? '', 'type'=>$type]) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="800" data-height="900">재발송</a>
                        </td>

                        <td>
                            @if(($row->payment_status ?? '') == 'Y' && !empty($row->user->sid) && !empty($row->tid) )
                                <a href="{{ route('fee.receipt',['user_sid'=>$row->user->sid, 'tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type8 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="650">영수증</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('fee.popup.all-list', ['user_sid' => $row->user_sid]) }}" class="btn btn-small color-type5 call-popup" data-width="1400" data-height="800" data-name="fee-all-list">
                                전체내역
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('fee.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-popup_name="fee-upsert" data-width="950" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15">회비내역이 없습니다.</td>
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
        const dataUrl = '{{ route('fee.data') }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '#renew-btn', function () {
            if (confirm('회비를 갱신 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'fee-renew',
                });
            }
        });

        // $(document).on('change', '.payment-status', function () {
        //     const _this = this;
        //     const sid = getPK(_this);
        //
        //     callAjax(dataUrl, {
        //         'case': 'db-change',
        //         'sid': sid,
        //         'field': 'payment_status',
        //         'value': $(_this).val(),
        //     });
        // });

        //납부방법
        $(document).on('change', '.payment-method', function () {
            callAjax(dataUrl, {
                'case': 'change-payment_method',
                'sid': getPK(this),
                'value': $(this).val(),
            });
        });

        //납부상태 변경
        $(document).on('change', '.payment-status', function () {
            callAjax(dataUrl, {
                'case': 'change-payment_status',
                'sid': getPK(this),
                'value': $(this).val(),
            });
        });

        $(document).on('click', '.btn-del', function () {
            const _this = this;
            const sid = getPK(_this);

            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'fee-delete',
                    'sid': sid,
                });
            }
        });
    </script>
@endsection
