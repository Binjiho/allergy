@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="bg-img-box bg-box">
                <div class="img-wrap">
                    <img src="/assets/image/sub/img_fee.png" alt="">
                </div>
                <div class="text-wrap">
                    <strong class="tit">회비 납부 안내</strong>
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
                    <div class="text-red mt-20">
                        * 평생회비 납부 시 당해연도 연회비부터는 납부하지 않으셔도 됩니다.
                    </div>
                </div>
            </div>

            <div class="line-box">
                <ul class="list-type list-type-dot">
                    <li>
                        납부하실 회비 항목 선택 후 회비 납부하기 버튼 클릭해주세요. (당해연도 회비만 납부 가능)
                    </li>
                    <li>
                        <img src="/assets/image/sub/img_shinhanbank.png" alt="신한은행"> 100-012-958376 / 대한천식알레르기학회
                    </li>
                    <li class="text-red">
                        영수증 출력은 PC에서만 제공됩니다.
                    </li>
                </ul>
                <div class="btn-wrap">
                    <a href="{{ route('fee.upsert') }}" class="btn btn-type1 color-type6 call-custom-popup">회비 납부하기</a>
                </div>
            </div>

            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table ">
                    <caption class="hide">목록</caption>
                    <colgroup>
                        <col style="width: 7%;">
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col style="width: 12%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="checkbox-wrap cst">
                                <label for="" class="checkbox-group empty"><input type="checkbox" name="" id="all_check"></label>
                            </div>
                        </th>
                        <th scope="col">연도</th>
                        <th scope="col">회비 구분</th>
                        <th scope="col">회비 금액</th>
                        <th scope="col">납부 일자</th>

                        <th scope="col">납부 방법</th>
                        <th scope="col">납부 상태</th>
                        <th scope="col">영수증</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $row)
                        <tr data-sid="{{ $row->sid }}">
                            @php
                                $disableCase = false;
                                // 차기연도 회비는 셋팅 되나 납부는 1월 1일 00시부터 가능
                                if( date('Y') < $row->year) $disableCase = true;
                                // 과거연도 회비 납부 불가
                                if( date('Y') > $row->year) $disableCase = true;
                                //과거 평생회비 납부 불가
//                                if( ($row->category ?? '') == 'C' &&  date('Y') > $row->year ) $disableCase = true;
                                //이미 납부한 회비
                                if( ($row->payment_status ?? '') == 'Y' ) $disableCase = true;

                                //해당없음은 납부 불가
                                if( ($row->payment_status ?? '') == 'E' ) $disableCase = true;
                            @endphp
                            <td>
                                <div class="checkbox-wrap cst">
                                    <label for="" class="checkbox-group empty"><input type="checkbox" name="fee_check" id="" value="{{ $row->sid }}" {{ $disableCase ? 'disabled' : '' }}></label>
                                </div>
                            </td>
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


                            @if($row->year == date('Y'))
                                <td>
                                    <span class="text-{{ ($row->payment_status ?? '') == 'Y' ? 'blue' : 'red' }}">{{ $feeConfig['payment_status'][$row->payment_status ?? ''] ?? '' }}</span>
                                </td>
                            @else
                                <td>
                                    <span class="text-red">해당없음</span>
                                </td>
                            @endif

                            <td>
                                @if(($row->payment_status ?? '') == 'Y')
                                    <a href="{{ route('fee.receipt',['tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type8 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="650">영수증</a>
                                @endif
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
            <!-- //e:회비납부-->
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        $(document).on('click', "#all_check", function(e){
            if( $(this).is(":checked") ){
                $("input[name='fee_check']:not(:disabled)").prop('checked', true);
            }else{
                $("input[name='fee_check']:not(:disabled)").prop('checked', false);
            }
        });

        $(document).on('click', ".call-custom-popup", function(e){
            e.preventDefault(); // 기본 이벤트 막기

            let _url = $(this).attr('href');

            let sidArr = [];

            // 체크된 체크박스 sid값 배열에 담기
            $('input[type=checkbox]:checked').each(function () {
                let sid = $(this).closest('tr').data('sid') ?? 0;
                if (sid > 0) {
                    sidArr.push(sid);
                }
            });

            if (sidArr.length < 1) {
                alert('납부하실 회비를 선택해주세요.');
                return false;
            }

            // 기존 URL에서 sid 파라미터 제거
            _url = $(this).attr('href').split('?')[0];
            // sid 배열을 쿼리스트링으로 추가
            _url += '?sid=' + sidArr.join(',');
            // href에 적용
            $(this).attr('href', _url);

            // console.log(sidArr);
            // console.log(_url);

            const popupHeight = isEmpty($(this).data('height')) ? 800 : $(this).data('height');
            const popupWidth = isEmpty($(this).data('width')) ? 950 : $(this).data('width');
            const popName = isEmpty($(this).data('popup_name')) ? 'fee-popup' : $(this).data('popup_name');
            const popupY = (window.screen.height / 2) - (popupHeight / 2);
            const popupX = (window.screen.width / 2) - (popupWidth / 2);

            window.open(_url, popName, 'status=no, height=' + popupHeight + ', width=' + popupWidth + ', left=' + popupX + ', top=' + popupY);
        });

    </script>
@endsection
