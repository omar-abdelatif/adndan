<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public static function updateBurialDates()
    {
        $lastBurialDates = Deceased::groupBy('room_id')
        ->select('room_id', DB::raw('MAX(burial_date) AS last_burial_date'))
        ->pluck('last_burial_date', 'room_id');

        foreach ($lastBurialDates as $roomId => $lastBurialDate) {
            $room = Rooms::find($roomId);
            $room->burial_date = $lastBurialDate;
            $room->save();
        }
    }

}
