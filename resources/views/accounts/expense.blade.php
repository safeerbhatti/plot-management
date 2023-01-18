@extends('layouts.app') @section('content')
<div class="container-fluid">
    <form action="/expense" method="POST">
        @csrf
        <label for="type">Expense Type</label>
        <input
            type="text"
            name="type"
            id="type"
            value="{{ old('type') }}"
        />
        @error('type')
        {{ $message }}
        @enderror

        <label for="desc">Expense Description</label>
        <input
            type="text"
            name="desc"
            id="desc"
            value="{{ old('desc') }}"
        />
        @error('desc')
        {{ $message }}
        @enderror

        <button type="submit">Submit</button>
    </form>
</div>
@endsection
