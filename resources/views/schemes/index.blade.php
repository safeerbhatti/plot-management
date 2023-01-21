@extends('layouts.app') @section('content')

<div class="container-fluid">
    @foreach($schemes as $scheme) Scheme Name: {{ $scheme->name }}
    <a href="/{{$scheme->slug ?? "none" }}/booking">click here</a> to view scheme details.
    <br />
    @endforeach
</div>/

@endsection
