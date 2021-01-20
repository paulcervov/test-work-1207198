@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mb-sm-3">New role</h2>

        @include('shared.errors')

        <form class="mb-sm-3 border-bottom"
              id="storeItem"
              method="POST"
              action="{{ route('home.roles.store') }}">

            @csrf

            <div class="row mb-sm-3">
                <div class="col-sm-3">
                    <div class="form-group">

                        <label for="name">Name</label>

                        <input class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               type="text" name="name"
                               value="{{ old('name') }}"
                               maxlength="255"
                        >

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

            </div><!-- /.row -->

        </form>

        <button class="btn btn-primary" type="submit" form="storeItem">Save</button>
        <a class="btn btn-light ml-sm-2" href="{{ route('home.roles.index') }}">Cancel</a>

    </div>
@endsection
