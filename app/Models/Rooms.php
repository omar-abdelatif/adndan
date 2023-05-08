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
    public function deceased()
    {
        return $this->hasMany(Deceased::class);
    }
}
