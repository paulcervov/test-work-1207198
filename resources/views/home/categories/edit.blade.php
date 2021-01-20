@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mb-sm-3">Editing category</h2>

        @include('shared.errors')

        <form class="mb-sm-3 border-bottom"
              id="updateItem"
              method="POST"
              action="{{ route('home.categories.update', $category) }}">

            @csrf
            @method('PATCH')

            <div class="row mb-sm-3">

                <div class="col-sm-6">
                    <div class="form-group">

                        <label for="title">Title</label>

                        <input class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               type="text" name="title"
                               value="{{ old('title', $category->title) }}"
                               maxlength="255"
                        >

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">

                        <label for="slug">Slug</label>

                        <input class="form-control @error('slug') is-invalid @enderror"
                               id="slug"
                               type="text" name="slug"
                               value="{{ old('slug', $category->slug) }}"
                               maxlength="255"
                        >

                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

            </div><!-- /.row -->

            <div class="form-group">

                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                          id="description"
                          maxlength="16000">{{ old('description', $category->description) }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </form>

        <button class="btn btn-primary" type="submit" form="updateItem">Save</button>
        <a class="btn btn-light ml-sm-2" href="{{ route('home.categories.index') }}">Cancel</a>

    </div>
@endsection
