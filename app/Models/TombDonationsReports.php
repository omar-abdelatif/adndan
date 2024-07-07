<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TombDonationsReports extends Model
{
    use HasFactory;
    protected $table = 'tomb_donations_reports';
    protected $fillable = [
        'donator_name',
        'transaction_type',
        'invoice_no',
        'amount',
    ];
}
