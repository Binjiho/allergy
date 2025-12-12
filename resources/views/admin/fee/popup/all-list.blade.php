@extends('admin.layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">회비 내역</h3>
    </div>

    <div class="write-wrap mb-30">
        <ul>
            <li class="write-wrap-tit">
                <div class="form-group form-group-text n3">
                    <div class="text-wrap">
                        이름: {{ $user->name_kr ?? '' }}
                    </div>

                    <span class="text">|</span>

                    <div class="text-wrap">
                        ID: {{ $user->id ?? '' }}
                    </div>

                    <span class="text">|</span>

                    <div class="text-wrap">
                        면허번호: {{ $user->license_number ?? '' }}
                    </div>

                    <span class="text">|</span>

                    <div class="text-wrap">
                        근무처: {{ $user->company_kr ?? '' }}
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="bg-box line">
        <div class="text-wrap text-left">
            <ul class="list-type list-type-dot">
                <li>
                    회원 등급 : {{ $userConfig['level'][$user->level ?? ''] ?? '' }}
                </li>
                <li>
                    당해연도 회비 납부 기간 : {{ date('Y') }}.01.01 ~ {{ date('Y') }}.12.31
                </li>
                @if($user->isLifeMember() === false)
                    <li>
                        차기연도 회비 납부일 : {{ date('Y',strtotime('+1 year')) }}.01.01 ~ {{ date('Y',strtotime('+1 year')) }}.12.31
                    </li>
                @endif
            </ul>
        </div>
    </div>


    <div class="list-contop text-right cf">
        <a href="{{ route('fee.upsert',['user_sid' => $user->sid]) }}" class="btn btn-small color-type6 call-popup" data-width="1000" data-height="900" data-name="fee-upsert">
            회비 추가 등록
        </a>
    </div>

    <div class="table-wrap scroll-x">
        <table class="cst-table list-table">
            <caption class="hide">회비 납부 목록</caption>
            <colgroup>
                <col style="width: 10%">
                <col style="width: 10%">
                <col style="width: 12%">
                <col style="width: 12%">
                <col style="width: 13%">

                <col style="width: 15%">
                <col style="width: 10%">
                <col style="width: 8%">
            </colgroup>

            <thead>
            <tr>
                <th scope="col">연도</th>
                <th scope="col">회비 구분</th>
                <th scope="col">회비 금액</th>
                <th scope="col">납부 일자</th>
                <th scope="col">납부 방법</th>

                <th scope="col">회비 납부 / 납부 상태</th>
                <th scope="col">영수증</th>
                <th scope="col">관리</th>
            </tr>
            </thead>

            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->year ?? 0 }}</td>
                    <td>{{ $feeConfig['category'][$row->category ?? ''] ?? '' }}</td>
                    <td>{{ number_format($row->price ?? 0) }}</td>
                    <td>
                        @if(!empty($row->payment_date) && isValidTimestamp($row->payment_date))
                            {{ $row->payment_date ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if(!empty($row->payment_method))
                            {{ $feeConfig['payment_method'][$row->payment_method ?? ''] ?? '' }}
                        @endif
                    </td>

                    <td>
                        <select name="payment_status" class="form-item">
                            @foreach($feeConfig['payment_status'] as $key => $val)
                                <option value="{{ $key }}" {{ ($row->payment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        @if(($row->payment_status ?? '') == 'Y')
                            <a href="{{ route('fee.receipt',['user_sid'=>$user->sid, 'tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="550">영수증</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('fee.upsert', ['sid' => $row->sid,'user_sid'=>$user->sid]) }}" class="btn-admin call-popup" data-popup_name="fee-upsert" data-width="1000" data-height="900">
                            <img src="/assets/image/admin/ic_modify.png" alt="수정">
                        </a>

                        <a href="javascript:void(0);" class="btn-admin btn-del">
                            <img src="/assets/image/admin/ic_del.png" alt="삭제">
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">회비 내역이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $list->links('pagination::custom') }}
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('fee.data') }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        //회원등급 변경
        $(document).on('change', '[name="payment_status"]', function () {
            callAjax(dataUrl, {
                'case': 'change-payment_status',
                'sid': getPK(this),
                'value': $(this).val(),
            });
        });

        $(document).on('click', '.btn-del', function () {
            const sid = $(this).closest('tr').data('sid');

            if (confirm('회비 납부 내역을 삭제하시겠습니까?\n삭제 후 원복 불가능하며 다시 세팅 해주셔야 합니다.')) {
                callAjax('{{ route('fee.data') }}', {
                    'case': 'fee-delete',
                    'sid': sid,
                })
            }
        });
    </script>
@endsection
