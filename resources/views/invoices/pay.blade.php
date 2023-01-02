@include('nav')

<form action="/invoice" method="POST">
    @csrf
    <label for="booking-id">Booking ID</label>
    <input type="text" name="booking_id" value="{{ $booking->id }}" readonly>
    <input type="hidden" name="monthly_installment_fee" value="{{ $booking->instalment_per_month }}">
    <br>

    <div id="installment_section" style="display: none">
        <label for="installment_year">Instalment Year</label>
        <select name="installment_year">
            @php
                $currentYear = date('Y');
                // get starting year from booking created at
                $startingYear = date('Y', strtotime($booking->created_at));

                // get booking duration
                $bookingDuration = $booking->instalment_duration / 12;

                // get ending year
                $endingYear = $startingYear + $bookingDuration;

                // make a look which echo options with year
                for ($i = $startingYear; $i <= $endingYear; $i++) {
                    echo "<option>$i</option>";
                }
            @endphp
        </select>
        <br>

        <label for="installment_month">Instalment Month</label>
        <div id="installment_months"></div>
        <br>

        <label for="instalment_amount">Instalment Amount</label>
        <input type="number" id="instalment_amount" readonly>
        <br>

        <label for="instalment_amount">Payable Instalment Amount</label>
        <input type="number" name="instalment_amount" id="payable_instalment_amount" value="{{old('instalment_amount')}}">
        <br>
    </div>


    <div id="development_section" style="display: none;">
        Development Fee
    </div>

    <button type="button" id="btnInvoice">Show Me Installment Invoice</button>
    <button type="button" id="btnDev">Show Me Development Charges Invoice</button>
    <button type="submit">Submit</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $('#btnInvoice').click(function(){
            $('#installment_section').show();
            $('#development_section').hide();
        });

        $('#btnDev').click(function(){
            $('#development_section').show();
            $('#installment_section').hide();
        });

        $('select[name=installment_year]').change(function(){
            var year = $(this).val();
            $.ajax({
                url: '/invoice/getBookingMonths',
                type: 'POST',
                data: {
                    installment_year: year,
                    booking_id: {{ $booking->id }},
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    // check if response is not empty
                    if (response != '') {
                        // empty the installment_months div
                        $('#installment_months').html('');
                        //loop through the response
                        $.each(response, function(key, value){
                            // append the checkbox
                            $('#installment_months').append('<input type="checkbox" name="installment_month[]" value="'+value+'">'+value+'<br>');
                        });

                    }
                }
            });
        }).trigger('change');

        // add event to the installment_months div
        $('#installment_months').on('change', 'input[type=checkbox]', function(){
            // get the monthly installment fee
            var monthlyInstallmentFee = $('input[name=monthly_installment_fee]').val();
            // get the checked months
            var checkedMonths = $('input[name="installment_month[]"]:checked').length;
            // calculate the payable amount
            var payableAmount = monthlyInstallmentFee * checkedMonths;
            // set the payable amount to the input field
            $('#instalment_amount').val(payableAmount);
            $('#payable_instalment_amount').val(payableAmount);
        });
    });
</script>
