<div class="table-wrap" style="margin-top: 10px;">
    <table class="cst-table list-table">
        <caption class="hide">목록</caption>

        <colgroup>
            <col style="width: 8%;">
            <col style="width: 6%;">
            <col style="width: 6%;">
            <col style="width: 6%;">
            <col style="width: 10%;">

            <col style="width: 10%;">
            <col style="width: 5%;">
            <col style="width: 7%;">
            <col style="width: 6%;">
            <col style="width: 6%;">

            <col style="width: 5%;">
            <col style="width: 5%;">
            <col style="width: 5%;">
            <col style="width: 5%;">
            <col style="width: 5%;">
        </colgroup>

        <thead>
        <tr>
            <th scope="col">접수번호</th>
            <th scope="col">회원구분</th>
            <th scope="col">등록구분</th>
            <th scope="col">이름</th>
            <th scope="col">근무처<br>(소속)</th>
            <th scope="col">면허번호</th>

            <th scope="col">이메일</th>
            <th scope="col">휴대폰번호</th>
            <th scope="col">등록비</th>
            <th scope="col">결제방법</th>
            <th scope="col">결제상태</th>

            <th scope="col">최초 등록일/<br>최종 등록일</th>
            <th scope="col">메일 재발송</th>
            <th scope="col">영수증 출력</th>
            <th scope="col">메모</th>
            <th scope="col">관리</th>
        </tr>
        </thead>

        <tbody>
        @forelse($list as $row)
            <tr data-sid="{{ $row->sid }}">
                <td>
                    <a href="{{ route('registration.upsert',['sid'=>$row->sid, 'wsid'=>$row->wsid]) }}" class="btn-admin call-popup" data-name="regist-pop" data-width="1550" data-height="900" style="color: #5a5ad7;">
                        {{ $row->reg_num ?? '' }}
                    </a>
                </td>
                <td>{{ $defaultConfig['member_gubun'][$row->member_gubun] ?? '' }}</td>
                <td>
                    <select class="form-item db-change" data-field="gubun">
                        <option value="">선택</option>
                        @foreach($defaultConfig['gubun'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->gubun ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ $row->name_kr ?? '' }}</td>
                <td>
                    @if( ($row['office_use'] ?? '') == 'Y')
                        ({{ $row->zipcode ?? '' }}) {{ $row->addr ?? '' }} {{ $row->addr_etc ?? '' }}
                    @else
                        {{ $row->office_name ?? '' }}
                    @endif
                </td>
                <td>{{ $row->license_number ?? '' }}</td>



                <td>{{ $row->email ?? '' }}</td>
                <td>{{ $row->phone ?? '' }}</td>
                <td>{{ number_format($row->amount ?? 0) ?? 0 }}</td>
                <td>
                    <select class="form-item db-change" data-field="pay_method">
                        <option value="">선택</option>
                        @foreach($defaultConfig['pay_method'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->pay_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-item db-change" data-field="pay_status">
                        <option value="">선택</option>
                        @foreach($defaultConfig['pay_status'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->pay_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>



                <td>{{ $row->created_at ?? '' }}<br>{{ $row->updated_at ?? '' }}</td>
                <td>
                    <a href="{{ route('registration.resend',['sid'=>$row->sid, 'wsid'=>$row->wsid]) }}" class="btn btn-small color-type5 call-popup" data-popup_name="resend-pop" data-width="800" data-height="900">재발송</a>
                </td>
                <td>
                    @if(($row->pay_status ?? '') == 'Y')
                        <a href="{{ route('registration.receipt',['sid'=>$row->sid, 'wsid'=>$row->wsid]) }}" class="btn btn-small color-type5 call-popup" data-popup_name="receipt-pop" data-width="800" data-height="900">영수증</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('registration.memo', ['sid' => $row->sid, 'wsid'=>$row->wsid]) }}" class="btn btn-small color-type18 call-popup" data-name="reg-memo" data-height="500">
                        메모
                    </a>
                </td>
                <td>
                    <a href="{{ route('registration.upsert', ['sid' => $row->sid, 'wsid'=>$row->wsid]) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="1550" data-height="900">
                        <img src="/assets/image/admin/ic_modify.png" alt="수정">
                    </a>

                    <a href="javascript:void(0);" class="btn-admin btn-del">
                        <img src="/assets/image/admin/ic_del.png" alt="삭제">
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="16">등록정보가 없습니다.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>