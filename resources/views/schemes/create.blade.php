@extends('layouts.app') @section('content')

<div class="container-fluid">
    <form action="/scheme" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" />
        <br />
        @error('name')
        {{ $message }}
        @enderror
        <br>

        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" />
        <br />
        @error('slug')
        {{ $message }}
        @enderror
        <br>
        <button type="submit">Submit</button>
    </form>
</div>

@endsection
