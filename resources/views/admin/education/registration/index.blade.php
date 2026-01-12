@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
    </style>
@endsection

@section('contents')
    <div class="sub-contents">

        <h2>{{ $workshop->title ?? '' }} - 사전등록 list</h2>

        <div class="sub-tab-wrap">
            <ul class="sub-tab-menu cf">
                <li class="{{ empty($registCase) ? 'on' : '' }}">
                    <a href="{{ route('registration',['wsid'=>$workshop->sid]) }}">전체 list</a>
                </li>

                <li class="{{ request()->case == 'elimination' ? 'on' : '' }}">
                    <a href="{{ route('registration', ['wsid'=>$workshop->sid, 'case' => 'elimination']) }}">삭제 list</a>
                </li>
            </ul>
        </div>


        <form id="searchF" name="searchF" action="{{ route('registration',['wsid'=>$workshop->sid]) }}" class="sch-form-wrap">
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
                            <th scope="row">접수번호</th>
                            <td class="text-left">
                                <input type="text" name="reg_num" value="{{ request()->reg_num ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">성명</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">의사면허번호</th>
                            <td class="text-left">
                                <input type="text" name="license_number" value="{{ request()->license_number ?? '' }}" class="form-item">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">근무처(소속)</th>
                            <td class="text-left">
                                <input type="text" name="sosok" value="{{ request()->sosok ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">등록구분</th>
                            <td class="text-left">
                                <select name="gubun" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($defaultConfig['gubun'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->gubun ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <th scope="row">이메일</th>
                            <td class="text-left">
                                <input type="text" name="email" value="{{ request()->email ?? '' }}" class="form-item">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">휴대폰번호</th>
                            <td class="text-left">
                                <input type="text" name="phone" value="{{ request()->phone ?? '' }}" class="form-item">
                            </td>
                            <th scope="row">회원구분</th>
                            <td class="text-left">
                                <select name="member_gubun" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($defaultConfig['member_gubun'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->member_gubun ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <th scope="row">결제방법</th>
                            <td class="text-left">
                                <select name="pay_method" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($defaultConfig['pay_method'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->pay_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">결제상태</th>
                            <td class="text-left">
                                <select name="pay_status" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($defaultConfig['pay_status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->pay_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row"></th>
                            <td></td>
                            <th scope="row"></th>
                            <td></td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="li_page" value="{{ $li_page }}" readonly>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('registration', ['wsid'=>request()->wsid, 'case'=>$registCase]) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('registration.excel', request()->except(['page']) + ['wsid'=>request()->wsid, 'case'=>$registCase]) }}" class="btn btn-type1 color-type19">데이터 엑셀 백업</a>
                    <a href="{{ route('workshop') }}" class="btn btn-type1 color-type15">목록 이동</a>
                </div>
            </fieldset>
        </form>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                [총 <strong>{{ number_format($list->total()) }}</strong>명]
            </span>

            @if( $_SERVER['REMOTE_ADDR']=="218.235.94.247")
                <a href="{{ route('registration.collective', ['wsid' => request()->wsid]) }}" class="btn btn-small btn-type1 color-type10 call-popup" data-popup_name="executive-upsert-collective" data-width="1350" data-height="700">엑셀 업로드</a>
            @endif

{{--            <a href="{{ route('registration.upsert',['wsid'=>request()->wsid ?? '']) }}" class="btn btn-small btn-type1 color-type8 call-popup" data-name="upsert-individual" data-width="1550" data-height="900">개별 등록</a>--}}

            @include('admin.layouts.include.li_page')
        </div>



        @switch(request()->case)
            @case('elimination' /* 삭제 회원 */)
                @include('admin.education.registration.include.elimination-list')
                @break

            @default
                @include('admin.education.registration.include.default-list')
                @break
        @endswitch

        {{ $list->links('pagination::custom') }}
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('registration.data',['wsid'=>request()->wsid]) }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.trigger', function(){
            const _isVisible = $(".toggleArea").is(":visible");
            if(_isVisible === true){
                $(".toggleArea").hide();
                $(this).text('열기');
            }else{
                $(".toggleArea").show();
                $(this).text('닫기');
            }
        });

        $(document).on('click', '.btn-del', function () {
            if (confirm('데이터 삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'registration-delete',
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

        //회원등급 변경
        // $(document).on('change', '.select-level', function () {
        //     callAjax(dataUrl, {
        //         'case': 'change-level',
        //         'sid': getPK(this),
        //         'value': $(this).val(),
        //     });
        // });
    </script>

    @yield('regScript')
@endsection
