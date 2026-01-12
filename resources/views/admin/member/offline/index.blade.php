@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="sub-contents">

        @include('admin.layouts.include.sub-tit')

        <form id="searchF" name="searchF" action="{{ route('memberoff') }}" class="sch-form-wrap">
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
                            <th scope="row">이름</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">면허번호</th>
                            <td class="text-left">
                                <input type="text" name="license_number" value="{{ request()->license_number ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">소속</th>
                            <td class="text-left" colspan="">
                                <input type="text" name="company" value="{{ request()->company ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">이메일</th>
                            <td class="text-left">
                                <input type="text" name="email" value="{{ request()->email ?? '' }}" class="form-item">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="li_page" value="{{ $li_page }}" readonly>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('memberoff') }}" class="btn btn-type1 color-type18">검색 초기화</a>
{{--                    <a href="{{ route('member.excel', request()->except(['page']) + $memberCase) }}" class="btn btn-type1 color-type19">데이터 엑셀 백업</a>--}}
                </div>
            </fieldset>
        </form>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                [총 <strong>{{ number_format($list->total()) }}</strong>명]
            </span>

            @include('admin.layouts.include.li_page')
        </div>

        <div class="table-wrap" style="margin-top: 10px;">
            <table class="cst-table list-table">
                <caption class="hide">목록</caption>

                <colgroup>
                    <col style="width: 3%;">
{{--                    <col style="width: 7%;">--}}
                    <col style="width: 8%;">
                    <col style="width: 6%;">
{{--                    <col style="width: 6%;">--}}

                    <col style="width: 8%;">
                    <col style="width: 6%;">
                    <col style="width: 8%;">
                    <col style="width: 7%;">
                    <col style="width: 6%;">

{{--                    <col style="width: 6%;">--}}
                    <col style="width: 6%;">
                    <col style="width: 5%;">
{{--                    <col style="width: 5%;">--}}
{{--                    <col style="width: 5%;">--}}

{{--                    <col style="width: 5%;">--}}
{{--                    <col style="width: 5%;">--}}
                    <col style="width: 5%;">
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">번호</th>
{{--                    <th scope="col">회원상태</th>--}}
                    <th scope="col">회원등급</th>
                    <th scope="col">이름</th>
{{--                    <th scope="col">아이디</th>--}}

                    <th scope="col">이메일</th>
                    <th scope="col">면허번호</th>
                    <th scope="col">근무처</th>
                    <th scope="col">근무처번호</th>
                    <th scope="col">휴대폰번호</th>

{{--                    <th scope="col">회비내역</th>--}}
                    <th scope="col">가입일</th>
                    <th scope="col">최종수정일</th>
{{--                    <th scope="col">최종로그인</th>--}}
{{--                    <th scope="col">비밀번호<br>초기화</th>--}}

{{--                    <th scope="col">로그인</th>--}}
{{--                    <th scope="col">관라자<br>지정</th>--}}
                    <th scope="col">관리</th>
                </tr>
                </thead>

                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>
                            {{ $userConfig['level'][$row->level] ?? ''}}
                        </td>
                        <td>
                            <a href="{{ route('memberoff.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="950" data-height="900" style="color: #5a5ad7;">
                                {{ $row->name_kr }}
                            </a>
                        </td>

                        <td>{{ $row->email ?? '' }}</td>
                        <td>{{ $row->license_number ?? '' }}</td>
                        <td>{{ !empty($row->company_kr) ? $row->company_kr : ($row->company_en ?? '') }}</td>
                        <td>{{ $row->companyTel ?? '' }}</td>
                        <td>{{ $row->phone ?? '' }}</td>
                        
                        <td>{{ $row->created_at ?? '' }}</td>
                        <td>{{ $row->updated_at ?? '' }}</td>

                        <td>
                            <a href="{{ route('memberoff.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="950" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="18">회원정보가 없습니다.</td>
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
        const dataUrl = '{{ route('member.data') }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-del', function () {
            if (confirm('오프라인 회원정보를 완전히 삭제 하시겠습니까?\n데이터를 복구할수 없습니다.')) {
                callAjax(dataUrl, {
                    'case': 'useroff-delete',
                    'sid': getPK(this),
                });
            }
        });


        //회원등급 변경
        $(document).on('change', '.select-level', function () {
            callAjax(dataUrl, {
                'case': 'change-level',
                'sid': getPK(this),
                'value': $(this).val(),
            });
        });

    </script>

    @yield('memberScript')
@endsection
