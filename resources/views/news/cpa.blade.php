@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <ul class="exam-list">
                <li>
                    <a href="https://www.kaim.or.kr/specialist/?sn=1&sn2=3_7" target="_blank">
                        <span>내과 전문의</span>
                        01
                        <strong>규정</strong>
                    </a>
                </li>
                <li>
                    <a href="https://www.kaim.or.kr/specialist/depart/info.php" target="_blank">
                        <span>내과 전문의</span>
                        02
                        <strong>인정시험</strong>
                    </a>
                </li>
                <li>
                    <a href="https://www.kaim.or.kr/specialist/depart_re/info.php" target="_blank">
                        <span>내과 전문의</span>
                        03
                        <strong>자격갱신 및 신청방법</strong>
                    </a>
                </li>
                <li class="on">
                    <a href="/assets/file/소아 알레르기_규정.pdf" target="_blank">
                        <span>소아 알레르기</span>
                        01
                        <strong>규정</strong>
                    </a>
                </li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
