<div class="row">

    <div class="col-sm-2">
        <select class="form-control border"
                form="fetchItems"
                name="role"
        >
            <option value="">All roles</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}"
                        @if($role->id === (int) request('role')) selected @endif
                >{{ $role->name }}</option>
            @endforeach
        </select>

    </div>

    <div class="col-sm-4">
        <input class="form-control" placeholder="Enter user name" autocomplete="off"
               form="fetchItems"
               name="query"
               value="{{ request('query') }}">

    </div>
    <div class="col-sm-3">
        <button class="btn btn-primary" type="submit"
                form="fetchItems"
                formaction="{{ route('home.users.index') }}"
        >Search
        </button>

        <a class="btn btn-light ml-sm-2" href="{{ route('home.users.index') }}">Reset</a>
    </div>

    <div class="col-sm-auto ml-sm-auto">
        <a href="{{ route('home.users.create') }}" class="btn btn-primary">Create</a>
    </div>
</div>
