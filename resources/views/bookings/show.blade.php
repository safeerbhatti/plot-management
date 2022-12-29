<h2>Booking Details</h2>
Booking ID: {{ $booking->id }}.
Plot ID: {{ $booking->plot->id}}.
Plot Number: {{ $booking->plot->plot_number }}.
Plot Area in Square feet: {{ $booking->plot->plot_area_in_square_feet }}.

<h4>Pricing</h4>
Price/Square feet: Rupees {{ $booking->price_square_feet }}/- <br>
Total Amount: Rupees {{ $booking->total_amount }}/-

<h4>Development Charges</h3>
Amount: Rupees {{ $booking->development_charges }}/-<br>
Times Customer has to pay: {{ $booking->number_of_dev_charges }}.<br>
Times Customer has paid: {{ $booking->paid_number_of_dev_charges }}.<br>
Number of payments remaining {{ $booking->number_of_dev_charges - $booking->paid_number_of_dev_charges }}.<br>

<h4>Payment Information</h4>
Down Payment: Rupees {{ $booking->down_payment}}/- <br>
Instalment/Month: Rupees {{ $booking->instalment_per_month}}/- <br>
Remaining Amount: Rupees {{ $booking->remaining_amount }}/- <br>
Total Instalment Duration: {{ $booking->instalment_duration }} months. <br>
Remaining Instalments Duration: {{ $booking->remaining_duration }} months. <br>
<br>
<a href="/invoices/{{$booking->id}}">Click here</a> to check paid invoices. <br>
<a href="/invoice/pay/{{$booking->id}}">Click here</a> to pay Instalment.

<h2>Customer(s) Information</h2>
@foreach($customers as $customer)
    Customer Name: {{$customer->name}}
    Customer Phone: {{$customer->phone}}
    Customer CNIC: {{$customer->cnic}}
    Customer Address: {{$customer->address}}
@endforeach