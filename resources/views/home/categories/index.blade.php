@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-sm-3">Categories</h2>

        @include('shared.status')

        @include('home.categories.index-panel')

        <table class="table mt-sm-3 border-bottom">

            <thead>
            @include('home.categories.index-header')
            </thead>

            <tbody>
            @forelse($categories as $category)
                @include('home.categories.index-row')
            @empty
                <tr class="d-flex">
                    <td>
                        <div class="col-sm-auto">
                            {{ __('messages.categories.not_found') }}
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
            {{ $categories->withQueryString()->links() }}
        </div>
    </div>
@endsection
