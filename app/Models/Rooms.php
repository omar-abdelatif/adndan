<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'name',
        'capacity',
        'tomb_id'
    ];
    public function tombs()
    {
        return $this->belongsTo(Tomb::class);
    }
    public function deceased()
    {
        return $this->hasMany(Deceased::class);
    }
    public function isFull()
    {
        return $this->deceased()->count() >= $this->capacity;
    }
    public function lastBurialDate()
    {
        return $this->max('burial_date');
    }
}
