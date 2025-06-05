@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <section id="container">
        <article class="main-visual">
            <div class="main-visual-wrap js-main-visual cf">
                <div class="main-visual-con main-visual-con01">
                    <div class="main-visual-text inner-layer">
                        <h2 class="main-visual-tit font-paper">
                            <img src="/assets/image/main/img_mainvisual_logo.png" alt="한, 중, 일 뇌신경과학회 엠블럼" class="logo">
                            <span>The 28<sup>th</sup> Annual meeting of KSBNS</span>
                            <strong>
                                K-Brain 2025 & <br>
                                The 3<sup>rd</sup> CJK <br>
                                Neuroscience Meeting
                                <span class="stroke">
                                K-Brain 2025 & <br>
                                The 3<sup>rd</sup> CJK <br>
                                Neuroscience Meeting
                            </span>
                            </strong>
                        </h2>
                        <ul class="info-list">
                            <li>
                                <span class="tit">DATE</span>
                                <p>
                                    Aug <strong>24</strong>(Sun) – Aug <strong>27</strong>(Wed), 2025
                                </p>
                            </li>
                            <li>
                                <span class="tit">Venue</span>
                                <p>
                                    Songdo Convensia, Incheon, Korea
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="main-visual-menu">
                <li>
                    <a href="#n">
                        Registration
                        <span class="icon"><img src="/assets/image/main/ic_visual_menu01.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="#n">
                        Abstract <br>Submission
                        <span class="icon"><img src="/assets/image/main/ic_visual_menu02.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="#n">
                        Program
                        <span class="icon"><img src="/assets/image/main/ic_visual_menu03.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="#n">
                        Sonsorship
                        <span class="icon"><img src="/assets/image/main/ic_visual_menu04.png" alt=""></span>
                    </a>
                </li>
            </ul>
        </article>

        <article class="main-contents">
            <div class="main-conbox inner-layer">
                <div class="main-tit-wrap">
                    <h3 class="main-tit">IMPORTANT <br>DATES</h3>
                </div>
                <ul class="dday-list">
                    <li>
                        <span class="dday">D-123</span>
                        <p>
                            Abstract Submission <br>
                            Deadline
                        </p>
                        <strong>By Feb. 1, 2025</strong>
                    </li>
                    <li>
                        <span class="dday">D-123</span>
                        <p>
                            Minisymposia <br>
                            Submission Deadline
                        </p>
                        <strong>After Feb. 1, 2025</strong>
                    </li>
                    <li>
                        <span class="dday">D-123</span>
                        <p>
                            Early Bird Registration <br>
                            Deadline
                        </p>
                        <strong>By Mar. 15, 2025</strong>
                    </li>
                    <li>
                        <span class="dday">D-123</span>
                        <p>
                            Standard Registration <br>
                            Deadline
                        </p>
                        <strong>By Mar. 15, 2025</strong>
                    </li>
                </ul>
            </div>
        </article>

        <article class="main-contents">
            <div class="main-conbox inner-layer">
                <div class="main-tit-wrap">
                    <h3 class="main-tit">Invited Speakers</h3>
                </div>
                <div class="speakers-wrap">
                    <div class="speakers-rolling cf js-speakers-rolling cf">
                        <div class="speakers-con">
                            <span class="cate cate01">Presidential</span>
                            <div class="img-wrap">
                                <img src="/assets/image/main/img_no_speakers.png"  alt="Benjamin Deneed">
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">Benjamin Deneed</strong>
                                <p class="affiliation">Baylor College of Medicine, <br>USA</p>
                            </div>
                        </div>
                        <div class="speakers-con">
                            <span class="cate cate01">Presidential</span>
                            <div class="img-wrap">
                                <img src="/assets/image/main/img_no_speakers.png"  alt="Benjamin Deneed">
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">Benjamin Deneed</strong>
                                <p class="affiliation">Baylor College of Medicine, <br>USA</p>
                            </div>
                        </div>
                        <div class="speakers-con">
                            <span class="cate cate01">Presidential</span>
                            <div class="img-wrap">
                                <img src="/assets/image/main/img_no_speakers.png"  alt="Peter Walter">
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">Peter Walter</strong>
                                <p class="affiliation">Altos Labs, <br>USA</p>
                            </div>
                        </div>
                        <div class="speakers-con">
                            <span class="cate cate02">KSBNS Plenary</span>
                            <div class="img-wrap">
                                <img src="/assets/image/main/img_no_speakers.png"  alt="Matteo Carandini">
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">Matteo Carandini</strong>
                                <p class="affiliation">University College London, <br> UK</p>
                            </div>
                        </div>
                        <div class="speakers-con">
                            <span class="cate cate02">KSBNS Plenary</span>
                            <div class="img-wrap">
                                <img src="/assets/image/main/img_no_speakers.png"  alt="Matthew Rushworth">
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">Matthew Rushworth</strong>
                                <p class="affiliation">University Oxford, <br>UK </p>
                            </div>
                        </div>
                        <div class="speakers-con">
                            <span class="cate cate03">CJK Plenary</span>
                            <div class="img-wrap">
                                <img src="/assets/image/main/img_no_speakers.png"  alt="Hailan Hu">
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">Hailan Hu</strong>
                                <p class="affiliation">Zhejiang University, <br>China</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <article class="main-contents inner-layer">
            <div class="main-conbox main-board-conbox">
                <div class="main-tit-wrap">
                    <h3 class="main-tit">Notice</h3>
                </div>
                <ul class="main-board-list">
                    <li class="no-data" style="display: none;">
                        No Contents.
                    </li>
                    <li>
                        <a href="#n">
                            <span class="subject ellipsis">Invitation to the KSBNS Neuro Night: A Night of Music and Fun Invitation to the KSBNS Neuro Night: A Night of Music and Fun</span>
                            <span class="date">MORE <span class="plus">+</span></span>
                        </a>
                    </li>
                    <li>
                        <a href="#n">
                            <span class="subject ellipsis">Invitation to the KSBNS Neuro Night: A Night of Music and Fun Invitation to the KSBNS Neuro Night: A Night of Music and Fun</span>
                            <span class="date">MORE <span class="plus">+</span></span>
                        </a>
                    </li>
                    <li>
                        <a href="#n">
                            <span class="subject ellipsis">Invitation to the KSBNS Neuro Night: A Night of Music and Fun Invitation to the KSBNS Neuro Night: A Night of Music and Fun</span>
                            <span class="date">MORE <span class="plus">+</span></span>
                        </a>
                    </li>
                    <li>
                        <a href="#n">
                            <span class="subject ellipsis">Invitation to the KSBNS Neuro Night: A Night of Music and Fun Invitation to the KSBNS Neuro Night: A Night of Music and Fun</span>
                            <span class="date">MORE <span class="plus">+</span></span>
                        </a>
                    </li>
                </ul>
                <a href="/html/bbs/notice/list.html" class="btn btn-more"><span class="hide">더보기</span></a>
            </div>
            <div class="main-conbox main-download-conbox">
                <div class="main-tit-wrap">
                    <h3 class="main-tit">Download Center</h3>
                </div>
                <div class="scroll-y">
                    <ul class="download-list">
                        <li>
                            <a href="#n" download><img src="/assets/image/main/ic_file01.png" alt="">KSBNS 2024 Poster</a>
                        </li>
                        <li>
                            <a href="#n" download><img src="/assets/image/main/ic_file02.png" alt="">2024 APSN-ISN-Neurochemistry School Poster</a>
                        </li>
                        <li>
                            <a href="#n" download><img src="/assets/image/main/ic_file03.png" alt="">KSBNS NeuroNight Poster</a>
                        </li>
                        <li>
                            <a href="#n" download><img src="/assets/image/main/ic_file01.png" alt="">KSBNS 2024 Poster</a>
                        </li>
                        <li>
                            <a href="#n" download><img src="/assets/image/main/ic_file02.png" alt="">2024 APSN-ISN-Neurochemistry School Poster</a>
                        </li>
                        <li>
                            <a href="#n" download><img src="/assets/image/main/ic_file03.png" alt="">KSBNS NeuroNight Poster</a>
                        </li>
                    </ul>
                </div>
            </div>
        </article>
    </section>
@endsection

@section('addScript')
{{--    @if(!empty($boardPopupList))--}}
{{--        @include('common.board.popup.multi_pop', ['boardPopupList' => $boardPopupList])--}}
{{--    @endif--}}

    @isset($boardPopupList)
        @include('common.board.popup.rolling-popup')
        @include('common.board.popup.rolling-popup-script')
    @endisset

@endsection
