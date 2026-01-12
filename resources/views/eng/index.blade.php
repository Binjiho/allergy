@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="main-contents inner-layer" id="section1">
        <h2>
            <span>Since 1972</span><br>
            The Korean Academy of Asthma,<br class="m-hide">
            Allergy and Clinical Immunology
        </h2>
    </article>
    <article class="main-contents inner-layer" id="section2">
        <div class="main-slide js-main-slide">
            <div class="main-slide-con">
                <div class="con-wrap">
                    <div class="img-wrap">
                        <img src="/html/english/assets/image/main/img_main_slide.png" alt="">
                    </div>
                    <div class="text-wrap">
                        <h3 class="main-visual-tit ellipsis3">Asthma and Allergic Disease, 3rd. edition</h3>
                        <p>Publisher: <br>Yeomungak Publishing Co.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="main-slide-con">
                <div class="con-wrap">
                    <div class="img-wrap">
                        <img src="/html/english/assets/image/main/img_main_slide.png" alt="">
                    </div>
                    <div class="text-wrap">
                        <h3 class="main-visual-tit ellipsis3">Asthma and Allergic Disease, 3rd. edition</h3>
                        <p>Publisher: <br>Yeomungak Publishing Co.</p>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="quick-menu">
            <ul class="col2">
                <li><a href="/eng/publication/aair">
                        <p>AAIR</p>
                        <i class="icon"><span class="hide">arrow</span></i>
                    </a></li>
                <li><a href="/eng/publication/aard">
                        <p>AAIR</p>
                        <i class="icon"><span class="hide">arrow</span></i>
                    </a></li>
            </ul>
            <ul class="col3">
                <li><a href="/eng/board/news">
                        <p>NEWS & NOTICE</p>
                        <i class="icon"><span class="hide">arrow</span></i>
                    </a></li>
                <li><a href="/eng/about/welcome">
                        <p>ABOUT KAAACI</p>
                        <i class="icon"><span class="hide">arrow</span></i>
                    </a></li>
                <li><a href="/eng/board/meeting">
                        <p>ACADEMIC <br class="m-hide">MEETINGS</p>
                        <i class="icon"><span class="hide">arrow</span></i>
                    </a></li>
            </ul>
        </div>
    </article>

@endsection

@section('addScript')

@endsection
