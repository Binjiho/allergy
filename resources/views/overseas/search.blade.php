@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('overseas.include.sub-tab-wrap')

            <p class="overseas-list-title"><strong>{{ thisUser()->name_kr ?? '' }}</strong> 국외 학회 참가 지원 신청 내역 입니다.</p>
            <p class="text-skyblue mb-10 m-hide">
                <span class="highlights">
                    * 지원신청 취소를 원하시는 경우 학회( <a href="mailto:allergy@allergy.or.kr">allergy@allergy.or.kr</a>,
                    <a href="mailto:kaaaci@naver.com">kaaaci@naver.com</a> )로 연락 주시기 바랍니다.
                </span>
            </p>
            <p class="text-red mb-10 m-show">
                <span class="highlights">* 해외학회 지원 신청 수정 및 결과보고서 작성은 PC에서만 가능합니다.</span>
            </p>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table text-center">
                    <caption class="hide">해외학회 참가 지원 신청</caption>
                    <colgroup>
                        <col>
                        <col style="width: 15%;">
                        <col style="width: 12%;">
                        <col style="width: 11%;">
                        <col style="width: 8%;">
                        <col style="width: 8%;">
                        <col style="width: 11%;">
                        <col style="width: 8%;">
                        <col style="width: 11%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>지원학회 명</th>
                        <th>개최일자</th>
                        <th>개최장소</th>
                        <th>신청완료일</th>
                        <th>신청상태</th>
                        <th>심사결과</th>
                        <th>결과보고서</th>
                        <th>지급여부</th>
                        <th>관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ing_list as $row)
                        <tr>
                            <td>{{ $row->overseasSetting->title ?? '' }}</td>
                            <td>{{ $row->overseasSetting->sdate ?? '' }} ~ <br>{{ $row->overseasSetting->edate ?? '' }}</td>
                            <td>{{ $row->overseasSetting->place ?? '' }}</td>
                            <td>{{ !empty($row->completed_at) ? substr($row->completed_at,0,10) : '' }}</td>
                            <td>{{ $overseasConfig['complete'][$row->complete] ?? '' }}</td>
                            <td>
                                @if($row->judge == 'Y')
                                    <span class="text-red">선정<br>{{ $overseasConfig['assistant_name'][$row->assistant] ?? '' }}</span>
                                @else
                                    <span class="text-blue">미선정</span>
                                @endif
                            </td>

                            @php
                                /**
                                 * 결과보고서
                                    제출하기 : 결과보고서 미제출 / 제출 기간인 경우
                                    수정하기 : 결과보고서 임시저장 or 제출 / 제출 기간인 경우
                                    제출자료보기 : 제출 완료 / 제출기간이 지난 경우
                                 */
                            @endphp
                            <td>
                                @if($row->judge == 'Y' && !empty($row->assistant))
                                    @php
                                        $now = date('Y-m-d H:i:s');
                                        $sDate = $row->overseasSetting->report_sdate;
                                        $eDate = $row->overseasSetting->report_edate;
                                        $isReported = ($row->report ?? '') == 'Y'; // 제출(또는 임시저장) 여부
                                        $isPeriod = ($now >= $sDate && $now <= $eDate) || masterIp(); // 제출 가능 기간
                                        $isPast = $now > $eDate; // 기간 종료
                                    @endphp

                                    @if($isPast)
                                        {{-- 3. 제출기간이 지난 경우 --}}
                                        @if($isReported)
                                            <p class="color-type1">제출완료</p>
                                            <a href="{{ route('overseas.report_preview',['sid'=>$row->sid, 'o_sid'=>$row->o_sid]) }}" class="btn btn-small color-type4 m-hide">제출자료 보기</a>
                                        @else
                                            <span class="text-muted">미제출</span>
                                        @endif

                                    @elseif($isPeriod)
                                        {{-- 1 & 2. 제출 기간 내인 경우 --}}
                                        @if($isReported)
                                            {{-- 이미 데이터가 있다면 '수정하기' --}}
                                            <a href="{{ route('overseas.report',['sid'=>$row->sid, 'o_sid'=>$row->o_sid]) }}" class="btn btn-small color-type2 m-hide">수정하기</a>
                                        @else
                                            {{-- 데이터가 없다면 '제출하기' --}}
                                            <a href="{{ route('overseas.report',['sid'=>$row->sid, 'o_sid'=>$row->o_sid]) }}" class="btn btn-small color-type1 m-hide">제출하기</a>
                                        @endif

                                    @else
                                        {{-- 제출 기간 전 --}}
                                        @if($isReported)
                                            {{-- 기간 전이라도 관리자가 등록했을 경우 대비 --}}
                                            <p>제출완료</p>
                                            <a href="{{ route('overseas.report_preview',['sid'=>$row->sid, 'o_sid'=>$row->o_sid]) }}" class="btn btn-small color-type4 m-hide">제출자료 보기</a>
                                        @else
                                            <span class="text-muted">제출 준비중</span>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(!empty($row->pay_result) )
                                    {{ $overseasConfig['pay_result'][$row->pay_result] ?? '' }}
                                @endif
                            </td>

                            @php
                                /**
                                 * 신청내역
                                    수정 : 참가 지원 임시저장 or 제출 / 제출 기간인 경우
                                    신청내역보기 : 제출 완료 / 제출기간이 지난 경우
                                 */
                                $now = date('Y-m-d H:i:s');
                                $regSdate = $row->overseasSetting->regist_sdate;
                                $regEdate = $row->overseasSetting->regist_edate;

                                $isPeriod = ($now >= $regSdate && $now <= $regEdate) || masterIp(); // 신청/수정 가능 기간
                                $isPast = $now > $regEdate; // 기간 종료 여부
                                $isComplete = ($row->complete ?? 'N') == 'Y'; // 최종 제출 완료 여부
                            @endphp

                            <td>
                                @if($isPeriod)
                                    {{-- 1. 신청 기간 내인 경우: 임시저장이든 제출이든 '수정' 가능 --}}
                                    <a href="{{ route('overseas.modify',['sid'=>$row->sid, 'o_sid'=>$row->o_sid, 'step'=>'1']) }}"
                                       class="btn btn-small color-type5 m-hide">수정</a>

                                @elseif($isPast)
                                    {{-- 2. 신청 기간이 지난 경우 --}}
                                    @if($isComplete)
                                        {{-- 제출 완료자만 내역 보기 가능 --}}
                                        <a href="{{ route('overseas.preview',['sid'=>$row->sid, 'o_sid'=>$row->o_sid]) }}"
                                           class="btn btn-small color-type8 m-hide">신청내역보기</a>
                                    @else
                                        {{-- 미완료 상태로 기간 종료 --}}
                                        <span class="text-muted">마감</span>
                                    @endif

                                @else
                                    {{-- 신청 기간 시작 전 (필요 시 추가) --}}
                                    <span class="text-muted"></span>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    </tbody>
                </table>
            </div>


            <p class="overseas-list-title past"><strong>{{ thisUser()->name_kr ?? '' }}</strong> 과거 수혜 내역 입니다.</p>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table text-center">
                    <caption class="hide">과거 수혜 내역</caption>
                    <colgroup>
                        <col>
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>학회명</th>
                        <th>개최일자</th>
                        <th>개최장소</th>
                        <th>지원협회</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $row)
                        <tr>
                            <td>{{ $row->title ?? '' }}</td>
                            <td>{{ $row->event_date ?? '' }}</td>
                            <td>{{ $row->place ?? '' }}</td>
                            <td>KRPIA</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">수혜 내역이 없습니다</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            {{ $list->links('pagination::custom') }}

        </div>
    </article>

@endsection

@section('addScript')
@endsection
