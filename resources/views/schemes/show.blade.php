@extends('layouts.app') @section('content')

<div class="container-fluid">
    <p>List of all plots in this scheme:</p>

    <h2>{{ $scheme->name }}</h2>

    <a href="/plot/create">Create new plot</a>

    @foreach($scheme->plots as $plot) Plot Number: {{ $plot->plot_number }}
    <br />
    Plot Area: {{ $plot->plot_area_in_square_feet }} <br />
    <br />
    @endforeach
</div>

@endsection
