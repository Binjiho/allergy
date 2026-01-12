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

                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2002년 학회지 22권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'022','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'022','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'022','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'022','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2001년 학회지 21권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'021','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'021','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'021','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'021','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>
                    <li>
                        <div class="tit">
                            천식 및 알레르기
                            <strong>2000년 학회지 20권</strong>
                        </div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'020','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'020','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'020','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'020','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1999년 학회지 19권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'019','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'019','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'019','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'019','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1998년 학회지 18권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'018','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'018','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'018','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'018','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1997년 학회지 17권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'017','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'017','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'017','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'017','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1996년 학회지 16권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'016','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'016','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'016','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'016','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1995년 학회지 15권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'015','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'015','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'015','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'015','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1994년 학회지 14권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'014','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'014','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'014','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'014','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1993년 학회지 13권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'013','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'013','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'013','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'013','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1992년 학회지 12권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'012','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'012','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'012','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'012','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1991년 학회지 11권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'011','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'011','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'011','num'=>'03']) }}" class="btn">3호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'011','num'=>'04']) }}" class="btn">4호</a>
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1990년 학회지 10권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'010','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'010','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'010','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'010','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1989년 학회지 9권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'009','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'009','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'009','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'009','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1988년 학회지 8권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'008','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'008','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'008','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'008','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1987년 학회지 7권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'007','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'007','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'007','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'007','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1986년 학회지 6권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'006','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'006','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'006','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'006','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1985년 학회지 5권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'005','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'005','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'005','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'005','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1984년 학회지 4권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'004','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'004','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'004','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'004','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1983년 학회지 3권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'003','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'003','num'=>'02']) }}" class="btn">2호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'003','num'=>'03']) }}" class="btn">3호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'003','num'=>'04']) }}" class="btn">4호</a>--}}
                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1982년 학회지 2권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'002','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'002','num'=>'02']) }}" class="btn">2호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'002','num'=>'03']) }}" class="btn">3호</a>--}}

                        </div>
                    </li>

                    <li>
                        <div class="tit">천식 및 알레르기 <strong>1981년 학회지 1권</strong></div>
                        <div class="btn-wrap">
                            <a href="{{ route('journal.asKwonList',['vol'=>'001','num'=>'01']) }}" class="btn">1호</a>
                            <a href="{{ route('journal.asKwonList',['vol'=>'001','num'=>'02']) }}" class="btn">2호</a>
{{--                            <a href="{{ route('journal.asKwonList',['vol'=>'001','num'=>'03']) }}" class="btn">3호</a>--}}

                        </div>
                    </li>
                </div>
            </div>
        </div>
    </article>
 
@endsection

@section('addScript')
@endsection
