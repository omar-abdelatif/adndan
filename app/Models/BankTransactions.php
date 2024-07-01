<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransactions extends Model
{
    use HasFactory;
    protected $table = 'bank_transactions';
    protected $fillable = [
        'transaction_type',
        'amount',
        'proof_img',
    ];
}
