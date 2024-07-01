<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KfalaBank extends Model
{
    use HasFactory;
    protected $table = 'kfala_banks';
    protected $fillable = [
        'amount',
    ];
}
