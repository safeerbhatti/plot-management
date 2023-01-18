<?php

namespace App\Models;

use App\Models\Plot;
use App\Models\Scheme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

}
