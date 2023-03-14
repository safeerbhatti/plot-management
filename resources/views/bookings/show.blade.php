@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid plot-profile d-flex justify-content-around">

    <div class="plot-profile_list">
        <h4 class="font-weight-bold text-primary">Booking Details</h4>
        <ul class="list-group list-group-flush">
            <li>Plot: {{ $booking->plot->plot_number}} </li>
            <li>Size: {{ $booking->plot->plot_area_in_square_feet}}</li>
            <li>Scheme Name: {{$scheme->name}} </li>
            <li>Total Amount: Rupees {{ $booking->total_amount }}PKR </li>
            <li>Bi-annyal: {{$booking->bi_yearly_fee}}
                @if ($booking->bi_yearly_type === 'monthly')
            Bi Yearly Fee added in instalments.
            @elseif($booking->bi_yearly_type === 'once')
            Bi yearly fee saperate from monthly instalments.
            @endif
            </li>
            <li>Development Charges: {{ $booking->development_charges }} PKR. Status: {{$booking->dev_charges_status}} </li>
            <li>Number of installments: {{ $booking->instalment_duration }}</li>
            <li>Amount of installment: {{ $booking->instalment_per_month}} PKR. </li>
            <li>Number of paid installments: {{ $booking->instalment_duration - $booking->remaining_duration }}</li>
            <li>Down Payment: Rupees {{ $booking->down_payment}} PKR</li>
            <li>Total amount paid: {{ $booking->total_amount - $booking->remaining_amount }} PKR</li>
            <li>Total amount remaining: {{ $booking->remaining_amount }} PKR</li>
            <!-- <li>Price/Square feet: Rupees {{ $booking->price_square_feet }}/-</li>
        <li>Amount: Rupees {{$booking->bi_yearly_fee}}</li>
        <li> Instalment/Month: Rupees {{ $booking->instalment_per_month}}/-</li>
        <li> Total Instalment Duration: {{ $booking->instalment_duration }} months</li>
        <li> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li>
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
        <li> Remaining Instalments Duration: {{ $booking->remaining_duration }} months</li> -->
        </ul>
    </div>

    <div class="plot-profile_customer-info">
        <h4 class="font-weight-bold text-primary">Customer(s) Information</h4>
        <div class="customer-img my-5"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPgW5i4PRnwi6v1A9oAZcN-Zdi0E4K7r9iMcW7X1qVnQ&s" alt="customer-img" class="img-fluid"></div>
        <ul class="plot-profile_customer-info_list list-group list-group-flush">
            <li>1st Owner {{$booking->first_owner}}</li>
            <li>Name: {{$booking->customer->name}} </li>
            <li>Father Name: {{$booking->customer->father_name}}</li>
            <li>Contact Phone: {{$booking->customer->phone}}</li>
            <li>Date of birth: N/A</li>
            <li>Next of kin: {{$booking->customer->next_kin}}</li>
            <li>Customer Address: {{$booking->customer->address}}</li>
        </ul>
    </div>
</div>

@endsection