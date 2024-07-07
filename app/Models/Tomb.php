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
        'power',
        'type',
        'tomb_specifices',
        'other_tomb_power',
        'region',
        'burial_date',
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
        $id = $this->id;
        $region = $this->region;
        $name = $this->name;
        $power = $this->power;
        $type = $this->type;
        $otherPower = $this->other_tomb_power;
        if ($type === "لحد") {
            for ($i = 1; $i <= $otherPower; $i++) {
                Rooms::create([
                    'name' => "لحد " . $i . " - " . $name . " - " . $region,
                    'capacity' => 6,
                    'burial_date' => null,
                    'tomb_id' => $id,
                ]);
            }
        } else {
            for ($i = 1; $i <= $power; $i++) {
                Rooms::create([
                    'name' => "غرفة " . $i . " - " . $name . " - " . $region,
                    'capacity' => 6,
                    'burial_date' => null,
                    'tomb_id' => $id,
                ]);
            }
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
        $totalDeceased = 0;
        $totalLahd = 0;
        $power = $this->power;
        $otherPower = $this->other_tomb_power;
        foreach ($this->rooms as $room) {
            $roomCapacity = $room->getCapacity();
            if ($power === 0) {
                $totalDeceased = $roomCapacity * $otherPower;
            } else {
                $totalDeceased = $roomCapacity * $power;
            }
        }
        //! Update total male and female counts
        $totalMale = $totalDeceased / 2;
        $totalFemale = $totalDeceased / 2;
        //! Calculate totals when tomb is exclusively for males or females
        $totalMaleOnly = $totalMale + $totalFemale;
        $totalFemaleOnly = $totalMale + $totalFemale;
        return [
            'male' => $totalMale,
            'female' => $totalFemale,
            'totalMaleOnly' => $totalMaleOnly,
            'totalFemaleOnly' => $totalFemaleOnly,
            'lahd' => $totalLahd,
        ];
    }
    public function getAvailablePlaces()
    {
        $lahd = 0;
        $MaleFemale = 0;
        $FemaleMale = 0;
        foreach ($this->rooms as $rooms) {
            $maleDeceasedSize = $rooms->deceased->where("gender", "ذكر")->where("rooms_id", $rooms->id)->sum('size');
            $femaleDeceasedSize = $rooms->deceased->where("gender", "أنثى")->where("rooms_id", $rooms->id)->sum('size');
            $deceasedLahd = $rooms->deceased->where("size", 6)->where("rooms_id", $rooms->id)->count();
            $lahd += 1 - $deceasedLahd;
            $MaleFemale += $rooms->capacity - ($maleDeceasedSize + $femaleDeceasedSize);
            $FemaleMale += $rooms->capacity - ($maleDeceasedSize + $femaleDeceasedSize);
        }
        return [
            'lahd' => $lahd,
            'MaleFemale' => $MaleFemale,
            'FemaleMale' => $FemaleMale,
        ];
    }
    public function mixTombs()
    {
        foreach ($this->rooms as $room) {
            $availableMales = 0;
            $availableFemales = 0;
            $maleDeceasedSize = $room->deceased->where("gender", "ذكر")->sum('size');
            $femaleDeceasedSize = $room->deceased->where("gender", "أنثى")->sum('size');
            $availableMales = ($room->capacity - $maleDeceasedSize);
            $availableFemales = ($room->capacity - $femaleDeceasedSize);
        }
        return [
            'male' => $availableMales,
            'female' => $availableFemales,
        ];
    }
}
