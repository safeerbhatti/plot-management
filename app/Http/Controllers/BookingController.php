<?php

namespace App\Http\Controllers;

use App\Models\BookedCustomer;
use App\Models\Due;
use App\Models\Plot;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all plots
        $plots = Plot::all();

        return view('bookings.create', compact('plots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'price_square_feet' => 'required',
            'down_payment' => 'required',
            'development_charges' => 'required',
            'khata_number' => 'required',
            'agreement_number' => 'required',
            'number_of_dev_charges' => 'required',
            'plot_number' => 'required',
            'instalment_duration' => 'required',
        ]);

        $plot = Plot::where('plot_number', $validated['plot_number'])->first();
        if (!$plot) {
            return 'Plot number does not exist';
        }
        $amount = ($validated['price_square_feet'] * $plot->plot_area_in_square_feet) +
            ($validated['number_of_dev_charges'] * $validated['development_charges']);

        $duration = $validated['instalment_duration'];

        $timesDevPaid = 0;

        $remainingAmount = $amount - $validated['down_payment'] -
            ($timesDevPaid * $validated['development_charges']);

        $monthlyInstalment = $remainingAmount / $duration;

        $booking = Booking::create([
            'plot_id' => $plot->id,
            'user_id' => 1,
            'price_square_feet' => $validated['price_square_feet'],
            'total_amount' => $amount,
            'down_payment' => $validated['down_payment'],
            'instalment_per_month' => $monthlyInstalment,
            'development_charges' => $validated['development_charges'],
            'khata_number' => $validated['khata_number'],
            'agreement_number' => $validated['agreement_number'],
            'number_of_dev_charges' => $validated['number_of_dev_charges'],
            'paid_number_of_dev_charges' => $timesDevPaid,
            'instalment_duration' => $duration,
            'remaining_amount' => $remainingAmount,
            'remaining_duration' => $duration,
        ]);

        Due::create([
            'booking_id' => $booking->id,
        ]);

        return 'Booking Created';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bookedCustomers = BookedCustomer::where('booking_id', $id)->pluck('customer_id');
        $customers = Customer::findMany($bookedCustomers);
        $booking = Booking::find($id);
        return view('bookings.show', compact('booking', 'customers'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignCustomer()
    {
        $bookings = Booking::pluck('id');
        $customers = Customer::pluck('id');
        return view('bookings.assign', compact('bookings', 'customers'));
    }

    public function saveCustomer(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required',
            'customer_id' => 'required',
        ]);
        BookedCustomer::create($validated);
        return 'Booking assigned to customer';
    }
}
