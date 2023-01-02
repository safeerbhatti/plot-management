@include('nav')


<a href="/booking/create">Create new booking</a>
<a href="/invoice">Invoices</a>
<a href="/booking/assign">Assign Customers</a>

<br> <br>

<h2>Bookings</h2>

@foreach($bookings as $booking)
    Booking ID : {{$booking->id}}
    <br>
    <br>
    <a href="/booking/{{$booking->id}}">Click here</a> for more details.
@endforeach