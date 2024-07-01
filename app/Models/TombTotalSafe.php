<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TombTotalSafe extends Model
{
    use HasFactory;
    protected $table = 'tomb_total_safes';
    protected $fillable = ['amount'];
}
