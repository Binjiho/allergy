@extends('admin.layouts.admin-layout')

@section('addStyle')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('contents')
    <div class="sub-contents">
        <form id="searchF" name="searchF" action="{{ route('mail') }}" class="sch-form-wrap">
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
                            <th scope="row">메일 제목</th>
                            <td class="text-left">
                                <input type="text" name="subject" value="{{ request()->subject ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">발송자명</th>
                            <td class="text-left">
                                <input type="text" name="sender_name" value="{{ request()->sender_name ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">작성일</th>
                            <td class="text-left">
                                <input type="text" name="create_sdate" value="{{ request()->create_sdate ?? '' }}" class="form-item" readonly datepicker style="width: 47%">

                                <span>~</span>

                                <input type="text" name="create_edate" value="{{ request()->create_edate ?? '' }}" class="form-item" readonly datepicker style="width: 47%">
                            </td>

                            <th scope="row"></th>
                            <td class="text-left"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('mail') }}" class="btn btn-type1 color-type18">검색 초기화</a>
                </div>
            </fieldset>
        </form>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                [총 <strong>{{ number_format($list->total()) }}</strong> 건]
            </span>

            @include('admin.layouts.include.li_page')
        </div>

        <div class="table-wrap" style="margin-top: 10px;">
            <table class="cst-table list-table">
                <caption class="hide">목록</caption>

                <colgroup>
                    <col style="width: 4%;">
                    <col>
                    <col style="width: 9%;">
                    <col style="width: 5%;">
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">제목</th>
                    <th scope="col">발송자명</th>
                    <th scope="col">작성일</th>
                </tr>
                </thead>

                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>
                            <a href="{{ route('mail.preview', ['sid' => $row->sid]) }}" class="call-popup" data-popup_name="mail-preview" data-width="750" data-height="800">
                                <b>{{ $row->subject }}</b>
                            </a>
                        </td>
                        <td>{{ $row->sender_name }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">등록된 메일이 없습니다.</td>
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
        const dataUrl = '{{ route('mail.data') }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.send-renew', function() {
            if (confirm('발송상태 갱신시 시간이 소요될수 있습니다. 잠시만 기다려 주세요.')) {
                callAjax(dataUrl, {
                    'case': 'send-renew',
                    'sid': getPK(this),
                });
            }
        });

        $(document).on('click', '.mail-send', function() {
            const ajaxData = {
                'sid': getPK(this),
                'case': 'mail-send',
            };

            if (confirm(`메일을 ${$(this).html()} 하시겠습니까?`)) {
                callAjax(dataUrl, ajaxData);
            }
        });

        $(document).on('click', '.btn-del', function() {
            const ajaxData = {
                'sid': getPK(this),
                'case': 'mail-delete',
            };

            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, ajaxData);
            }
        });
    </script>
@endsection
