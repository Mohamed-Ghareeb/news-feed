@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.dashboard')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"> @lang('site.dashboard')</a></li>
            <li class="active"> @lang('site.admins')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
                    
                        <div class="box-header with-border">
                    
                            <h3 class="box-title" style="margin-bottom: 15px">@lang('site.admins')</h3>
                    
                            <form action="{{ route('dashboard.admins.index') }}" method="get">
                    
                                <div class="row">
                    
                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('site.search')">
                                    </div>
                    
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                        <a href="{{ route('dashboard.admins.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                                    </div>
                    
                                </div>
                            </form>
                            <!-- end of form -->
                    
                        </div>
                        <!-- end of box header -->
                    
                        <div class="box-body">
                    
                            @if ($admins->count() > 0)
                    
                            <table class="table table-hover">
                    
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.email')</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                    
                                <tbody>
                                    @foreach ($admins as $index=>$admin)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td><img src="{{ $admin->image_path }}" alt="" width="100" height="100" class="img-thumbnail"></td>
                                        <td>
                                            <a href="{{ route('dashboard.admins.edit', $admin->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                            <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }} {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form>
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