<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        $region = $this->region;
        $name = $this->name;
        $power = $this->power;

        for ($i = 1; $i <= $power; $i++) {
            $room = new Rooms;
            $room->name = "غرفة " . $i . " - " . $name . " - " . $region;
            $room->burial_date = null;
            $room->capacity = 6;
            $room->tomb_id = $this->id;
            $room->save();
        }
    }

    public function getBurialDateAttribute()
    {
        $lastDeceased = null;

        foreach ($this->rooms as $room) {
            $deceased = $room->deceased->first();
            if ($deceased) {
                if (!$lastDeceased || $deceased->burial_date > $lastDeceased->burial_date) {
                    $lastDeceased = $deceased;
                }
            }
        }

        if ($lastDeceased) {
            return [
                'burial_date' => $lastDeceased->burial_date,
                'name' => $lastDeceased->name,
                'room' => $lastDeceased->room,
                'gender' => $lastDeceased->gender,
            ];
        } else {
            return null;
        }
    }

    public function getTotalPlaces()
    {
        foreach ($this->rooms as $room) {
            $totalTomb = 0;
            $male = 0;
            $female = 0;
            $power = $this->power;
            $roomCapacity = 0;
            $roomCapacity = $room->getCapacity();
            $totalTomb += $roomCapacity * $power;
            $male = $totalTomb / 2;
            $female = $totalTomb / 2;
        }
        return [
            'male' => $male,
            'female' => $female,
        ];
    }
    // public function getRemaining(){}
}
