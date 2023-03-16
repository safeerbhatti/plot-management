@extends('layouts.app', ['slug' => $slug])
@section('content')

<div class="container-fluid">
    <h3 class="card-header text-primary">Customers</h3>
    <table class="plot-info_table table table-borderless">
        <thead class="border-left-primary shadow rounded">
            <tr class="text-gray-800 font-wieght-bolder py-3">
                <th scope="col">Customer Name</th>
                <th scope="col">Father's Name</th>
                <th scope="col">Customer CNIC</th>
                <th scope="col">Customer Phone</th>
                <th scope="col">Date Of Birth</th>
                <th scope="col">Next Kin</th>
                <th scope="col">Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <!-- <th scope="row">1</th> -->
                <td> {{ $customer->name }} </td>
                <td> {{ $customer->father_name }} </td>
                <td> {{ $customer->cnic }} </td>
                <td> {{ $customer->phone }} </td>
                <td> {{ $customer->dob }} </td>
                <td> {{ $customer->next_kin }} </td>
                <td> {{ $customer->address }} </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection