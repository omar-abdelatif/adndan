<?php

namespace App\Models;

use App\Models\Deceased;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rooms extends Model
{
    use HasFactory;
    public $capacity = 6;
    public $lahd = 1;
    public $gender;
    protected $table = 'rooms';
    protected $fillable = [
        'name',
        'burial_date',
        'capacity',
        'isDisabled',
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
    public function getLahd()
    {
        return $this->lahd;
    }
}
