<?php

namespace App\Http\Controllers\Dashboard;

use App\Tag;
use App\TagTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $all_trashed = Tag::onlyTrashed()->get();
        return view('dashboard.tags.index', compact('tags', 'all_trashed'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('tags', 'name')],
        ]);

        Tag::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.tags.index');
    }

    public function edit(Tag $tag)
    {
        return view('dashboard.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => ['required', Rule::unique('tags', 'name')->ignore($tag->id, 'id')],
        ]);
        
        $tag->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.tags.index');
    }
    
    public function all_trashed() // Soft Delete [ all_trashed ] => Mean Showing All Records trashed
    {
        $all_trashed = Tag::onlyTrashed()->get();
        return view('dashboard.tags.trashed', compact('all_trashed'));
    }

    public function restore($id) // Soft Delete [ restore ] => Mean restoring The Trashed Tags
    {
        // dd($id, Tag::onlyTrashed()->where('id', $id)->get());
        Tag::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', __('site.restored_successfully'));
        return redirect()->route('dashboard.tags.all_trashed');
    }

    public function delete($id) // Soft Delete [ delete ] => Mean Delete form Database And The Application
    {
        $tag = Tag::onlyTrashed()->where('id', $id)->first();
        $tag->forceDelete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.tags.index');
    }
}
