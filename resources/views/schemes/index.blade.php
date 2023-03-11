@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="schemes-container d-flex justify-content-start">
        @foreach($schemes as $scheme)
        <div class="card border-top-primary w-25 shadow mx-3">
            <h1 class="card-header text-primary font-weight-bold text-center">{{ $scheme->name }}</h1>

            <div class="card-body card-text font-weight-bold text-primary">
                <div class="scheme-logo mx-auto w-50"><img class="rounded-circle img-fluid" src="http://plot-management.test/img/undraw_profile.svg" alt="scheme-logo"></div>
                <div class="mt-5">Total plots </div>
                <div class="my-1">Available plots:</div>
                <div class="my-1">Booked plots:</div>
                <div class="w-75 mx-auto mt-4"><button class="text-uppercase font-weight-bold btn text-primary text-center border rounded-pill w-100">select</button></div>
            </div>
        </div>
        @endforeach
    </div>
</div>/

@endsection