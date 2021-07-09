<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon;
// use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            //
            'adm_no' => $row['adm_no'],
            'doa' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['doa'])),
            'class' => $row['class'],
            'dob' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob'])),
            'gender' => $row['gender'] == "M" ? "male" : "female",
            'fname' => $row['fname'],
            'lname' => $row['lname'],
            'parent_fname' => $row['parent_fname'],
            'parent_lname' => $row['parent_lname'],
            'parent_phone' => "+254" . $row['phone'],
            'branch' => 2
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }
}
