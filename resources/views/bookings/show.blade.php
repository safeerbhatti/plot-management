@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">

    <ul class="list-group list-group-flush">
        <li>Plot: {{ $booking->plot->plot_number}} </li>
        <li>Size: {{ $booking->plot->plot_area_in_square_feet}}</li>
        <li>Scheme Name: {{ $scheme->name}}</li>
        <li>Total Amount: Rupees {{ $booking->total_amount }}/-</li>
        <li>
            @if ($booking->bi_yearly_type === 'monthly')
            <p>Bi Yearly Fee added in instalments.</p>
            @elseif($booking->bi_yearly_type === 'once')
            <p>Bi yearly fee saperate from monthly instalments.</p>
            @endif
        </li>
        <li>Development Charges: {{ $booking->development_charges }}/-</li>
        <li>Booking ID: {{ $booking->id }}</li>
        <li>Class: {{ $booking->plot->class}}</li>
    </ul>

    <h4 class="card-header font-weight-bold text-success">Pricing</h4>

    <ul class="list-group list-group-flush">
        <li>Price/Square feet: Rupees {{ $booking->price_square_feet }}/-</li>
    </ul>


    <h4 class="card-header font-weight-bold text-info">Development Charges</h4>

    <ul class="list-group list-group-flush">
        <li>Amount: Rupees {{$booking->bi_yearly_fee}}</li>
    </ul>

    <h4 class="card-header font-weight-bold text-warning">Payment Information</h4>

    <ul class="list-group list-group-flush">
        <li>Down Payment: Rupees {{ $booking->down_payment}}/-</li>
        <li> Instalment/Month: Rupees {{ $booking->instalment_per_month}}/-</li>
        <li> Remaining Amount: Rupees {{ $booking->remaining_amount }}/-</li>
        <li> Total Instalment Duration: {{ $booking->instalment_duration }} months</li>
        <li> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li>
    </ul>

    <ul class="list-group list-group-flush">
        <li><a href="{{$booking->agreement_file}}">Click here </a>to view Agreement</li>
        <li><a href="/{{$slug}}/invoices/{{$booking->id}}">Click here</a> to check paid invoices</li>
        <li><a href="/{{$slug}}/invoice/pay/{{$booking->id}}">Click here</a> to pay Instalment</li>
        <li> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li>
        <li> @if($booking->bi_fee_status === 'unpaid')
            <a href="/bi-yearly/pay/{{$booking->id}}">Click here</a> to pay Bi Yearly Fee.
            @elseif($booking->bi_fee_status === 'half')
            Bi Yearly Fee partially paid, remaining amount added to dues.
            @elseif($booking->bi_fee_status === 'paid')
            Bi Yearly Fee already paid.
            @endif
        </li>
        <li> @if($booking->dev_charges_status === 'unpaid')
            <a href="/dev-charges/pay/{{$booking->id}}">Click here</a> to pay Development Charges.
            @elseif($booking->dev_charges_status === 'half')
            Development charges partially paid, remaining amount added to dues.
            @elseif($booking->dev_charges_status === 'paid')
            Development Charges paid.
            @endif
        </li>
        <li> <a href="/{{$slug}}/assign/customer/{{$booking->id}}">Click here</a> to assign a Customer</li>
        <li> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li>
    </ul>

    <h4 class="card-header font-weight-bold text-primary">Customer(s) Information</h4>
    @foreach($customers as $customer)
    <ul class="list-group list-group-flush">
        <li>Customer Name: {{$customer->name}}</li>
        <li> Customer Phone: {{$customer->phone}}</li>
        <li> Customer CNIC: {{$customer->cnic}}</li>
        <li>Customer Address: {{$customer->address}}</li>
    </ul>
    @endforeach

</div>

@endsection