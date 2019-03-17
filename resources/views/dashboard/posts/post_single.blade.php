@extends('layouts.dashboard.app') 
@section('content')

<div class="content-wrapper">

    <section class="content-header">
    
        <h1>@lang('site.post_details')</h1>
    
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"></a> @lang('site.dashboard')</li>
            <li><a href="{{ route('dashboard.posts.index') }}"></a> @lang('site.posts')</li>
            <li class="active"> @lang('site.post_details')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
                    
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.show') : <strong>{{ $post->title }}</strong></h3>
            </div>
            <!-- end of box header -->
        
            <div class="box-body">
                <p>{{ $post->body }}</p>
            
                <br>
                <hr>

                <div class="row">
                    @if ($post->category)
                    <div class="col-md-3">
                        <p class="text-center">@lang('site.follow_for') : &nLeftarrow; <strong>{{ $post->category->name }}</strong></p>
                    </div>
                    @endif @if ($post->user)
                    <div class="col-md-3">
                        <p class="text-center">@lang('site.posted_by') : &nLeftarrow; <strong>{{ $post->user->name }}</strong></p>
                    </div>
                    @endif {{-- @dd($post->tags) --}} @if ($post->tags()->exists())
                    <div class="col-md-3">
                
                        <ul class="list-group">
                            <li class="list-group-item active">@lang('site.tags')</li>
                            @foreach ($post->tags as $tag)
                
                            <li class="list-group-item">
                                <a href="{{ route('dashboard.tags.index') }}s">{{ $tag->name }}</a>
                            </li>
                
                            @endforeach
                        </ul>
                    </div>
                
                
                    @endif
                </div>
            </div>
            
            <!-- end of box body -->
        
        
        </div>
        <!-- end of box -->

    </section>
    <!-- end of content -->

</div>
<!-- end of content wrapper -->
@endsection