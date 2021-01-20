<?php declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\StoreCategoryRequest;
use App\Http\Requests\Home\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::query()
            ->withTrashed()
            ->when(request('query'), function ($q, $query) {
                return $q->where('title', 'like', "%{$query}%");
            })
            ->when(request('column', 'updated_at'), function ($q, $column) {
                return $q->orderBy($column, request('direction', 'desc'));
            })
            ->paginate();

        return view('home.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('home.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Category::create($validated);

        return redirect()
            ->route('home.categories.index')
            ->with('status', __('messages.categories.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('home.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $validated = $request->validated();

        $category->update($validated);

        return redirect()
            ->route('home.categories.index')
            ->with('status', __('messages.categories.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('home.categories.index')
            ->with('status', __('messages.categories.deleted'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $category = Category::onlyTrashed()
            ->findOrFail($id);

        $category->restore();

        return redirect()
            ->route('home.categories.index')
            ->with('status', __('messages.categories.restored'));
    }
}
