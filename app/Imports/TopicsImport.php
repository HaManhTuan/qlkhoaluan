<?php

namespace App\Imports;
use App\Model\Topics;
use Maatwebsite\Excel\Concerns\ToModel;

class TopicsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Topics([
        'lecturers_id' => $row[0],
        'fields_id' => $row[1],
        'name' => ($row[2]),
        'accept' => $row[3],
        'description' => $row[4],
        ]);
    }
}
