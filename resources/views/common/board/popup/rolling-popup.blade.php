<div class="popup-wrap" style="display: block;">
    <div class="popup-rolling-wrap js-popup-rolling {{ $boardPopupList->count() > 3 ? 'n3' : '' }} inner-layer slider">
        @foreach($boardPopupList as $board /* 게시판 팝업 */)

            @php
                $popup = $board->popups
            @endphp

            @switch($popup->popup_skin)
                @case('A')
                    <div class="popup-contents type1" id="board-popup-{{ $board->sid ?? 0 }}">
                        @include("common.board.popup.templateA")
                    </div>
                    @break

                @case('B')
                    <div class="popup-contents type2" id="board-popup-{{ $board->sid ?? 0 }}">
                        @include("common.board.popup.templateB")
                    </div>
                    @break

                @case('C')
                    <div class="popup-contents type3" id="board-popup-{{ $board->sid ?? 0 }}">
                        @include("common.board.popup.templateC")
                    </div>
                    @break

                @case('none')
                    <div class="popup-contents type4" id="board-popup-{{ $board->sid ?? 0 }}">
                        @include("common.board.popup.templatenone")
                    </div>
                    @break

                @default
                    @break
            @endswitch
        @endforeach
    </div>
</div>