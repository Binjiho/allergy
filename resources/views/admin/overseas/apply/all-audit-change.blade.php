@extends('admin.layouts.popup-layout')

@section('addStyle')
    <style>
        .write-wrap:has(.preview-wrap) {
            margin-top: 60px !important;
        }
    </style>
@endsection

@section('contents')
    <div style="padding: 25px;">
        <div class="write-form-wrap">
            <form id="all-judge-change-frm" method="post" data-case="all-judge-change">
				<fieldset>
					<ul class="list-type list-type-bar mt-20">
						<li>심사상태 > 선정 선택 후 지원 협회 선택 해주세요. 그 다음 선정 된 참가자를 선택하여 [완료] 버튼을 클릭 해주셔야 완료 됩니다.</li>
						<li>심사상태 > 미선정 선택 후 미선정된 참가자들 선택하여 [완료] 버튼을 클릭 해주셔야 완료 됩니다.</li>
					</ul>
					
					<ul class="write-wrap mt-20">
						<li>
							<div class="form-tit"><strong class="required">*</strong> 심사상태</div>
							<div class="form-con">
								<div class="radio-wrap cst">
									@foreach($overseasConfig['judge'] as $tkey=>$tval)
										<label class="radio-group">
											<input type="radio" name="judge" id="judge_{{ $tkey }}" value="{{ $tkey }}">{{ $tval }}
										</label>
									@endforeach
								</div>
							</div>
						</li>
						<li class="judge_show show_Y" style="display:none;" style="display:none;">
							<div class="form-tit"><strong class="required">*</strong> 지원협회</div>
							<div class="form-con">
								<div class="radio-wrap cst">
									@foreach($overseasConfig['assistant'] as $tkey=>$tval)
										<label class="radio-group">
											<input type="radio" name="assistant" id="assistant_{{ $tkey }}" value="{{ $tkey }}">{{ $tval }}
										</label>
									@endforeach
								</div>
							</div>
						</li>
					</ul>

					<div class="table-wrap mt-20">
						<table class="cst-table application-table text-center">
							<colgroup>
								<col style="width: 3.5%;">
								<col style="width: 10%;">
								<col style="width: 10%;">
								<col style="width: 10%;">
								<col>
								<col style="width: 10%;">
								<col style="width: 20%;">
								<col style="width: 10%;">
								<col style="width: 10%;">
							</colgroup>
							<thead>
								<tr>
									<th>
										<div class="checkbox-wrap cst">
											<label class="checkbox-group">
												<input type="checkbox" name="all_chk" id="all_chk" value="Y" onchange="syncAllCheckboxes('sids', this)">
											</label>
										</div>
									</th>
									<th>신청상태</th>
									<th>학회 ID</th>
									<th>성명 (한글)</th>
									<th>소속</th>
									<th>면허번호</th>
									<th>이메일</th>
									<th>휴대폰번호</th>
									<th>심사상태</th>
								</tr>
							</thead>
							<tbody>
								@forelse($list as $row)
									<tr>
										<td>
											<div class="checkbox-wrap cst">
												<label class="checkbox-group">
													<input type="checkbox" name="sids[]" id="sids_{{ $row->sid }}" class="sids" value="{{ $row->sid }}">
												</label>
											</div>
										</td>
										<td>{{ $overseasConfig['complete'][$row->complete] ?? '' }}</td>
										<td>{{ $row->user->id ?? '' }}</td>
										<td>{{ $row->user->name_kr ?? '' }}</td>
										<td>{{ $row->sosok_kr ?? '' }}</td>
										<td>{{ $row->user->license_number ?? '' }}</td>
										<td>{{ $row->email }}</td>
										<td>{{ $row->phone }}</td>
										<td>{{ $overseasConfig['judge'][$row->judge] ?? '' }}</td>
									</tr>
								@empty
									<tr>
										<td colspan="9">등록한 내역이 없습니다.</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="btn-wrap text-center">
						<a href="javaScript:window.close();" class="btn btn-type1 color-type1 btn-line">취소</a>
						<button type="submit" class="btn btn-type1 color-type9">완료</button>
					</div>     
				</fieldset>
			</form>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('apply.data',['o_sid'=>request()->o_sid]) }}';
		const form = '#all-judge-change-frm';
		
		$(document).on('submit', form, function () {
			if (isEmpty($('input[name="judge"]:checked').val())) {
				alert('심사상태를 선택해주세요.');
				$('input[name="judge"]').eq(0).focus();
				return false;
			}
			if($('input[name="judge"]:checked').val() == 'Y'){
				if (isEmpty($('input[name="assistant"]:checked').val())) {
					alert('지원협회를 선택해주세요.');
					$('input[name="assistant"]').eq(0).focus();
					return false;
				}
			}
			if(!$('input[name="sids[]"]').is(':checked')){
				alert('명단을 하나 이상 선택해주세요.');
				return false;
			}
			
			let ajaxData = newFormData(form);

			callMultiAjax(dataUrl, ajaxData);
		});


        //라디오 이벤트
		$(document).on("change", 'input[type="radio"]', function() {
			//변수 선언 및 정제
			const $this = $(this);
			const objName = $this.attr('name');
			const objNameClean = objName.replace(/[\[\]]/g, "");

			const $checkedItem = $('input[name="'+objName+'"]:checked');
			const objVal = $checkedItem.length > 0 ? $checkedItem.val() : '';

			//타겟 요소 캐싱
			const $showTarget = $('.' + objNameClean + '_show');
			const $disabledTarget = $('.' + objNameClean + '_disabled');

			if ($showTarget.length > 0) {
				$showTarget.each(function() {
					const $container = $(this);
					const classList = $container.attr('class').split(/\s+/);
					const matchedClass = classList.find(cls => cls.startsWith('show_'));

					if (!matchedClass) return;

					const valueKey = matchedClass.replace('show_', '');
					const shouldShow = (objVal == valueKey);

					if (shouldShow) {
						if ($container.is(':hidden')) {
							$container.show();
						}
					} else {
						if ($container.is(':visible')) {
							$container.hide();
							$container.find('input:not([type="radio"]):not([type="checkbox"]), select, textarea').val('').trigger('change');
							$container.find('input[type="radio"], input[type="checkbox"]').prop('checked', false).trigger('change');
							$container.find('input[type="hidden"][name$="_check"]').val('N');
						}
					}
				
				});
			}

			if ($disabledTarget.length > 0) {
				$disabledTarget.each(function() {
					const $input = $(this);
					if (objVal === '') {
						if ($input.prop('disabled')) {
							$input.not('.not-enable').prop('disabled', false);//disabled가 풀리면 안되는 경우 클래스 not-enable 추가(신청마감 등)
						}
						return;
					}

					const classList = $input.attr('class').split(/\s+/);
					const matchedClass = classList.find(cls => cls.startsWith('disabled_'));

					if (!matchedClass) return;

					const valueKey = matchedClass.replace('disabled_', '');
					const shouldEnable = (objVal == valueKey);

					if (shouldEnable) {
						if ($input.prop('disabled')) {
							$input.not('.not-enable').prop('disabled', false);
						}
					} else {
						if (!$input.prop('disabled')) {
							if ($input.is(':checkbox') || $input.is(':radio')) {
								$input.prop('checked', false).prop('disabled', true).trigger('change');
							} else {
								$input.val('').prop('disabled', true).trigger('change');
							}
						}
					}
				});
			}
		});

		//체크박스 전체선택 / 전체해제
		const syncAllCheckboxes = (targetClass, master) => {
			$('.' + targetClass).prop('checked', $(master).is(':checked'));
			//<input type="checkbox" onclick="syncAllCheckboxes('my_chk', this)"> 전체 선택
			//<input type="checkbox" class="my_chk"> 항목 1
			//<input type="checkbox" class="my_chk"> 항목 2
		};


    </script>
@endsection
