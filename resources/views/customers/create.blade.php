@extends('layouts.app', ['slug' => $slug])
@section('content')

<form action="/{{$slug}}/customer" method="POST">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{old('name')}}">

    @error('name')
        <p>Can not edit if empty.</p>
    @enderror

    <label for="cnic">Cnic Number</label>
    <input type="text" name="cnic" id="cnic" value="{{old('cnic')}}">

    @error('cnic')
        <p>Can not edit if empty.</p>
    @enderror

    <label for="phone">Phone Number</label>
    <input type="text" name="phone" id="phone" value="{{old('phone')}}">

    @error('phone')
        <p>Can not edit if empty.</p>
    @enderror

    <br>
    <label for="address">Address</label>
    <input type="text" name="address" id="address" value="{{old('address')}}">
    <br>

    @error('address')
        <p>Can not edit if empty.</p>
    @enderror

    <button type="submit">Submit</button>
</form>


@endsection