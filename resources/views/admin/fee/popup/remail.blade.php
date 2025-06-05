@extends('admin.layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">메일 미리보기</h3>
    </div>

    @include("template.fee-{$type}")

    <div class="btn-wrap text-center">
        <button id="send-mail" class="btn btn-type1 color-type6">발송하기</button>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('fee.data') }}';

        $(document).on('click', '#send-mail', function () {
            if (confirm('발송 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'send-mail',
                    'type': '{{ $type }}',
                    'sid': {{ $fee->sid }},
                })
            }
        });
    </script>
@endsection
