<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, UuidForKey;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'booking_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'schedule_id',
        'price',
        'date',
        'start',
        'end',
        'status'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
    

    public function fisioterapis()
    {
        return $this->hasOneThrough(Fisioterapis::class, Schedule::class, 'schedule_id', 'fisioterapis_id', 'schedule_id', 'fisioterapis_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
