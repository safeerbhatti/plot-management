@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <h2>Select Booking to pay installment</h2>


<select id="invoices" name="pay_invoices">
    <option value="none">Select</option>
    @foreach($bookings as $booking)
        <option value="/invoice/pay/{{$booking->id}}">{{$booking->id}}</option>
    @endforeach

</select>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.getElementById("invoices").onchange = function() {
        if (this.selectedIndex!==0) {
            window.location.href = this.value;
        }        
    };
</script>

@endsection
   


