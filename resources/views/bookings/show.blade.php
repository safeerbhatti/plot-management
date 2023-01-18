@extends('layouts.app') @section('content')

<div class="container-fluid">
    <h2>Booking Details</h2>
Booking ID: {{ $booking->id }}.

Total Plots: Test
Plot Numbers: Test
Total Area in Square feet: Test.

<h4>Pricing</h4>
Price/Square feet: Rupees {{ $booking->price_square_feet }}/- <br>
Total Amount: Rupees {{ $booking->total_amount }}/-

<h4>Development Charges</h3>
Amount: Rupees {{ $booking->development_charges }}/-<br>

<h4>Development Charges</h3>
Amount: Rupees {{$booking->bi_yearly_fee}}

@if ($booking->bi_yearly_type === 'monthly')
    <p>Bi Yearly Fee added in instalments.</p>
@elseif($booking->bi_yearly_type === 'once')
    <p>Bi yearly fee saperate from monthly instalments.</p>
@endif


<h4>Payment Information</h4>
Down Payment: Rupees {{ $booking->down_payment}}/- <br>
Instalment/Month: Rupees {{ $booking->instalment_per_month}}/- <br>
Remaining Amount: Rupees {{ $booking->remaining_amount }}/- <br>
Total Instalment Duration: {{ $booking->instalment_duration }} months. <br>
Remaining Instalments Duration: {{ $booking->remaining_duration }} months. <br>
<br>
<a href="{{$booking->agreement_file}}">Click here </a>to view Agreement. <br>
<a href="/invoices/{{$booking->id}}">Click here</a> to check paid invoices. <br>
<a href="/invoice/pay/{{$booking->id}}">Click here</a> to pay Instalment. <br>

@if($booking->bi_fee_status === 'unpaid')
    <a href="/bi-yearly/pay/{{$booking->id}}">Click here</a> to pay Bi Yearly Fee.
@elseif($booking->bi_fee_status === 'half')
    Bi Yearly Fee partially paid, remaining amount added to dues.
@elseif($booking->bi_fee_status === 'paid')
    Bi Yearly Fee already paid.
@endif
<br>

@if($booking->dev_charges_status === 'unpaid')
<a href="/dev-charges/pay/{{$booking->id}}">Click here</a> to pay Development Charges.
@elseif($booking->dev_charges_status === 'half')
    Development charges partially paid, remaining amount added to dues.
@elseif($booking->dev_charges_status === 'paid')
    Development Charges paid.
@endif
<br>
<a href="/assign/customer/{{$booking->id}}">Click here</a> to assign a Customer.


<h2>Customer(s) Information</h2>
@foreach($customers as $customer)
    Customer Name: {{$customer->name}}
    Customer Phone: {{$customer->phone}}
    Customer CNIC: {{$customer->cnic}}
    Customer Address: {{$customer->address}}
@endforeach
</div>

@endsection