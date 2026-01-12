@extends('layouts.web-layout')

@section('addStyle')
    <link href="/assets/css/board_brochure.css" rel="stylesheet">
@endsection

@section('contents')
        @include('layouts.include.sub-menu-wrap')

        <article class="sub-contents">
            <div class="sub-conbox inner-layer">
                <div class="ev-conbox">
                    <div class="sch-wrap">
                        <form id="searchF" name="searchF" action="{{ route('workshop.education') }}" class="sch-form-wrap">
                            <fieldset>
                                <legend class="hide">검색</legend>
                                <div class="form-group">
                                    <select name="search" id="search" class="form-item sch-cate">
                                        <option value="title" {{ (request()->search ?? '' ) == 'title' ? 'selected' : '' }}>행사명</option>
                                        <option value="place" {{ (request()->search ?? '' ) == 'place' ? 'selected' : '' }}>장소</option>
                                    </select>
                                    <input type="text" name="keywrod" id="keywrod" value="{{ request()->keyword ?? '' }}" class="form-item sch-key" placeholder="검색하실 내용을 입력해주세요.">
                                    <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                                    <a href="{{ route('workshop.education') }}" type="reset" class="btn btn-reset" style="align-content: center;">검색 초기화</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    @if(isAdmin())
                    <div class="btn-wrap text-right">
                        <a href="{{ route('workshop.upsert') }}" class="btn btn-type1 color-type1 call-popup" data-popup_name="workshop-upsert" data-width="1200" data-height="900">행사 등록</a>
                    </div>
                    @endif

                    <div class="ev-list-wrap">
                        <div class="ev-list-tit">
                            <img src="/assets/image/sub/ic_ev_tit.png" alt=""> 진행 중 행사
                        </div>
                        <ul class="ev-list ev-list-type2">
                            @forelse($ing_list as $row)
                            <li data-sid="{{ $row->sid }}">
                                <div class="ev-tit">
                                    <span>{{ $row->title ?? '' }}</span>

                                    <div class="state {{ $row->regist_edate >= date('Y-m-d') ? '' : 'end' }}">사전등록 {{ $row->regist_edate >= date('Y-m-d') ? '접수 중' : '마감' }}</div>

                                    @if(isAdmin())
                                    <div class="bbs-admin">
                                        <select name="" id="" class="form-item hide-select">
                                            <option value="Y" {{ 'Y' == ($row->hide ?? '') ? 'selected' : '' }}>설정중</option>
                                            <option value="N" {{ 'N' == ($row->hide ?? '') ? 'selected' : '' }}>공개</option>
                                        </select>
                                        <a href="{{ route('workshop.upsert',['sid'=>$row->sid]) }}" class="btn btn-modify call-popup" data-name="new-workshop-upsert" data-width="850" data-height="900"><span class="hide">수정</span></a>
                                        <a href="javascript:;" class="btn btn-delete board-delete"><span class="hide">삭제</span></a>
                                    </div>
                                    @endif
                                </div>
                                <div class="ev-con">
                                    <ul class="list-type list-type-dot">
                                        <li>행사일 : {{ $row->event_sdate ?? '' }}{{ formatKoreanDate($row->event_sdate) }} {{ ($row->date_type ?? '') == 'L' ? ' ~ '.$row->event_edate.formatKoreanDate($row->event_edate) : '' }}</li>
                                        <li>장소 : {{ $row->place ?? '' }}</li>
                                        <li>사전등록 마감일 : <span class="date">{{ $row->regist_edate ?? '' }}{{ formatKoreanDate($row->regist_edate) }}</span></li>
                                    </ul>
                                    <div class="btn-wrap">
                                        <a href="{{ route('workshop.detail',['wsid'=>$row->sid]) }}" class="btn btn-type1 btn-line color-type9">+ 상세보기</a>

                                        <a href="{{ route('registration',['wsid'=>$row->sid]) }}" class="btn btn-type1 color-type11">사전등록</a>

                                        <a href="{{ route('registration.search',['wsid'=>$row->sid]) }}" class="btn btn-type1 color-type9">사전등록 확인 및 영수증 출력</a>
                                        <a href="{{ route('lecture',['wsid'=>$row->sid]) }}" class="btn btn-type1 color-type6">강의원고 보기</a>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <!-- no data -->
                            <li class="no-data text-center">
                                진행 중인 행사가 없습니다.
                            </li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="ev-list-wrap end">
                        <div class="ev-list-tit">
                            <img src="/assets/image/sub/ic_ev_tit.png" alt=""> 지난 행사
                        </div>
                        <ul class="ev-list ev-list-type2">
                            @forelse($list as $row)
                            <li data-sid="{{ $row->sid }}">
                                <div class="ev-tit">
                                    <span>{{ $row->title ?? '' }}</span>

                                    @if(isAdmin())
                                        <div class="bbs-admin">
                                            <select name="" id="" class="form-item hide-select">
                                                <option value="Y" {{ 'Y' == ($row->hide ?? '') ? 'selected' : '' }}>설정중</option>
                                                <option value="N" {{ 'N' == ($row->hide ?? '') ? 'selected' : '' }}>공개</option>
                                            </select>
                                            <a href="{{ route('workshop.upsert',['sid'=>$row->sid]) }}" class="btn btn-modify call-popup" data-name="new-workshop-upsert" data-width="850" data-height="900"><span class="hide">수정</span></a>
                                            <a href="javascript:;" class="btn btn-delete board-delete"><span class="hide">삭제</span></a>
                                        </div>
                                    @endif
                                </div>
                                <div class="ev-con">
                                    <ul class="list-type list-type-dot">
                                        <li>행사일 : {{ $row->event_sdate ?? '' }}{{ formatKoreanDate($row->event_sdate) }} {{ ($row->date_type ?? '') == 'L' ? ' ~ '.$row->event_edate.formatKoreanDate($row->event_edate) : '' }}</li>
                                        @if(!empty($row->place))
                                        <li>장소 : {{ $row->place ?? '' }}</li>
                                        @endif
                                        @if( ($row->regist_use ?? '') == 'Y')
                                        <li>사전등록 마감일 : <span class="date">{{ $row->regist_edate ?? '' }}{{ formatKoreanDate($row->regist_edate) }}</span></li>
                                        @endif
                                    </ul>
                                    <div class="btn-wrap">
                                        <a href="{{ route('workshop.detail',['wsid'=>$row->sid]) }}" class="btn btn-type1 btn-line color-type9">+ 상세보기</a>
                                        @if( ($row->regist_use ?? '') == 'Y')
                                        <a href="{{ route('registration.search',['wsid'=>$row->sid]) }}" class="btn btn-type1 color-type9">사전등록 확인 및 영수증 출력</a>
                                        @endif
                                        <a href="{{ route('lecture',['wsid'=>$row->sid]) }}" class="btn btn-type1 color-type6">강의원고 보기</a>
                                    </div>
                                </div>
                            </li>
                            @empty
                                <!-- no data -->
                                <li class="no-data text-center">
                                    진행 중인 행사가 없습니다.
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="paging-wrap">
                        {{ $list->links('pagination::custom') }}
                    </div>

                </div>
            </div>
        </article>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('workshop.data') }}';
        const boardForm = '#board-frm';

        const getPK = (_this) => {
            return $(_this).closest('li').data('sid');
        }
    </script>

    <script>
        $(document).on('change', '.hide-select', function() {
            console.log('hi');
            const ajaxData = {
                case: 'db-change',
                sid: getPK(this),
                field: 'hide',
                value: $(this).val(),
            }

            callAjax(dataUrl, ajaxData);
        });

        $(document).on('click', '.board-delete', function() {
            const ajaxData = {
                case: 'workshop-delete',
                sid: getPK(this),
            }

            if (confirm('삭제 시 등록된 DB 모두 삭제 되며 복구 불가능 합니다.')) {
                callAjax(dataUrl, ajaxData);
            }
        });
    </script>
@endsection
