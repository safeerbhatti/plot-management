<h1>Customers</h1>

@foreach ($customers as $user)
    <h3>{{ $user->name }}</h3>
    <p>Phone {{ $user->phone }}</p>
    <p>Address {{ $user->address }}</p>
    <p>Cnic {{ $user->cnic }}</p>
@endforeach

<a href="/customer/create">Create New</a>