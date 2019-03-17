@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.update')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.tags.index') }}"> @lang('site.tags')</a></li>
            <li class="active"> @lang('site.update')</li>
        </ol>
    </section>

    <section class="content">
    @include('partials._errors')
    
        <form action="{{ route('dashboard.tags.update', $tag->id) }}" method="post">

            @csrf 
            @method('put')
            
            <div class="form-group">
                <label>@lang('site.name')</label>
                <input class="form-control" type="text" name="name" value="{{ $tag->name }}">
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