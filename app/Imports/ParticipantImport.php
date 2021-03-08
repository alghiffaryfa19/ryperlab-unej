<?php

namespace App\Imports;

use App\Models\Participant;;
use Maatwebsite\Excel\Concerns\ToModel;

class ParticipantImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $words = explode(" ", $row[0]);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        $number = str_shuffle($row[3]);

        return new Participant([
            'nama' => $row[0],
            'instansi' => $row[1], 
            'email' => $row[2], 
            'identity' => $row[3], 
            'sub_event_id' => $row[4],
            'code' => $acronym.substr($number,2).rand(),
        ]);
    }
}