@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.update')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.cities.index') }}"> @lang('site.cities')</a></li>
            <li class="active"> @lang('site.update')</li>
        </ol>
    </section>

    <section class="content">
    @include('partials._errors')

        <form action="{{ route('dashboard.cities.update', $city->id) }}" method="post">

            @csrf
            @method('put') 
            
            <div class="form-group">
                <label>@lang('site.name')</label>
                <input class="form-control" type="text" name="name" value="{{ $city->name }}">
            </div>
            <div class="form-group">
                <label>@lang('site.country')</label>
                <select class="form-control" name="country_id">
                @foreach ($countries as $country)    
                    <option value="{{ $country->id }}" {{ $country->id == $city->country_id ? 'selected' : '' }}>{{ $country->name }}</option>
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