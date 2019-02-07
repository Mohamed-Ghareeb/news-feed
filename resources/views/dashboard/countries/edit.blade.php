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
    
        <form action="{{ route('dashboard.countries.update', $country->id) }}" method="post">

            @csrf 
            @method('put')
            
            @foreach (config('translatable.locales') as $locale)
        
                <div class="form-group">
                    <label>@lang('site.' . $locale . '.name')</label>
                <input class="form-control" type="text" name="{{ $locale }}[name]" value="{{ $country->translate($locale)->name }}"> <!-- $country . $locale . '.name' -->
                </div>
        
            @endforeach
            <div class="form-group">
                <button class="btn btn-primary" type="submit">@lang('site.save')</button>
            </div>

        </form>

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->
@endsection