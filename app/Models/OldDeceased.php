<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldDeceased extends Model
{
    use HasFactory;
    protected $table = "old_deceaseds";
    protected $fillable = [
        'name',
        'burial_date',
        'death_date',
        'region',
        'tomb'
    ];
}
