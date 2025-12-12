@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="textbook-conbox">
                <div class="sch-wrap">
                    <form id="searchF" name="searchF" action="{{ route('journal.publication') }}" class="sch-form-wrap">
                        <fieldset>
                            <legend class="hide">검색</legend>
                            <div class="form-group">
                                <input type="text" name="keyword" id="keyword" value="{{ request()->keyword ?? '' }}" class="form-item sch-key" placeholder="제목, 저자명, 발행처 등 검색하고자 하는 내용 입력 후 검색 버튼 클릭 해주세요.">
                                <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                                <a href="{{ route('journal.publication') }}" type="reset" class="btn btn-reset" style="align-content: center;">검색 초기화</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <ul class="textbook-list">
                    @forelse($list as $row)
                    <li data-sid="{{ $row->sid }}">
                        <div class="list-con">
                            <div class="img-wrap">
                                @if(!empty($row->realfile))
                                    <img src="{{ $row->realfile }}" alt="">
                                @else
                                    <img src="/assets/image/sub/img_no_textbook.png" alt="">
                                @endif
                            </div>
                            <div class="text-wrap">
                                <strong class="tit">{{ $row->title ?? '' }}</strong>
                                <ul class="list-type list-type-dot">
                                    <li>{{ $row->name_kr ?? '' }} 지음</li>
                                    <li>발행일 : {{ $row->publicated_at->format('Y년 m월 d일') ?? '' }}</li>
                                    <li>발행처 : {{ $row->location ?? '' }}</li>
                                </ul>
                                @if(!empty($row->url))
                                <div class="btn-wrap">
                                    <a href="{{ $row->url }}" class="btn btn-type1 color-type1" target="_blank">구매처 바로가기 <span class="icon"><img src="/assets/image/sub/ic_link.png" alt=""></span></a>
                                </div>
                                @endif

                                @if(isAdmin())
                                <div class="bbs-admin">
                                    <select name="hide" id="hide" class="form-item">
                                        <option value="N" {{ ($row->hide ?? '') == 'N' ? 'selected' : '' }}>공개</option>
                                        <option value="Y" {{ ($row->hide ?? '') == 'Y' ? 'selected' : '' }}>비공개</option>
                                    </select>
                                    <a href="{{ route('publication.upsert',['sid'=>$row->sid]) }}" class="btn btn-modify call-popup" data-popup_name="publication-modify" data-width="800" data-height="700"><span class="hide">수정</span></a>
                                    <a href="javascript:;" class="btn btn-delete"><span class="hide">삭제</span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    @empty
                    @endforelse
                </ul>

                @if(isAdmin())
                    <div class="btn-wrap text-right">
                        <a href="{{ route('publication.upsert') }}" class="btn btn-type1 color-type1 call-popup" data-popup_name="publication-individual" data-width="800" data-height="700">등록</a>
                    </div>
                @endif
            </div>
        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('journal.data') }}';
        const getPK = (_this) => {
            return $(_this).closest('li').data('sid');
        }

        $(document).on('click', '.btn-delete', function () {
            const _this = this;
            const sid = getPK(_this);

            if (confirm('데이터 삭제 시 복구는 불가능 합니다.')) {
                callAjax(dataUrl, {
                    'case': 'publication-delete',
                    'sid': sid,
                });
            }
        });

        $(document).on('change', "[name='hide']", function () {
            const _this = this;
            const _sid = getPK(_this);
            const _val = $(this).val();

            callAjax(dataUrl, {
                'case': 'publication-hide',
                'sid': _sid,
                'val': _val,
            });
        });
    </script>
@endsection
