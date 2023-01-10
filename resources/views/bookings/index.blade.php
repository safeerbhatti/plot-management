@extends('layouts.app') @section('content')

<div class="container-fluid">
    <a href="/invoice">Invoices</a>
    <a href="/booking/assign">Assign Customers</a>

    <br />
    <br />

    <h2>Bookings</h2>

    @foreach($bookings as $booking) Booking ID : {{$booking->id}}
    <br />
    <br />
    <a href="/booking/{{$booking->id}}">Click here</a> for more details.
    @endforeach
</div>

@endsection
