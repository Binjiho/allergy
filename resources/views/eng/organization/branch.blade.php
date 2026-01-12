@extends('eng.layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('eng.layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="branch-map-wrap">
                <div class="branch-wrap">
                    <div class="img-wrap">
                        <img src="/html/english/assets/image/sub/img_branch.png" alt="">
                    </div>
                    <ul class="pin-list">
                        <li class="seoul">
                            <a href="#n">
                                <img src="/html/english/assets/image/sub/img_branch_pin.png" alt="">
                            </a>
                            <p>Seoul Branch</p>
                        </li>
                        <li class="gangwon">
                            <a href="#n">
                                <img src="/html/english/assets/image/sub/img_branch_pin.png" alt="">
                            </a>
                            <p>Gangwon Branch</p>
                        </li>
                        <li class="incheon">
                            <a href="#n">
                                <img src="/html/english/assets/image/sub/img_branch_pin.png" alt="">
                            </a>
                            <p>Kyeonggi-Incheon Branch</p>
                        </li>
                        <li class="daegu">
                            <a href="#n">
                                <img src="/html/english/assets/image/sub/img_branch_pin.png" alt="">
                            </a>
                            <p>Daegu-Gyeongbuk Branch</p>
                        </li>
                        <li class="jeonbuk">
                            <a href="#n">
                                <img src="/html/english/assets/image/sub/img_branch_pin.png" alt="">
                            </a>
                            <p>Jeonbuk Branch</p>
                        </li>
                        <li class="busan">
                            <a href="#n">
                                <img src="/html/english/assets/image/sub/img_branch_pin.png" alt="">
                            </a>
                            <p>Busan-Gyeongnam Branch</p>
                        </li>
                        <li class="gwangju">
                            <a href="#n">
                                <img src="/html/english/assets/image/sub/img_branch_pin.png" alt="">
                            </a>
                            <p>Gwangju-Chonnam Branch</p>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="branch-list">
                <li>
                    <p>Seoul Branch</p>
                </li>
                <li>
                    <p>Kyeonggi-Incheon Branch</p>
                </li>
                <li>
                    <p>Gangwon Branch</p>
                </li>
                <li>
                    <p>Busan-Gyeongnam Branch</p>
                </li>
                <li>
                    <p>Daegu-Gyeongbuk Branch</p>
                </li>
                <li>
                    <p>Jeonbuk Branch</p>
                </li>
                <li>
                    <p>Gwangju-Chonnam Branch</p>
                </li>
            </ul>

        </div>
    </article>
@endsection

@section('addScript')

@endsection
