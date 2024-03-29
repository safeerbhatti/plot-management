@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <h3 class="card-header text-primary">Bookings</h3>
    <table class="plot-info_table table table-borderless">
        <thead class="border-left-primary shadow rounded">
            <tr class="text-gray-800 font-wieght-bolder py-3">
                <th scope="col">Plot Number</th>
                <th scope="col">Area</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Remaining Amount</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <!-- <th scope="row">1</th> -->
                <td> {{$booking->plot->class}}{{$booking->plot->plot_number}} </td>
                <td>{{$booking->plot->plot_area_in_square_feet}}</td>
                <td>

                    @if($booking->customer)
                    {{$booking->customer->name}}
                    @else
                    N/A
                    @endif

                </td>
                <td> {{$booking->remaining_amount}} </td>
                <td><a class="btn rounded-pill border-primary mx-2" href="/{{$slug === null ? $booking->scheme->slug : $slug }}/booking/{{$booking->id}}">Details</a><button class="btn rounded-pill border-primary">Transfer</button></td>
                <td><button class="btn rounded-pill border-primary">Cancel</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection