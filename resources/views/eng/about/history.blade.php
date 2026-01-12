@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="tab-wrap">
                <div class="sub-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">History</button>
                    <ul class="sub-tab-menu">
                        <li class="on"><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('journal') }}">Official Journals</a></li>
                        <li><a href="{{ route('meeting') }}">International Meetings</a></li>
                        <li><a href="{{ route('society') }}">Related Societies</a></li>
                        <li ><a href="{{ route('past') }}">Past Presidents</a></li>
                    </ul>
                </div>
            </div>

            <div class="history-wrap">
                <p>
                    The Korean Academy of Asthma, Allergy and Clinical Immunology (KAAACI) has been devoted to improve the treatment of allergic diseases and promote the
                    understanding of allergy, asthma and clinical immunology. For nearly 40 years, the KAAACI has also been an active advocate of clinical and basic research.
                </p>
                <ul class="history-list">
                    <li>
                        <p class="title">
                            <span class="years">2000</span>
                            <span>Globalization (2000s)</span>
                        </p>
                        <p>
                            The Academy regularly held international conferences. Annual congresses held in spring and autumn attracted around 400 participants.
                            The KAAACI has successfully made a bid for hosting the World Allergy Congress 2015.
                        </p>
                    </li>
                    <li>
                        <p class="title">
                            <span class="years">1990</span>
                            <span>Expansion (1990s)</span>
                        </p>
                        <p>
                            The KAAACI expanded tremendously, both in size and social influence, in the 1990s and 2000s. The number of allergy-related illnesses increased rapidly
                            over these years and allergy became a social issue. The Academy’s role and responsibilities also increased.
                        </p>
                    </li>
                    <li>
                        <p class="title">
                            <span class="years">1980</span>
                            <span>Transition (1980s)</span>
                        </p>
                        <p>
                            The 1980s was a period of great transition for the Academy. The Korean Journal of Asthma, Allergy and Clinical Immunology, a scientific quarterly
                            journal, made its debut in 1981, and has steadily influenced the allergy community in Korea. The KAAACI became increasingly active in many international
                            meetings.
                        </p>
                    </li>
                    <li>
                        <p class="title">
                            <span class="years">1970</span>
                            <span>Establishment (1970s)</span>
                        </p>
                        <p>
                            Founded in 1972 with fifty-eight members, the KAAACI has since grown into a global organization. The number of dedicated members has skyrocketed to
                            reach 1,160 in 2010.
                        </p>
                    </li>
                </ul>

            </div>

        </div>
    </article>

@endsection

@section('addScript')

@endsection
