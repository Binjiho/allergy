@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="tab-wrap">
                <div class="sub-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">Related Societies</button>
                    <ul class="sub-tab-menu">
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('journal') }}">Official Journals</a></li>
                        <li><a href="{{ route('meeting') }}">International Meetings</a></li>
                        <li class="on"><a href="{{ route('society') }}">Related Societies</a></li>
                        <li ><a href="{{ route('past') }}">Past Presidents</a></li>
                    </ul>
                </div>
            </div>
            <p>The KAAACI maintains extensive networks with other organizations within Korea and around the world.</p>
            <ul class="society-list">
                <li>
                    <p>World Allergy Organization (WAO)</p>
                </li>
                <li>
                    <p>The Asian Pacific Association of Allergology and Clinical Immunology (APAAACI)</p>
                </li>
                <li>
                    <p>Asia Pacific Association of Pediatric, Allergy, Respirology and Immunology (APAPARI)</p>
                </li>
                <li>
                    <p>West Pacific Allergy Organization (WPAO)</p>
                </li>
                <li>
                    <p>Korean Medical Association</p>
                </li>
                <li>
                    <p>The Korean Association of Immunobiologists</p>
                </li>
                <li>
                    <p>The Korean Academy of Pediatric Allergy and Respiratory Disease</p>
                </li>
                <li>
                    <p>The Korean Academy of Tuberculosis and Respiratory Diseases</p>
                </li>
                <li>
                    <p>The Korean Rhinologic Society</p>
                </li>
                <li>
                    <p>The Korean Association of Internal Medicine</p>
                </li>
                <li>
                    <p>The Korean Pediatric Society</p>
                </li>
                <li>
                    <p>Korean Society of Otorhinolaryngology <br>- Head and Neck Surgery</p>
                </li>
                <li>
                    <p>Korean Dermatological Association</p>
                </li>
            </ul>


        </div>
    </article>

@endsection

@section('addScript')

@endsection
