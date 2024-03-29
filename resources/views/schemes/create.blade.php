@extends('layouts.app') @section('content')

<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 row" style="display: flex; justify-content: center;">
                <div class="col-lg-7">
                        <div class="text-center p-5">
                            <h1 class="h4 text-gray-900 mb-4">Create A new Scheme</h1>
                            <form action="/scheme" method="POST" class="user" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name') }}"
                                        class="form-control"
                                        placeholder="Scheme Name"
                                    />
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                        type="text"
                                        name="contact_number"
                                        id="contact_number"
                                        value="{{ old('contact_number') }}"
                                        class="form-control"
                                        placeholder="Contact Number"
                                    />
                                    @error('contact_number')
                                    {{ $message }}
                                    @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                        type="text"
                                        name="address"
                                        id="address"
                                        value="{{ old('address') }}"
                                        class="form-control"
                                        placeholder="Scheme Address"
                                    />
                                    @error('address')
                                    {{ $message }}
                                    @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                        type="text"
                                        name="slug"
                                        id="slug"
                                        value="{{ old('slug') }}"
                                        class="form-control"
                                        placeholder="Scheme Unique Value"
                                    />
                                    @error('slug')
                                    {{ $message }}
                                    @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="file" name="picture" id="picture" class="form-control"/>
                                        @error('picture')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block ">Submit</button>

                                <hr>
                            </form>
                        </div>
                </div>
        </div>
    </div>
</div>

@endsection
