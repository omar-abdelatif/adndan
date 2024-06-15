<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TombDonations extends Model
{
    use HasFactory;
    protected $table = 'tomb_donations';
    protected $fillabl = [
        'name',
        'mobile_no',
        'donation_type',
        'amount',
        'invoice_no',
        'donation_duration',
        'tomb_donator_id',
    ];
    public function donators(){
        return $this->belongsTo(NewTombDonators::class);
    }
}
