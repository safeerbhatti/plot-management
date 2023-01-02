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
    public function pay($booking)
    {

        $booking = Booking::find($booking);

        // find booking starting date
        $start_date = $booking->created_at;


        return view('invoices.pay', compact('booking'));
    }

    public function getBookingMonths(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $installment_year = $request->installment_year;

        // generate months from january to december
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 10)).' '.$installment_year;
        }

        // check invoices for this booking with year is installment_year
        $invoices = Invoice::where('booking_id', $booking->id)->whereYear('created_at', $installment_year)->get();

        // remove months from $months array if invoice is already generated
        foreach ($invoices as $invoice) {
            $month = $invoice->booking_month;
            $key = array_search($month, $months);
            unset($months[$key]);
        }

        return response()->json($months);
    }

    public function create()
    {
        $bookings = Booking::all();
        return view('invoices.create', compact('bookings'));
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
            'installment_month' => 'required',
            'booking_id' => 'required',
            'instalment_amount' => 'required',
        ]);


        $booking = Booking::find($validated['booking_id']);
//        $booking->remaining_amount -= $validated['instalment_amount'];
//        $booking->remaining_duration -= 1;
//        $booking->save();

        // get instalment_per_month
        $instalment_per_month = $booking->instalment_per_month;

        $installment_amount = $validated['instalment_amount'];

        // loop through months and generate invoices
        foreach ($validated['installment_month'] as $month) {

            $invoice = new Invoice();
            $invoice->user_id = 1;
            $invoice->booking_id = $validated['booking_id'];
            $invoice->booking_month = $month;
            $invoice->dues = 0;


            // check if installment amount is greater than instalment_per_month
            if ($installment_amount >= $instalment_per_month) {
                $invoice->instalment_amount = $instalment_per_month;

                $installment_amount = $installment_amount - $instalment_per_month;
                $invoice->save();
            } else {
                $invoice->instalment_amount = $installment_amount;
                $invoice->dues = $instalment_per_month - $installment_amount;
                $invoice->save();

                break;
            }
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
