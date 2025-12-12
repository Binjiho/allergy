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

                <div class="date-box">
                    <img src="/assets/image/sub/img_date.png" alt="">
                    <div class="text-wrap">
                        사전등록 마감일 : <span>~ {{ \Carbon\Carbon::parse($workshop->regist_edate)->format('Y') }}년 <strong>{{  \Carbon\Carbon::parse($workshop->regist_edate)->format('m') }}</strong>월 <strong>{{  \Carbon\Carbon::parse($workshop->regist_edate)->format('d') }}일</strong> {{ formatKoreanDate($workshop->regist_edate) }} 까지</span>
                    </div>
                </div>
                <ul class="regi-cate-list">
                    <li>
                        <strong class="tit">회원전용 사전등록</strong>
                        <p>
                            회원으로 등록하시면 학회의 다양한 혜택이 있습니다. <br>
                            로그인 후 등록해주세요.
                        </p>
                        <div class="btn-wrap text-center">
                            @if(!empty(thisPK()) && thisPK()>0)
                                <a href="{{ route('registration.upsert',['wsid'=>$workshop->sid, 'member_gubun'=>'Y']) }}" class="btn"> 사전등록 바로가기</a>
                            @else
                                <a href="javascript:loginChk();" class="btn"> 사전등록 바로가기</a>
                            @endif
                        </div>
                    </li>
                    <li>
                        <strong class="tit">비회원전용 사전등록</strong>
                        <p>
                            학회회원으로 등록하지 않고 <br class="n-br">
                            1회성 참가를 원하신다면 클릭해주세요.
                        </p>
                        <div class="btn-wrap text-center">
                            @if(!empty(thisPK()) && thisPK()>0)
                                <a href="javascript:alert('회원전용 사전등록 진행해주세요.');" class="btn"> 사전등록 바로가기</a>
                            @else
                                <a href="{{ route('registration.upsert',['wsid'=>$workshop->sid, 'member_gubun'=>'N']) }}" class="btn"> 사전등록 바로가기</a>
                            @endif
                        </div>
                    </li>
                </ul>

                <div class="regi-info">
                    @if(!empty($workshop->fee_info))
                    <dl>
                        <dt>등록비</dt>
                        <dd>
                            <div class="ev-view-con editor-contents">
                                {!! $workshop->fee_info ?? '' !!}
                            </div>
                        </dd>
                    </dl>
                    @endif
                    @if(!empty($workshop->notice_info))
                    <dl>
                        <dt>주의사항</dt>
                        <dd>
                            <div class="ev-view-con editor-contents">
                                {!! $workshop->notice_info ?? '' !!}
                            </div>

                        </dd>
                    </dl>
                    @endif
                    @if(!empty($workshop->pay_info))
                    <dl>
                        <dt>결제안내</dt>
                        <dd>
                            <div class="ev-view-con editor-contents">
                                {!! $workshop->pay_info ?? '' !!}
                            </div>

                        </dd>
                    </dl>
                    @endif
                    @if(!empty($workshop->inquire_info))
                    <dl>
                        <dt>문의처</dt>
                        <dd>
                            <div class="ev-view-con editor-contents">
                                {!! $workshop->inquire_info ?? '' !!}
                            </div>

                        </dd>
                    </dl>
                    @endif
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        function loginChk()
        {
            alert('회원만 등록 가능합니다.\n회원이 아닌 경우 비회원 사전등록 해주시고\n회원인 경우 로그인 이후 등록해주세요.');
            const _ret_url = 'workshop/{{ $workshop->sid }}/registration/upsert';
            window.location.href='{{ route('login') }}'+'?ret_url='+_ret_url;
        }
    </script>
@endsection
