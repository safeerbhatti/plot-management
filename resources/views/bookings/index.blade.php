@extends('layouts.app') @section('content')

<div class="container-fluid">
    <a href="/invoice">Invoices</a>
    <a href="/bookings/new-assign">Assign Customers</a>

    <br />
    <br />

    <h2>Bookings</h2>

    @foreach($bookings as $booking) Booking ID : {{$booking->id}}. 
    <a href="/booking/{{$booking->id}}">Click here</a> for more details. <br>
    @endforeach
</div>

@endsection
