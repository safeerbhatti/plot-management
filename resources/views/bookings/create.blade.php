@extends('layouts.app',  ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <form action="/booking" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="size" value="" />
        <input type="hidden" name="slug" id="slug" class="slug" value="{{$slug}}" />

        <label for="class">Class</label>
        <input
            type="text"
            name="class"
            id="class"
            value="{{ old('class') }}"
        />
        <br/>
        @error('class')
        {{ $message }}
        @enderror
        <br>

        <label for="plot_number">Plot Number</label>
        <input
            type="text"
            name="plot_number"
            id="plot_number"
            value="{{ old('plot_number') }}"
        />
        <br/>
        @error('plot_number')
        {{ $message }}
        @enderror
        <br>

        {{-- <label for="plot_number">Plot Number</label>
        <select name="plot_number[]" id="plot_number" multiple>
            @foreach($plots as $plot)
            <option value="{{ $plot->plot_number }}">
                {{$plot->plot_number}}
            </option>
            @endforeach
        </select>
        --}}

        <div id="details" style="display: none">
            <label for="khata_number">Khata Number</label>
            <input
                type="text"
                name="khata_number"
                id="khata_number"
                value="{{ old('khata_number') }}"
            />
            <br />
            @error('khata_number')
            {{ $message }}
            @enderror
            <br>

            <label for="agreement_number">Agreement Number</label>
            <input
                type="text"
                name="agreement_number"
                id="agreement_number"
                value="{{ old('agreement_number') }}"
            />
            <input type="file" name="agreement_file" id="agreement_file" />
            <br />
            @error('agreement_number')
            {{ $message }}
            @enderror
            <br>

            <label for="price_square_feet">Price per square feet</label>
            <input
                type="number"
                name="price_square_feet"
                id="price_square_feet"
                value="{{ old('price_square_feet') }}"
            />
            <br />
            @error('price_square_feet')
            {{ $message }}
            @enderror
            <br>

            <label for="down_payment">Down Payment</label>
            <input
                type="number"
                name="down_payment"
                id="down_payment"
                value="{{ old('down_payment') }}"
            />
            <br />
            @error('down_payment')
            {{ $message }}
            @enderror
            <br>

            <label for="instalment_duration">Instalment Duration</label>
            <input
                type="number"
                name="instalment_duration"
                id="instalment_duration"
                value="{{ old('instalment_duration') }}"
            />
            <br />

            @error('instalment_duration')
            {{ $message }}
            @enderror
            <br>

            <label for="development_charges">Development Charges Amount</label>
            <input
                type="number"
                name="development_charges"
                id="development_charges"
                value="{{ old('development_charges') }}"
            />

            <br />
            @error('development_charges')
            {{ $message }}
            @enderror
            <br>

            <label for="bi-yearly-fee">Bi Yearly Fee</label>
            <input
                type="number"
                name="bi-yearly-fee"
                id="bi-yearly-fee"
                value="{{ old('bi-yearly-fee') }}"
            />

            <br />
            @error('bi-yearly-fee')
            {{ $message }}
            @enderror
            <br>

            <input
                type="radio"
                name="biYearlyRadio"
                id="payBiYearlyMonthly"
                value="monthly"
                checked
            />
            <label for="payBiYearlyMonthly"> Add In Monthly Instalment </label>
            <input
                type="radio"
                name="biYearlyRadio"
                id="payBiYearlyOnce"
                value="once"
            />
            <label for="payBiYearlyOnce"> Add In Saperate Payment </label>
            <br />
            <label for="instalment_duration">Monthly Installment</label>
            <input
                type="number"
                name="instalment_fee"
                id="instalment_fee"
                readonly
            />
            <button type="button" id="calculate">Calculate</button>
            <br />
        </div>

        <button type="submit">Submit</button>
    </form>

    <div
        class="parent"
        style="
            width: 350px;
            height: 200px;
            border: 1px solid black;
            margin: auto;
            display: grid;
            grid-template-columns: 250px 100px;
        "
    >
        <div class="child child1" style="border: 1px solid black">
            Price per square feet
        </div>
        <div
            id="square_price"
            class="child child1"
            style="border: 1px solid black"
        ></div>
        <div class="child child1" style="border: 1px solid black">
            Down Payment
        </div>
        <div
            class="child child1"
            style="border: 1px solid black"
            id="down_payment2"
        ></div>
        <div class="child child1" style="border: 1px solid black">
            Monthly Instalment
        </div>
        <div
            class="child child1"
            style="border: 1px solid black"
            id="monthly_instalment"
        ></div>
        <div class="child child1" style="border: 1px solid black">
            Development Charges
        </div>
        <div
            class="child child1"
            style="border: 1px solid black"
            id="dev_charges"
        ></div>
        <div class="child child1" style="border: 1px solid black">
            Bi Yearly Fee
        </div>
        <div
            class="child child1"
            style="border: 1px solid black"
            id="bi_yearly_fee"
        ></div>
        <div class="child child1" style="border: 1px solid black">
            Total Fee
        </div>
        <div
            class="child child1"
            style="border: 1px solid black"
            id="total_fee"
        ></div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $("#class").on("change", function () {
            $("#plot_number").on("change", function () {
                var plot_number = $("#class").val()+'@'+$("#plot_number").val();
                var slug = '/' + $("#slug").val();
            $.ajax({
                url: slug + "/plot/" + plot_number,
                type: "GET",
                success: function (data) {

                    if(data.booking_id === 0 || data.booking_id === null)
                    {
                        $('input[name="size"]').val(data.plot_area_in_square_feet);
                        $("#details").show();
                    }
                    else if(jQuery.isEmptyObject(data)
)
                    {
                        alert('Plot number does not exist');
                    }
                    else
                    {
                        alert('Booking already exists');
                    }
                },
            });
        });
        })

        $("#plot_number").on("change", function () {
            $("#class").on("change", function () {
            var plot_number = $("#class").val()+'@'+$("#plot_number").val();
            $.ajax({
                url: "/plot/" + plot_number,
                type: "GET",
                success: function (data) {

                    if(data.booking_id === 0 || data.booking_id === null)
                    {
                        $('input[name="size"]').val(data.plot_area_in_square_feet);
                        $("#details").show();
                    }
                    else
                    {
                        alert('A booking already exists');
                    }
                },
            });
        });
        })


        $("#price_square_feet").on("change", function () {
            var square_price = $("#price_square_feet").val();
            $("#square_price").text(square_price);
        });

        $("#down_payment").on("change", function () {
            var square_price = $("#down_payment").val();
            $("#down_payment2").text(square_price);
        });

        $("#development_charges").on("change", function () {
            var square_price = $("#development_charges").val();
            $("#dev_charges").text(square_price);
        });

        $("#bi-yearly-fee").on("change", function () {
            var square_price = $("#bi-yearly-fee").val();
            $("#bi_yearly_fee").text(square_price);
        });


        $("#calculate").on("click", function () {
            // calculate total size and price from price_square_feet
            var price_square_feet = $("#price_square_feet").val();
            var size = $('input[name="size"]').val();
            var bi_fee = $("#bi-yearly-fee").val();
            var value = $("input[name='biYearlyRadio']:checked").val();

            console.log('bi fee' + bi_fee);
            console.log(value);

            var total_price = size * price_square_feet;
            var new_total;

            if(value === 'monthly')
            {
                new_total = parseFloat(total_price) + parseFloat(bi_fee)
            }
            else if(value === 'once')
            {
                new_total = total_price;
            }

            total_price = new_total;


            // calculate down payment
            var down_payment = $("#down_payment").val();
            var total_price_after_down_payment = total_price - down_payment;

            // divide by monthly instalment
            var instalment_duration = $("#instalment_duration").val();
            var monthly_instalment =
                total_price_after_down_payment / instalment_duration;

            // put in into instalment_fee
            $("#instalment_fee").val(monthly_instalment);
            $("#monthly_instalment").text(monthly_instalment);
        });
    });
</script>

@endsection
