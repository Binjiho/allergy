@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/guide/assets/css/board.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="journal-conbox guideline-conbox">
                <div class="btn-wrap text-right mt-0">
                    <a href="#pop-sch-info" class="btn btn-type1 btn-round color-type1 js-pop-open">개발규정 <span class="icon"><img src="/assets/image/sub/ic_btn_info.png" alt=""></span></a>
                    <a href="/assets/file/진료지침_개발 규정.docx" class="btn btn-type1 btn-round color-type8" traget="_blank" download>개발 규정 다운로드 <span class="icon"><img src="/assets/image/sub/ic_btn_download03.png" alt=""></span></a>
					<a href="/assets/file/진료지침_개발 규정 부록.docx" class="btn btn-type1 btn-round color-type5" traget="_blank" download>개발 규정 부록 다운로드 <span class="icon"><img src="/assets/image/sub/ic_btn_download04.png" alt=""></span></a>
                    <!-- <a href="/assets/flie/진료지침_개발 규정 부록.docx" class="btn btn-type1 btn-round color-type5" traget="_blank" download>개발 규정 부록 다운로드 <span class="icon"><img src="/assets/image/sub/ic_btn_download04.png" alt=""></span></a> -->
                </div>

                <!-- s:board -->
                <form id="bbsSearch" action="{{ route('board', ['code' => $code]) }}" method="get">
                    <input type="hidden" name="gubun" value="{{ request()->gubun ?? 1 }}" readonly>

                <div class="board-cate-wrap">
                    <button type="button" class="btn btn-tab-menu js-btn-tab-menu">전체</button>
                    <ul class="board-cate-menu">
                        <li class="all">
                            <label for="field_ALL"><input type="checkbox" name="field[]" id="field_ALL" value="ALL" {{ !empty(request()->field) && in_array( 'ALL', request()->field) ? 'checked' : '' }}>전체</label>
                        </li>

                        @foreach($boardConfig['field'] as $key => $val)
                        <li>
                            <label for="field_{{ $key }}"><input type="checkbox" name="field[]" value="{{ $key }}" id="field_{{ $key }}" {{ !empty(request()->field) && in_array( $key, request()->field) ? 'checked' : '' }}>{{ $val }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div id="board" class="board-wrap">
                    <div class="sch-wrap">

                            <input type="hidden" name="gubun" value="{{ request()->gubun ?? '1' }}" readonly>
                            <fieldset>
                                <legend class="hide">검색</legend>
                                <div class="form-group">
                                    <select name="year" id="year" class="form-item sch-cate">
                                        <option value="">연도 전체</option>
                                        @foreach($boardConfig['year'] as $key => $val)
                                            <option value="{{ $key }}" {{ ((request()->year ?? '') == $key) ? 'selected'  : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <select name="search" id="search" class="form-item sch-cate">
                                        <option value="ALL">전체</option>
                                        @foreach($boardConfig['search'] as $key => $val)
                                            <option value="{{ $key }}" {{ ((request()->search ?? '') == $key) ? 'selected'  : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="keyword" id="keyword" class="form-item sch-key" placeholder="검색어를 입력하세요." value="{{ request()->keyword ?? '' }}">
                                    <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                                    <a href="{{ route('board', ['code' => $code, 'gubun'=>request()->gubun ?? '1']) }}"  class="btn btn-reset" style="align-content:center;">검색 초기화</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <ul class="board-list">
                        <li class="list-head">
                            <div class="bbs-no bbs-col-xs n-bar">번호</div>
{{--                            <div class="bbs-col-s n-bar">연도</div>--}}
                            <div class="bbs-col-m">분야</div>
                            <div class="bbs-tit n-bar">진료지침/전문가 의견서</div>
{{--                            <div class="bbs-link bbs-col-xs n-bar">링크</div>--}}
{{--                            <div class="bbs-file bbs-col-xs">파일</div>--}}
                            @if(isAdmin())
                            <div class="bbs-admin bbs-col-s">관리</div>
                            @endif
                        </li>

                        @forelse($list ?? [] as $row)
                        <li data-sid="{{ $row->sid }}">
                            <div class="bbs-no bbs-col-xs n-bar">
                                {{ $row->seq }}
                            </div>
{{--                            <div class="bbs-col-s n-bar">--}}
{{--                                {{ $row->year ?? '' }}--}}
{{--                            </div>--}}
                            <div class="bbs-col-m">
                                @php
                                    $field_arr = $field_str = array();
                                    $field_arr = explode(',', $row->field);
                                    foreach ($field_arr as $val){
                                        $field_str[] = $boardConfig['field'][$val];
                                    }
                                @endphp
                                {{ implode(',', $field_str) }}
                            </div>
                            <div class="bbs-tit n-bar">
                                <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid, 'gubun'=>request()->gubun ?? '1']) }}" class="ellipsis">{{ $row->subject ?? '' }}</a>
                            </div>
{{--                            <div class="bbs-link bbs-col-xs n-bar">--}}
{{--                                @if(!empty($row->link_url) )--}}
{{--                                    @if(($row->link_type ?? '') == '1')--}}
{{--                                        <a href="{{ $row->link_url ?? '' }}" target="_blank" ><img src="{{ asset('/html/bbs/guide/assets/image/board/ic_link.png') }}" alt=""></a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{ $row->link_url ?? '' }}" target="_blank" ><img src="{{ asset('/html/bbs/guide/assets/image/board/ic_video.png') }}" alt=""></a>--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="bbs-file bbs-col-xs">--}}
{{--                                @if(!empty($row->realfile1) )--}}
{{--                                    <a href="{{ $row->downloadUrl('1') }}" target="_blank" ><img src="{{ asset('/html/bbs/guide/assets/image/board/ic_attach_file.png') }}" alt=""></a>--}}
{{--                                @endif--}}

{{--                            </div>--}}
                            @if(isAdmin())
                            <div class="bbs-admin bbs-col-s">
                                <div class="btn-admin">
                                    <a href="{{ route('board.upsert', ['code' => $row->code, 'sid' => $row->sid, 'gubun'=>request()->gubun ?? '1']) }}" class="btn btn-modify"><span class="hide">수정</span></a>
                                    <a href="javascript:void(0);" class="btn btn-delete"><span class="hide">삭제</span></a>
                                </div>
                            </div>
                            @endif
                        </li>
                        @empty
                        <!-- no data -->
                        <li class="no-data text-center">
                            등록된 게시글이 없습니다.
                        </li>
                        @endforelse
                    </ul>

                    @if(isAdmin())
                        <div class="btn-wrap text-right">
                            <a href="{{ route('board.upsert', ['code' => $code, 'gubun'=>request()->gubun ?? '1']) }}" class="btn btn-board btn-write">등록</a>
                        </div>
                    @endif

                    {{ $list->links('pagination::custom') }}
                </div>
                <!-- //e:board -->
            </div>
        </div>
    </article>

    <!-- s:개발규정 popup -->
    <div class="popup-wrap dim-click" id="pop-sch-info" style="display: none;">
        <div class="popup-contents">
            <div class="popup-conbox">
                <div class="popup-contit-wrap">
                    <h4 class="popup-contit">개발 규정 <img src="/assets/image/sub/ic_popup_info02.png" alt=""></h4>
                </div>
                <div class="term-wrap scroll-y">
                    <strong class="term-tit mt-0">제1조 (목적과 범위)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>본 규정은 대한천식알레르기학회(이하 학회) 진료지침 등 공식문건(official document, 이하 문건)과 자료의 개발과 승인, 출간, 활용에 대한 여러 사항을 규정하는 것을 목적으로 한다.</li>
                        <li>학회에서 독자 개발하는 경우 외에 다른 학회, 조직과 함께 개발하는 문건 및 자료 모두 이 규정을 따르도록 한다.</li>
                    </ol>

                    <strong class="term-tit">제2조 (진료지침위원회)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>
                            본 규정에서 다루는 문건의 제안서 검토와 심사, 개발지원, 최종원고 심사 등은 진료지침위원회에서 담당한다.
                        </li>
                        <li>
                            진료지침이사는 위원회를 구성, 운영하며 이사회에 문건과 관련한 진행상황을 보고하고 타 위원회 또는 이사와 협력하여 업무를 수행한다.
                        </li>
                    </ol>

                    <strong class="term-tit">제3조 (문건의 분류)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>학회 공식문건은 진료지침(guideline), 의견서(statement), 기타 자료로 구분한다.</li>
                        <li>기타 자료는 학회 진료지침과 의견서, 교과서 등을 바탕으로 지침의 확산과 보급을 위하여 의료인 또는 환자, 일반인 대상으로 한 교육 및 홍보자료(강의자료, 슬라이드, 동영상, 애니메이션, 리플렛, 책자 등)를 지칭하며 진료지침의 이차 자료가 아닌 학회 공인 교육자료도 포함한다.</li>
                    </ol>

                    <div class="table-contop mt-20">표1. 학회 공식문건과 자료의 분류</div>
                    <div class="table-wrap scroll-x touch-help mt-10">
                        <table class="cst-table">
                            <caption class="hide">표1. 학회 공식문건과 자료의 분류</caption>
                            <colgroup>
                                <col style="width: 22%;">
                                <col>
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th scope="col">명칭(국문)</th>
                                <th scope="col">진료지침</th>
                                <th scope="col">의견서</th>
                                <th scope="col">기타 자료</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>명칭(영문)</td>
                                <td>Guideline</td>
                                <td>Statement (or consensus document)</td>
                                <td>Other materials</td>
                            </tr>
                            <tr>
                                <td>내용</td>
                                <td>질환이나 특정상황에 대한 전반적인 내용</td>
                                <td>진료지침보다 세부적인 내용 진단, 검사, 치료, 예방 등 특정 주제에 국한 정책, 연구 등에 대한 의견 기술적 표준화</td>
                                <td>강의 자료 슬라이드 동영상, 에니메이션(흡입기 사용설명 등) 리플렛/책자</td>
                            </tr>
                            <tr>
                                <td>GRADE 적용</td>
                                <td>권고</td>
                                <td>권고</td>
                                <td>해당 없음</td>
                            </tr>
                            <tr>
                                <td>개발기한</td>
                                <td>2년</td>
                                <td>1년</td>
                                <td>해당 없음</td>
                            </tr>
                            <tr>
                                <td>보급과 확산을 위한 이차자료 개발</td>
                                <td>권고</td>
                                <td>권고</td>
                                <td>해당 없음</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <strong class="term-tit">제4조 (개발 제안)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>
                            문건개발 제안서(부록1)는 연1회 학회 사무국을 통하여 접수한다. 학회사무국은 홈페이지 공지사항과 학회원 메일을 통하여 제안서 접수기한과 방법을 공지한다.
                        </li>
                        <li>
                            공식문건 제정이 긴급한 경우 진료지침위원회 위원을 통하여 제안할 수 있고 위원회 심사와 이사회 승인 이후 개발 절차를 진행할 수 있다.
                        </li>
                        <li>
                            학회의 워크그룹(연구팀), 지회, 위원회, 개인 모두 제안 자격을 가진다.
                        </li>
                        <li>
                            제안서 제출시 개발팀(Task Force, TF)을 구성한 후 제안서를 제출할 것을 권고한다.
                        </li>
                        <li>
                            개발하려는 문건의 주제와 관련이 있는 학회 워크그룹(연구팀), 지회, 위원회가 있는 경우에는 제안서 제출 전 해당 단체와 협의 후 제출할 것을 권고한다.
                        </li>
                        <li>
                            이사회에서 문건 개발이 필요하다고 결정된 주제는 진료지침이사가 해당 주제 전문가에 연락하여 TF 팀을 구성한 후 제안서를 제출하도록 한다.
                        </li>
                        <li>
                            제출된 제안서는 사무국과 진료지침이사가 사전 검토하고 내용이 충분하지 않은 경우 수정하여 제출하도록 권고할 수 있다.
                        </li>
                    </ol>

                    <strong class="term-tit">제5조 (제안서 심사와 승인)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>접수된 제안서는 진료지침위원회에서 심사하고 심사 의견과 채택 여부에 대한 권고 의견을 이사회에 제출한다. 이사회에서는 제안서 채택, TF 승인, 지원 예산을 최종 결정한다.</li>
                        <li>진료지침이사는 이사회 권고 의견 제출 전 총무이사, 간행이사, 관련 워크그룹(연구팀) 등 관계부서(단체)와 협의과정을 거치고 협의 의견을 첨부하여 이사회에 제출한다.</li>
                        <li>이사회는 제안서 접수마감 후 4개월 이내에 제안서 채택 여부를 최종 결정하고 사무국은 제안자에게 결정사항을 메일로 회신하도록 한다.</li>
                    </ol>

                    <strong class="term-tit">제6조 (개발과정)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>
                            TF 팀장은 제안서 승인 4주 이내에 팀원을 구성하고 개시모임을 개최한다. 개시모임에는 TF 팀원과 진료지침위원회 위원이 참여한다.
                        </li>
                        <li>
                            TF 팀장은 TF팀을 조직, 운영하고 문건을 기한 내에 윤리적이고 합리적으로 개발할 의무가 있다.
                        </li>
                        <li>
                            TF 팀장은 제안서 승인 4주 이내에 개발에 참여하는 모든 팀원의 비밀유지와 이해상충 서약서(부록2)를 받아 진료지침위원회에 제출한다.
                        </li>
                        <li>
                            TF 팀장은 제안서 승인 후 1년마다 개발 진행에 대해 연간 보고서(부록3)를, 그리고 개발 완료 후 최종보고서를 제출하고 진료지침위원회에서 심사한다.
                        </li>
                        <li>
                            TF 팀장은 개발과정 중 제안서의 내용, 기한, 예산 등 변경이 필요한 경우 진료지침위원회와 협의하고 승인을 받아 진행한다.
                        </li>
                        <li>
                            진료지침이사는 TF 팀장에게 문건개발 진행상황을 보고 요청하고 확인할 수 있다. 문제점이 있을 경우 이사회에 보고한다. 중대한 규정위반이 확인된 경우 이사회는 TF 해산 또는 지원중지를 결정할 수 있다.
                        </li>
                    </ol>

                    <strong class="term-tit">제7조 (승인과 논문 투고)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>개발이 완료된 문건은 진료지침위원회에서 심사하고 제목과 내용에 대한 심사의견을 TF 팀에 회신하여 반영하도록 한다.</li>
                        <li>진료지침이사는 문건 심사 의견과 채택여부에 대한 권고 의견을 이사회에 제출한다. 이사회에서는 학회 공식문건으로 승인 여부를 최종결정한다.</li>
                        <li>이사회 승인을 받은 문건만이 저널 투고와 출간이 가능하다.</li>
                        <li>투고 문건은 국문의 경우 “대한천식알레르기학회 진료지침” 또는 “대한천식알레르기학회 의견서”라고 표기하고 영문의 경우 “the KAAACI guideline” 또는 “the KAAACI statement (or consensus document)”라고 표기한다. 제목 변경이 필요한 경우 진료지침위원회와 협의한다.</li>
						<li>
							학회에서 지원을 받아 발간하는 진료지침/가이드라인에 지원과 관련하여 다음을 그대로 혹은 알맞게 변형하여 사용하길 권한다.<br>
							- 영문<br>
							&nbsp;This guideline was supported by the Korean Academy of Asthma, Allergy and Clinical Immunology (KAAACI).<br>
							- 국문<br>
							&nbsp;이 지침은 대한천식알레르기학회의 지원으로 개발되었습니다.
						</li>
						<li>
							이사회의 승인을 받은 진료지침/가이드라인은 공식문건임을 입증하기 위해 하기 문구를 적용할 수 있다.<br>
							- 영문<br>
							&nbsp;This guideline has been officially reviewed and endorsed by KAAACI and reflects the official position of the Academy.<br>
							- 국문<br>
							&nbsp;이 지침은 대한천식알레르기학회의 심의와 이사회 승인을 거쳐 공식 채택되었으며, 학회의 공식 입장을 반영합니다.
						</li>
                        <li>저자 리스트와 순서는 TF 위원의 의견을 수렴하여 TF 팀장이 결정한다. 필요시 워크그룹(연구팀), 지회, 위원회의 이름을 넣을 수 있다.</li>
                        <li>투고 문건의 최종 게재 승인 여부는 AAIR와 AARD 편집자의 결정에 따른다.</li>
                        <li>AAIR와 AARD, 또는 다른 학회지에 중복게재가 필요한 경우 진료지침이사와 간행이사에게 보고하고 승인된 경우 이중 투고가 가능하다. AAIR와 AARD 중복게재 최종 승인여부는 AAIR와 AARD 편집자의 결정에 따른다.</li>
                    </ol>

                    <strong class="term-tit">제8조 (공동개발 문건)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>다른 학회 또는 조직과 공동으로 문건을 개발하는 경우 진료지침이사가 본 학회 개발 담당자를 선임하여 제안서를 제출하도록 한다. 진료지침위원회에서 검토된 심사의견은 관련 이사, 워크그룹(연구팀) 의견을 첨부하여 이사회에 제출하고 이사회는 진행여부를 최종 결정한다. </li>
                        <li>학회를 대표하여 참여하는 개발 담당자는 TF 구성 등 진행상황을 진료지침이사에게 보고하고 상의하여야 한다.</li>
                        <li>타 학회와 공동으로 개발한 문건은 진료지침위원회에서 심사하고 심사의견과 채택여부에 대한 권고의견을 이사회에 제출한다. 이사회에서는 학회 공식문건으로 승인여부를 최종결정한다.</li>
                        <li>문건과 논문의 제목과 학회 표기 등은 타 학회와 조율하여 이사회에서 최종 결정한다.</li>
                    </ol>

					<strong class="term-tit">제9조 (외부 개발 지침의 검토와 승인)</strong>
					<ol class="list-type list-type-decimal">
						<li>국내 혹은 국외 타 학회에서 이미 개발되어 검토를 요청받은 지침의 승인은 진료지침이사가 본 학회의 관련 분야 담당자(예: 관련이사, 연구팀[워크그룹])를 선임하여 검토를 요청하도록 한다. 검토된 심사의견은 진료지침이사가 이사회에 제출하고, 이사회는 승인 여부를 최종 결정한다.</li>
						<li>검토 의견이 승인이 아닌 경우, 진료지침이사는 해당 의견에 대해 이사회 전에 각 이사들에게 메일로 사전 회람한다.</li>
						<li>승인으로 최종 결정된 지침이나 의견서는 진료지침위원회에서 작성하되, 사무국에서 직인 및 공식 문건으로 만들어 최종 회신한다.</li>
					</ol>

                    <strong class="term-tit">제10조 (활용과 보급)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>문건 개발 시 학회 진료지침과 의견서를 바탕으로 지침의 확산과 보급을 위한 교육 및 홍보자료(강의자료, 슬라이드, 동영상, 애니메이션, 리플렛, 책자 등)의 개발을 권고한다. TF 제안서에 제작여부를 포함하여 제안하도록 하며 문건 개발 이후 계획이 수정 변경되는 경우 진료지침위원회에서 심의한다.</li>
                        <li>저널에 게시된 논문 자료를 바탕으로 한 이차 자료(강의자료, 슬라이드, 동영상, 애니메이션, 리플렛, 책자 등)는 해당 저널의 승인을 얻어 제작한다.</li>
                        <li>진료지침과 이차 자료는 학회 홈페이지에 게시하고 인쇄물을 제작하여 활용할 수 있다.</li>
                        <li>외부 기관이나 회사에서 진료지침과 이차 자료 활용을 요청하는 경우 활용계획서를 받아 진료지침위원회에서 심사 후 이사회에서 최종 승인여부를 결정한다. 단 저널에 게재된 논문을 활용하는 경우 해당 저널에도 사용에 대한 승인을 받아야 한다.</li>
                    </ol>

                    <strong class="term-tit">제11조 (부칙)</strong>
                    <ol class="list-type list-type-decimal">
                        <li>본 규정은 2025년 12월 4일 이사회 승인을 받은 날부터 유효하다.</li>
                    </ol>
                </div>
            </div>
            <button type="button" class="btn btn-pop-close js-pop-close">
                <span class="hide">팝업 닫기</span>
            </button>
        </div>
    </div>
    <!-- //e:개발규정 popup -->
@endsection

@section('addScript')
    @include("board.default-script")

    <script>
        $(document).on('change', '#field_ALL', function () {
            // "전체" 체크박스 클릭 시 나머지 전부 체크/해제
            const isChecked = $(this).is(':checked');
            $("input[name='field[]']").not('#field_ALL').prop('checked', isChecked);

            goUrl();
        });

        $(document).on('change', "input[name='field[]']", function () {
            if ($(this).attr('id') === 'field_ALL') return;

            const total = $("input[name='field[]']").not('#field_ALL').length;
            const checked = $("input[name='field[]']:checked").not('#field_ALL').length;

            $('#field_ALL').prop('checked', total === checked);

            goUrl();
        });

        function goUrl()
        {
            // 1. 기본 URL: /board/notice?category=xxx 등등 'page'는 빠짐
            const baseUrl = "{{ route('board', ['code' => $code]) }}";
            const baseQuery = `{!! http_build_query(request()->except(['page', 'field'])) !!}`; // 기존 field 빼고 유지

            const _checked = $("input[name='field[]']:checked")
                .map(function () {
                    return 'field[]=' + encodeURIComponent($(this).val());
                }).get().join('&');

            const query = [baseQuery, _checked].filter(Boolean).join('&'); // 둘 다 있을 경우 &로 붙이기

            location.href = baseUrl + (query ? '?' + query : '');
        }

        function buildQueryString(params) {
            return Object.entries(params)
                .map(([key, val]) => {
                    if (Array.isArray(val)) {
                        return val.map(v => `${encodeURIComponent(key)}[]=${encodeURIComponent(v)}`).join('&');
                    } else {
                        return `${encodeURIComponent(key)}=${encodeURIComponent(val)}`;
                    }
                })
                .join('&');
        }
    </script>

    @if(isAdmin())
        <script>
            $(document).on('change', 'select[name=hide]', function() {
                const ajaxData = {
                    case: 'db-change',
                    sid: getPK(this),
                    column: 'hide',
                    value: $(this).val(),
                }

                callAjax(dataUrl, ajaxData);
            });

            $(document).on('click', '.btn-delete', function() {
                const ajaxData = {
                    case: 'board-delete',
                    sid: getPK(this),
                    gubun: '{{ request()->gubun ?? 1 }}',
                }

                if (confirm('삭제 하시겠습니까?')) {
                    callAjax(dataUrl, ajaxData);
                }
            });
        </script>
    @endif
@endsection
