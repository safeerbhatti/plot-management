<form action="/booking" method="POST">
    @csrf
    <input type="hidden" name="size" value="">

    <label for="khata_number">Khata Number</label>
    <input type="text" name="khata_number" id="khata_number" value="{{old('khata_number')}}">
    <br>

    <label for="agreement_number">Agreement Number</label>
    <input type="text" name="agreement_number" id="agreement_number" value="{{old('agreement_number')}}">
    <br>

    <label for="plot_number">Plot Number</label>
    <input type="text" name="plot_number" id="plot_number" value="{{old('plot_number')}}">
    <br>

    <div id="details" style="display: none">
        <label for="price_square_feet">Price per square feet</label>
        <input type="number" name="price_square_feet" id="price_square_feet" value="{{old('price_square_feet')}}">
        <br>

        <label for="down_payment">Down Payment</label>
        <input type="number" name="down_payment" id="down_payment" value="{{old('down_payment')}}">
        <br>

        <label for="instalment_duration">Instalment Duration</label>
        <input type="number" name="instalment_duration" id="instalment_duration" value="{{old('instalment_duration')}}">
        <br>

        <label for="instalment_duration">Monthly Installment</label>
        <input type="number" name="instalment_fee" id="instalment_fee" readonly>
        <button type="button" id="calculate">Calculate</button>
        <br>

        <label for="development_charges">Development Charges Amount</label>
        <input type="number" name="development_charges" id="development_charges" value="{{old('development_charges')}}">
        <br>

        <label for="number_of_dev_charges">Total Number of Development Charges</label>
        <input type="number" name="number_of_dev_charges" id="number_of_dev_charges" value="{{old('number_of_dev_charges')}}">
        <br>
    </div>

    <button type="submit">Submit</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#plot_number').on('change', function(){
            var plot_number = $(this).val();
            $.ajax({
                url: '/plot/'+plot_number,
                type: 'GET',
                success: function(data){
                    $('input[name="size"]').val(data.plot_area_in_square_feet);

                    // show the details div
                    $('#details').show();
                }
            });
        });

        $('#calculate').on('click', function(){
            // calculate total size and price from price_square_feet
            var price_square_feet = $('#price_square_feet').val();
            var size = $('input[name="size"]').val();
            var total_price = price_square_feet * size;

            // calculate down payment
            var down_payment = $('#down_payment').val();
            var total_price_after_down_payment = total_price - down_payment;

            // divide by monthly instalment
            var instalment_duration = $('#instalment_duration').val();
            var monthly_instalment = total_price_after_down_payment / instalment_duration;

            // put in into instalment_fee
            $('#instalment_fee').val(monthly_instalment);

        })
    });
</script>
