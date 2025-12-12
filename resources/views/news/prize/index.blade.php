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
                        <li class="on"><a href="{{ route('news.prize') }}">학술상</a></li>
                        <li class=""><a href="{{ route('news.research') }}">연구비</a></li>
                    </ul>
                </div>
                <div class="sub-tab-wrap">
                    <ul class="sub-tab-menu type3">
                        <li class="on"><a href="{{ route('news.prize') }}">수상내역</a></li>
                        <li class=""><a href="{{ route('news.prize.rule') }}">학술상 규정</a></li>
                    </ul>
                </div>

                <div class="sch-wrap">
                    <form id="searchF" name="searchF" action="{{ route('news.prize') }}" class="sch-form-wrap">

                        <fieldset>
                            <legend class="hide">검색</legend>
                            <div class="form-group">
                                <input type="text" name="keyword" id="keyword" value="{{ request()->keyword ?? '' }}" class="form-item sch-key" placeholder="연도, 학술상명, 수상자, 소속 등 검색하고자 하는 내용 입력 후 검색 버튼 클릭 해주세요.">
                                <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                                <a href="{{ route('news.prize') }}" class="btn btn-reset" style="align-content: center;">검색 초기화</a>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="btn-wrap text-right mt-0">
                    @if(isAdmin())
                        <a href="{{ route('prize.collective') }}" class="btn btn-type1 btn-round color-type8 call-popup" data-popup_name="prize-collective" data-width="1000" data-height="900">학술상 다건 등록 <span class="icon"><img src="/assets/image/sub/ic_btn_regi.png" alt=""></span></a>
                        <a href="{{ route('prize.upsert') }}" class="btn btn-type1 btn-round color-type5 call-popup" data-popup_name="prize-individual" data-width="700" data-height="700">학술상 단건 등록 <span class="icon"><img src="/assets/image/sub/ic_btn_regi02.png" alt=""></span></a>
                    @endif
                </div>

                <div class="table-wrap scroll-x touch-help mt-30">
                    <table class="cst-table auto_rowspan">
                        <caption class="hide">수상내역</caption>
                        <colgroup>
                            <col style="width: 7%;">
                            <col style="width: 15%;">
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                            @if(isAdmin())
                                <col style="width: 7%;">
                            @endif
                        </colgroup>
                        <thead>
                        <tr class="active">
                            <th scope="col">연도</th>
                            <th scope="col">학술상명</th>
                            <th scope="col">수상자</th>
                            <th scope="col">소속</th>

                            @if(isAdmin())
                                <th scope="col">관리</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($list as $row)
                            <tr data-sid="{{ $row->sid }}">
                                <td scope="row">{{ $row->year ?? date('Y') }}</td>
                                <td>{{ $row->gubun ?? '' }}</td>
                                <td>{{ $row->name_kr ?? '' }}</td>
                                <td>{{ $row->sosok ?? '' }}</td>
                                @if(isAdmin())
                                    <td class="no-merge">
                                        <div class="btn-admin">
                                            <a href="{{ route('prize.upsert',['sid'=>$row->sid ]) }}" class="btn btn-modify call-popup" data-popup_name="prize-modify" data-width="700" data-height="700"><span class="hide">수정</span></a>
                                            <a href="javascript:;" class="btn btn-delete"><span class="hide">삭제</span></a>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
    <script type="text/javascript" src="/script/app/jquery.rowspanizer.js"></script>
    <script>
        const dataUrl = '{{ route('news.data') }}';
        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(function(){
            $(".auto_rowspan").rowspanizer({
                cols : [0],
                vertical_align: "middle"
            });
        });

        $(document).on('click', '.btn-delete', function () {
            const _this = this;
            const sid = getPK(_this);

            if (confirm('데이터 삭제 시 복구는 불가능 합니다.')) {
                callAjax(dataUrl, {
                    'case': 'prize-delete',
                    'sid': sid,
                });
            }
        });
    </script>
@endsection
