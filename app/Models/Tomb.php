<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tomb extends Model
{
    use HasFactory;
    protected $table = 'tombs';
    protected $fillable = [
        'name',
        'type',
        'power',
        'region',
        'annual_cost',
        'region_id'
    ];

    public function regions()
    {
        return $this->belongsTo(Region::class);
    }
    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }
    public function createRooms()
    {
        $power = $this->power;
        for ($i = 1; $i <= $power; $i++) {
            $room = new Rooms;
            $room->name = "غرفة " . $i;
            $room->capacity = 6;
            $room->tomb_id = $this->id;
            $room->save();
        }
    }
    public function lastBurialDate()
    {
        return $this->rooms()->max('burial_date');
    }
    // public function getLastBurialDateAttribute()
    // {
    //     if ($this->deceased->isEmpty()) {
    //         return null;
    //     }

    //     return $this->deceased->max('burial_date');
    // }

}
