<?php

namespace App\Http\Controllers\Plot;

use App\Models\Plot;
use App\Models\Scheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlotController extends Controller
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
        $plots = Plot::where('scheme_id', $scheme->id)
            ->orderBy('class', 'ASC')->orderBy('plot_number')
            ->get();

        return view('plots.index', compact('plots', 'slug'));
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

        return view('plots.create', compact('slug'));
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

        $scheme = Scheme::where('slug', $validated['scheme'])->first();

        if (str_contains($validated['plot_number'], '-')) {
            $plot_numbers = explode("-", $validated['plot_number']);
            $numbers = range($plot_numbers[0], $plot_numbers[1]);
            foreach ($numbers as $plot) {
                Plot::firstOrCreate(
                    [
                        'plot_number' => $plot,
                        'scheme_id' => $scheme->id,
                        'class' => $validated['class'],

                    ],
                    [
                        'plot_area_in_square_feet' => $validated['plot_area_in_square_feet'],
                    ]
                );
            }
        } else {
            Plot::firstOrCreate(
                [
                    'plot_number' => $validated['plot_number'],
                    'scheme_id' => $scheme->id,
                    'class' => $validated['class'],

                ],
                [
                    'plot_area_in_square_feet' => $validated['plot_area_in_square_feet'],
                ]
            );
        }

        return redirect('/' . $validated['scheme'] . '/plot');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($scheme, $id)
    {
        // check if request ajax
        if (request()->ajax()) {

            $scheme = Scheme::where('slug', $scheme)->firstOrFail();
            $data = explode("@", $id);
            $plot = Plot::where('scheme_id', $scheme->id)->where('class', $data[0])->where('plot_number', $data[1])->first();
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
