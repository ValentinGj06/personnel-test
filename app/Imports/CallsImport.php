<?php

namespace App\Imports;

use App\Models\Calls;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CallsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
//        return new Calls([
//            'user'     => $row['user'],
//            'client'     => $row['client'],
//            'clientType'     => $row['client_type'],
//            'date'     => date('Y-m-d H:i:s', strtotime($row['date'])),
//            'duration'     => $row['duration'],
//            'typeOfCall'     => $row['type_of_call'],
//            'externalCallScore'     => $row['external_call_score'],
//        ]);

        foreach ($rows as $row) {

            $userId = '';
            $userModel = User::firstOrCreate([
                'name'     => $row['user']
            ]);
            $userId = $userModel->id;
            Calls::create(
                [
                    'user_id'     => $userId,
                    'client'     => $row['client'],
                    'clientType'     => $row['client_type'],
                    'date'     => date('Y-m-d H:i:s', strtotime($row['date'])),
                    'duration'     => $row['duration'],
                    'typeOfCall'     => $row['type_of_call'],
                    'externalCallScore'     => $row['external_call_score'],
                ]);
        }
    }
}
