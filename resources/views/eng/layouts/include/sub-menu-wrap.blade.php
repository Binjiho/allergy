@php
    $main_name = $menu['main'][$main_menu]['name'] ?? '';
    if(!empty($sub_menu)){
        $sub_name = $menu['sub'][$main_menu][$sub_menu]['name'] ?? '';
    }
@endphp

<article class="sub-visual">
    <div class="sub-visual-con inner-layer">
        <div class="sub-visual-con inner-layer">
            <h2 class="sub-visual-tit">{{ $main_name }}</h2>
        </div>
    </div>
</article>

<article class="sub-menu-wrap inner-layer">
    <div class="sub-menu">
        <ul class="sub-menu-list js-sub-menu-list">
            <li class="sub-menu-depth01">
                <a href="javascript:;" class="btn-sub-menu js-btn-sub-menu">{{ $main_name }}</a>
                <ul>
                    @foreach($menu['main'] ?? [] as $key => $val)
                        @if($val['continue']) @continue @endif
                        <li class="{{ ($main_menu ?? '') == $key ? 'on':'' }}"><a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}" >{{ $val['name'] }}</a></li>
                    @endforeach
                </ul>
            </li>

            @if(!empty($menu['sub'][$main_menu][$sub_menu]))
                <li class="sub-menu-depth02">
                    <a href="javascript:;" class="btn-sub-menu js-btn-sub-menu">{{ $sub_name }}</a>
                    <ul>
                        @foreach($menu['sub'][$main_menu] ?? [] as $sKey => $sVal)

                            @if($sVal['continue']) @continue @endif
                            @if($sVal['isLogined']) @if(thisAuth()->check()) @else @continue @endif @endif
                            @if($main_menu == 'MYPAGE') @if(thisAuth()->check() && $sVal['isLogined'] == false) @continue @endif @endif
                            <li class="{{ ($sub_menu ?? '') == $sKey ? 'on':'' }}"><a href="{{ empty($sVal['url']) ? route($sVal['route'], $sVal['param']) : $sVal['url'] }}" {{ $sVal['blank'] === true ? "target=_blank" : '' }} >{{ $sVal['name'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</article>