<?php

namespace App\Models;

use App\Models\Plot;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scheme extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
