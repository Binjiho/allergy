@extends('layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popup-wrap">
        <div class="popup-contents">
            <div class="popup-tit-wrap text-center">
                <h3 class="popup-tit">연구비 수상내역 {{ empty($prize->sid) ? '등록' : '수정' }}</h3>
            </div>

            <div class="popup-conbox">
                <div class="write-form-wrap">

                <form id="member-frm" data-sid="{{ $prize->sid ?? 0 }}" data-case="prize-{{ empty($prize->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                    <input type="hidden" name="tab" value="{{ request()->tab ?? '1' }}">
                    <fieldset>
                        <ul class="write-wrap">
                            <li>
                                <div class="form-tit">연도 <strong class="required">*</strong></div>
                                <div class="form-con">
                                    <select name="year" class="form-item">
                                        <option value="">선택</option>
                                        @for($i=2040; $i >= 2016; $i--)
                                            <option value="{{ $i }}" {{ ($prize->year ?? date('Y')) == $i ? 'selected':'' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </li>

                            <li>
                                <div class="form-tit">학술상명 <strong class="required">*</strong></div>
                                <div class="form-con">
                                    <input type="text" name="gubun" id="gubun" value="{{ $prize->gubun ?? '' }}" class="form-item">
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">수상자 <strong class="required">*</strong></div>
                                <div class="form-con">
                                    <input type="text" name="name_kr" id="name_kr" value="{{ $prize->name_kr ?? '' }}" class="form-item">
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">소속 <strong class="required">*</strong></div>
                                <div class="form-con">
                                    <input type="text" name="sosok" id="sosok" value="{{ $prize->sosok ?? '' }}" class="form-item">
                                </div>
                            </li>

                        </ul>
                    </fieldset>

                    <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                        <a href="javascript:window.close();" class="btn btn-type1 color-type4">닫기</a>
                        <input class="btn btn-type1 color-type1" type="submit" value="{{ empty($prize->sid) ? '등록' : '수정' }}">
                    </div>
                </form>

                </div>
            </div>
            <button type="button" class="btn btn-pop-close" onclick="window.close();"><span class="hide">팝업 닫기</span></button>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('news.data') }}';
        const groupFrm = '#member-frm';

        $(document).on('click', '.select-member', function() {
            callAjax(dataUrl, {
                'case': 'select-member',
                'sid': $(this).closest('tr').data('sid'),
            });
        });

        defaultVaildation();

        $(groupFrm).validate({
            rules: {
                year: {
                    isEmpty: true,
                },
                gubun: {
                    isEmpty: true,
                },
                name_kr: {
                    isEmpty: true,
                },

            },
            messages: {
                year: {
                    isEmpty: '연도를 선택해주세요.',
                },
                gubun: {
                    isEmpty: '학술상명을 입력해주세요.',
                },
                name_kr: {
                    isEmpty: '수상자를 입력해주세요.',
                },

            },
            submitHandler: function() {
                callAjax(dataUrl, formSerialize(groupFrm));
            }
        });
    </script>
@endsection
