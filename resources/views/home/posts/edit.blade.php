@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mb-sm-3">Editing post</h2>

        @include('shared.errors')

        <form class="mb-sm-3 border-bottom"
              id="updateItem"
              method="POST"
              action="{{ route('home.posts.update', $post) }}">

            @csrf
            @method('PATCH')

            <div class="row mb-sm-3">

                <div class="col-sm-6">
                    <div class="form-group">

                        <label for="title">Title</label>

                        <input class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               type="text" name="title"
                               value="{{ old('title', $post->title) }}"
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
                               value="{{ old('slug', $post->slug) }}"
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

                <label for="text">Text</label>
                <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="text"
                          maxlength="16000">{{ old('text', $post->text) }}</textarea>

                @error('text')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </form>

        <button class="btn btn-primary" type="submit" form="updateItem">Save</button>
        <a class="btn btn-light ml-sm-2" href="{{ route('home.posts.index') }}">Cancel</a>

    </div>
@endsection
