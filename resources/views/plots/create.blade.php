@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form action="/plot" method="POST">
        @csrf
        <label for="class">Class</label>
        <input type="text" name="class" id="class" value="{{old('class')}}">
    
        <br>
        @error('class')
        {{ $message }}
        @enderror
        <br>
    
        <label for="plot_number">Plot Number</label>
        <input type="text" name="plot_number" id="plot_number" value="{{old('plot_number')}}">
    
        <br>
        @error('plot_number')
        {{ $message }}
        @enderror
        <br>

        <label for="plot_area_in_square_feet">Plot Area</label>
        <input type="text" name="plot_area_in_square_feet" id="plot_area_in_square_feet" value="{{old('plot_area_in_square_feet')}}">
    
        <br>
        @error('plot_area_in_square_feet')
        {{ $message }}
        @enderror
        <br>

        <label for="scheme">Select Scheme</label>
        <select for="scheme" name="scheme" id="scheme">
            @foreach($schemes as $scheme)
            <option value="{{ $scheme }}">{{ $scheme }}</option>
            @endforeach
        </select>

        <br>
        @error('scheme')
        {{ $message }}
        @enderror
        <br>
    
        <button type="submit">Submit</button>
    </form>
</div>

@endsection