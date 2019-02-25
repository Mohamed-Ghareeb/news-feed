<?php

namespace App\Http\Controllers\Dashboard;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Auth;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'title'        => 'required',
            'body'         => 'required',
            'category_id'  => ['required', Rule::exists('categories', 'id')],
            'user_id'      => User::id(),
        ]);


        $data = $request->except('summary', 'user_id');
        $data['summary'] = substr($request->body, 0, 20);
        // $data['user_id'] = Auth::id();

        Post::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.posts.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'ar.name' => ['required', Rule::unique('category_translations', 'name')->ignore($post->id)]
        ]);

        $post->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.posts.index');
    }

    public function single($id)
    {
        // dd($post->first()->body);

        $post = Post::find($id);

        return view('dashboard.posts.post_single', compact('post'));
    }
}
