<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\Booking;
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
        return view('bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookings.create');
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
            'instalment_per_month' => 'required',
            'development_charges' => 'required',
            'khata_number' => 'required',
            'agreement_number' => 'required',
            'number_of_dev_charges' => 'required',
            'plot_number' => 'required',
        ]);

        $plot = Plot::where('plot_number', $validated['plot_number'])->first();
        if(!$plot)
        {
            return 'Plot number does not exist';
        }
        $amount = ($validated['price_square_feet'] * $plot->plot_area_in_square_feet) +         
                  ($validated['number_of_dev_charges']*$validated['development_charges']);        
        
        $duration = ($amount-$validated['down_payment']) / $validated['instalment_per_month'];

        Booking::create([
            'plotId' => $plot->id,
            'userId' => 1,
            'price_square_feet' => $validated['price_square_feet'],
            'total_amount' => $amount,
            'down_payment' => $validated['down_payment'],
            'instalment_per_month' => $validated['instalment_per_month'],
            'development_charges' => $validated['development_charges'],
            'khata_number' => $validated['khata_number'],
            'agreement_number' => $validated['agreement_number'],
            'number_of_dev_charges' => $validated['number_of_dev_charges'],
            'paid_number_of_dev_charges' => 0,
            'instalment_duration' => $duration,
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
        //
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
}
