List of all plots in this scheme:
<br> <br> 

@foreach($scheme->plots as $plot)
Plot Number: {{ $plot->plot_number }} <br>
Plot Area: {{ $plot->plot_area_in_square_feet }} <br> <br>
@endforeach
