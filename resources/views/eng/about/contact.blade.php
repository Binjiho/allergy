@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="map-wrap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.3773830918317!2d126.9723285762969!3d37.56973032394423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca292d9e78ca3%3A0x271c7083f27c1a17!2s92%20Saemunan-ro%2C%20Jongno%20District%2C%20Seoul!5e0!3m2!1sen!2skr!4v1765954999845!5m2!1sen!2skr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="map-info">
                    <img src="/html/english/assets/image/sub/img_contactus.png" alt="">
                    <div>
                        <strong>The Korean Acdemy of Asthma, Allergy and Clinical Immunology (KAAACI)</strong>
                        <p>1329, Gwanghwamun Officia, 92, Saemunan-ro, Jongno-gu, Seoul 03186, Korea</p>
                    </div>
                </div>
            </div>

            <ul class="contact-list">
                <li>
                    <p>
                        <strong>TEL</strong>
                        +82-2·747·0528
                    </p>
                    <img src="/html/english/assets/image/sub/ico_contact01.png" alt="">
                </li>
                <li>
                    <p>
                        <strong>FAX</strong>
                        82-2·3676·2847
                    </p>
                    <img src="/html/english/assets/image/sub/ico_contact02.png" alt="">
                </li>
                <li>
                    <p>
                        <strong>E-mail </strong>
                        allergy@allergy.or.kr
                    </p>
                    <img src="/html/english/assets/image/sub/ico_contact03.png" alt="">
                </li>
            </ul>

        </div>
    </article>

@endsection

@section('addScript')

@endsection
