<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Fisioterapis extends Authenticatable
{
    use HasApiTokens, HasFactory, UuidForKey;

    protected $primaryKey = 'fisioterapis_id';

    protected $guard = 'fisioterapis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clinic_id',
        'name',
        'email',
        'password',
        'email_verified_at',
        'address',
        'village',
        'district',
        'city',
        'province',
        'phone',
        'lang',
        'long',
        'price',
        'about',
        'photo',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'lang',
        'long',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['photo_url'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'fisioterapis_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'fisioterapis_id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'fisioterapis_id');
    }

    public function online_bookings()
    {
        return $this->hasManyThrough(Booking::class, Schedule::class, 'fisioterapis_id', 'schedule_id')->where('schedules.type', 'Online');
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('uploads/fisioterapis/' . $this->photo);
        }
    }
}
