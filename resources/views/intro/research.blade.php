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

                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">연구팀</caption>
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 20%;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
								<th scope="row" rowspan="2">난치성 아토피피부염</th>
								<td>팀장</td>
								<td class="text-left">이동훈 (서울의대 피부과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">이영수 (아주의대 내과)</td>
							</tr>

							<tr>
								<th scope="row" rowspan="2">약물알레르기</th>
								<td>팀장</td>
								<td class="text-left">김소리 (전북의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">심다운 (전남의대 내과)</td>
							</tr>

							<tr>
								<th scope="row" rowspan="4">면역요법/알레르겐</th>
								<td>팀장</td>
								<td class="text-left">신유섭 (아주의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">정수지 (한림의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">류광희 (성균관대 이비인후과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">김주희 (차의대 소아청소년과)</td>
							</tr>

							<tr>
								<th scope="row" rowspan="2">중증천식</th>
								<td>팀장</td>
								<td class="text-left">박흥우 (서울의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">김주희 (한림의대 내과)</td>
							</tr>

							<tr>
								<th scope="row" rowspan="2">두드러기/혈관부종/아나필락시스</th>
								<td>팀장</td>
								<td class="text-left">최정희 (한림의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">반가영 (한림의대 내과)</td>
							</tr>

							<tr>
								<th scope="row" rowspan="2">만성 기침</th>
								<td>팀장</td>
								<td class="text-left">송우정 (울산의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">이화영 (가톨릭의대 내과)</td>
							</tr>

							<tr>
								<th scope="row" rowspan="4">비염</th>
								<td>팀장</td>
								<td class="text-left">이상민 (단국의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">김미애 (차의대 내과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">이일환 (한림의대 이비인후과)</td>
							</tr>
							<tr>
								<td>간사</td>
								<td class="text-left">양송이 (한림의대 소아청소년과)</td>
							</tr>

							<tr>
								<th scope="row" rowspan="3">호산구/면역질환</th>
								<td>팀장</td>
								<td class="text-left">양민석 (보라매병원 내과)</td>
							</tr>
							<tr>
								<td>호산구 간사</td>
								<td class="text-left">강노을 (성균관의대 내과)</td>
							</tr>
							<tr>
								<td>면역 간사</td>
								<td class="text-left">장재혁 (아주의대 내과)</td>
							</tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
