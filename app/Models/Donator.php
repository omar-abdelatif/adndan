<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    use HasFactory;
    protected $table = 'donators';
    protected $fillable = [
        'name',
        'mobile_phone',
        'amount',
        'duration'
    ];
}
