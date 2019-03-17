<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\CategoryTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $all_trashed = Category::onlyTrashed()->get();
        return view('dashboard.categories.index', compact('categories', 'all_trashed'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => ['required', Rule::unique('categories', 'name')]
        ]);
        Category::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => ['required', Rule::unique('categories', 'name')->ignore($category->id, 'id')]
        ]);
        $category->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    }
    
    public function all_trashed() // Soft Delete [ all_trashed ] => Mean Showing All Records trashed
    {
        $all_trashed = Category::onlyTrashed()->get();
        return view('dashboard.categories.trashed', compact('all_trashed'));
    }

    public function restore($id) // Soft Delete [ restore ] => Mean restoring The Trashed Categories
    {
        // dd($id, Category::onlyTrashed()->where('id', $id)->get());
        Category::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', __('site.restored_successfully'));
        return redirect()->route('dashboard.categories.all_trashed');
    }

    public function delete($id) // Soft Delete [ delete ] => Mean Delete form Database And The Application
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();
        $category->forceDelete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    }
}
