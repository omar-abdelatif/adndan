<?php

namespace App\Imports;

use App\Models\OldDeceased;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class OldDeceasedImport implements WithHeadingRow, WithBatchInserts, SkipsEmptyRows, ToCollection
{
    function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            OldDeceased::create([
                'name' => $row['name'],
                'burial_date' => $row['burial_date'],
                'death_date' => $row['death_date'],
                'region' => $row['region'],
                'tomb' => $row['tomb'],
            ]);
        }
    }

    function rules(): array
    {
        return [
            'name' => 'required',
            'burial_date' => 'required',
            'burial_place' => 'required'
        ];
    }

    function headingRow(): int
    {
        return 1;
    }

    function batchSize(): int
    {
        return 100;
    }
}
