@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mb-sm-3">New user</h2>

        @include('shared.errors')

        <form class="mb-sm-3 border-bottom"
              id="storeItem"
              method="POST"
              action="{{ route('home.users.store') }}">

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
                <div class="col-sm-3">
                    <div class="form-group">

                        <label for="email">Email</label>

                        <input class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               type="text" name="email"
                               value="{{ old('email') }}"
                               maxlength="255"
                        >

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">

                        <label for="password">Password</label>

                        <input class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               type="password" name="password"
                               value="{{ old('password') }}"
                               maxlength="255"
                        >

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control @error('role_id') is-invalid @enderror"
                                id="role"
                                name="role_id"
                        >
                            <option value="">Not selected</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                        @if($role->id === (int) old('role_id')) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>

                </div>
            </div><!-- /.row -->


        </form>

        <button class="btn btn-primary" type="submit" form="storeItem">Save</button>
        <a class="btn btn-light ml-sm-2" href="{{ route('home.users.index') }}">Cancel</a>

    </div>
@endsection
