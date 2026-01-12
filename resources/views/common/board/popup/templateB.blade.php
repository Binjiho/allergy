@php
    /*

    팝업 세팅시 추가되는 css

    크기조절 : width:auto; min-width:팝업넓이; max-width:팝업넓이; min-height:팝업높이; max-height:팝업높이;
    위치조절 : margin:0; margin-top:팝업위치위에서; margin-left:팝업위치왼쪽에서;

    ex) 크기조절
    <div class="popup-contents" style="width:auto; min-width:600px; max-width:600px; min-height:600px; max-height:600px;">

    ex) 위치조절
    <div class="popup-contents" style="margin:0; margin-top:100px; margin-left:100px;">

    ex) 크기 + 위치조절
    <div class="popup-contents" style="width:auto; min-width:600px; max-width:600px; min-height:600px; max-height:600px; margin:0; margin-top:100px; margin-left:100px;">

    */
@endphp

@if(!empty($preview)) {{-- 미리보기팝업 --}}
<div class="popup-rolling-wrap js-popup-rolling inner-layer" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%); z-index: 9999;">
    <div class="popup-contents type2" @if(empty($preview)) id="board-popup-{{ $board->sid }}" @endif style="width:auto;  ">
@endif

        <div class="scroll-y">
            <div class="popup-conbox">
                <div class="popup-contit-wrap">
                    <h2 class="popup-contit">{{ $board->subject }}</h2>
                </div>

                <div class="popup-con">
                    {!! $popup->popup_contents !!}
                </div>

                @if(($board->files_count ?? 0) > 0)
                    <div class="popup-attach-con">
                        @foreach($board->files as $key => $file)
                            <a href="{{ empty($preview) ? $file->downloadUrl() : "javascript:void(0);" }}">
                                {{ $file->filename }} (다운로드 : {{ number_format($file->download) }}회)
                            </a>
                        @endforeach
                    </div>
                @endif

                <div class="btn-wrap text-center">
                    @if(!empty($popup->popup_link))
                        <a href="{{ $popup->popup_link }}" class="btn btn-pop-more">자세히보기</a>
                    @endif

                    @if(!empty($board->link_url))
                        <a href="{{ $board->link_url }}" class="btn btn-pop-link">바로가기</a>
                    @endif
                </div>

            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn-pop-today-close">[오늘하루 그만보기]</button>
            <button type="button" class="btn-pop-7-close">[7일동안 열지않기]</button>
        </div>

        <button type="button" class="btn btn-pop-close">
            <span class="hide">팝업 닫기</span>
        </button>

@if(!empty($preview))
    </div>
</div>
@endif

<script>
    @if(!empty($preview))
    $(document).on('click', '.btn-pop-close', function () {
        $('.popup-rolling-wrap').remove();
    });

    $(document).on('click', '.btn-pop-today-close', function () {
        $('.popup-rolling-wrap').remove();
    });
    @else

    $(document).on('click', '.popup_close_btn', function () {
        self.close();
    });

    @if(!empty($main_pop) && $main_pop !== false)
    $(document).on('click', '.btn-pop-today-close', function () {
        const layer = $(this).closest('.win-popup-wrap');

        setCookie24(layer.attr('id'), 'done', 1);

        self.close();
    });

    $(document).on('click', '.btn-pop-7-close', function () {
        const layer = $(this).closest('.win-popup-wrap');

        setCookie24(layer.attr('id'), 'done', 7);

        self.close();
    });
    @endif

    function setCookie24(name, value, expiredays) {
        var todayDate = new Date();

        todayDate.setDate(todayDate.getDate() + expiredays);

        document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";";
    }
    @endif
</script>