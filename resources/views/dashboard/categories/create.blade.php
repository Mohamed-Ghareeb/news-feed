@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.create')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.categories.index') }}"> @lang('site.categories')</a></li>
            <li class="active"> @lang('site.create')</li>
        </ol>
    </section>

    <section class="content">

     @include('partials._errors')   

    <form action="{{ route('dashboard.categories.store') }}" method="post">
    
        @csrf 

        {{-- @dd(config('translatable.locales')) --}}

        @foreach (config('translatable.locales') as $locale)
            
            <div class="form-group">
                <label>@lang('site.' . $locale . '.name')</label>
                <input class="form-control" type="text" name="{{ $locale }}[name]" value="{{ old($locale . '.name') }}">
            </div>

        @endforeach
        <div class="form-group">
            <button class="btn btn-primary" type="submit">@lang('site.add')</button>
        </div>
        
    </form>

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->
@endsection