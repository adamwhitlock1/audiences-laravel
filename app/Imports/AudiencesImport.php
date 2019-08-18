<?php

namespace App\Imports;

use App\Audience;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AudiencesImport implements ToModel, WithBatchInserts, WithChunkReading {
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Audience([
            'account_id'     => 1,
            'facebook_id'    => $row[0],
            'odc_id'         => $row[1],
            'name'           => $row[2],
            'type'           => $row[3],
            'sla'            => $row[4],
            'estimated_size' => $row[5],
            'description'    => $row[6]
        ]);
    }

    public function batchSize(): int
    {
        return 350;
    }

    public function chunkSize(): int
    {
        return 350;
    }
}
