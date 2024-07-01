<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KfalaTransaction extends Model
{
    use HasFactory;
    protected $table = 'kfala_transactions';
    protected $fillable = [
        'transaction_type',
        'amount',
        'proof_img',
        'invoice_no',
        'donation_type',
        'other_type',
        'money_type',
    ];
}
