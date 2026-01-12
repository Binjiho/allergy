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

                @if(isAdmin())
                <div class="btn-wrap text-right">
                    <a href="{{ route('lecture.upsert',['wsid'=>$workshop->sid]) }}" class="btn btn-type1 color-type1">강의원고 등록</a>
                </div>
                @endif

                <ul class="lecture-list">
                    @forelse($list as $row)
                    <li>
                        <strong class="tit"><span>{{ $row->title ?? '' }}</span></strong>
                        <div class="lecture-info">
                            <p>
                                {{ $row->name_kr ?? '' }} ({{ $row->sosok ?? '' }})
                            </p>
                            <div class="btn-wrap">
                                @if(!empty($row->realfile))
                                <a href="{{ $row->downloadUrl() }}" class="btn btn-small color-type1" >강의원고 다운로드 <span class="icon"><img src="/assets/image/sub/ic_btn_download.png" alt=""></span></a>
                                @endif
                                @if(isAdmin())
                                    <div class="bbs-admin">
                                        <a href="{{ route('lecture.upsert',['wsid'=>$workshop->sid, 'sid'=>$row->sid]) }}" class="btn btn-modify"><span class="hide">수정</span></a>
                                        <a href="#n" class="btn btn-delete" data-sid="{{ $row->sid }}"><span class="hide">삭제</span></a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </li>
                    @empty
                    @endforelse

                </ul>

                {{ $list->links('pagination::custom') }}
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('lecture.data',['wsid'=>$workshop->sid]) }}';

        $(document).on('click', '.btn-delete', function () {
            const sid = $(this).data('sid');

            if (confirm('삭제하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'lecture-delete',
                    'sid': sid,
                });
            }
        });
    </script>
@endsection
