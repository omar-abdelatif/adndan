<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalKfalaSafe extends Model
{
    use HasFactory;
    protected $table = 'total_kfala_safes';
    protected $fillable = [
        'amount',
    ];
}
