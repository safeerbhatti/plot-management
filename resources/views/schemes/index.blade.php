@extends('layouts.app') @section('content')

<div class="container-fluid">

    <div class="card border-left-primary shadow">
        <h3 class="card-header text-primary font-weight-bold">Scheme Details </h3>
        @foreach($schemes as $scheme)
        <div class="card-body text-gray-800">
            <h5 class="card-title font-weight-bold">Scheme Name: {{ $scheme->name }}</h5>
            <div class="card-text"><a class="card-link" href="/{{$scheme->slug ?? "none" }}/booking">click here</a> to view scheme details.</div>
            <hr>
        </div>

        @endforeach
    </div>
</div>/

@endsection