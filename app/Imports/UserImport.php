<?php

namespace App\Imports;

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
            TableCase::create([
                'fullname' => $row['fullname'],
                'ssn' => $row['ssn'],
                'phone_number' => $row['phone_number'],
                'age' => $row['age'],
                'address' => $row['address'],
                'income_type' => $row['income_type'],
                'benefit_type' => $row['benefit_type'],
                'monthly_income' => $row['monthly_income'],
                'marital_status' => $row['marital_status'],
                'health_status' => $row['health_status'],
                'gov' => $row['gov'],
                'sons' => $row['sons'],
                'daughters' => $row['daughters'],
                'files' => $row['files'],
            ]);
        }
    }

    function rules(): array
    {
        return [
            'name' => 'required',
            'email' => Rule::unique('upload', 'email'),
            'img' => 'required'
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
