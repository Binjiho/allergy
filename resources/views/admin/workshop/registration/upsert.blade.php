@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <div class="sub-tit-wrap">
        <h3 class="sub-tit">행사 {{ empty($reg->sid) ? '등록' : '수정' }}</h3>
    </div>

    <form id="register-frm" method="post" data-sid="{{ $reg->sid ?? 0 }}" data-case="registration-{{ empty($reg->sid) ? 'create' : 'update' }}">
        <input type="hidden" name="member_gubun" id="member_gubun" value="{{ $reg->member_gubun ?? 'N' }}" readonly>
        <input type="hidden" name="wsid" id="wsid" value="{{ $wsid }}" readonly>
        <input type="hidden" name="mode" id="mode" value="{{ request()->mode ?? '' }}" readonly>

        @include('conference.workshop.detail.registration.form.regist-frm')

        <div class="btn-wrap text-center">
            <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
            <button type="submit" class="btn btn-type1 color-type6">{{ empty($reg->sid) ? '등록' : '수정' }}</button>
        </div>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('registration.data',['wsid'=>request()->wsid]) }}';

        const boardSubmit = () => {
            let ajaxData = newFormData(form);
            
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('reg-script')
@endsection
