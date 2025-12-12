@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="journal-conbox">
                <div class="sub-tab-wrap">
                    <ul class="sub-tab-menu">
                        <li ><a href="{{ route('journal.asSearch') }}">논문검색</a></li>
                        <li class="on"><a href="{{ route('journal.asKwon') }}">권·호수별 보기 (1981~2012)</a></li>
                    </ul>
                </div>
                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">학회지 목록</h3>
                </div>
                <div class="journal-detail-list">
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2012년 학회지 32권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'032','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'032','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'032','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'032','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2011년 학회지 31권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'031','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'031','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'031','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'031','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2010년 학회지 30권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'030','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'030','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'030','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'030','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2009년 학회지 29권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'029','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'029','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'029','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'029','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2008년 학회지 28권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'028','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'028','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'028','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'028','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2007년 학회지 27권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'027','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'027','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'027','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'027','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2006년 학회지 26권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'026','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'026','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'026','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'026','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2005년 학회지 25권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'025','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'025','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'025','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'025','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2004년 학회지 24권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'024','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'024','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'024','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'024','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2003년 학회지 23권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'023','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'023','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'023','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'023','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </article>
 
@endsection

@section('addScript')
@endsection
