<?php

namespace App\Imports;

use Carbon\Carbon;
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
                'burial_date' => Carbon::createFromFormat('d-m-Y', $row['burial_date'])->toDateString(),
                'death_date' => Carbon::createFromFormat('d-m-Y', $row['death_date'])->toDateString(),
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
            'death_date' => 'required',
            'region' => 'required',
            'tomb' => 'required',
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

    // public function map($row): array
    // {
    //     return [
    //         'burial_date' => Carbon::createFromFormat('d-m-Y', $row['burial_date'])->toDateString(),
    //         'death_date' => Carbon::createFromFormat('d-m-Y', $row['death_date'])->toDateString(),
    //         'burial_date' => Carbon::parse($row['burial_date'])->format('Y-m-d'),
    //         'death_date' => Carbon::parse($row['death_date'])->format('Y-m-d'),
    //     ];
    // }
}
