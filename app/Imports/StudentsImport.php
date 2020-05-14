<?php

namespace App\Imports;

use App\Model\Students;
use Maatwebsite\Excel\Concerns\ToModel;
use Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Students([
         'msv'  => $row['msv'],
         'name'   => $row['hoten'],
         'password'   => Hash::make($row['password']),
         'phone'    => $row['phone'],
         'status'  => $row['status'],
         'email'  => $row['email'],
         'id_department'   => $row['id_department'],
         'id_classes'   => $row['id_classes'],
         'id_branch'   => $row['id_branch']
        ]);
    }
}
