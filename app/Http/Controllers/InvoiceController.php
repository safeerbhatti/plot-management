<?php

namespace App\Http\Controllers;

use App\Models\Due;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.index');
    } 

    public function list($id)
    {
        $booking = Booking::find($id);

        $invoices = Invoice::where('booking_id', $booking->id)->get();
        $dues = Due::where('booking_id', $booking->id)->first();
        return view('invoices.history', compact('invoices', 'dues', 'booking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($booking)
    {

        $booking = Booking::find($booking)->id;
        return view('invoices.create', compact('booking'));
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
            'booking_month' => 'required',
            'booking_id' => 'required',
            'instalment_amount' => 'required',
        ]);
        $invoice = Invoice::create([
            'booking_id' => $validated['booking_id'],
            'booking_month' => $validated['booking_month'],
            'instalment_amount' => $validated['instalment_amount'],
            'user_id' => 1,
        ]);

        $booking = Booking::find($validated['booking_id']);
        $booking->remaining_amount -= $validated['instalment_amount'];
        $booking->save();

        $dues = null;

        if($invoice->instalment_amount < $booking->instalment_per_month)
        {
            $dues = Due::where('booking_id', $validated['booking_id'])->first();
            $dues->dues_remaining += $booking->instalment_per_month - $invoice->instalment_amount;
            $dues->save();
        }

        return 'Invoice created successfully';

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
