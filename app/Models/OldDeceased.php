<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldDeceased extends Model
{
    use HasFactory;
    protected $table = "old_deceased";
    protected $fillable = [
        'name',
        'burial_date',
        'burial_place',
    ];
}
