@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="map-wrap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.377383091835!2d126.97232857635584!3d37.56973032394416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca3370d37d539%3A0xc4947da533eb08b1!2z64yA7ZWc7LKc7Iud7JWM66CI66W06riw7ZWZ7ZqM!5e0!3m2!1sko!2skr!4v1753254243009!5m2!1sko!2skr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="map-info">
                    <img src="/assets/image/sub/img_emblem.png" alt="">
                    <div class="text-wrap">
                        <strong>대한천식알레르기학회</strong>
                        <p>03186 서울 종로구 새문안로 92 광화문오피시아빌딩 1329호</p>
                    </div>
                </div>
            </div>
            <ul class="map-info-list">
                <li>
                    <div class="text-wrap">
                        <strong>전화</strong>
                        <a href="tel:02-747-0528" target="_blank">02-747-0528</a>
                    </div>
                    <img src="/assets/image/sub/img_map_tel.png" alt="">
                </li>
                <li>
                    <div class="text-wrap">
                        <strong>팩스</strong>
                        02-3676-2847
                    </div>
                    <img src="/assets/image/sub/img_map_fax.png" alt="">
                </li>
                <li>
                    <div class="text-wrap">
                        <strong>E-mail</strong>
						<a href="mailto:allergy@allergy.or.kr" target="_blank">allergy@allergy.or.kr</a>
                        <!-- <a href="mailto:korall@chol.com" target="_blank">korall@chol.com</a> -->
                    </div>
                    <img src="/assets/image/sub/img_map_mail.png" alt="">
                </li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
