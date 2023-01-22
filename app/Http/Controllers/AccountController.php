<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Account;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($scheme)
    {
        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = $scheme->slug;
        $accounts = Account::where('scheme_id', $scheme->id)->get();
        return view('accounts.index', compact('accounts', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($scheme)
    {
        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = $scheme->slug;
        $expenses = ExpenseType::where('scheme_id', $scheme->id)->get();
        return view('accounts.create', compact('expenses', 'slug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($scheme, Request $request)
    {
        $validated = $request->validate([
            'expense_type' => 'required',
            'expense_amount' => 'required',
        ]);

        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = $scheme->slug;

        $acounts = Account::create([
            'expense_type' => $validated['expense_type'],
            'expense_amount' => $validated['expense_amount'],
            'scheme_id' => $scheme->id,
        ]);

        return redirect('/'.$slug.'/account');
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

    public function createExpense($scheme)
    {
        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = $scheme->slug;
        return view('accounts.expense', compact('slug'));
    }

    public function storeExpense($scheme, Request $request)
    {

        $validated = $request->validate([
            'type' => 'required',
            'desc' => 'required',
        ]);
        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = $scheme->slug;

        $expense = ExpenseType::create([
            'type' => $validated['type'],
            'desc' => $validated['desc'],
            'scheme_id' => $scheme->id,
        ]);

        return redirect('/'.$slug.'/account/create');
    }
}
