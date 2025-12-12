@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="journal-conbox">
                <div class="sub-tab-wrap">
                    <ul class="sub-tab-menu">
                        <li class="on"><a href="{{ route('journal.asSearch') }}">논문검색</a></li>
                        <li><a href="{{ route('journal.asKwon') }}">권·호수별 보기 (1981~2012)</a></li>
                    </ul>
                </div>
                <div class="btn-wrap text-right">
                    <a href="{{ route('journal.asSearch') }}" class="btn btn-type1 btn-round btn-reset color-type10"><span class="icon"><img src="/assets/image/sub/ic_btn_sch.png" alt=""></span>재검색</a>
                </div>
                <ul class="journal-list">
                    @forelse($list as $row)
                        <li>
                            <p class="cate">
                                <span>{{ $row['category'] ?? '' }}</span>
                            </p>
                            <div class="tit">
                                {{ $row['subject_kr'] ?? '' }}
                            </div>
                            <div class="info">
                                <p class="name">{!! $row['author_kr'] ?? '' !!}</p>
                                <p>{{ $row['subject_en'] ?? '' }}</p>
                                <p>{!! $row['author_en'] ?? '' !!}</p>
                            </div>
                            <div class="iso">
                                @php
                                    $dateString = $row['published_at'];
                                    $timestamp = strtotime($dateString);
                                    $formattedDate = date('Y M', $timestamp);
                                @endphp
                                {{ $formattedDate }}; {{ $row['vol'] ?? '' }}({{ $row['num'] ?? '' }}): {{ $row['start_page'] ?? '' }}-{{ $row['last_page'] ?? '' }}.
                            </div>
                            <div class="keywords">
                                {{ $row['keywords'] ?? '' }}
                            </div>
                            @php
                                $book = $row['book'];
                                if($book == 'Journal'){
                                    $link_url = "https://pdf.medrang.co.kr/".$row['code']."/".$row['vol']."/".$row['filename'];
                                }else{
                                    $link_url = "https://pdf.medrang.co.kr/".$row['code']."/".$row['book']."/".$row['filename'];
                                }
                            @endphp
                            <a href="{{ $link_url }}" target="_blank" class="btn btn-download">다운로드 <span class="icon"><img src="/assets/image/sub/ic_btn_download02.png" alt=""></span></a>
                        </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
