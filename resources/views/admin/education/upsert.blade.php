@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">행사 {{ empty($workshop->sid) ? '등록' : '수정' }}</h3>
    </div>

    <form id="register-frm" method="post" data-sid="{{ $workshop->sid ?? 0 }}" data-case="workshop-{{ empty($workshop->sid) ? 'create' : 'update' }}">
        <input type="hidden" name="kind" value="E" readonly>

        @include('admin.education.form.register-frm')

        <div class="btn-wrap text-center">
            <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
            <button type="submit" class="btn btn-type1 color-type6">{{ empty($workshop->sid) ? '등록' : '수정' }}</button>
        </div>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('education.data') }}';

    </script>

    @yield('reg-script')
@endsection
