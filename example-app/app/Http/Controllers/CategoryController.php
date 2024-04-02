<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        return view('category.index', [
            'categories' => Category::all(),
            'user' => $request->user(),
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function create(Request $request): View
    {
        return view('category.create', [
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['required','string']
        ]);
        Category::create(
            $request->all()
        );
        return redirect()->route('category.index');
    }

    /**
     * Update the user's profile information.
     */
    public function edit(Request $request, Category $category): View
    {
        return view('category.edit', [
            'category' => $category,
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['string'],
        ]);
        $category->update(
            $request->all()
        );
        return redirect()->route('category.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $category->books()->each(function (Book $book) {$book->delete();});
        $category->delete();
        return redirect()->route('category.index');
    }
}
