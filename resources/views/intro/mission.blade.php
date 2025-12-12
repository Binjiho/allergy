@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="mission-conbox">
                <h3 class="mission-tit">Mission</h3>
                <p>
                    국민보건 향상을 위한 <strong>천식, 알레르기 및 임상면역학 분야</strong>의 <br>학문발전에 기여한다.
                </p>
                <h3 class="mission-tit">Vision</h3>
                <p>
                    천식 알레르기 분야의 대표학회로서 <br>
                    최고의 연구 및 진료 역량을 바탕으로 <br>
                    <strong>국민의 신뢰를 받는 글로벌선도학회</strong>가 된다.
                </p>

                <h3 class="mission-tit">핵심가치</h3>
                <ul class="value-list">
                    <li>
                        소통과 화합
                    </li>
                    <li>
                        신뢰와 전문성
                    </li>
                    <li>
                        국민건강
                    </li>
                    <li>
                        창조적연구
                    </li>
                </ul>

                <h3 class="mission-tit">전략방향 & 전략과제</h3>
                <ul class="mission-list">
                    <li>
                        <p class="tit">미래성장 동력 확보</p>
                        <ul class="list-type list-type-dot">
                            <li>신의료 치료기술의 개발 / 연구활성화</li>
                            <li>인프라 구축</li>
                        </ul>
                    </li>
                    <li>
                        <p class="tit">학회사업 확대 및 강화</p>
                        <ul class="list-type list-type-dot">
                            <li>대정부 및 대국민 홍보활동 강화</li>
                            <li>학문적 교류 활성화</li>
                        </ul>
                    </li>
                    <li>
                        <p class="tit">조직체계 개선 및 협력</p>
                        <ul class="list-type list-type-dot">
                            <li>학회의 개발적 구조 강화 및 사무국 운영 효율화</li>
                            <li>유관기관과의 협력 강화</li>
                        </ul>
                    </li>
                    <li>
                        <p class="tit">회원확대 및 소통강화</p>
                        <ul class="list-type list-type-dot">
                            <li>학회 내 회원간 소통 활성화</li>
                            <li>학회 다양성을 통한 규모 증대</li>
                        </ul>
                    </li>
                    <li>
                        <p class="tit">글로벌 학회 선도</p>
                        <ul class="list-type list-type-dot">
                            <li>글로벌 간행사업 집중</li>
                            <li>글로벌 학회 교류활동 활성화</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
