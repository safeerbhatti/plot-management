@extends('layouts.app', ['slug' => $slug])
@section('content')


<div class="container-fluid">
    @if($plots === null)
    <h3 class="text-danger">No plots available on this scheme</h3>
    @else
    @foreach($plots as $plot)
    <div class="card shadow border-left-primary text-gray-800">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Scheme Name : {{ $plot->scheme->name }} </li>
            <li class="list-group-item">Class: {{$plot->class}} </li>
            <li class="list-group-item">Plot Number: {{ $plot->plot_number }} </li>
            <li class="list-group-item">Plot Area: {{ $plot->plot_area_in_square_feet }}</li>
        </ul>
    </div>
    @endforeach
    @endif
</div>


@endsection