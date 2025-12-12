@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="/assets/css/editor.css">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="ev-conbox">

                @include('conference.workshop.detail.workshop_info')
                
                <div class="ev-view-con editor-contents">
                    {!! $workshop->total_info ?? '' !!}
                </div>

                {{--
                <div class="btn-wrap text-center">
                    <a href="#n" class="btn btn-type1 color-type1" download target="_blank">행사 안내 이미지 다운로드</a>
                </div>
                --}}
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection
