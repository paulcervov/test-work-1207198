<tr class="d-flex">
    <td class="col-sm-6">{{ $role->name }}</td>
    <td class="col-sm-3">{{ $role->updated_at->format('d.m.y H:i') }}</td>
    <td class="col-sm-3 text-right">

        @if($role->trashed())

            <button class="btn btn-light"
                    formaction="{{ route('home.roles.restore', $role) }}"
                    form="restoreItem"
                    type="submit"
            >Restore
            </button>
        @else

            <a
                class="btn btn-primary"
                href="{{ route('home.roles.edit', $role) }}"
            >Edit</a>


            <button class="btn btn-danger  ml-sm-2"
                    formaction="{{ route('home.roles.destroy', $role) }}"
                    form="deleteItem"
                    type="submit"
            >Delete
            </button>

        @endif
    </td>
</tr>
