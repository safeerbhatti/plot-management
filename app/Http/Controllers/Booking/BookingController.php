<?php

namespace App\Http\Controllers\Booking;

use App\Models\Due;
use App\Models\Plot;
use App\Models\Scheme;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\BookedCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($scheme)
    {
        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        $bookings = Booking::where('scheme_id', $scheme->id)->get();

        return view('bookings.index', compact('bookings', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($scheme)
    {
        // get all plots
        $plots = Plot::all();
        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        $customers = Customer::all();

        return view('bookings.create', compact('plots', 'slug', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $scheme)
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
            'class' => 'required',
        ]);



        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;

        $file = $request->file('agreement_file');

        $newName = time() . '.' . $file->getClientOriginalExtension();
        $path = Storage::putFileAs('public/files', $file, $newName);

        $newPath = substr($path, 6);
        $path = env('APP_URL') . 'storage' . $newPath;

        $plot = Plot::where('plot_number', $validated['plot_number'])
        ->where('class', $validated['class'])
        ->where('scheme_id', $scheme->id)->first();


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
            'bi_yearly_type' => $validated['biYearlyRadio'],
            'scheme_id' => $scheme->id,
            'plot_id' => $plot->id,
            
        ]);
        $plot->booking_id = $booking->id;
        $plot->save();

        Due::create([
            'booking_id' => $booking->id,
        ]);

        $customer = null;

        if($request->filled('customer_name') && $request->filled('customer_phone') 
        && $request->filled('customer_address') && $request->filled('customer_cnic'))
        {
            $customer = Customer::create([
                'name' => $request->input('customer_name'),
                'cnic' => $request->input('customer_cnic'),
                'address' => $request->input('customer_address'),
                'phone' => $request->input('customer_phone'),
                'scheme_id' => $scheme->id,
                
            ]);

            BookedCustomer::create([
                'customer_id' => $customer->id,
                'booking_id' => $booking->id,
            ]);
        }

        return redirect('/' . $slug . '/booking');
    }

    /**
     * Display the specified resource.d
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($scheme, $id)
    {
        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        $booking = Booking::with('customer')->find($id);

        // $bookedCustomers = BookedCustomer::where('booking_id', $id)->pluck('customer_id');
        // $customers = Customer::findMany($bookedCustomers);
        // $booking = Booking::find($id);

        return view('bookings.show', compact('booking', 'slug'));
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

    public function assignCustomer($scheme, $id)
    {
        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        $booking = $id;
        $customers = Customer::pluck('id');
        return view('bookings.assign', compact('booking', 'customers', 'slug'));
    }

    public function assignNewCustomer($scheme)
    {

        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        $bookings = Booking::where('scheme_id', $scheme->id)->pluck('id');

        if(!$bookings)
        {
            $bookings = false;
        }

        $customers = Customer::pluck('id');
        return view('customers.assign', compact('bookings', 'customers', 'slug'));
    }

    public function saveCustomer(Request $request, $scheme)
    {

        $validated = $request->validate([
            'booking_id' => 'required',
            'customer_id' => 'required',
        ]);
        BookedCustomer::firstOrCreate($validated);

        return redirect('/'.$scheme.'/booking' . '/' . $validated['booking_id']);
    }
}
