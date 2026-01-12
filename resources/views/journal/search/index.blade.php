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
                    <a href="#pop-sch-info" class="btn btn-type1 btn-round color-type1 js-pop-open">논문 검색 방법 <span class="icon"><img src="/assets/image/sub/ic_sch_info.png" alt=""></span></a>
                </div>
                <div class="sch-form-wrap journal-sch-form">
                    <form id="searchF" name="searchF" action="{{ route('journal.asSearchList') }}">
                        <fieldset>
                            <legend class="hide">논문검색</legend>
                            <div class="table-wrap">
                                <table class="cst-table sch-table">
                                    <caption class="hide">논문검색</caption>
                                    <colgroup>
                                        <col style="width: 15%;">
                                        <col>
                                        <col style="width: 15%;">
                                        <col style="width: 27%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">검색대상</th>
                                        <th scope="col">검색어</th>
                                        <th scope="col">연결</th>
                                        <th scope="col">추가/삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <div class="search_div">

                                        <tr class="search_tr">
                                            <td class="text-left">
                                                <select name="search[]" id="search1" class="form-item">
                                                    <option value="title" {{ (request()->search1 ?? '') == 'title' ? 'selected' : '' }}>Title</option>
                                                    <option value="author" {{ (request()->search1 ?? '') == 'author' ? 'selected' : '' }}>Author</option>
                                                    <option value="keywords" {{ (request()->search1 ?? '') == 'keywords' ? 'selected' : '' }}>Keywords</option>
                                                    <option value="abstract" {{ (request()->search1 ?? '') == 'abstract' ? 'selected' : '' }}>Abstract</option>
                                                </select>

                                            </td>
                                            <td class="text-left">
                                                <input type="text" name="keyword[]" id="keyword1" value="{{ request()->keyword1 ?? '' }}" class="form-item">
                                            </td>
                                            <td >
                                                <div class="radio-wrap cst text-center and_div" style="display:none;">
                                                    <label for="and1_1" class="radio-group"><input type="radio" name="and1" id="and1_1" value="and" {{ (request()->and1 ?? '') == 'and' ? 'selected' : '' }}>AND</label>
                                                    <label for="and1_2" class="radio-group"><input type="radio" name="and1" id="and1_2" value="or" {{ (request()->and1 ?? '') == 'or' ? 'selected' : '' }}>OR</label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-small color-type10 add">추가</a>
                                                <a href="javascript:;" class="btn btn-small color-type7 del">삭제</a>
                                            </td>
                                        </tr>

                                    </div>

                                    <tr>
                                        <th scope="row">발행연도</th>
                                        <td class="text-left">
                                            <div class="form-group n2">
                                                <input type="text" name="sdate" id="sdate" class="form-item" datepicker>
                                                <input type="text" name="edate" id="edate" class="form-item" datepicker>
                                            </div>
                                        </td>
                                        <th scope="row">리스트 갯수</th>
                                        <td>
                                            <div class="radio-wrap cst">
                                                <label for="li_page_1" class="radio-group"><input type="radio" name="li_page" id="li_page_1" value="10">10건</label>
                                                <label for="li_page_2" class="radio-group"><input type="radio" name="li_page" id="li_page_2" value="20">20건</label>
                                                <label for="li_page_3" class="radio-group"><input type="radio" name="li_page" id="li_page_3" value="30">30건</label>
                                                <label for="li_page_4" class="radio-group"><input type="radio" name="li_page" id="li_page_4" value="40">40건</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">출력결과</th>
                                        <td class="text-left">
                                            <div class="checkbox-wrap cst">
                                                <label for="chk4_1" class="checkbox-group"><input type="checkbox" name="show_list[]" value="subject" id="chk4_1" checked disabled>제목</label>
                                                <label for="chk4_2" class="checkbox-group"><input type="checkbox" name="show_list[]" value="author" id="chk4_2">저자</label>
                                                <label for="chk4_3" class="checkbox-group"><input type="checkbox" name="show_list[]" value="sosok" id="chk4_3">소속</label>
                                                <label for="chk4_4" class="checkbox-group"><input type="checkbox" name="show_list[]" value="keywords" id="chk4_4">키워드</label>
                                                <label for="chk4_5" class="checkbox-group"><input type="checkbox" name="show_list[]" value="abstract" id="chk4_5">초록</label>
                                                <label for="chk4_6" class="checkbox-group"><input type="checkbox" name="show_list[]" value="publisher" id="chk4_6">학회지명 및 출판 정보</label>
                                            </div>
                                        </td>
                                        <th scope="row">정렬기준</th>
                                        <td class="text-left">
                                            <select name="orderby" id="orderby" class="form-item">
                                                <option value="published_at">발행연도</option>
                                                <option value="subject_kr">제목</option>
                                                <option value="author_kr">저자명</option>
                                            </select>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="btn-wrap text-center">
                                <button type="submit" class="btn btn-type1 btn-sch">
                                    <span class="icon"><img src="/assets/image/sub/ic_btn_sch.png" alt=""></span> 검색
                                </button>
                                <button type="reset" class="btn btn-type1 btn-reset">초기화</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </article>

    <!-- s:논문 검색 방법 popup -->
    <div class="popup-wrap" id="pop-sch-info" style="display: none;">
        <div class="popup-contents">
            <div class="popup-conbox">
                <div class="popup-contit-wrap">
                    <h4 class="popup-contit">논문 검색 방법 <img src="/assets/image/sub/ic_popup_info.png" alt=""></h4>
                </div>
                <ul class="list-type list-type-bar">
                    <li>
                        학회지 목록을 선택하고 "권호수별 검색" 버튼을 클릭하면 권호수별 리스트가 출력 됩니다.
                    </li>
                    <li>
                        "권호수별 검색"에서는 "키워드검색"을 클릭하면 키워드검색으로 이동합니다.
                    </li>
                    <li>
                        검색어에서는 "제목, 저자, 키워드, 초록"을 이용하여 검색 하실 수 있습니다.
                    </li>
                    <li>
                        출력갯수를 환경에 맞게 설정하여 검색결과를 보실 수 있습니다.
                    </li>
                    <li>
                        발행년도를 선택하여 출력할 수 있습니다.
                    </li>
                    <li>
                        출력결과에 나올 항목을 임의로 설정하실 수 있습니다. 단 제목은 항상 출력 됩니다.
                    </li>
                    <li>
                        발행년도, 제목, 저자명 순으로 정렬 할 수 있습니다.
                    </li>

                </ul>
            </div>
            <button type="button" class="btn btn-pop-close js-pop-close">
                <span class="hide">팝업 닫기</span>
            </button>
        </div>
    </div>
    <!-- //e:논문 검색 방법 popup -->
@endsection

@section('addScript')
<script>
    const dataUrl = '{{ route('journal.data') }}';

    $(document).on('click','.del', function(){
        const _tr_cnt = $(".search_tr").length;

        if(_tr_cnt < 2){
            alert("더 이상 삭제할 수 없습니다.");
            return false;
        }

        $(this).closest('.search_tr').remove();
        $(".search_tr").last().find(".and_div").hide();
    });

    $(document).on('click','.add', function(){
        const _tr_cnt = $(".search_tr").length;

        if(_tr_cnt > 3){
            alert("더 이상 추가할 수 없습니다.");
            return false;
        }

        callAjax(dataUrl, {
            'case': 'add-search',
            'eq': (_tr_cnt + 1),
        });
    });

</script>

@endsection
