<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory, UuidForKey;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'clinic_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'image',
        'about',
        'address',
        'village',
        'district',
        'city',
        'province'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    public function fisioterapis()
    {
        return $this->hasOne(Fisioterapis::class, 'clinic_id');
    }

    public function schedules()
    {
        return $this->hasManyThrough(
            Schedule::class,
            Fisioterapis::class,
            'clinic_id',
            'fisioterapis_id'
        )->where('schedules.type', 'Offline');
    }

    public function getImageUrlAttribute()
    {
        return asset('uploads/clinic/' . $this->image);
    }
}
