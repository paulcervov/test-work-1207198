@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-sm-3">Users</h2>

        @include('shared.status')

        @include('home.users.index-panel')

        <table class="table mt-sm-3 border-bottom">

            <thead>
            @include('home.users.index-header')
            </thead>

            <tbody>
            @forelse($users as $user)
                @include('home.users.index-row')
            @empty
                <tr class="d-flex">
                    <td>
                        <div class="col-sm-auto">
                            {{ __('messages.users.not_found') }}
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
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endsection
