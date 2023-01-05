<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\Scheme;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $plots = Plot::all();

        return view('plots.index', compact('plots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $schemes = Scheme::pluck('name');

        return view('plots.create', compact('schemes'));
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
            'plot_number' => 'required',
            'plot_area_in_square_feet' => 'required',
            'scheme' => 'required',
            'class' => 'required',
        ]);

        $scheme = Scheme::where('name', $validated['scheme'])->first();

        if (str_contains($validated['plot_number'], '-')) {
            $plot_numbers = explode("-", $validated['plot_number']);
            $numbers = range($plot_numbers[0], $plot_numbers[1]);
            foreach ($numbers as $plot) {
                Plot::firstOrCreate([
                    'plot_number' => $plot,
                    'plot_area_in_square_feet' => $validated['plot_area_in_square_feet'],
                    'scheme_id' => $scheme->id,
                    'class' => $validated['class'],

                ]);
            }
        } else {
            Plot::firstOrCreate([
                'plot_number' => $validated['plot_number'],
                'plot_area_in_square_feet' => $validated['plot_area_in_square_feet'],
                'scheme_id' => $scheme->id,
                'class' => $validated['class'],

            ]);
        }

        return redirect('/plot');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // check if request ajax
        if (request()->ajax()) {
            $plot = Plot::where('plot_number',$id)->first();
            return response()->json($plot);
        }
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
