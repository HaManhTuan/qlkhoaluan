<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>MSV</th>
        <th>HOTEN</th>
        <th>DETAI</th>>
        <th>Điểm</th>
    </tr>
    </thead>
    <tbody>
        @php
            $stt = 1;
        @endphp
            @foreach($StudentCouncil as $StudentCouncil)
                <tr>
                    <td>{{ $stt++ }}</td>
                    <td>{{ $StudentCouncil->students->msv }}</td>
                    <td>{{ $StudentCouncil->students->name }}</td>
                    <td>{{ $StudentCouncil->topics->name }}</td>
                    <td>
                     <input type="text" name="score" class="form-control" value="{{ $StudentCouncil->score}}">
                     </td>
                </tr>
            @endforeach
    </tbody>
</table>
