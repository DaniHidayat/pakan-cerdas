<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidForKey;

    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'birth_date',
        'address',
        'village',
        'district',
        'city',
        'province',
        'gender',
        'height',
        'weight',
        'photo',
        'otp',
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
    protected $appends = [
        'photo_url',
        'photo_string'
    ];

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('uploads/photo/' . $this->photo);
        }
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function getFullAddressAttribute()
    {
        return $this->address . ', ' . $this->village . ', ' . $this->district . ', ' . $this->city . ', ' . $this->province;
    }

    public function getPhotoStringAttribute()
    {
        // $url = $this->photo_url;
        // $image = file_get_contents($url);
        // if ($image) {
        //     return base64_encode($image);
        // }
        return base64_encode($this->photo_url);
    }
}
