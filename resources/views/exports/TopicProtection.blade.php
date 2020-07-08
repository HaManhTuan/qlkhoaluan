<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>MSV</th>
        <th>HOTEN</th>
        <th>DETAI</th>
        <th>MADETAI</th>
        <th>GVHD</th>
        <th>MAGVHD</th>
    </tr>
    </thead>
    <tbody>
        @php
            $stt = 1;
        @endphp
    @foreach($TopicProtection as $TopicProtection)
        <tr>
            <td>{{ $stt++ }}</td>
            <td>{{ $TopicProtection->students->msv }}</td>
            <td>{{ $TopicProtection->students->name }}</td>
            <td>{{ $TopicProtection->topics->name }}</td>
            <td>{{ $TopicProtection->id_topic }}</td>
            <td>
                @php
                    $id_lecturer = DB::table('topics')->where('id',$TopicProtection->id_topic)->value('lecturers_id');
                    $name_lecturer = DB::table('lecturers')->where('id',$id_lecturer)->value('name_lecturer');
                    echo $name_lecturer;
                @endphp
            </td>
            <td>
                @php
                    $id_lecturer = DB::table('topics')->where('id',$TopicProtection->id_topic)->value('lecturers_id');
                    echo $id_lecturer;
                @endphp
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
