<div class="row">

    <div class="col-sm-4">
        <input class="form-control" placeholder="Enter category title" autocomplete="off"
               form="fetchItems"
               name="query"
               value="{{ request('query') }}">

    </div>
    <div class="col-sm-3">
        <button class="btn btn-primary" type="submit"
                form="fetchItems"
                formaction="{{ route('home.categories.index') }}"
        >Search
        </button>

        <a class="btn btn-light ml-sm-2" href="{{ route('home.categories.index') }}">Reset</a>
    </div>

    <div class="col-sm-auto ml-sm-auto">
        <a href="{{ route('home.categories.create') }}" class="btn btn-primary">Create</a>
    </div>
</div>
