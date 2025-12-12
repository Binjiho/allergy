@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')
    
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap type2">
                <ul class="sub-tab-menu">
                    <li ><a href="{{ route('intro.history') }}">연혁</a></li>
                    <li class="on"><a href="{{ route('intro.history',['tab'=>2]) }}">50년사</a></li>
                </ul>
            </div>
            <div class="brochure-conbox">
                <div class="con-wrap inner-layer">
                    <div class="text-wrap text-right">
                        <img src="/assets/image/sub/img_brochure_text.png" alt="대한천식알레르기학회 50년사. 1972~2022">
                    </div>
                    <div class="img-wrap text-center">
                        <img src="/assets/image/sub/img_brochure_text02.png" alt="50 years">
                        <div class="btn-wrap text-center">
                            <a href="/assets/file/대한천식알레르기학회_50년사.pdf" target="_blank" download class="btn btn-type1 btn-round">기념책자 다운로드 <span class="icon"><img src="/assets/image/sub/ic_brochure_down.png" alt=""></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
