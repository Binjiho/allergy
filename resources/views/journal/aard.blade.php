@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="journal-info-box">
                <p>
                    알레르기 천식 호흡기질환(<strong>Allergy Asthma & Respiratory Disease, Allergy Asthma Respir Dis</strong>)은 대한 소아알레르기 호흡기학회와 대한천식알레르기학회의 공식 학술잡지(pISSN 2288-0402, eISSN 2288-0410)로서 기존의 ‘소아알레르기 호흡기학회지’와 ‘천식 및 알레르기’를 통합하여 2013년 3월 1일 창간되었고, 연 4회(1, 4, 7, 10월) 발간하며, 기타 필요 시 부록(Supplement)을 발간할 수 있다. <br><br>
                    Allergy Asthma Respir Dis는 알레르기, 천식, 임상 면역, 소아 호흡기질환 및 이와 관련된 임상과 실험 연구 분야를 다루며, 원고의 종류는 원저, 종설, 미니리뷰, Ask the expert, Clinical insight, 증례, 논평, Letter to the Editor 등으로 한다. <br><br>

                    또한 실제 진료와 관련된 주제와 알레르기 및 소아 호흡기질환의 임상과 관련된 기술 및 도구의 최근 발전에 관련된 주제를 다룬다.
                </p>
                <div class="btn-wrap text-center">
                    <a href="https://www.aard.or.kr/" class="btn btn-type1 btn-journal" target="_blank">AARD 바로가기 <span class="icon"><img src="/assets/image/sub/ic_btn_link.png" alt=""></span></a>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
