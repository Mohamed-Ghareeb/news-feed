@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.dashboard')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li class="active"> @lang('site.posts')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
                    
                        <div class="box-header with-border">
                    
                            <h3 class="box-title" style="margin-bottom: 15px">@lang('site.posts')</h3>
                    
                            <form action="{{ route('dashboard.posts.index') }}" method="get">
                    
                                <div class="row">
                    
                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('site.search')">
                                    </div>
                    
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                        <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                                    </div>
                    
                                </div>
                            </form>
                            <!-- end of form -->
                    
                        </div>
                        <!-- end of box header -->
                    
                        <div class="box-body">
                    
                            @if ($posts->count() > 0)
                    
                            <table class="table table-hover">
                    
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.description')</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                    
                                <tbody>
                                    @foreach ($posts as $index=>$post)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            {{ $post->summary }} <br>
                                            <a href="{{ route('dashboard.posts.single', $post->id) }}" class="btn btn-info btn-xs align-center">@lang('site.show_more')</a>
                                        </td>
                                        <td><img src="{{ $post->image_path }}" alt="" width="100" height="100"></td>
                                        <td>
                                            <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                            <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="post" style="display: inline-block">
                                                    {{ csrf_field() }} {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                </form>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.approvel')</a>
                                            <!-- end of form -->
                                        </td>
                                    </tr>
                    
                                    @endforeach
                                </tbody>
                    
                            </table>
                            <!-- end of table -->
                    
                            @else
                    
                            <h2>@lang('site.no_data_found')</h2>
                    
                            @endif
                    
                        </div>
                        <!-- end of box body -->
                    
                    
                    </div>
                    <!-- end of box -->

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->
@endsection