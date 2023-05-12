<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'name' => 'أكتوبر',
                'capacity' => '6'
            ],
            [
                'name' => 'الفيوم',
                'capacity' => '6'
            ],
            [
                'name' => 'القطامية',
                'capacity' => '6'
            ],
            [
                'name' => 'الغفير',
                'capacity' => '6'
            ],
            [
                'name' => 'زينهم',
                'capacity' => '6'
            ],
            [
                'name' => 'مايو',
                'capacity' => '6'
            ]
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
