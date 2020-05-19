<?php

namespace App\Imports;
use Hash;
use App\Model\StudentCouncil;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentCouncilImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StudentCouncil([
        'name' => $row['hoten'],
        'msv' => $row['msv'],
        'topic' =>  ($row['detai']),
        'id_topic' => $row['madetai'],
        'lecturer' => $row['gvhd'],
        'id_lecturer' => $row['magvhd'],
        'council' => $row['hd']
        ]);
    }
}
