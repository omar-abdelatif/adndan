<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewTombDonators extends Model
{
    use HasFactory;
    protected $table = 'new_donators';
    protected $fillable = [
        'name',
        'mobile_number',
        'donator_type',
        'donator_duration'
    ];
    public function tombdonations(){
        return $this->hasMany(TombDonations::class);
    }
}
