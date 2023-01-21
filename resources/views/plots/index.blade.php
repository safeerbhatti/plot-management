@extends('layouts.app', ['slug' => $slug]) 
@section('content')


<div class="container-fluid">
    @if($plots === null)
    No plots available on this scheme
    @else
    @foreach($plots as $plot)
    Scheme Name : {{ $plot->scheme->name }} | 
    Class: {{$plot->class}} |
    Plot Number: {{ $plot->plot_number }} |
    Plot Area: {{ $plot->plot_area_in_square_feet }}
    <br>
    @endforeach
    @endif
</div>


@endsection