<tr class="search_tr">
    <td class="text-left">
        <select name="search[]" id="search_{{ $eq ?? 2 }}" class="form-item">
            <option value="title" >Title</option>
            <option value="author" >Author</option>
            <option value="keywords" >Keywords</option>
            <option value="abstract" >Abstract</option>
        </select>

    </td>
    <td class="text-left">
        <input type="text" name="keyword[]" id="keyword_{{ $eq ?? 2 }}" value="" class="form-item">
    </td>
    <td >
        <div class="radio-wrap cst text-center and_div" style="display:none;">
            <label for="and{{ $eq ?? 2 }}_1" class="radio-group"><input type="radio" name="and{{ $eq ?? 2 }}" id="and{{ $eq ?? 2 }}_1" value="and" >AND</label>
            <label for="and{{ $eq ?? 2 }}_2" class="radio-group"><input type="radio" name="and{{ $eq ?? 2 }}" id="and{{ $eq ?? 2 }}_2" value="or" >OR</label>
        </div>
    </td>
    <td>
        <a href="javascript:;" class="btn btn-small color-type10 add">추가</a>
        <a href="javascript:;" class="btn btn-small color-type7 del">삭제</a>
    </td>
</tr>