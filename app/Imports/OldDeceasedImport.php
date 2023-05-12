<?php

namespace App\Imports;

use App\Models\Deceased;
use App\Models\TableCase;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class UserImport implements WithHeadingRow, WithBatchInserts, SkipsEmptyRows, ToCollection
{

    function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Deceased::create([
                'name' => $row['name'],
                'burial_date' => $row['burial_date'],
                'burial_place' => $row['burial_place'],
            ]);
        }
    }

    function rules(): array
    {
        return [
            'name' => 'required',
            'email' => Rule::unique('upload', 'email'),
            'img' => 'required',
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
