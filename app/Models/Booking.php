<?php

namespace App\Models;

use App\Models\Plot;
use App\Models\Scheme;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
