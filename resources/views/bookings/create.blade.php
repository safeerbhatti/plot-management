@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 row">
            <div class="w-100">
                <h1 class="h4 text-gray-900 my-4 font-weight-bolder text-center">Create A new Booking</h1>
                <div class="p-5 row booking-form">
                    <div class="booking-form_plot-details">
                        <form action="/{{ $slug }}/booking" method="POST" enctype="multipart/form-data" class="user">
                            @csrf
                            <input type="hidden" name="size" value="" />
                            <input type="hidden" name="slug" id="slug" class="slug" value="{{ $slug }}" />
                            <div class="form-group row">
                                <div class="w-100">
                                    <input type="text" name="class" id="class" class="form-control" value="{{ old('class') }}" placeholder="Class" />
                                    @error('class')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="w-100">
                                    <input type="text" name="plot_number" id="plot_number" value="{{ old('plot_number') }}" class="form-control" placeholder="Plot Number" />
                                    @error('plot_number')
                                    {{ $message }}
                                    @enderror
                                </div>
                                {{-- <label for="plot_number">Plot Number</label>
                            <select
                                name="plot_number[]"
                                id="plot_number"
                                multiple
                            >
                                @foreach($plots as $plot)
                                <option value="{{ $plot->plot_number }}">
                                {{$plot->plot_number}}
                                </option>
                                @endforeach
                                </select>
                                --}}
                            </div>
                            <div id="details" class="">
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="text" name="khata_number" id="khata_number" value="{{ old('khata_number') }}" class="form-control" placeholder="Khata Number" />
                                        @error('khata_number')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="text" name="agreement_number" id="agreement_number" value="{{ old('agreement_number') }}" class="form-control" placeholder="Agreement Number" />
                                        @error('agreement_number')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="file" name="agreement_file" id="agreement_file" class="form-control" />
                                        @error('agreement_file')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="number" name="price_square_feet" id="price_square_feet" value="{{ old('price_square_feet') }}" class="form-control" placeholder="Price / Square Feet" />
                                        @error('price_square_feet')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="number" name="down_payment" id="down_payment" class="form-control" placeholder="Down Payment" value="{{ old('down_payment') }}" />
                                        @error('down_payment')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="number" name="instalment_duration" id="instalment_duration" value="{{ old('instalment_duration') }}" class="form-control" placeholder="Instalment Duration" />
                                        @error('instalment_duration')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="number" name="development_charges" id="development_charges" value="{{ old('development_charges') }}" class="form-control" placeholder="Development Charges" hidden />
                                        @error('development_charges')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="w-100">
                                        <input type="number" name="bi-yearly-fee" id="bi-yearly-fee" value="{{ old('bi-yearly-fee') }}" class="form-control" placeholder="Bi Yearly Fee" hidden />
                                        @error('bi-yearly-fee')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row justify-content-between">
                                    <div class="font-weight-bold pt-4 px-3">Bi Annual</div>
                                    <div>
                                        <div class="form-group">
                                            <input type="radio" name="biYearlyRadio" id="payBiYearlyMonthly" value="monthly" checked />
                                            <label for="payBiYearlyMonthly">
                                                Add In Monthly Instalment
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="biYearlyRadio" id="payBiYearlyOnce" value="once" />
                                            <label for="payBiYearlyOnce">
                                                Add In Saperate Payment
                                            </label>
                                        </div>
                                        @error('biYearlyRadio')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="monthly-installment">
                        <div class="form-group row justify-content-center">
                            <div>
                                <input class="my-2" type="number" name="instalment_fee" id="instalment_fee" class="form-control" placeholder="Monthly Instalment" readonly />
                                <button class="mx-4 btn btn-secondary border" type="button" id="calculate">
                                    Calculate
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="w-100">
                                <div class="parent" style="
                                            width: 350px;
                                            height: 200px;
                                            border: 1px solid black;
                                            margin: auto;
                                            display: grid;
                                            grid-template-columns: 250px 100px;
                                        ">
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;">
                                        Price per square feet
                                    </div>
                                    <div id="square_price" class="child child1" style="border: 1px solid black; padding-left: 8px;"></div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;">
                                        Down Payment
                                    </div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;" id="down_payment2"></div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;">
                                        Monthly Instalment
                                    </div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;" id="monthly_instalment"></div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;">
                                        Development Charges
                                    </div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;" id="dev_charges"></div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;">
                                        Bi Yearly Fee
                                    </div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;" id="bi_yearly_fee"></div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;">
                                        Total Fee
                                    </div>
                                    <div class="child child1" style="border: 1px solid black; padding-left: 8px;" id="total_fee"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer-info_form">
                        <div class="form-group row">
                            <div class="w-100">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" placeholder="Customer Name" />
                                    @error('name')
                                    <p>Can not edit if empty.</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="customer_cnic" id="customer_cnic" value="{{ old('customer_cnic') }}" placeholder="Customer CNIC" />
                                    @error('customer_cnic')
                                    <p>Can not edit if empty.</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" placeholder="Customer Phone" />
                                    @error('customer_phone')
                                    <p>Can not edit if empty.</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="customer_address" id="customer_address" value="{{ old('customer_address') }}" placeholder="Customer Address" />
                                    @error('customer_address')
                                    <p>Can not edit if empty.</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Submit
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var bi_annual_fee;
    var development_charges_fee;

    $(document).ready(function() {
        $("#class").on("change", function() {
            $("#plot_number").on("change", function() {
                var plot_number =
                    $("#class").val() + "@" + $("#plot_number").val();
                var slug = "/" + $("#slug").val();
                $.ajax({
                    url: slug + "/plot/" + plot_number,
                    type: "GET",
                    success: function(data) {
                        if (data.booking_id === 0 || data.booking_id === null) {
                            $('input[name="size"]').val(
                                data.plot_area_in_square_feet
                            );
                            $("#details").show();
                        } else if (jQuery.isEmptyObject(data)) {
                            alert("Plot number does not exist");
                        } else {
                            alert("Booking already exists");
                        }
                    },
                });
            });
        });

        $("#plot_number").on("change", function() {
            $("#class").on("change", function() {
                var plot_number =
                    $("#class").val() + "@" + $("#plot_number").val();
                $.ajax({
                    url: "/plot/" + plot_number,
                    type: "GET",
                    success: function(data) {
                        if (data.booking_id === 0 || data.booking_id === null) {
                            $('input[name="size"]').val(
                                data.plot_area_in_square_feet
                            );
                            $("#details").show();
                        } else {
                            alert("A booking already exists");
                        }
                    },
                });
            });
        });

        $("#price_square_feet").on("change", function() {
            var square_price = $("#price_square_feet").val();
            $("#square_price").text(square_price);

            var plot_size = $('input[name="size"]').val();
            var plot_price = square_price * plot_size;

            bi_annual_fee = (plot_price / 100) * 10;
            development_charges_fee = ((plot_price - bi_annual_fee) / 100) * 10;

            $("#development_charges").val(development_charges_fee);
            $("#bi-yearly-fee").val(bi_annual_fee);

            console.log("Bi annual fee: " + bi_annual_fee);
            console.log("development_charges_fee: " + development_charges_fee);
            console.log(plot_price);

            $("#dev_charges").text(development_charges_fee);
            $("#bi_yearly_fee").text(bi_annual_fee);
        });

        $("#down_payment").on("change", function() {
            var square_price = $("#down_payment").val();
            $("#down_payment2").text(square_price);
        });

        // $("#development_charges").on("change", function () {
        //     // var square_price = $("#development_charges").val();

        //     var square_price = development_charges_fee;
        //     $("#dev_charges").text(square_price);
        // });

        // $("#bi-yearly-fee").on("change", function () {
        //     var square_price = bi_annual_fee;
        //     console.log('new bi fee: '+ bi_annual_fee);
        //     $("#bi_yearly_fee").text(square_price);
        // });

        $("#calculate").on("click", function() {
            // calculate total size and price from price_square_feet
            var price_square_feet = $("#price_square_feet").val();
            var size = $('input[name="size"]').val();
            var bi_fee = $("#bi-yearly-fee").val();
            var value = $("input[name='biYearlyRadio']:checked").val();


            var total_price = size * price_square_feet;
            var new_total;

            var down_payment = $("#down_payment").val();
            var dev_charges_value = $("#development_charges").val();
            var bi_fee_value = $("#bi-yearly-fee").val();

            var total_fee_value =
                parseFloat(total_price) +
                parseFloat(dev_charges_value) +
                parseFloat(bi_fee_value);
            $("#total_fee").text(total_fee_value);

            if (value === "monthly") {
                new_total = parseFloat(total_price) + parseFloat(bi_fee);
                bi_fee_total = total_price;
            } else if (value === "once") {
                new_total = total_price;
                bi_fee_total = total_price;
            }

            total_price = new_total;

            // calculate down payment

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