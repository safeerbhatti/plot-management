@extends('layouts.app', ['slug' => $slug])
@section('content')


<div class="container-fluid">
    @if($plots === null)
    <h3 class="text-danger">No plots available on this scheme</h3>
    @else
    <div class="search-bar border-left-primary my-3 rounded shadow">
        <form class="search-bar_form py-3">
            <div class="row">
                <label class="form-label col-form-label font-weight-bolder text-gray-800" for="search">Search</label>
                <input id="search" class="form-control w-25 rounded-pill" type="text">
            </div>
        </form>
    </div>

    <!-- Table From Bootsrap -->
    <table class="table table-borderless">
        <thead class="border-left-primary shadow rounded ">
            <tr class="text-gray-800 font-wieght-bolder py-3">
                <th scope="col">Plot number and class</th>
                <th scope="col">Booked/Available</th>
                <th scope="col">Area</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Remaining Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plots as $plot)
            <tr>
                <!-- <th scope="row">1</th> -->
                <td>{{ $plot->plot_number }} {{$plot->class}} </td>
                <td>Booked</td>
                <td>{{ $plot->plot_area_in_square_feet }}</td>
                <td>John</td>
                <td>1234500</td>
                <td><button class="btn rounded-pill border-primary mx-2">Transfer</button><button class="btn rounded-pill border-primary">Cancel</button></td>
                <td><button class="btn rounded-pill border-primary">Book Now</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Bootstrap table end -->

    <!-- @foreach($plots as $plot)
    <div class="card shadow border-left-primary text-gray-800">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Scheme Name : {{ $plot->scheme->name }} </li>
            <li class="list-group-item">Class: {{$plot->class}} </li>
            <li class="list-group-item">Plot Number: {{ $plot->plot_number }} </li>
            <li class="list-group-item">Plot Area: {{ $plot->plot_area_in_square_feet }}</li>
        </ul>
    </div>
    @endforeach -->
    @endif
</div>


@endsection