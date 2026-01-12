@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="tab-wrap">
                <div class="sub-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">Official Journals</button>
                    <ul class="sub-tab-menu">
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li class="on"><a href="{{ route('journal') }}">Official Journals</a></li>
                        <li><a href="{{ route('meeting') }}">International Meetings</a></li>
                        <li><a href="{{ route('society') }}">Related Societies</a></li>
                        <li ><a href="{{ route('past') }}">Past Presidents</a></li>
                    </ul>
                </div>
            </div>

            <p>
                The Korean Journal of Asthma, Allergy and Clinical Immunology is a scientific quarterly journal published by the KAAACI. First published in 1981, this journal
                has now become a prominent publication that motivates KAAACI members toward more in-depth research. <br>
                In 1993, the KAAACI started to publish National Allergy Guidelines to educate doctors and to reduce suffering among growing number of allergy patients in Korea.
                <br><br>
                Since 2009, Allergy, Asthma & Immunology Research (AAIR), an English journal (http://e-aair.org/), has been published by the KAAACI together with the Korean
                Academy of Pediatric Allergy and Respiratory Disease by the extraordinary effort of the members, This journal had seen registered to Pubmed.
            </p>
            <p class="con-tit">* Other KAAACI publications</p>
            <ul class="journal-list">
                <li>
                    <dl>
                        <dt>2005</dt>
                        <dd>National Allergy Guideline</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>2005</dt>
                        <dd>National Guideline for the Management of Asthma (revised edition), 2005</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>2002</dt>
                        <dd>Asthma and Allergic Diseases</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>2001</dt>
                        <dd>Guidelines for the Management of Urticaria</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>1999</dt>
                        <dd>National Guideline for the Diagnosis and Management of Allergic Rhinitis</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>1998</dt>
                        <dd>National Guideline for the Management of Asthma</dd>
                    </dl>
                </li>
            </ul>
        </div>
    </article>

@endsection

@section('addScript')

@endsection
