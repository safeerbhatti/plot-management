@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <div class="card border-left-primary shadow">
        <h3 class="card-header text-success">Bookings</h3>
        @foreach($bookings as $booking)
        <div class="card-body text-gray-800">
            <h5 class="card-title font-weight-bold ">Booking ID : {{$booking->id}}</h5>
            <div class="card-text"><a class="card-link" href="/{{$slug}}/booking/{{$booking->id}}">Click here</a> for more details.</div>
            <hr>
        </div>

        @endforeach
    </div>




</div>

@endsection