<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table = 'regions';
    protected $fillable = [
        'name',
        'capacity'
    ];

    public function tombs()
    {
        return $this->hasMany(Tomb::class);
    }

    public function updateTombsRoomsBurialDates()
    {
        foreach ($this->tombs as $tomb) {
            $tomb->updateRoomsBurialDates();
        }
    }
}
