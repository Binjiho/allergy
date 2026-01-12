<tr class="aff_div">
    <td class="text-left">
        <select name="member_gubun[]" class="form-item">
            <option value="">선택</option>
            @foreach($defaultConfig['member_gubun'] as $k => $v)
                <option value="{{ $k }}" >{{ $v }}</option>
            @endforeach
        </select>
    </td>
    <td class="text-left">
        <select name="gubun[]" class="form-item">
            <option value="">선택</option>
            @foreach($defaultConfig['gubun'] as $k => $v)
                <option value="{{ $k }}" >{{ $v }}</option>
            @endforeach
        </select>
    </td>
    <td class="text-left">
        <input type="text" name="amount[]" value="" id="" class="form-item" onlyNumber>
    </td>
    <td>
        <div class="btn-admin">
            <a href="javascript:;" onclick="change_tr(this,'add');" class="btn btn-tbl-inner color-type1">추가</a>
            <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-tbl-inner color-type9">삭제</a>
        </div>
    </td>
</tr>