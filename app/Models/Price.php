<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory, UuidForKey;

    protected $primaryKey = 'price_id';

    protected $fillable = [
        'name',
        'amount',
        'type',
    ];
}
