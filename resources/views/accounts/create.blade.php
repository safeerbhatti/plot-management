@include('nav')


<form action="/account" method="POST">
    @csrf
    <label for="expense_type">Expense Type</label>
    <input type="text" name="expense_type" id="expense_type" value="{{old('expense_type')}}">

    @error('expense_type')
        <p>Can not edit if empty.</p>
    @enderror

    <label for="expense_amount">Expense Amount</label>
    <input type="number" name="expense_amount" id="expense_amount" value="{{old('expense_amount')}}">

    @error('expense_amount')
        <p>Can not edit if empty.</p>
    @enderror

    <button type="submit">Submit</button>
</form>
