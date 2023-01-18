@extends('layouts.app') @section('content')

<div class="container-fluid">
    <form action="/booking/assign" method="POST">
        @csrf

        <label for="booking_id">Booking ID</label>
        <input
            type="number"
            name="booking_id"
            id="booking_id"
            value="{{ $booking }}"
            readonly
        />
        <br />
        @error('booking_id')
        {{ $message }}
        @enderror
        <br />
        <label for="customer_id">Select Customer ID</label>
        <select for="customer_id" name="customer_id" id="customer_id">
            @foreach($customers as $customer)
            <option value="{{ $customer }}">{{ $customer }}</option>
            @endforeach
        </select>
        <br />
        @error('customer_id')
        {{ $message }}
        @enderror
        <br />

        <button type="submit">Assign</button>
    </form>
</div>

@endsection
