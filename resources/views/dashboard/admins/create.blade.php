@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.create')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li class="active"> @lang('site.create')</li>
        </ol>
    </section>

    <section class="content">

     @include('partials._errors')   

    <form action="{{ route('dashboard.admins.store') }}" method="post" enctype="multipart/form-data">
    
        @csrf
        @method('post') 
        
        <div class="form-group">
            <label>@lang('site.first_name')</label>
            <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" required>
        </div>
        <div class="form-group">
            <label>@lang('site.last_name')</label>
            <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" required>
        </div>
        <div class="form-group">
            <label>@lang('site.email')</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label>@lang('site.password')</label>
            <input class="form-control" type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>@lang('site.password_confirmation')</label>
            <input class="form-control" type="password" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label>@lang('site.profile_image')</label>
            <input class="form-control image" type="file" name="profile_image">
        </div>
        <div class="form-group">
            <img src="{{ asset('uploads/admins_images/default.png') }}" class="img-thumbnail image-preview" width="150" height="150">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">@lang('site.add')</button>
        </div>
        
    </form>

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->
@endsection