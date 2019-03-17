<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Tag;
use App\Post;
use App\User;
use Auth;
use Image;
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
        $tags = Tag::all();
        return view('dashboard.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title'        => 'required',
            'body'         => 'required',
            'main_image'   => 'required|image',
            'images.*'     => 'sometimes|nullable|image',
            'category_id'  => ['required', Rule::exists('categories', 'id')],
        ]);
        
        $data = $request->except('summary', 'user_id', 'main_image', 'images');
        if ($request->hasFile('main_image')) {
            Image::make($request->main_image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/posts_main_img/' . $request->main_image->hashName()));
            $data['main_image'] = 'uploads/posts_main_img/' . $request->main_image->hashName();
        }

        if ($request->hasFile('images')) {
            $images_name = [];
            foreach ($request->images as $image) {
                
                Image::make($image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/posts_images/' . $image->hashName()));
                $images_name[] = 'uploads/posts_images/' . $image->hashName();
            }

            $data['images'] = json_encode($images_name);
        }

        $data['summary'] = str_limit($request->body, 20);
        $data['user_id'] = auth()->id();
        
        // auth()->user()->posts()->create($data);
        $post = Post::create($data);
        
        $post->tags()->attach($request->tags_ids);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.posts.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('dashboard.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'        => 'required',
            'body'         => 'required',
            'category_id'  => ['required', Rule::exists('categories', 'id')],
        ]);

        $data = $request->except('summary', 'user_id');
        $data['summary'] = str_limit($request->body, 20);
        $data['user_id'] = auth()->id();
        $post->update($request->all());

        $post->tags()->sync($request->tags_ids);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.posts.index');
    }

    public function single(Post $post)
    {
        // dd($post->first()->body);
        $tags = Tag::all();
        return view('dashboard.posts.post_single', compact('post', 'tags'));
    }
}
