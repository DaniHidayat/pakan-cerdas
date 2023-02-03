<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory, UuidForKey;

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'fisioterapis_id',
        'day',
        'type',
        'from',
        'to',
    ];

    public function fisioterapi()
    {
        return $this->belongsTo(Fisioterapis::class, 'fisioterapis_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'schedule_id');
    }
}
