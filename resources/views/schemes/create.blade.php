@extends('layouts.app') @section('content')
<form action="/scheme" method="POST">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" />
    <br />
    <button type="submit">Submit</button>
</form>
@endsection
