<?php

namespace App\Http\Controllers;

use App\Models\Due;
use App\Models\Scheme;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.index');
    }

    public function list($scheme, $id)
    {
        //booking scheme where slug from url

        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        $booking = Booking::find($id);
        $invoices = Invoice::where('booking_id', $booking->id)->get();
        $dues = Due::where('booking_id', $booking->id)->first();

        return view('invoices.history', compact('invoices', 'dues', 'booking', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay($scheme, $booking)
    {

        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = $scheme->slug;
        $booking = Booking::find($booking);

        // find booking starting date
        $start_date = $booking->created_at;

        return view('invoices.pay', compact('booking', 'slug'));
    }

    public function custom($scheme)
    {
        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = $scheme->slug;
        $bookings = Booking::where('scheme_id', $scheme->id)->get();
        return view('invoices.custom', compact('bookings', 'slug'));
    }

    public function getBookingMonths(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $installment_year = $request->installment_year;

        // generate months from january to december
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 10)) . ' ' . $installment_year;
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

        

        if ($request->filled('development_charges') && $request->filled('pay_charges')) {
            $validated = $request->validate([
                'booking_id' => 'required',
                'development_charges' => 'required',
                'pay_charges' => 'required',
            ]);

            if($validated['development_charges'] < $validated['pay_charges'])
            return 'Maximum development charges exceed';

            $booking = Booking::find($validated['booking_id']);

            if($booking->dev_charges_status === 'paid')
            {
                return 'Charges Already Paid';
            }

            $invoice = new Invoice();
            $invoice->user_id = 1;
            $invoice->booking_id = $validated['booking_id'];
            $invoice->booking_month = 'Development Charges';
            $invoice->instalment_amount = $validated['pay_charges'];
            $invoice->dues = $validated['development_charges'] - $validated['pay_charges'];
            $invoice->save();

            $dues = Due::where('booking_id', $booking->id)->first();
            if(!$dues)
            {
                $dues = new Due();
                $dues->booking_id = $booking->id;
            }
            $dues->dues_remaining += $invoice->dues;
            $dues->save();

            $booking->dev_charges_status = 'paid';
            $booking->save();
            
            return redirect('/');
        }

        if ($request->filled('bi_yearly_fee') && $request->filled('pay_yearly')){
            $validated = $request->validate([
                'booking_id' => 'required',
                'bi_yearly_fee' => 'required',
                'pay_yearly' => 'required',
            ]);

            if($validated['bi_yearly_fee'] < $validated['pay_yearly'])
            return 'Maximum Bi Yearly charges exceed';

            $booking = Booking::find($validated['booking_id']);

            if($booking->bi_fee_status === 'paid')
            {
                return 'Bi Yearly fee already Paid';
            }

            $invoice = new Invoice();
            $invoice->user_id = 1;
            $invoice->booking_id = $validated['booking_id'];
            $invoice->booking_month = 'Bi Yearly Fee';
            $invoice->instalment_amount = $validated['pay_yearly'];
            $invoice->dues = $validated['bi_yearly_fee'] - $validated['pay_yearly'];
            $invoice->save();
            $booking->bi_fee_status = 'paid';
            $booking->save();
            
            $dues = Due::where('booking_id', $booking->id)->first();
            if(!$dues)
            {
                $dues = new Due();
                $dues->booking_id = $booking->id;
            }
            $dues->dues_remaining += $invoice->dues;
            $dues->save();

            return redirect('/');

        }

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
            $dues = Due::where('booking_id', $booking->id)->first();
            if(!$dues)
            {
                $dues = new Due();
                $dues->booking_id = $booking->id;
            }
            $dues->dues_remaining += $invoice->dues;
            $dues->save();
        }

        $scheme = Scheme::find($booking->scheme_id);
        $slug = $scheme->slug;

        return redirect('/'.$slug.'/booking');
    }


    public function payBiYearly($id)
    {
        $booking = Booking::find($id);
        return view('invoices.bi-yearly', compact('booking'));
    }

    public function storeBiYearly(Request $request)
    {
        // booking month = biyearlyfee
        // installment amount = biyearly fee amount

        $validated = $request->validate([
            'booking_id' => 'required',
            'installment_amount' => 'required',
            'payable_amount' => 'required',
        ]);

        $booking = Booking::find($validated['booking_id']);

        if($validated['installment_amount'] > $validated['payable_amount'])
        {
            return 'Amount can not be greater than payable amount';
        }

        $dues = $validated['payable_amount'] - $validated['installment_amount'];

        Invoice::create([
            'user_id' => auth()->user()->id,
            'booking_id' => $validated['booking_id'],
            'booking_month' => 'bi_fee',
            'instalment_amount' => $validated['installment_amount'],
            'dues' => $dues,
        ]);
        $booking->bi_fee_status = 'paid';
        if($dues > 0)
        {
            $booking->bi_fee_status = 'half';
        }

        $booking->save();
        return redirect('/booking/'.$validated['booking_id']);

    }

    public function payDevCharges($id)
    {
        $booking = Booking::find($id);
        return view('invoices.dev-charges', compact('booking'));
    }

    public function storeDevCharges(Request $request)
    {
        
        $validated = $request->validate([
            'booking_id' => 'required',
            'installment_amount' => 'required',
            'payable_amount' => 'required',
        ]);

        $booking = Booking::find($validated['booking_id']);

        if($validated['installment_amount'] > $validated['payable_amount'])
        {
            return 'Amount can not be greater than payable amount';
        }

        $dues = $validated['payable_amount'] - $validated['installment_amount'];

        Invoice::create([
            'user_id' => auth()->user()->id,
            'booking_id' => $validated['booking_id'],
            'booking_month' => 'Development Charges',
            'instalment_amount' => $validated['installment_amount'],
            'dues' => $dues,
        ]);

        $booking->dev_charges_status = 'paid';
        if($dues > 0)
        {
            $booking->dev_charges_status = 'half';
        }

        $booking->save();

        return redirect('/booking/'.$validated['booking_id']);
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
