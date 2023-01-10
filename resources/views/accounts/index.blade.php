@extends('layouts.app') @section('content')


<div class="container-fluid">
    <!-- <a href="/account/create">Insert new record</a> -->

<h2>Records</h2>

@foreach($accounts as $account)
    Expense Type: {{$account->expense_type}} | Amount: {{$account->expense_amount}} <br>
@endforeach
</div>

@endsection