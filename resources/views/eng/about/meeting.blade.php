@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="tab-wrap">
                <div class="sub-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">International Meetings</button>
                    <ul class="sub-tab-menu">
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('journal') }}">Official Journals</a></li>
                        <li class="on"><a href="{{ route('meeting') }}">International Meetings</a></li>
                        <li><a href="{{ route('society') }}">Related Societies</a></li>
                        <li ><a href="{{ route('past') }}">Past Presidents</a></li>
                    </ul>
                </div>
            </div>

            <p>The KAAACI has hosted many conferences over the past decades, building experience and widening its networks.</p>
            <div class="tab-wrap">
                <div class="sub-tab-wrap type2">
                    <ul class="sub-tab-menu js-tab-menu">
                        <li class="on"><a href="#n">2001 ~ Present</a></li>
                        <li><a href="#n">1983 ~ 2000</a></li>
                    </ul>
                </div>
                <!-- 2001 ~ Present -->
                <div class="sub-tab-con js-tab-con" style="display: block;">
                    <ul class="meeting-list">
                        <li>
                            <p>Korea-Japan Joint Symposium</p>
                            <ul>
                                <li class="date">May 2010</li>
                                <li class="rocation">Seoul, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>Japan-Korea Joint Symposium</p>
                            <ul>
                                <li class="date">Oct. 2009</li>
                                <li class="rocation">Akita, Japan</li>
                            </ul>
                        </li>
                        <li>
                            <p>KAAACI-WPAO Joint Meeting</p>
                            <ul>
                                <li class="date">Oct. 2008</li>
                                <li class="rocation">Gwangju, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>KAAACI-ARIA-INTERASMA Joint Congress 2007 &amp; WHO/GARD Meeting</p>
                            <ul>
                                <li class="date">May 2007</li>
                                <li class="rocation">Seoul, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>KAAACI-WAO Joint Congress &amp; the 9th WPAS</p>
                            <ul>
                                <li class="date">Nov. 2006</li>
                                <li class="rocation">Seoul, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>8th WPAS</p>
                            <ul>
                                <li class="date">Oct. 2004</li>
                                <li class="rocation">Tokyo, Japan</li>
                            </ul>
                        </li>
                        <li>
                            <p>5th APAAACI &amp; the 7th WPAS</p>
                            <ul>
                                <li class="date">Oct. 2002</li>
                                <li class="rocation">Seoul, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>9th Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">Nov. 2001</li>
                                <li class="rocation">Jeju, Korea</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- //2001 ~ Present -->
                <!-- 1983 ~ 2000 -->
                <div class="sub-tab-con js-tab-con">
                    <ul class="meeting-list">
                        <li>
                            <p>6th WPAS</p>
                            <ul>
                                <li class="date">Oct. 2000</li>
                                <li class="rocation">Sydney, Australia</li>
                            </ul>
                        </li>
                        <li>
                            <p>8th Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">Nov. 1999</li>
                                <li class="rocation">Tokyo, Japan</li>
                            </ul>
                        </li>
                        <li>
                            <p>5th WPAS &amp; 7th Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">Jun. 1997</li>
                                <li class="rocation">Seoul, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>4th WPAS &amp; 6th Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">Jun. 1991</li>
                                <li class="rocation">Utsunomiya, Japan</li>
                            </ul>
                        </li>
                        <li>
                            <p>3rd WPAS &amp; 5th Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">Jun. 1991</li>
                                <li class="rocation">Seoul, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>2nd WPAS &amp; 4th Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">May 1988</li>
                                <li class="rocation">Tokyo, Japan</li>
                            </ul>
                        </li>
                        <li>
                            <p>1st WPAS &amp; 3rd Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">May 1986</li>
                                <li class="rocation">Gwangju, Korea</li>
                            </ul>
                        </li>
                        <li>
                            <p>2nd Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">Oct. 1984</li>
                                <li class="rocation">Tokyo, Japan</li>
                            </ul>
                        </li>
                        <li>
                            <p>1st Korea-Japan Joint Allergy Symposium</p>
                            <ul>
                                <li class="date">May 1983</li>
                                <li class="rocation">Daegu, Korea</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- //1983 ~ 2000 -->
            </div>

        </div>
    </article>

@endsection

@section('addScript')

@endsection
