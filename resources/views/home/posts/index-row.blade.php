<tr class="d-flex">
    <td class="col-sm-3">{{ $post->title }}</td>
    <td class="col-sm-3">{{ $post->user->name }}</td>
    <td class="col-sm-3">{{ $post->updated_at->format('d.m.y H:i') }}</td>
    <td class="col-sm-3 text-right">

        @if($post->trashed())

            <button class="btn btn-light"
                    formaction="{{ route('home.posts.restore', $post) }}"
                    form="restoreItem"
                    type="submit"
            >Restore
            </button>
        @else

            <a
                class="btn btn-primary"
                href="{{ route('home.posts.edit', $post) }}"
            >Edit</a>


            <button class="btn btn-danger  ml-sm-2"
                    formaction="{{ route('home.posts.destroy', $post) }}"
                    form="deleteItem"
                    type="submit"
            >Delete
            </button>

        @endif
    </td>
</tr>
