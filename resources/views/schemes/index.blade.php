@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="schemes-container w-100 flex-wrap d-flex justify-content-start">
        @foreach($schemes as $scheme)
        <div class="card border-top-primary shadow">
            <h1 class="card-header text-primary font-weight-bolder text-center">{{ $scheme->name }}</h1>

            <div class="card-body card-text font-weight-bolder text-primary">
                <div class="scheme-logo mx-auto w-50"><img class="rounded-circle img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPgW5i4PRnwi6v1A9oAZcN-Zdi0E4K7r9iMcW7X1qVnQ&s" alt="scheme-logo"></div>
                <div class="mt-5">Total plots: {{$scheme->plots_count}} </div>
                <div class="my-1">Available plots: {{$scheme->availble_plots_count}}</div>
                <div class="my-1">Booked plots: {{ $scheme->plots_count-$scheme->availble_plots_count }} </div>
                <div class="w-75 mx-auto mt-4"><a href="/{{$scheme->slug}}/booking" class="text-uppercase font-weight-bolder btn text-primary text-center border rounded-pill w-100">select</a></div>
            </div>
        </div>
        @endforeach
    </div>
</div>/
@endsection