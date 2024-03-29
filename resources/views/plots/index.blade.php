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

    <div class="plot-info shadow px-5 py-2 my-2 rounded d-flex bg-white">
        <div class="d-flex flex-column py-2 my-3">
            <div>{{$scheme->name}}</div>
            <img class="scheme-logo my-2 img-fluid rounded-circle" src="{{$scheme->picture}}"></img>
        </div>
        <div class="d-flex flex-column py-2 my-3">
            <div class="mb-5">Number of plots: {{$scheme->plots_count}} </div>
            <div>Available Plots: {{$scheme->availble_plots_count}} </div>
        </div>
        <div class="d-flex flex-column py-2 my-3">
            <div>Address: {{$scheme->address}}</div>
            <div>Contact Number: {{$scheme->contact_number}}</div>
        </div>
    </div>

    <!-- Table From Bootsrap -->
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
            @foreach($plots as $plot)
            <tr>
                <!-- <th scope="row">1</th> -->
                <td>{{ $plot->plot_number }} {{$plot->class}} </td>
                <td>

                    @if($plot->booking_id !== null)
                    Booked
                    @elseif($plot->booking_id === null)
                    Available
                    @endif

                </td>
                <td>{{ $plot->plot_area_in_square_feet }}</td>
                <td>

                    @if($plot->booking)
                    @if($plot->booking->customer)
                    {{ $plot->booking->customer->name }}
                    @else
                    N/A
                    @endif
                    @else
                    Unregistered
                    @endif
                </td>
                <td>

                    @if($plot->booking)
                    {{ $plot->booking->remaining_amount }}
                    @else
                    Unregistered
                    @endif

                </td>
                <td>
                    @if($plot->booking)
                    <button class="btn rounded-pill border-primary">Transfer</button>
                    <a class="btn rounded-pill border-primary" href="/{{$slug}}/booking/{{$plot->booking->id}}">Details</a>
                    @else
                    <a class="btn rounded-pill border-primary mx-2" href="/{{$slug}}/booking/create/{{$plot->plot_number}}/{{$plot->class}}">Book Now</a>
                    <form method="POST" action="/{{$slug}}/plot/{{$plot->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="mt-2 btn rounded-pill border-primary mx-2" type="submit">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>


@endsection