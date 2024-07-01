<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TombSafe extends Model
{
    use HasFactory;
    protected $table = 'tomb_safes';
    protected $fillable = [
        'transaction_type',
        'proof_img',
        'amount',
    ];
}
