<form action="/invoice" method="POST">
    @csrf
    <label for="booking-id">Select Booking ID</label>
    <select for="booking_id" name="booking_id" id="booking_id">
        <option value="{{ $booking }}">{{$booking}}</option>
    </select>
    <label for="booking_month">Booking Month</label>
    <input type="text" name="booking_month" id="booking_month" value="{{old('booking_month')}}">

    <label for="instalment_amount">Instalment Amount</label>
    <input type="number" name="instalment_amount" id="instalment_amount" value="{{old('instalment_amount')}}">
    
    <button type="submit">Submit</button>
</form>
