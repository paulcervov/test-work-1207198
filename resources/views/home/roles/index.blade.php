@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-sm-3">Roles</h2>

        @include('shared.status')

        @include('home.roles.index-panel')

        <table class="table mt-sm-3 border-bottom">

            <thead>
            @include('home.roles.index-header')
            </thead>

            <tbody>
            @forelse($roles as $role)
                @include('home.roles.index-row')
            @empty
                <tr class="d-flex">
                    <td>
                        <div class="col-sm-auto">
                            {{ __('messages.roles.not_found') }}
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <form id="fetchItems" method="GET"></form>

        <form id="deleteItem" method="POST">
            @method('DELETE')
            @csrf
        </form>

        <form id="restoreItem" method="POST">
            @method('PATCH')
            @csrf
        </form>

        <div class="text-center">
            {{ $roles->withQueryString()->links() }}
        </div>
    </div>
@endsection
