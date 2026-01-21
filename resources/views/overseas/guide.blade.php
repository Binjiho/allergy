@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('overseas.include.sub-tab-wrap')

            <div class="overseas-box yellow">
                <p>자세한 사항은 아래 참가지원 규정 버튼을 눌러 확인 부탁드립니다.</p>
                <div class="btn-wrap">
                    <a href="/assets/file/KRPIA_국내외학술대회_참가자_정산_매뉴얼(2024_07_15).pdf" target="_blank" class="btn btn-type1 color-type2">
                        한국글로벌의약산업협회(KRPIA) 규정 다운로드<img src="/assets/image/sub/ic_btn_download.png" alt="">
                    </a>
                    <a href="/assets/file/한국제약바이오협회_학술대회_참가자_지원_가이드라인(2023.09.20).pdf" target="_blank" class="btn btn-type1 color-type3">
                        한국제약바이오협회(KPBMA) 규정 다운로드<img src="/assets/image/sub/ic_btn_download.png" alt="">
                    </a>
                </div>
            </div>

            <div class="sub-tit-wrap">
                <h4 class="sub-tit">신청 자격</h4>
            </div>
            <ul class="list-type list-type-check">
                <li>학술대회의 연자, 발표자 (포스터 발표자 포함), 좌장, 토론자</li>
                <li>단, 발표자의 경우 주저자 및 공동저자 1명만 지원</li>
                <li>발표자 미참석시 공동저자 1명만 지원</li>
                <li>e-포스터 발표자: 초청장 또는 초록 체택 메일에 발표시간 또는 질의 응답 시간이 명시되어 발표자의 역할이 확인된 경우 1명만 지원</li>
            </ul>

            <div class="sub-tit-wrap">
                <h4 class="sub-tit">신청 및 정산 프로세스</h4>
            </div>
            <ul class="list-type list-type-check">
                <li>국외학회 지원신청 메뉴에서 온라인 접수</li>
                <li>접수내용 : 신청서 작성 초록사본, 초록선정여부를 확인 할 수 있는 서류, 기타 심의에 필요한 증빙자료 업로드</li>
                <li><strong>학회에서 정산서류를 일괄 취합하고 한국제약바이오협회(KPBMA)와 한국글로벌의약산업협회(KRPIA)에 전달하여 꼼꼼한 심사과정을 거치게 됩니다. </strong></li>
                <li><strong class="text-blue">최종 정산까지는 행사 종료 후 6개월 이상이 소요되고 있으니 여유있게 기다려 주시길 바랍니다.</strong></li>
            </ul>

            <ul class="process-list">
                <li>
                    <div class="icon">
                        <img src="/assets/image/sub/ico_overseas_step01.png" alt="">
                    </div>
                    <p>신청서 작성 및 제출</p>
                </li>
                <li>
                    <div class="icon">
                        <img src="/assets/image/sub/ico_overseas_step02.png" alt="">
                    </div>
                    <p>지원대상자 발표</p>
                </li>
                <li>
                    <div class="icon">
                        <img src="/assets/image/sub/ico_overseas_step03.png" alt="">
                    </div>
                    <p>학술대회 참가</p>
                </li>
                <li>
                    <div class="icon">
                        <img src="/assets/image/sub/ico_overseas_step04.png" alt="">
                    </div>
                    <p>정산서류 학회제출 <br><span>(홈페이지 결과보고 및 원본 우편 접수)</span></p>
                </li>
                <li>
                    <div class="icon">
                        <img src="/assets/image/sub/ico_overseas_step05.png" alt="">
                    </div>
                    <p>정산서류 심사기관 제출</p>
                </li>
                <li>
                    <div class="icon">
                        <img src="/assets/image/sub/ico_overseas_step06.png" alt="">
                    </div>
                    <p>심사기관 서류 확인 및 정산</p>
                </li>
            </ul>

        </div>
    </article>

@endsection

@section('addScript')
@endsection
