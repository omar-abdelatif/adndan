<?php

namespace App\Models;

use App\Models\Deceased;
// use Illuminate\Support\Facades\DB;
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
}
