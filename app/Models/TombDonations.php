<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TombDonations extends Model
{
    use HasFactory;
    protected $table = 'tomb_donations';
    protected $fillable = [
        'name',
        'mobile_no',
        'donation_type',
        'amount',
        'invoice_no',
        'donation_duration',
        'new_tomb_donators_id',
    ];
    public function donators(){
        return $this->belongsTo(NewTombDonators::class);
    }
}
