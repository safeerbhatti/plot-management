@extends('layouts.app') @section('content')

<div class="container-fluid">

    <div class="card border-left-primary shadow">
        <h1 class="card-header text-primary">Scheme Details </h1>
        @foreach($schemes as $scheme)
        <div class="card-body border broder-info">Scheme Name: {{ $scheme->name }} <a class="card-link" href="/{{$scheme->slug ?? "none" }}/booking">click here</a> to view scheme details.</div>
        @endforeach
    </div>
</div>/

@endsection