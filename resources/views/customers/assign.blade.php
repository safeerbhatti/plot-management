@extends('layouts.app') @section('content')


<div class="container-fluid">
    <form action="/booking/assign" method="POST">
        @csrf
    
        <label for="booking_id">Booking ID</label>
        <select for="customer_id" name="customer_id" id="customer_id">
            @foreach($customers as $customer)
            <option value="{{ $customer }}">{{ $customer }}</option>
            @endforeach
        </select>
            
        <label for="customer_id">Select Customer ID</label>
        <select for="customer_id" name="customer_id" id="customer_id">
            @foreach($customers as $customer)
            <option value="{{ $customer }}">{{ $customer }}</option>
            @endforeach
        </select>
    
    
        <button type="submit">Assign</button>
    </form>
</div>

@endsection