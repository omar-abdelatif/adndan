<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationHistory extends Model
{
    use HasFactory;
    protected $table = 'donation_histories';
    protected $fillable = [
        'name',
        'mobile_phone',
        'amount',
        'duration',
        'donator_id'
    ];
    public function donator()
    {
        return $this->belongsTo(Donator::class);
    }
}
