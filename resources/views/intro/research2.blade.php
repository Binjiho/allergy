@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="history-conbox">

                <div class="sub-tab-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">연혁</button>
                    <ul class="sub-tab-menu js-tab-menu">
                        <li class="{{ (request()->tab ?? '') == '' ? 'on' : '' }}"><a href="{{ route('intro.research') }}">현 임원진</a></li>
                        <li class="{{ (request()->tab ?? '') == '2' ? 'on' : '' }}"><a href="{{ route('intro.research',['tab'=>2]) }}">역대 임원진</a></li>
                        <li class=""><a href="{{ route('board',['code'=>'research-team']) }}">게시판</a></li>
                    </ul>
                </div>

                @include('not_page')
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
