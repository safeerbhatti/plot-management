<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $customers = Customer::where('scheme_id', $scheme->id)->get();
        return view('customers.index', compact("customers", "slug"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($scheme)
    {
        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        return view('customers.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($scheme, Request $request)
    {
        $scheme = Scheme::where('slug', $scheme)->firstOrFail();
        $slug = $scheme->slug;
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'cnic' => 'required',
            'phone' => 'required',
        ]);

        Customer::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'cnic' => $validated['cnic'],
            'phone' => $validated['phone'],
            'scheme_id' => $scheme->id,
        ]);
        
        return redirect('/'.$slug.'/customer');
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
