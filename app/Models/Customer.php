<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function Booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
