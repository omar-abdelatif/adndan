<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donator extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'donators';
    protected $fillable = [
        'name',
        'mobile_phone',
        'duration',
        'other_duration'
    ];
    public function donationHistory()
    {
        return $this->hasMany(DonationHistory::class);
    }
}
