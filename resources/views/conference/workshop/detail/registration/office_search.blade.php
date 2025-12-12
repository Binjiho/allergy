@extends('layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')

    <div class="popup-wrap">
        <div class="popup-contents">
            <div class="popup-tit-wrap text-center">
                <h3 class="popup-tit">검색어를 입력 후 검색 버튼을 클릭해주세요.</h3>
            </div>
            <div class="popup-conbox">
                <div class="write-form-wrap">
                    <div class="sch-wrap">

                        <form id="searchF" name="searchF" class="sch-form-wrap">
                            <fieldset>
                                <legend class="hide">검색</legend>
                                <div class="form-group">
                                    <input type="text" name="keyword" id="keyword" class="form-item sch-key" placeholder="검색하실 내용을 입력해주세요." value="{{ request()->keyword ?? '' }}">
                                    <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">소속 목록</caption>
                            <colgroup>
                                <col style="width: 35%;">
                                <col>
                                <col style="width: 12%;">
                            </colgroup>

                            <thead>
                            <tr>
                                <th scope="col">병원명</th>
                                <th scope="col">주소</th>
                                <th scope="col">선택</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list ?? [] as $row)
                                <tr data-sid="{{ $row->sid }}" data-name_kr = "{{ $row->office_kr ?? '' }}" data-zipcode="{{ $row->office_zipcode ?? '' }}" data-addr="{{ $row->office_addr ?? '' }}">
                                    <td>{{ $row->office_kr ?? '' }}</td>
                                    <td>{{ $row->office_addr ?? '' }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-small color-type2 user-select">
                                            선택
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        검색된 데이터가 없습니다.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:self.close();" class="btn btn-type1 color-type4">닫기</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @isset($list)
        {{ $list->links('pagination::custom') }}
    @endisset
@endsection

@section('addScript')
    <script>
        $(document).on('click', '.user-select', function () {
            const _user_sid = $(this).closest('tr').data('sid');
            const _user_name_kr = $(this).closest('tr').data('name_kr');
            const _zipcode = $(this).closest('tr').data('zipcode');
            const _addr = $(this).closest('tr').data('addr');

            // 부모창에 회원 정보 전달
            if (window.opener && !window.opener.closed) {

                window.opener.$('#office_sid').val(_user_sid);
                window.opener.$('#office_name').val(_user_name_kr);
                window.opener.$('#zipcode').val(_zipcode);
                window.opener.$('#addr').val(_addr);

                window.close();
            } else {
                window.close();
            }
        });
    </script>
@endsection
