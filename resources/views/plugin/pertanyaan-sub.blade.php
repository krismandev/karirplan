@if($data->jenis==1)
<tr>
    <td></td>
    <td class="subASK">▪ {{$data->pertanyaan}}</td>
    <td>
        <select class="selectize" id="{{$data->kode}}">
            <option value="1">Ya</option>
            <option value="0" selected>Tidak</option>
        </select>
    </td>
    <td>
        #PTS
    </td>
</tr>
@elseif($data->jenis==2)
<tr>
    <td></td>
    <td class="subASK">▪ {{$data->pertanyaan}}</td>
    <td>
        <div class="input-group">
            <input type="text" id="{{$data->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3">
            <span class="input-group-addon btn-default">{{$data->satuan}}</span>
        </div>
    </td>
    <td>
        #PTS
    </td>
</tr>
@endif