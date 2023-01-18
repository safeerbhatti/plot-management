@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <h2>Booking ID: {{$booking->id}} </h2>

<hr>

<h3>Instalments</h3>

<hr>
@foreach($invoices as $invoice)
    Instalment Month: {{ $invoice->booking_month }}. <br>
    Instalment Amount: Rupees {{ $booking->instalment_per_month }} /- <br>
    Instalment Paid: Rupees {{ $invoice->instalment_amount }} /- <br>
    Amount added to deus: Rupees {{ $booking->instalment_per_month-$invoice->instalment_amount }} /-
    <hr>
@endforeach

Total Dues Remaining: Rupees {{$dues->dues_remaining}} /-
</div>

@endsection