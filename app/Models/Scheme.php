<?php

namespace App\Models;

use App\Models\Plot;
use App\Models\Account;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\ExpenseType;
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

    public function expense_types()
    {
        return $this->hasMany(ExpenseType::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

}
