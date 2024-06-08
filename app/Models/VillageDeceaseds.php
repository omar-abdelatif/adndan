<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageDeceaseds extends Model
{
    use HasFactory;
    protected $table = 'village_deceaseds';
    protected $fillable = [
        'name',
        'gender',
        'death_place',
        'death_date',
        'burial_date',
    ];
}
