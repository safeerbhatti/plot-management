@include('nav')


<form action="/booking/assign" method="POST">
    @csrf

    <label for="booking-id">Select Booking ID</label>
    <select for="booking_id" name="booking_id" id="booking_id">
        @foreach($bookings as $booking)
        <option value="{{ $booking }}">{{ $booking }}</option>
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
