@extends('layouts.app', ['slug' => $slug])
@section('content')

<div class="container-fluid">
    @foreach($plots as $plot)
    Scheme Name : {{ $plot->scheme->name }} | 
    Plot Number: {{ $plot->plot_number }} |
    Plot Area: {{ $plot->plot_area_in_square_feet }}
    <br>

@endforeach
</div>

@endsection