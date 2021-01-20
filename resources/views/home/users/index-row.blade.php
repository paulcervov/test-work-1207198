<tr class="d-flex">
    <td class="col-sm-3">{{ $user->name }}</td>
    <td class="col-sm-3">{{ $roles->firstWhere('id', $user->role_id)->name }}</td>
    <td class="col-sm-3">{{ $user->updated_at->format('d.m.y H:i') }}</td>
    <td class="col-sm-3 text-right">

        @if($user->trashed())

            <button class="btn btn-light"
                    formaction="{{ route('home.users.restore', $user) }}"
                    form="restoreItem"
                    title="Restore"
                    type="submit"
            >Restore
            </button>
        @else

            <a
                class="btn btn-primary"
                href="{{ route('home.users.edit', $user) }}"
                title="Edit"
            >Edit</a>


            <button class="btn btn-danger  ml-sm-2"
                    formaction="{{ route('home.users.destroy', $user) }}"
                    form="deleteItem"
                    title="Delete"
                    type="submit"
            >Delete
            </button>

        @endif
    </td>
</tr>
