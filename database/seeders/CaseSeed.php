<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table("users")->insert([
            "name" => "Mido",
            "email" => "mido@mido.com",
            "password" => bcrypt("123456789"),
        ]);
    }
}
