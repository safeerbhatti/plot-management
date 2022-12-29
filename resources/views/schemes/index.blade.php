<a href="/scheme/create">Create new scheme</a>

<br>
<br>

@foreach($schemes as $scheme)
    Scheme Name: {{ $scheme->name }}
    <a href="/scheme/{{$scheme->id}}">click here</a> to view all plots on this scheme
    <br>
@endforeach