@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="/assets/css/editor.css">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="ev-conbox">

                @include('conference.workshop.detail.workshop_info')

                <div class="bg-img-box bg-box">
                    <div class="img-wrap">
                        <img src="/assets/image/sub/ic_confirm.png" alt="">
                    </div>
                    <div class="text-wrap">
                        <ul class="list-type list-type-star">
                            <li>
                                사전등록 수정은 사전등록 기간 내 결제상태 미입금인 상태만 가능하며, 아래 수정 버튼을 클릭하면 수정모드로 이동합니다.
                            </li>
                            <li>
                                영수증 인쇄는 결제상태 > 입금 완료 상태인 경우에만 영수증 인쇄 버튼 노출됩니다.
                            </li>
                        </ul>
                    </div>
                </div>

                @if( ($reg->pay_status ?? '') == 'Y' )
                <div class="btn-wrap text-right mb-20">
                    <a href="{{ route('registration.receipt', ['wsid'=>$wsid, 'sid'=>$reg->sid]) }}" class="btn btn-type1 color-type1 call-popup" data-width="850" data-name="registration-receipt">영수증 출력</a>
                </div>
                @endif

                <ul class="write-wrap">
                    <li>
                        <div class="form-tit">접수번호</div>
                        <div class="form-con">
                            {{ $reg->reg_num ?? '' }}
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">회원등급 및 ID</div>
                        <div class="form-con">
                            @if( ($reg->member_gubun ?? '') == 'Y' )
                                {{ $userConfig['level'][$reg->user->level ?? 'A'] ?? '' }} / {{ $reg->user->id ?? '' }}
                            @else
                                비회원
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">등록구분</div>
                        <div class="form-con">
                            {{ $defaultConfig['gubun'][$reg['gubun']] }} -
                            {{ number_format($reg['amount']) ?? 0 }}원
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">성명</div>
                        <div class="form-con">
                            {{ $reg->name_kr ?? '' }}
                        </div>
                    </li>
                    @if( ($reg->gubun ?? '') != '5' )
                    <li>
                        <div class="form-tit">의사면허번호</div>
                        <div class="form-con">
                            <div class="form-group has-btn">
                                {{ $reg->license_number ?? '' }}
                            </div>
                        </div>
                    </li>
                    @endif
                    @if(!empty($reg->region))
                    <li>
                        <div class="form-tit">소속의사회</div>
                        <div class="form-con">
                            {{ $defaultConfig['region'][$reg->region] ?? '' }} {{ $reg->sigu ?? '' }}
                        </div>
                    </li>
                    @endif

                    @if( ($reg->office_use ?? '') == 'N' )
                    <li>
                        <div class="form-tit">근무처(소속)</div>
                        <div class="form-con">
                            {{ $reg->office_name ?? '' }}
                        </div>
                    </li>
                    @else
                    <li>
                        <div class="form-tit">근무처(소속) 주소</div>
                        <div class="form-con">
                            ({{ $reg->zipcode ?? '' }}) {{ $reg->addr ?? '' }} {{ $reg->addr_etc ?? '' }}
                        </div>
                    </li>
                    @endif
                    <li>
                        <div class="form-tit">소속과</div>
                        <div class="form-con">
                            {{ $reg->department ?? '' }}
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">근무처(소속) 전화번호</div>
                        <div class="form-con">
                            {{ $reg->office_tel ?? '' }}
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">휴대전화번호</div>
                        <div class="form-con">
                            {{ $reg->phone ?? '' }}
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">E-Mail</div>
                        <div class="form-con">
                            {{ $reg->email ?? '' }}
                        </div>
                    </li>

                    <li>
                        <div class="form-tit">총 등록비</div>
                        <div class="form-con">
                            <strong class="text-red">{{ number_format($reg->amount ?? 0) }}원</strong>
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">결제 방법</div>
                        <div class="form-con">
                            {{ $defaultConfig['pay_method'][$reg->pay_method] }}
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">결제 상태</div>
                        <div class="form-con">
                            @if( ($reg->pay_status ?? '') == 'Y' )
                                <strong class="text-blue">입금완료</strong>
                            @else
                                <strong class="text-red">미입금</strong>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">최초등록일</div>
                        <div class="form-con">
                            {{ $reg->created_at ?? '' }}
                        </div>
                    </li>
                    <li>
                        <div class="form-tit">최종등록일</div>
                        <div class="form-con">
                            {{ $reg->updated_at ?? '' }}
                        </div>
                    </li>
                </ul>

                {{--
                수정 버튼 노출 조건
                사전등록 기간 내에만 노출 되며, 결제 상태 > 미입금일 경우에만 노출
                --}}
                @if( ($reg->pay_status ?? '') == 'N' && $isRegistDue )
                <div class="btn-wrap text-center">
                    <a href="{{ route('registration.upsert',['wsid'=>$workshop->sid, 'sid'=>$reg->sid, 'member_gubun'=>$reg->member_gubun, 'mode'=>'modify']) }}" type="submit" class="btn btn-type1 color-type5">수정</a>
                </div>
                @endif
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
