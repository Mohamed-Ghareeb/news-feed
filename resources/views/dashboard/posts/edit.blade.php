@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.update')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li class="active"> @lang('site.update')</li>
        </ol>
    </section>

    <section class="content">
    @include('partials._errors')
    
        <form action="{{ route('dashboard.posts.update', $post->id) }}" method="post">

            @csrf 
            @method('put')
            
            <div class="form-group">
                <label>@lang('site.title')</label>
                <input class="form-control" type="text" name="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label>@lang('site.body')</label>
                <textarea class="form-control" name="body" cols="20" rows="10">{{ $post->body }}</textarea>
            </div>
            <div class="form-group">
                <label>@lang('site.main_image')</label>
                <input class="form-control image" type="file" name="main_image">
            </div>
            <div class="form-group">
                <img class="image-preview" src="{{ $post->main_image }}" alt="" width="100" height="100">
            </div>
            <div class="form-group">
                <label>@lang('site.images')</label>
                <input class="form-control" type="file" name="images[]" multiple>
            </div>
            <div class="form-group">
                <label>@lang('site.category')</label>
                <select class="form-control" name="category_id">
                                <option>.....</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
            </div>
            <div class="form-group">
                <label>@lang('site.tags')</label>
                <select class="form-control" name="tags_ids[]" multiple>
                                <option>.....</option>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">@lang('site.save')</button>
            </div>

        </form>

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->
@endsection