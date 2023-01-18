<?php

namespace App\Http\Controllers;

use App\Models\BookedCustomer;
use App\Models\Due;
use App\Models\Plot;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;


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
            'plot_number' => 'required',
            'instalment_duration' => 'required',
            'bi-yearly-fee' => 'required',
            'agreement_file' => 'required|mimes:jpeg,png,jpg|max:2048',
            'biYearlyRadio' => 'required',
        ]);

        $file = $request->file('agreement_file');

        $newName = time() . '.' . $file->getClientOriginalExtension();
        $path = Storage::putFileAs('public/files', $file, $newName);

        $newPath = substr($path, 6);



        $path = env('APP_URL') . 'storage' . $newPath;

        //$plot = Plot::whereIn('plot_number', $validated['plot_number'])->get();
        $plot = Plot::where('plot_number', $validated['plot_number'])->first();


        if (!$plot) {
            return 'Plot number does not exist';
        }

        $amount = 0;
        $biFee = 0;

        if ($validated['biYearlyRadio'] === 'once') {
            $amount = ($validated['price_square_feet'] * $plot->plot_area_in_square_feet);
            $biFee = $validated['bi-yearly-fee'];
        } else if ($validated['biYearlyRadio'] === 'monthly') {
            $amount = ($validated['price_square_feet'] * $plot->plot_area_in_square_feet) + $validated['bi-yearly-fee'];
            $biFee = $validated['bi-yearly-fee'];
        }

        $duration = $validated['instalment_duration'];

        $remainingAmount = $amount - $validated['down_payment'];
        $monthlyInstalment = $remainingAmount / $duration;

        $booking = Booking::create([
            'user_id' => 1,
            'price_square_feet' => $validated['price_square_feet'],
            'total_amount' => $amount,
            'down_payment' => $validated['down_payment'],
            'instalment_per_month' => $monthlyInstalment,
            'development_charges' => $validated['development_charges'],
            'khata_number' => $validated['khata_number'],
            'agreement_number' => $validated['agreement_number'],
            'instalment_duration' => $duration,
            'remaining_amount' => $remainingAmount,
            'remaining_duration' => $duration,
            'bi_yearly_fee' => $biFee,
            'agreement_file' => $path,
            'bi_yearly_type' => $validated['biYearlyRadio']
        ]);
        $plot->booking_id = $booking->id;
        $plot->save();

        Due::create([
            'booking_id' => $booking->id,
        ]);

        return redirect('/booking');
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

    public function assignCustomer($id)
    {
        $booking = $id;
        $customers = Customer::pluck('id');
        return view('bookings.assign', compact('booking', 'customers'));
    }

    public function assignNewCustomer()
    {
        $bookings = Booking::pluck('id');
        $customers = Customer::pluck('id');
        return view('customers.assign', compact('bookings', 'customers'));
    }

    public function saveCustomer(Request $request)
    {

        $validated = $request->validate([
            'booking_id' => 'required',
            'customer_id' => 'required',
        ]);
        BookedCustomer::firstOrCreate($validated);

        return redirect('/booking' . '/' . $validated['booking_id']);
    }
}
