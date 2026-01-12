@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="tab-wrap">
                <div class="sub-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">Past Presidents</button>
                    <ul class="sub-tab-menu">
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('journal') }}">Official Journals</a></li>
                        <li><a href="{{ route('meeting') }}">International Meetings</a></li>
                        <li><a href="{{ route('society') }}">Related Societies</a></li>
                        <li class="on"><a href="{{ route('past') }}">Past Presidents</a></li>
                    </ul>
                </div>
            </div>

            <ul class="past-list">
                <li>
                    <p class="years">2013-2015</p>
                    <p class="name">Hae-Ran Lee</p>
                    <p>Dept. of Pediatirics, Hallym Uni.</p>
                </li>
                <li>
                    <p class="years">2011-2013</p>
                    <p class="name">Byoung Whui Choi</p>
                    <p>Dept. of Internal Medicine, Chung-Ang Univ.</p>
                </li>
                <li>
                    <p class="years">2009-2011</p>
                    <p class="name">Hee-Bom Moon</p>
                    <p>Dept. of Internal Medicine, Ulsan Univ.</p>
                </li>
                <li>
                    <p class="years">2007-2009</p>
                    <p class="name">Joon-Sung Lee</p>
                    <p>Dept. of Pediatrics, Catholic Univ.</p>
                </li>
                <li>
                    <p class="years">2005-2007</p>
                    <p class="name">Sang-Il Lee</p>
                    <p>Dept. of Pediatrics, Sungkyunkwan Univ.</p>
                </li>
                <li>
                    <p class="years">2003-2005</p>
                    <p class="name">Sung-Hak Park</p>
                    <p>Dept. of Internal Medicine, Catholic Univ.</p>
                </li>
                <li>
                    <p class="years">2000-2003</p>
                    <p class="name">Yang-Gi Min</p>
                    <p>Dept. of Otorhinolaryngology, Seoul National Univ.</p>
                </li>
                <li>
                    <p class="years">1997-2000</p>
                    <p class="name">Chein-Soo Hong</p>
                    <p>Dept. of Internal Medicine, Yonsei Univ.</p>
                </li>
                <li>
                    <p class="years">1994-1997</p>
                    <p class="name">You-Young Kim</p>
                    <p>Dept. of Internal Medicine, Seoul National Univ.</p>
                </li>
                <li>
                    <p class="years">1992-1994</p>
                    <p class="name">Jeong-Won Kim</p>
                    <p>Dept. of Dermatology, Catholic Univ.</p>
                </li>
                <li>
                    <p class="years">1990-1992</p>
                    <p class="name">Ki-Young Lee</p>
                    <p>Dept. of Pediatrics, Yonsei Univ.</p>
                </li>
                <li>
                    <p class="years">1974-1990</p>
                    <p class="name">Suk-Young Kang</p>
                    <p>Dept. of Internal Medicine, Seoul National Univ.</p>
                </li>
                <li>
                    <p class="years">1972-1974</p>
                    <p class="name">Il-Sun Yoon</p>
                    <p>Dept. of Pathology, Seoul National Univ.</p>
                </li>
            </ul>

        </div>
    </article>

@endsection

@section('addScript')

@endsection
