<?php

namespace App\Http\Controllers\Scheme;

use App\Models\Scheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $schemes = Scheme::withCount('plots')->get();

        $schemes = Scheme::withCount([
            'plots',
            'plots as availble_plots_count' => function ($query) {
                $query->where('booking_id', null);
            },
        ])->get();
        

        // $schemes = Scheme::all();
        $slug = 'none';
        return view('schemes.index', compact('schemes', 'slug'));
    }

    public function list($scheme)
    {
        $scheme = Scheme::where('name', $scheme)->first();
        $plots = $scheme->plots;

        return view('plots.scheme', compact('plots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schemes.create');
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
            'name' => 'required',
            'slug' => 'required|unique:schemes,slug',
            'address' => 'required',
            'contact_number' => 'required',
            'picture' => 'required',
        ]);

        $file = $request->file('picture');
        $newName = time() . '.' . $file->getClientOriginalExtension();
        $path = Storage::putFileAs('public/files', $file, $newName);

        $newPath = substr($path, 6);
        $path = env('APP_URL') . 'storage' . $newPath;
        $validated['picture'] = $path;

        Scheme::create($validated);
        return redirect('/'.$validated['slug'].'/plot');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scheme = Scheme::find($id);
        $slug = $scheme->slug;
        return view('schemes.show', compact('scheme', 'slug'));
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
        Scheme::destroy($id);
        return redirect('/scheme');
    }
}
