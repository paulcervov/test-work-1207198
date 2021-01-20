<?php declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\StorePostRequest;
use App\Http\Requests\Home\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::query()
            ->withTrashed()
            ->with('user')
            ->when(User::ID_ROLE_AUTHOR === auth()->user()->role_id, function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->when(request('query'), function ($q, $query) {
                return $q->where('title', 'like', "%{$query}%");
            })
            ->when(request('column', 'updated_at'), function ($q, $column) {
                return $q->orderBy($column, request('direction', 'desc'));
            })
            ->paginate();

        return view('home.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('home.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        $categories = Arr::get($validated, 'categories', []);
        $post->categories()->sync($categories);

        return redirect()
            ->route('home.posts.index')
            ->with('status', __('messages.posts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        $categories = Category::all();

        $post->load('categories');

        return view('home.posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validated();

        $post->update($validated);

        $categories = Arr::get($validated, 'categories', []);
        $post->categories()->sync($categories);

        return redirect()
            ->route('home.posts.index')
            ->with('status', __('messages.posts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('home.posts.index')
            ->with('status', __('messages.posts.deleted'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function restore(int $id): RedirectResponse
    {
        $post = Post::onlyTrashed()
            ->findOrFail($id);

        $this->authorize('restore', $post);

        $post->restore();

        return redirect()
            ->route('home.posts.index')
            ->with('status', __('messages.posts.restored'));
    }
}
