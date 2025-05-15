<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->latest()->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Category::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('category.index')
            ->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        if (auth()->id() == $category->user_id) {
            return view('category.edit', compact('category'));
        }

        return redirect()->route('category.index')->with('danger', 'You are not authorized to edit this category!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        if (auth()->id() == $category->user_id) {
            $category->update([
                'title' => ucfirst($request->title),
            ]);

            return redirect()->route('category.index')->with('success', 'Category updated successfully!');
        }

        return redirect()->route('category.index')->with('danger', 'You are not authorized to update this category!');
    }

    public function destroy(Category $category)
    {
        if (auth()->id() == $category->user_id) {
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
        }

        return redirect()->route('category.index')->with('danger', 'You are not authorized to delete this category!');
    }
}
