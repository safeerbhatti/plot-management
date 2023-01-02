<?php

namespace App\Models;

use App\Models\Plot;
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

}
