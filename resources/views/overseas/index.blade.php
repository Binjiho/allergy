@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('overseas.include.sub-tab-wrap')

            <div class="overseas-box">
                <p>
                    <span class="highlights">국외학술대회 참가 지원 관련하여 안내 드립니다. <br>
                        본 학회에서 지원 예정인 국외학술대회를 아래와 같이 안내 드리오니 해당 학술대회에 참석을 계획하시는 경우 지원 가능 일정을 참고하시고 신청 부탁드립니다.</span>
                </p>
                <div class="btn-wrap">
                    <a href="" class="btn btn-type1 color-type1">지원 규정 및 선정 규정 바로가기</a>
                </div>
            </div>

            <div class="img-border-box">
                <img src="/assets/image/sub/img_overseas.png" alt="">
                <ul class="list-type-check list-type blue">
                    <li>동일 학회에서 발표할 초록 또는 논문이 타 기관 또는 단체로부터 동일 항목으로 유사한 지원을 받았음이 확인된 경우와 제반 서류 중 허위사실이 있거나
                        이를 기재한 경우는 본 위원회에서 선정되더라도 추후에 취소됨을 미리 알려드립니다.
                    </li>
                    <li>국외학술대회 참가 경비 지원과 관련하여 궁금하신 사항은 학회 사무국으로 문의해 주시기 바랍니다.</li>
                </ul>
            </div>

            <p class="progress-title">신청 중인 행사 list</p>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table text-center">
                    <caption class="hide">신청 중인 행사 list</caption>
                    <colgroup>
                        <col style="width: 15%;">
                        <col style="width: 20%;">
                        <col style="width: 15%;">
                        <col style="width: 10%;">
                        <col style="width: 20%;">
                        <col style="width: 10%;">
                        <col class="m-hide">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>학회명</th>
                        <th>개최일자</th>
                        <th>개최장소</th>
                        <th>선정인원</th>
                        <th>신청일자</th>
                        <th>결과발표일</th>
                        <th class="m-hide">진행상황</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ing_list as $row)
                        <tr data-sid="{{ $row->sid }}">
                            <td>{{ $row->title ?? '' }}</td>
                            <td>{{ $row->sdate ?? '' }} {{ !empty($row->edate) ? ' ~ '.$row->edate : '' }}</td>
                            <td>{{ $row->place ?? '' }}</td>
                            <td>{{ $row->limit_person ?? '' }}명</td>
                            <td>{{ $row->regist_sdate ?? '' }} {{ !empty($row->regist_edate) ? ' ~ '.$row->regist_edate : '' }}</td>
                            @if(!empty($row->result_date))
                                <td>{{ $row->result_date ?? '' }}</td>
                            @else
                                <td>추후 안내</td>
                            @endif

                            @if(date('Y-m-d H:i:s') >= $row->regist_sdate)
                                <td class="m-hide">
                                    @if(thisLevel() == 'A' || isAdmin())
                                        <a href="{{ route('overseas.upsert',['o_sid'=>$overseasSetting->sid, 'step'=>1]) }}" class="btn btn-small color-type5">바로가기</a>
                                    @else
                                        <a href="javascript:;" class="btn btn-small color-type5">바로가기</a>
                                    @endif
                                </td>
                            @else
                                <td class="m-hide">오픈 예정</td>
                            @endif

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">신청 가능한 행사가 없습니다.</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>


            <p class="progress-title end">신청 마감된 행사 List</p>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table text-center">
                    <caption class="hide">신청 마감된 행사 list</caption>
                    <colgroup>
                        <col style="width: 15%;">
                        <col style="width: 20%;">
                        <col style="width: 15%;">
                        <col style="width: 10%;">
                        <col style="width: 20%;">
                        <col style="width: 10%;">
                        <col class="m-hide">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>학회명</th>
                        <th>개최일자</th>
                        <th>개최장소</th>
                        <th>선정인원</th>
                        <th>신청일자</th>
                        <th>결과발표일</th>
                        <th class="m-hide">진행상황</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->title ?? '' }}</td>
                        <td>{{ $row->sdate ?? '' }} {{ !empty($row->edate) ? ' ~ '.$row->edate : '' }}</td>
                        <td>{{ $row->place ?? '' }}</td>
                        <td>{{ $row->limit_person ?? '' }}명</td>
                        <td>{{ $row->regist_sdate ?? '' }} {{ !empty($row->regist_edate) ? ' ~ '.$row->regist_edate : '' }}</td>
                        <td>{{ $row->result_date ?? '' }}</td>
                        <td class="m-hide">신청마감</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7">신청 가능한 행사가 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
            </div>

        </div>
    </article>

@endsection

@section('addScript')
@endsection
