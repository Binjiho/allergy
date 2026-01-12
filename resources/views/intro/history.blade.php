@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

                <article class="sub-contents">
                    <div class="sub-conbox inner-layer">
                        <div class="sub-tab-wrap type2">
                            <ul class="sub-tab-menu">
                                <li class="on"><a href="{{ route('intro.history') }}">연혁</a></li>
                                <li><a href="{{ route('intro.history',['tab'=>2]) }}">50년사</a></li>
                            </ul>
                        </div>
                        <div class="history-contents">
                            <div class="year-rolling-wrap">
                                <a href="#n" class="btn btn-year-arrow btn-year-prev js-prev"><span class="hide">이전</span></a>
                                <div class="year-rolling js-year">
                                    <a href="#n" class="current"><span>2020년 ~ 현재</span></a>
                                    <a href="#n"><span>2002년 ~ 2019년</span></a>
                                    <a href="#n"><span>1972년 ~ 1998년</span></a>
                                </div>
                                <a href="#n" class="btn btn-year-arrow btn-year-next js-next"><span class="hide">다음</span></a>
                            </div>

                            <div class="history-rolling-wrap js-history-rolling">
                                <div class="history-wrap js-history-wrap">
                                    <div class="history-bar js-bar"></div>

									<div class="year-history-conbox js-history-conbox active">
                                        <div class="year-conbox">
                                            <strong class="year">2025년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        질병관리청-대한천식알레르기학회 업무협약식
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="year-history-conbox js-history-conbox active">
                                        <div class="year-conbox">
                                            <strong class="year">2024년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        충청지회 설립 <br>
                                                        학회 SNS 개설(YouTube, Instagram) <br>
                                                        태국알레르기학회(AAIAT)와 MOU 체결
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2023년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        천식과 알레르기 질환 3판 출간(일조각)
                                                    </p>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2022년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        학회 창립 50주년 기념학회 개최 <br>
                                                        대한천식알레르기학회 50년사 발행
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2020년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        알레르기 및 임상면역 의학용어 한글표준화집 발행 <br>
                                                        학술대회 온라인 개최
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="history-wrap js-history-wrap">
                                    <div class="history-bar js-bar"></div>

                                    <div class="year-history-conbox js-history-conbox active">
                                        <div class="year-conbox">
                                            <strong class="year">2019년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        유럽알레르기학회(EAACI)와 MOU 체결 <br>
                                                        학회 사무실 이전
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2016년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        연구팀 심포지엄 신설
                                                    </p>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2015년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        세계알레르기학술대회(WAC 2015) 서울 개최
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2013년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        
                                                        국문학술지 AARD 창간(Allergy Asthma & Respiratory Disease)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2012년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        학회 창립 40주년 기념학회 개최<br>
														대한천식알레르기학회 40년사 발행 <br>
                                                        천식과 알레르기 질환 2판 출간(일조각) 
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2011년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        대한천식알레르기학회로 명칭 변경
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2009년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        영문학술지 AAIR 창간(Allergy, Asthma & Immunology Research)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2006년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        KAAACI-WAO Joint Congress 2006 & the 9th WPAS 개최
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2007년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        GINA 가이드라인 한국판 발행
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2006년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        제1회 Airway Symposium 개최(대한결핵 및 호흡기학회 공동)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2005년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        4천만의 알레르기(개정판) 발행
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2004년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        경인지회 명칭 변경(경인/인천 통합)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">2002년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        천식과 알레르기 질환 발행(군자출판사) <br>
                                                        대한천식 및 알레르기학회 30년사 발행
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="history-wrap js-history-wrap">
                                    <div class="history-bar js-bar"></div>

                                    <div class="year-history-conbox js-history-conbox active">
                                        <div class="year-conbox">
                                            <strong class="year">1998년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        대한천식 및알레르기학회로 명칭 변경 <br>
                                                        학회지 명칭 변경(천식 및 알레르기, Journal of Asthma, Allergy and Clinical Immunology)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1997년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        학회 창립 25주년 기념학회 개최(제7회 한일합동 심포지엄, 제5회 서태평양 심포지엄 합동) <br>
                                                        알레르기 교육강좌로 명칭 변경(강습회)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1996년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        제1회 소오 우수논문상 시상(춘계)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1995년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        제1회 창산 우수논문상 시상(추계)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1992년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        제1회 강습회 개최 <br>
                                                        강원지회 설립
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1991년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        이사장 중심제로 운영체재 개편 <br>
                                                        직업성천식연구회 발족
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1986년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        제1회 서태평댱 알레르기 심포지엄 개최
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1983년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        제1회 한일 합동 알레르기 심포지엄 개최
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1982년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        국제 알레르기 및 임상면역학회 정회원 가입 <br>
                                                        부산경남지회, 대구경북지회 설립
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1981년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        학회지 창간(알레르기, Journal of The Korean Society of Allergology) <br>
                                                        서울지회, 전북지회 설립
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1980년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        충남지회 설립
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1978년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        광주/전남지회 설립
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1974년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        인천지회 설립
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1973년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="con">
                                                        제1회 학술 심포지엄 개최 <br>
                                                        제1회 추계학술대회 개최 <br>
                                                        경기지회 설립
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="year-history-conbox js-history-conbox">
                                        <div class="year-conbox">
                                            <strong class="year">1972년</strong>
                                            <ul class="history-con">
                                                <li>
                                                    <p class="date"><span>11. 30</span></p>
                                                    <p class="con">
                                                        대한알레르기학회 창립(초대 회장 윤일선. 부회장 강석영)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

@endsection

@section('addScript')
@endsection
