<?php

namespace App\Imports;
use Hash;
use App\Model\Lecturers;
use Maatwebsite\Excel\Concerns\ToModel;

class LecturersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lecturers([
        'name_lecturer' => $row[0],
        'email_address_lecturer' => $row[1],
        'password' =>  Hash::make($row[2]),
        'status' => $row[3],
        'address_lecturer' => $row[4],
        'phone_number' => $row[5],
        'id_department' => $row[6],
        'id_field' => $row[7]
        ]);
    }
}
