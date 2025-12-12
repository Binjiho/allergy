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
                        <li class="{{ (request()->tab ?? '') == '' ? 'on' : '' }}"><a href="{{ route('intro.branch') }}">현 임원진</a></li>
                        <li class="{{ (request()->tab ?? '') == '2' ? 'on' : '' }}"><a href="{{ route('intro.branch',['tab'=>2]) }}">역대 임원진</a></li>
                        <li class=""><a href="{{ route('board',['code'=>'branch']) }}">게시판</a></li>
                    </ul>
                </div>

                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">지회</caption>
                        <colgroup>
                            <col style="width: 25%">
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                            <tr class="active">
                                <th scope="col">지회</th>
                                <th scope="col">지회장</th>
                                <th scope="col">총무</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">서울</th>
                                <td>심정연 (성균관의대 소아청소년과)</td>
                                <td>이화영 (가톨릭의대 내과)</td>
                            </tr>
                            <tr>
                                <th scope="row">경기, 인천</th>
                                <td>김선태 (가천의대 이비인후과)</td>
                                <td>이용원 (가톨릭관동의대 내과)</td>
                            </tr>
                            <tr>
                                <th scope="row">강원</th>
                                <td>김봉성 (울산의대 소아청소년과)</td>
                                <td>이지호 (연세원주의대 내과)</td>
                            </tr>
                            <tr>
                                <th scope="row">부산, 경남</th>
                                <td>조규섭 (부산의대 이비인후과)</td>
                                <td>이승은 (부산의대 내과)</td>
                            </tr>
                            <tr>
                                <th scope="row">대구, 경북</th>
                                <td>서영익 (성누가종합내과외과의원)</td>
                                <td>정지웅 (경북의대 내과)</td>
                            </tr>
                            <tr>
                                <th scope="row">전북</th>
                                <td>이용철 (전북의대 내과)</td>
                                <td>김소리 (전북의대 내과)</td>
                            </tr>
                            <tr>
                                <th scope="row">광주, 전남</th>
                                <td>김원영 (우리들내과의원)</td>
                                <td>고영일 (전남의대 내과)</td>
                            </tr>
                            <tr>
                                <th scope="row">충청</th>
                                <td>지영구 (단국의대 내과)</td>
                                <td>이상민 (단국의대 내과)</td>
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
