<header id="header" class="js-header">
    <div class="header-wrap inner-layer">
        <ul class="sns-menu">
            <li><a href="https://www.instagram.com/allergy_kaaaci/" target="_blank"><img src="/assets/image/common/ic_insta.png" alt="인스타그램"></a></li>
{{--            <li><a href="#n"><img src="/assets/image/common/ic_facebook.png" alt="페이스북"></a></li>--}}
            <li><a href="https://www.youtube.com/@Kaaaci_Allergy" target="_blank"><img src="/assets/image/common/ic_youtube.png" alt="유튜브"></a></li>
        </ul>
        <h1 class="header-logo">
            <a href="/"><img src="/assets/image/common/h1_logo.png" alt="대한천식알레르기학회. The Korean Academy of Asthma, Allergy and Clinical Immunology"></a>
        </h1>

        <ul class="util-menu">
            <li class="lang"><a href="{{ env('APP_URL') }}" target="_blank">KOR</a></li>

        </ul>

        <button type="button" class="btn btn-menu-open js-btn-menu-open" title="메뉴 열기">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>

    <div id="dim" class="js-dim"></div>
    <nav id="gnb">
        <div class="m-gnb-header">
            <ul class="util-menu">
                <li class="lang"><a href="{{ env('APP_URL') }}" target="_blank">KOR</a></li>

            </ul>
        </div>

        <div class="gnb-wrap inner-layer">
            <ul class="gnb js-gnb">
                @foreach($menu['main'] as $key => $val)
                    @if($val['continue']) @continue @endif
                    @if($val['isLogined']) @if(thisAuth()->check()) @else @continue @endif @endif
                    <li >
                        <a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}" ><span>{!! $val['name'] !!}</span></a>

                        @if(!empty($menu['sub'][$key]))
                            <ul>
                            @foreach($menu['sub'][$key] ?? [] as $sKey => $sVal)
                                @if($sVal['continue']) @continue @endif
                                @if($sVal['isLogined']) @if(thisAuth()->check()) @else @continue @endif @endif
                                @if($key == 'MYPAGE') @if(thisAuth()->check() && $sVal['isLogined'] == false) @continue @endif @endif
                                <li><a href="{{ empty($sVal['url']) ? route($sVal['route'], $sVal['param']) : $sVal['url'] }}" target="{{ $sVal['blank'] ? '_blank' : '' }}" >{!! $sVal['name'] !!}</a></li>
                            @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            <button type="button" class="btn btn-allmenu js-allmenu-open" title="전체메뉴">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <ul class="sns-menu">
            <li class="lang"><a href="https://www.allergy.or.kr/eng/" target="_blank">ENGLISH</a></li>
            <li><a href="https://www.instagram.com/allergy_kaaaci/" target="_blank"><img src="/assets/image/common/ic_insta.png" alt="인스타그램"></a></li>
{{--            <li><a href="#n"><img src="/assets/image/common/ic_facebook.png" alt="페이스북"></a></li>--}}
            <li><a href="https://www.youtube.com/@Kaaaci_Allergy" target="_blank"><img src="/assets/image/common/ic_youtube.png" alt="유튜브"></a></li>
        </ul>

        <button type="button" class="btn btn-menu-close js-btn-menu-close"><span class="hide">메뉴 닫기</span></button>

    </nav>
</header>

<article id="allmenu" class="js-allmenu">
    <div class="allmenu-wrap inner-layer">
        <h3 class="tit">전체 메뉴</h3>
        <ul>
            @foreach($menu['main'] as $key => $val)
                @if($val['continue']) @continue @endif
                @if($val['isLogined']) @if(thisAuth()->check()) @else @continue @endif @endif
                <li >
                    <a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}" ><span>{!! $val['name'] !!}</span></a>

                    @if(!empty($menu['sub'][$key]))
                        <ul>
                            @foreach($menu['sub'][$key] ?? [] as $sKey => $sVal)
                                @if($sVal['continue']) @continue @endif
                                @if($sVal['isLogined']) @if(thisAuth()->check()) @else @continue @endif @endif
                                @if($key == 'MYPAGE') @if(thisAuth()->check() && $sVal['isLogined'] == false) @continue @endif @endif
                                <li><a href="{{ empty($sVal['url']) ? route($sVal['route'], $sVal['param']) : $sVal['url'] }}" target="{{ $sVal['blank'] ? '_blank' : '' }}" >{!! $sVal['name'] !!}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
        <button type="button" class="btn btn-allmenu-close js-allmenu-close"><span class="hide">메뉴 닫기</span></button>
    </div>
</article>