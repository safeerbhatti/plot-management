<form action="/booking" method="POST">
    @csrf

    <label for="plot_number">Plot Number</label>
    <input type="text" name="plot_number" id="plot_number" value="{{old('plot_number')}}">
    <br>

    <label for="price_square_feet">Price per square feet</label>
    <input type="number" name="price_square_feet" id="price_square_feet" value="{{old('price_square_feet')}}">
    <br>

    <label for="down_payment">Down Payment</label>
    <input type="number" name="down_payment" id="down_payment" value="{{old('down_payment')}}">
    <br>

    <label for="instalment_duration">Instalment Duration</label>
    <input type="number" name="instalment_duration" id="instalment_duration" value="{{old('instalment_duration')}}">
    <br>

    <label for="development_charges">Development Charges Amount</label>
    <input type="number" name="development_charges" id="development_charges" value="{{old('development_charges')}}">
    <br>

    <label for="number_of_dev_charges">Total Number of Development Charges</label>
    <input type="number" name="number_of_dev_charges" id="number_of_dev_charges" value="{{old('number_of_dev_charges')}}">
    <br>

    <label for="khata_number">Khata Number</label>
    <input type="text" name="khata_number" id="khata_number" value="{{old('khata_number')}}">
    <br>

    <label for="agreement_number">Agreement Number</label>
    <input type="text" name="agreement_number" id="agreement_number" value="{{old('agreement_number')}}">
    <br>

    <button type="submit">Submit</button>
</form>
