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

    // public function createRoomsForTomb($tombId)
    // {
    //     $tomb = Tomb::find($tombId);
    //     $power = $tomb->power;
    //     for ($i = 1; $i <= $power; $i++) {
    //         $room = new Rooms;
    //         $room->name = "Room " . $i;
    //         $room->capacity = 6; // Set the default capacity for each room
    //         $room->tomb_id = $tombId;
    //         $room->save();
    //     }
    // }

    public function createRooms()
    {
        // Get the power of the tomb
        $power = $this->power;

        // Loop through the power and create the rooms
        for ($i = 1; $i <= $power; $i++) {
            $room = new Rooms;
            $room->name = "غرفة " . $i;
            $room->capacity = 6;
            $room->tomb_id = $this->id;
            $room->save();
        }
    }

}
