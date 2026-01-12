<header id="header" class="js-header">
    <div class="header-wrap inner-layer">
        <h1 class="header-logo">
            <a href="{{ env('APP_URL') }}/eng">헤더 로고</a>
        </h1>
        <ul class="util-menu">
            <li><a href="{{ env('APP_URL') }}" target="_blank">KOREAN</a></li>
            <li><a href="#n" class="btn-allmenu js-allmenu-open">SITEMAP</a></li>
            <li><a href="https://www.instagram.com/allergy_kaaaci/" target="_blank"><img src="/html/english/assets/image/common/img_instagram.png" alt="instagram"></a></li>
            <li><a href="https://www.youtube.com/@Kaaaci_Allergy" target="_blank"><img src="/html/english/assets/image/common/img_youtube.png" alt="youtube"></a></li>
        </ul>
        <button type="button" class="btn btn-menu-open js-btn-menu-open"><span class="hide">메뉴 열기</span></button>
    </div>

    <div id="dim" class="js-dim"></div>

    <nav id="gnb">
        <div class="m-gnb-header">
            <ul class="util-menu">
                <li><a href="https://www.instagram.com/allergy_kaaaci/" target="_blank"><img src="/html/english/assets/image/common/img_instagram.png" alt="instagram"></a></li>
                <li><a href="https://www.youtube.com/@Kaaaci_Allergy" target="_blank"><img src="/html/english/assets/image/common/img_youtube.png" alt="youtube"></a></li>
            </ul>
            <button type="button" class="btn btn-menu-close js-btn-menu-close"><span class="hide">메뉴 닫기</span></button>
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
        </div>
    </nav>
</header>

<section id="allmenu" class="js-allmenu">
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
</section>