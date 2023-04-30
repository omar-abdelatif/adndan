<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OctoberTomb extends Model
{
    use HasFactory;
    protected $table = 'october_tombs';
    protected $fillable = [
        'name',
        'type',
        'power',
        'annually_cost'
    ];
}
