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
    
        <form action="{{ route('dashboard.admins.update', $admin->id) }}" method="post" enctype="multipart/form-data">

            @csrf 
            @method('put')

            <div class="form-group">
                <label>@lang('site.name')</label>
                <input class="form-control" type="text" name="name" value="{{ $admin->name }}" required>
            </div>
            <div class="form-group">
                <label>@lang('site.email')</label>
                <input class="form-control" type="email" name="email" value="{{ $admin->email }}" required>
            </div>
            <div class="form-group">
                <label>@lang('site.profile_image')</label>
                <input class="form-control image" type="file" name="profile_image">
            </div>
            <div class="form-group">
                <img src="{{ $admin->image_path }}" class="img-thumbnail image-preview" width="150" height="150">
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