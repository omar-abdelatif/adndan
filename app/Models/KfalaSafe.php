<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KfalaSafe extends Model
{
    use HasFactory;
    protected $table = 'kfala_safes';
    protected $fillable = [
        'amount',
        'proof_img',
        'transaction_type'
    ];
}
