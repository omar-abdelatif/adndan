<?php

namespace App\Models;

use App\Models\Deceased;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rooms extends Model
{
    use HasFactory;
    public $capacity = 6;
    public $gender;
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
    public function getCapacity()
    {
        return $this->capacity;
    }
    public function availableMaleSlots()
    {
        $tomb = $this->tombs()->first();
        if ($tomb) {
            $totalMale = $tomb->totalMale;
            $occupiedMale = $this->deceased()->where('gender', 'ذكر')->sum('size');
            dd(["occupiedMales" => $occupiedMale]);
            return max(0, $totalMale - $occupiedMale);
        }
        return 0;
    }

    public function availableFemaleSlots()
    {
        $tomb = $this->tombs()->first();
        if ($tomb) {
            $totalFemale = $tomb->totalFemale;
            $occupiedFemale = $this->deceased()->where('gender', 'أنثى')->sum('size');
            dd(["occupiedMales" => $occupiedFemale]);
            return max(0, $totalFemale - $occupiedFemale);
        }
        return 0;
    }
}
