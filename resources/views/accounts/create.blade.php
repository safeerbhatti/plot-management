@extends('layouts.app') @section('content')
<div class="container-fluid">
    <form action="/account" method="POST">
        @csrf

        <label for="expense_type">Select Expense Type</label>
        <select for="expense_type" name="expense_type" id="expense_type">
            @foreach($expenses as $expense)
            <option value="{{ $expense->type }}">{{ $expense->type }}</option>
            @endforeach
        </select>

        @error('expense_type')
        {{ $message }}
        @enderror
    
        <label for="expense_amount">Expense Amount</label>
        <input
            type="number"
            name="expense_amount"
            id="expense_amount"
            value="{{ old('expense_amount') }}"
        />
    
        @error('expense_amount')
        {{ $message }}
        @enderror
    
        <button type="submit">Submit</button>
    </form>
</div>
@endsection
