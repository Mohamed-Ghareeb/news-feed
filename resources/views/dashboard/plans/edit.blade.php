@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.update')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.plans.index') }}"> @lang('site.plans')</a></li>
            <li class="active"> @lang('site.update')</li>
        </ol>
    </section>

    <section class="content">
    @include('partials._errors')
    
        <form action="{{ route('dashboard.plans.update', $plan->id) }}" method="post" enctype="multipart/form-data">

            @csrf 
            @method('put')

            <div class="form-group">
                <label>@lang('site.name')</label>
                <input class="form-control" type="text" name="name" value="{{ $plan->name }}">
            </div>
            <div class="form-group">
                <label>@lang('site.features')</label>
                <textarea name="features" class="form-control">{{ $plan->features }}</textarea>
            </div>
            <div class="form-group">
                <label>@lang('site.price')</label>
                <input class="form-control" type="number" name="price" value="{{ $plan->price }}">
            </div>
            <div class="form-group">
               <label>@lang('site.icon')</label>
                <input class="form-control image" type="file" name="image">
             </div>
            <div class="form-group">
                <img src="{{ $plan->image_path }}" width="100" height="100" class="img-thumbnail image-preview" alt="">
            </div>
            <div class="form-group">
                <label>@lang('site.notification_type')</label>
                <select class="form-control" name="notification_type">           

                    @foreach ($types as $index => $type)
                        <option value="{{ $type }}" {{ $type ==  $plan->notification_type ? 'selected' : ''}}>{{ $type }}</option>
                        {{-- @dd($plan->notification_type) --}}
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