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
        'gender',
        'size',
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
    public static function boot()
    {
        parent::boot();

        self::created(function ($deceased) {
            $room = $deceased->rooms()->first();
            if ($room) {
                $room->burial_date = $deceased->burial_date;
                $room->save();
            }
        });
        self::updated(function ($deceased) {
            $room = $deceased->rooms()->first();
            if ($room) {
                $room->burial_date = $deceased->burial_date;
                $room->save();
            }
        });
    }
}
