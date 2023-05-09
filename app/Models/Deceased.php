<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    use HasFactory;
    protected $table = 'deceaseds';
    protected $fillable = [
        'name',
        'death_place',
        'death_date',
        'burial_date',
        'washer',
        'carrier',
        'region',
        'tomb',
        'room',
        'notes',
        'files',
        'pdf_files',
        'rooms_id',
    ];
    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }
}
