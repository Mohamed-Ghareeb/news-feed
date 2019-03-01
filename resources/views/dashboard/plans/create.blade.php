@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.create')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.plans.index') }}"> @lang('site.plans')</a></li>
            <li class="active"> @lang('site.create')</li>
        </ol>
    </section>

    <section class="content">

     @include('partials._errors')   

    <form action="{{ route('dashboard.plans.store') }}" method="post" enctype="multipart/form-data">
    
        @csrf 

        <div class="form-group">
            <label>@lang('site.name')</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>@lang('site.features')</label>
            <textarea name="features" class="form-control">{{ old('features') }}</textarea>
        </div>
        <div class="form-group">
            <label>@lang('site.price')</label>
            <input class="form-control" type="number" step="1" name="price">
        </div>
        <div class="form-group">
            <label>@lang('site.icon')</label>
            <input class="form-control image" type="file" name="image">
        </div>
        <div class="form-group">
            <img src="{{ asset('uploads/plans_icons/default.jpg') }}" width="100" height="100" class="img-thumbnail image-preview" alt="">
        </div>
        <div class="form-group">
            <label>@lang('site.notification_type')</label>
            <select class="form-control" name="notification_type">           
                <option>....</option>
                @foreach ($types as $index => $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                    {{-- @dd($plan->notification_type) --}}
                @endforeach

            </select>
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