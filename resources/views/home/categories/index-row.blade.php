<tr class="d-flex">
    <td class="col-sm-6">{{ $category->title }}</td>
    <td class="col-sm-3">{{ $category->updated_at->format('d.m.y H:i') }}</td>
    <td class="col-sm-3 text-right">

        @if($category->trashed())

            <button class="btn btn-light"
                    formaction="{{ route('home.categories.restore', $category) }}"
                    form="restoreItem"
                    type="submit"
            >Restore
            </button>
        @else

            <a
                class="btn btn-primary"
                href="{{ route('home.categories.edit', $category) }}"
            >Edit</a>


            <button class="btn btn-danger  ml-sm-2"
                    formaction="{{ route('home.categories.destroy', $category) }}"
                    form="deleteItem"
                    type="submit"
            >Delete
            </button>

        @endif
    </td>
</tr>
