<?php

namespace App\Models;

use App\Models\Scheme;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plot extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

}
