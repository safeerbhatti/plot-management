@extends('layouts.app', ['slug' => $slug]) @section('content')

<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div
            class="card-body p-0 row"
            style="display: flex; justify-content: center"
        >
            <div class="col-lg-7">
                <div class="text-center p-5">
                    <h1 class="h4 text-gray-900 mb-4">Create A new Plot</h1>
                    <form action="/{{ $slug }}/plot" method="POST" class="user">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input
                                    type="text"
                                    name="class"
                                    id="class"
                                    value="{{ old('class') }}"
                                    class="form-control form-control-user"
                                    placeholder="Class"
                                />
                                @error('name')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input
                                    type="text"
                                    name="plot_number"
                                    id="plot_number"
                                    value="{{ old('plot_number') }}"
                                    class="form-control form-control-user"
                                    placeholder="Plot Number"
                                />
                                @error('slug')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input
                                    type="text"
                                    name="plot_area_in_square_feet"
                                    id="plot_area_in_square_feet"
                                    value="{{
                                        old('plot_area_in_square_feet')
                                    }}"
                                    class="form-control form-control-user"
                                    placeholder="Plot Area"
                                />
                                @error('name')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input
                                    type="text"
                                    name="scheme"
                                    id="scheme"
                                    value="{{ $slug }}"
                                    readonly
                                    class="form-control form-control-user"
                                />
                                @error('slug')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary btn-user btn-block"
                        >
                            Submit
                        </button>

                        <hr />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
