@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.create')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.posts.index') }}"> @lang('site.posts')</a></li>
            <li class="active"> @lang('site.create')</li>
        </ol>
    </section>

    <section class="content">

     @include('partials._errors')

    <form action="{{ route('dashboard.posts.store') }}" method="post" enctype="multipart/form-data">
    
        @csrf
            
        {{-- @if (app()->getLocale() == 'ar') --}}
            <div class="form-group">
                <label>@lang('site.title')</label>
                <input class="form-control" type="text" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label>@lang('site.body')</label>
                <textarea class="form-control" name="body" cols="20" rows="10">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <label>@lang('site.main_image')</label>
                <input class="form-control" type="file" name="main_image">
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
                <select class="form-control select2 " name="tags_ids[]" multiple>
                    <option>.....</option>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">@lang('site.create')</button>
            </div>
            
        {{-- @endif --}}
        
    </form>

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->
@endsection