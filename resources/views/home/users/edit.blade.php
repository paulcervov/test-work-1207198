@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mb-sm-3">Editing user</h2>

        @include('shared.errors')

        <form class="mb-sm-3 border-bottom"
              id="updateItem"
              method="POST"
              action="{{ route('home.users.update', $user) }}">

            @csrf
            @method('PATCH')

            <div class="row mb-sm-3">
                <div class="col-sm-3">
                    <div class="form-group">

                        <label for="name">Name</label>

                        <input class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               type="text" name="name"
                               value="{{ old('name', $user->name) }}"
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
                               value="{{ old('email', $user->email) }}"
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
                               maxlength="255"
                               autocomplete="new-password"
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

                            @foreach(App\Models\User::ROLES as $roleId => $roleName)
                                <option value="{{ $roleId }}"
                                        @if($roleId === (int) old('role_id', $user->role_id)) selected @endif>{{ $roleName }}</option>
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

        <button class="btn btn-primary" type="submit" form="updateItem">Save</button>
        <a class="btn btn-light ml-sm-2" href="{{ route('home.users.index') }}">Cancel</a>

    </div>
@endsection
