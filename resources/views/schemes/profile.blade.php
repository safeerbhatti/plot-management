@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="card-body text-gray-800">
        <h5 class="card-title font-weight-bold">{{ $scheme->name }}</h5>
        <div class="card-text">Profile Picture:</div>
        <div class="card-text">Details:</div>
        <div class="card-text">Contact Number:</div>
        <div class="card-text">
            <form
                method="POST"
                action="{{ route('scheme', ['id' => $scheme->id]) }}"
            >
                @csrf @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
        <hr />
    </div>
</div>

@endsection
