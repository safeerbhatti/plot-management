@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <!-- <div class="card border-left-primary shadow">
        <h3 class="card-header text-success">Bookings</h3>
        @foreach($bookings as $booking)
        <div class="card-body text-gray-800">
            <h5 class="card-title font-weight-bold ">Booking ID : {{$booking->id}}</h5>
            <div class="card-text"><a class="card-link" href="/{{$slug}}/booking/{{$booking->id}}">Click here</a> for more details.</div>
            <hr>
        </div>

        @endforeach
    </div> -->
    <h3 class="card-header text-primary">Bookings</h3>
    <table class="plot-info_table table table-borderless">
        <thead class="border-left-primary shadow rounded">
            <tr class="text-gray-800 font-wieght-bolder py-3">
                <th scope="col">Plot number and class</th>
                <th scope="col">Booked/Available</th>
                <th scope="col">Area</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Remaining Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <!-- <th scope="row">1</th> -->
                <td>Plot number : Plot Class </td>
                <td>Booked/Available</td>
                <td>120 sqy</td>
                <td>John</td>
                <td>1234500</td>
                <td><button class="btn rounded-pill border-primary mx-2">Transfer</button><button class="btn rounded-pill border-primary">Cancel</button></td>
                <td><button class="btn rounded-pill border-primary">Book Now</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>




</div>

@endsection