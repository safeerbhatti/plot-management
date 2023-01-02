@include('nav')


<form action="/invoice" method="POST">
    @csrf
    <label for="booking-id">Select Booking ID</label>
    <select for="booking_id" name="booking_id" id="booking_id">
        @foreach($bookings as $booking)
        <option value="{{ $booking->id }}">{{$booking->id}}</option>
        @endforeach
    </select>
    <br>
    <label for="booking_month">Booking Month</label>
<br>
    <label for="dec">Dec</label>
    <input type="checkbox" name="booking_month[]" value="Dec" />
    <label for="dec">Jan</label>
    <input type="checkbox" name="booking_month[]" value="Jan" />
    <label for="dec">Feb</label>
    <input type="checkbox" name="booking_month[]" value="Feb" />
<br>

    <label for="instalment_amount">Total Amount</label>
    <input type="number" name="instalment_amount" id="instalment_amount" value="{{old('instalment_amount')}}">
    
    <button type="submit">Submit</button>
</form>
