@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 row" style="display: flex; justify-content: center">
            <div class="col-lg-7">
                <div class="text-center p-5">
                    <h1 class="h4 text-gray-900 mb-4">Assign customer to Selected Booking</h1>
                    <form action="/{{$slug}}/booking/assign" method="POST" class="user">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" name="booking_id" id="booking_id" value="{{ $booking }}" readonly class="form-control" />
                                @error('booking_id')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select for="customer_id" class="form-control" name="customer_id" id="customer_id">
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer }}">
                                        {{ $customer }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('customer_id')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Submit
                        </button>

                        <hr />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection