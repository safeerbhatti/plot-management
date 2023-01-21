@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <br />
    <h2>Bookings</h2>
    @foreach($bookings as $booking) Booking ID : {{$booking->id}}. 
    <a href="/{{$slug}}/booking/{{$booking->id}}">Click here</a> for more details. <br>
    @endforeach
</div>

@endsection
