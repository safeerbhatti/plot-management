@extends('layouts.app')

@section('content')
<br>
<br>
@foreach($schemes as $scheme)
    Scheme Name: {{ $scheme->name }}
    <a href="/scheme/{{$scheme->id}}">click here</a> to view scheme details.
    <br>
@endforeach
@endsection



