@include('nav')


<a href="/plot/create">Crete new plot</a>
<br>
<br>
@foreach($plots as $plot)
    Scheme Name : {{ $plot->scheme->name }} | 
    Plot Number: {{ $plot->plot_number }} |
    Plot Area: {{ $plot->plot_area_in_square_feet }}
    <br>

@endforeach