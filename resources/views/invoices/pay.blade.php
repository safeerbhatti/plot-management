@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <form action="/{{$slug}}/invoice" method="POST">
        @csrf
        <label for="booking-id">Booking ID</label>
        <input
            type="text"
            name="booking_id"
            value="{{ $booking->id }}"
            readonly
        />
        @error('booking_id')
        {{ $message }}
        @enderror
        <br>
        <input
            type="hidden"
            name="monthly_installment_fee"
            value="{{ $booking->instalment_per_month }}"
        />
        <br />
        @error('booking_id')
        {{ $message }}
        @enderror
        <br>

        <div id="installment_section" style="display: none">
            <label for="installment_year">Instalment Year</label>
            <select name="installment_year">
                @php
                $currentYear = date('Y'); 
                $startingYear = date('Y', strtotime($booking->created_at)); 
                $bookingDuration = $booking->instalment_duration / 12; 
                $endingYear = $startingYear + $bookingDuration; 
                for($i = $startingYear; $i <=$endingYear; $i++) 
                { echo "<option>$i</option>"; } 
                @endphp
            </select>
            <br />


            <label for="installment_month">Instalment Month</label>
            <div id="installment_months"></div>
            <br />

            <label for="instalment_amount">Instalment Amount</label>
            <input type="number" id="instalment_amount" readonly />
            <br />

            <label for="instalment_amount">Payable Instalment Amount</label>
            <input
                type="number"
                name="instalment_amount"
                id="payable_instalment_amount"
                value="{{ old('instalment_amount') }}"
            />
            <br />
            @error('instalment_amount')
            {{ $message }}
            @enderror
            <br>
        </div>
        <div id="development_section" style="display: none">
            <label for="development_charges">Total Charges</label>
            <input
                type="number"
                name="development_charges"
                id="development_charges"
                value="{{ $booking->development_charges}}"
                readonly
            />
            @error('development_charges')
            {{ $message }}
            @enderror
            <br>

            <label for="pay_charges">Pay Amount</label>
            <input
                type="number"
                name="pay_charges"
                id="pay_charges"
                value="{{ $booking->development_charges}}"
            />
            @error('pay_charges')
            {{ $message }}
            @enderror
            <br>
        </div>

        <div id="bi_yearly_section" style="display: none">
            <label for="development_charges">Total Charges</label>
            <input
                type="number"
                name="bi_yearly_fee"
                id="bi_yearly_fee"
                value="{{ $booking->bi_yearly_fee}}"
                readonly
            />
            @error('bi_yearly_fee')
            {{ $message }}
            @enderror
            <br>

            <label for="pay_yearly">Pay Amount</label>
            <input
                type="number"
                name="pay_yearly"
                id="pay_yearly"
                value="{{ $booking->bi_yearly_fee}}"
            />
            @error('pay_yearly')
            {{ $message }}
            @enderror
            <br>
        </div>

        <button type="button" id="btnInvoice">Show Installment Invoice</button>
        <button type="button" id="btnDev">
            Show Development Charges Invoice
        </button>
        <button type="button" id="btnBi">Show Bi Yearly Invoice</button>
        <button type="submit">Submit</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        var dev = $('#development_charges').val();
        var paydev = $('#pay_charges').val();
        var bi = $('#bi_yearly_fee').val();
        var paybi = $('#pay_yearly').val();

        $('#btnInvoice').click(function () {
            $('#installment_section').show();
            $('#development_section').hide();
            $('#bi_yearly_section').hide();
            $('#development_charges').val("");
            $('#pay_charges').val("");
        });

        $('#btnDev').click(function () {
            $('#development_section').show();
            $('#installment_section').hide();
            $('#bi_yearly_section').hide();
            $('#bi_yearly_fee').val("");
            $('#pay_yearly').val("");
            $('#development_charges').val(dev);
            $('#pay_charges').val(paydev);
        });

        $('#btnBi').click(function () {
            $('#development_section').hide();
            $('#installment_section').hide();
            $('#bi_yearly_section').show();
            $('#development_charges').val("");
            $('#pay_charges').val("");
            $('#bi_yearly_fee').val(bi);
            $('#pay_yearly').val(paybi);

        });

        $('select[name=installment_year]').change(function () {
            var year = $(this).val();
            $.ajax({
                url: '/invoice/getBookingMonths',
                type: 'POST',
                data: {
                    installment_year: year,
                    booking_id: {{ $booking-> id }}, 
                    _token: '{{ csrf_token() }}'
                },
        success: function (response) {
            // check if response is not empty
            if (response != '') {
                // empty the installment_months div
                $('#installment_months').html('');
                //loop through the response
                $.each(response, function (key, value) {
                    // append the checkbox
                    $('#installment_months').append('<input type="checkbox" name="installment_month[]" value="' + value + '">' + value + '<br>');
                });

            }
        }
            });
        }).trigger('change');

    // add event to the installment_months div
    $('#installment_months').on('change', 'input[type=checkbox]', function () {
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

@endsection
