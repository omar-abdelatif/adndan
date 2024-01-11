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
        try {
            for ($i = 1; $i <= $power; $i++) {
                $room = new Rooms;
                $room->name = "غرفة " . $i . " - " . $name . " - " . $region;
                $room->burial_date = null;
                $room->capacity = 6;
                $room->tomb_id = $this->id;
                $room->save();
            }
            return "Rooms created successfully";
        } catch (\Exception $e) {
            return "Error creating rooms: " . $e->getMessage();
        }
    }
    public function getBurialDateAttribute()
    {
        return $this->rooms()->max('burial_date');
    }
    public function getTotalPlaces()
    {
        $totalMale = 0;
        $totalFemale = 0;
        $availableMales = 0;
        $availableFemales = 0;
        foreach ($this->rooms as $room) {
            $power = $this->power;
            $roomCapacity = $room->getCapacity();
            $totalDeceased = $roomCapacity * $power;
            //! Update total male and female counts
            $totalMale += $totalDeceased / 2;
            $totalFemale += $totalDeceased / 2;
            //! Update available male and female counts based on the available slots in the room
            $availableMales += $room->availableMaleSlots();
            $availableFemales += $room->availableFemaleSlots();
        }
        return [
            'male' => $totalMale,
            'female' => $totalFemale,
            'availableMales' => $availableMales,
            'availableFemales' => $availableFemales,
        ];
    }
}
