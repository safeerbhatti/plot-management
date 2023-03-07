@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <div class="card border-left-primary shadow">
        <h1 class="card-header text-success">Bookings</h1>
        @foreach($bookings as $booking)
        <div class="card-body">Booking ID : {{$booking->id}}. <a class="card-link" href="/{{$slug}}/booking/{{$booking->id}}">Click here</a> for more details. </div>
        @endforeach
    </div>




</div>

@endsection