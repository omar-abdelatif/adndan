<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TableCase extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'table_case';
    protected $fillable = [
        'fullname',
        'ssn',
        'phone_number',
        'age',
        'address',
        'income_type',
        'benefit_type',
        'benefit_duration',
        'monthly_income',
        'another_source',
        'retire_income',
        'total_income',
        'marital_status',
        'health_status',
        'gov',
        'sons',
        'daughters',
        'files',
    ];
}
