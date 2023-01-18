@extends('layouts.app')
@section('content')

<form action="/dev-charges" method="POST">
    @csrf

    <label for="booking_id">Booking ID</label>
    <input
        type="text"
        name="booking_id"
        value="{{ $booking->id }}"
        readonly
    />
    <br>

    @error('booking_id')
    {{ $message }}
    @enderror
    <br>
    <label for="installment_month">Payment Type</label>
    <input
        type="text"
        name="installment_month"
        value="Development Charges"
        readonly
    />
    <br>
    @error('installment_month')
    {{ $message }}
    @enderror
    <br>

    <label for="payable_amount">Payable Amount</label>
    <input
        type="number"
        name="payable_amount"
        id="amount"
        value="{{$booking->development_charges}}"
        readonly
    />
    <br>
    @error('payable_amount')
    {{ $message }}
    @enderror
    <br>
    <label for="installment_amount">Select Amount between 0 and {{$booking->development_charges}}</label>
    <input
        type="number"
        name="installment_amount"
        value="0"
        id="month"
        max="{{$booking->development_charges}}"
    />


    <button type="submit">Submit</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        $('#month').on('input', function() {
        var value = $('#month').val();
        var max = $('#amount').val();

        var newValue = parseInt(value);
        var newMax = parseInt(max);

        if(newValue > newMax)
        {
            $('#month').val(newMax);
        }
        });

</script>

@endsection