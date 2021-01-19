<tr class="d-flex">
    <th class="col-sm-3">
        <a class="text-decoration-none"
           href="{{ route('home.users.index', array_merge(request()->query(), ['column' => 'name', 'direction' => request('direction', 'desc') === 'desc' ? 'asc' : 'desc', 'page' => null])) }}">
            Name
            @if(request('column', 'updated_at') === 'name')
                <span>@if(request('direction', 'desc') === 'desc') &darr; @else &uarr; @endif</span>
            @endif
        </a>
    </th>
    <th class="col-sm-3">Role</th>
    <th class="col-sm-3">

        <a class="text-decoration-none"
           href="{{ route('home.users.index', array_merge(request()->query(), ['column' => 'updated_at', 'direction' => request('direction', 'desc') === 'desc' ? 'asc' : 'desc', 'page' => null])) }}">
            Date
            @if(request('column', 'updated_at') === 'updated_at')
                <span>@if(request('direction', 'desc') === 'desc') &darr; @else &uarr; @endif</span>
            @endif
        </a>

    </th>
    <th class="col-sm-3 text-right">Action</th>
</tr>

