@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="mem-sch-conbox">
                <div class="bg-box">
                    <img src="/assets/image/sub/img_member_search.png" alt="">
                    <div class="text-wrap">
                        <ul class="list-type list-type-dot">
                            <li>
                                검색하고자 하는 회원의 검색조건을 선택한 후, 검색어를 입력한 다음 검색버튼을 클릭하시면 검색결과를 보실 수 있습니다.
                            </li>
                            <li>
                                검색어 전체가 생각이 안나시면 부분검색도 가능합니다.
                            </li>
                            <li>
                                성명, 출신의과대학, 근무처명 중 원하시는 항목만으로 검색이 가능합니다.
                            </li>
                            <li>
                                원하시는 검색조건을 선택하신 후 '찾아보기' 버튼을 클릭해 주십시오.
                            </li>
                            <li>
                                대한천식알레르기학회 홈페이지 가입 회원에 한해서만 검색이 됩니다.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="sch-wrap">
                    <form id="searchF" name="searchF" action="{{ route('mypage.member_search') }}">
                        <fieldset>
                            <legend class="hide">검색</legend>
                            <div class="form-group">
                                <select name="search" id="search" class="form-item sch-cate">
                                    <option value="name_kr" {{ (request()->search ?? '') == 'name_kr' ? 'selected' : '' }}>성명</option>
                                    <option value="id" {{ (request()->search ?? '') == 'id' ? 'selected' : '' }}>아이디</option>
                                    <option value="company_kr" {{ (request()->search ?? '') == 'company_kr' ? 'selected' : '' }}>소속</option>
                                    <option value="school" {{ (request()->search ?? '') == 'school' ? 'selected' : '' }}>출신대학</option>
                                </select>
                                <input type="text" name="keyword" id="keyword" class="form-item sch-key" value="{{ request()->keyword ?? '' }}" placeholder="검색하실 내용을 입력해주세요.">
                                <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                                <a href="{{ route('mypage.member_search') }}"  class="btn btn-reset" style="align-content: center">검색 초기화</a>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <ul class="member-list">
                    @forelse($list as $row)
                    <li>
                        <p class="name">
                            {{ $row->name_kr ?? '' }}
                        </p>
                        <strong class="tit">
                            <img src="/assets/image/sub/ic_hospital.png" alt=""> {{ $row->company_kr ?? '' }}
                        </strong>
                        <ul class="info-list">
                            <li>
                                <span class="icon"><img src="/assets/image/sub/ic_hos_addr.png" alt=""></span>
                                <div>({{ $row->company_zipcode ?? '' }}){{ $row->company_address ?? '' }} {{ $row->company_address2 ?? '' }}</div>
                            </li>
                            <li>
                                <span class="icon"><img src="/assets/image/sub/ic_hos_tel.png" alt=""></span>
                                <div><a href="tel:{{ $row->companyTel ?? '' }}" target="_blank">{{ $row->companyTel ?? '' }}</a></div>
                            </li>
                        </ul>
                    </li>
                    @empty
                    <li class="no-data text-center">
                        검색하신 회원이 없습니다.
                    </li>
                    @endforelse
                </ul>

{{--                {{ $list->links('pagination::custom') }}--}}
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
