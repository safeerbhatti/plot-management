@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <div class="card border-left-primary shadow my-5">
        <h3 class="card-header font-weight-bold text-primary">Booking Details</h3>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Booking ID: {{ $booking->id }}</li>
            <li class="list-group-item">Class: {{ $booking->plot->class}}</li>
            <li class="list-group-item">Number: {{ $booking->plot->plot_number}} </li>
            <li class="list-group-item">Total Area in Square feet: {{ $booking->plot->plot_area_in_square_feet}}</li>
        </ul>
    </div>

    <div class="card border-left-success shadwo my-5">
        <h4 class="card-header font-weight-bold text-success">Pricing</h4>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Price/Square feet: Rupees {{ $booking->price_square_feet }}/-</li>
            <li class="list-group-item">Total Amount: Rupees {{ $booking->total_amount }}/-</li>
        </ul>
    </div>

    <div class="card border-left-danger shadwo my-5">
        <h4 class="card-header font-weight-bold text-danger">Development Charges</h4>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Amount: Rupees {{ $booking->development_charges }}/-</li>
        </ul>
    </div>

    <div class="card border-left-info shadwo my-5">
        <h4 class="card-header font-weight-bold text-info">Development Charges</h4>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Amount: Rupees {{$booking->bi_yearly_fee}}</li>
            <li class="list-group-item">
                @if ($booking->bi_yearly_type === 'monthly')
                <p>Bi Yearly Fee added in instalments.</p>
                @elseif($booking->bi_yearly_type === 'once')
                <p>Bi yearly fee saperate from monthly instalments.</p>
                @endif
            </li>
        </ul>
    </div>

    <div class="card border-left-warning shadwo my-5">
        <h4 class="card-header font-weight-bold text-warning">Payment Information</h4>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Down Payment: Rupees {{ $booking->down_payment}}/-</li>
            <li class="list-group-item"> Instalment/Month: Rupees {{ $booking->instalment_per_month}}/-</li>
            <li class="list-group-item"> Remaining Amount: Rupees {{ $booking->remaining_amount }}/-</li>
            <li class="list-group-item"> Total Instalment Duration: {{ $booking->instalment_duration }} months</li>
            <li class="list-group-item"> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li>
        </ul>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="{{$booking->agreement_file}}">Click here </a>to view Agreement</li>
        <li class="list-group-item"><a href="/{{$slug}}/invoices/{{$booking->id}}">Click here</a> to check paid invoices</li>
        <li class="list-group-item"><a href="/{{$slug}}/invoice/pay/{{$booking->id}}">Click here</a> to pay Instalment</li>
        <li class="list-group-item"> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li>
        <li class="list-group-item"> @if($booking->bi_fee_status === 'unpaid')
            <a href="/bi-yearly/pay/{{$booking->id}}">Click here</a> to pay Bi Yearly Fee.
            @elseif($booking->bi_fee_status === 'half')
            Bi Yearly Fee partially paid, remaining amount added to dues.
            @elseif($booking->bi_fee_status === 'paid')
            Bi Yearly Fee already paid.
            @endif
        </li>
        <li class="list-group-item"> @if($booking->dev_charges_status === 'unpaid')
            <a href="/dev-charges/pay/{{$booking->id}}">Click here</a> to pay Development Charges.
            @elseif($booking->dev_charges_status === 'half')
            Development charges partially paid, remaining amount added to dues.
            @elseif($booking->dev_charges_status === 'paid')
            Development Charges paid.
            @endif
        </li>
        <li class="list-group-item"> <a href="/{{$slug}}/assign/customer/{{$booking->id}}">Click here</a> to assign a Customer</li>
        <li class="list-group-item"> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li>
    </ul>

    <div class="card border-left-primary shadwo my-5">
        <h4 class="card-header font-weight-bold text-primary">Customer(s) Information</h4>
        @foreach($customers as $customer)
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Customer Name: {{$customer->name}}</li>
            <li class="list-group-item"> Customer Phone: {{$customer->phone}}</li>
            <li class="list-group-item"> Customer CNIC: {{$customer->cnic}}</li>
            <li class="list-group-item">Customer Address: {{$customer->address}}</li>
        </ul>
        @endforeach
    </div>








</div>

@endsection