@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
    <!--============================
          BREADCRUMB PART START
    ==============================-->
    <section id="wsus__breadcrumb" style="background:url({{ url($banner_image->image) }})">
        <div class="wsus_bread_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ $menus->where('id',7)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>

                                <li class="breadcrumb-item"><a>{{ $menus->where('id',7)->first()->navbar }}</a></li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          BREADCRUMB PART END
    ==============================-->



    <!--============================
          BLOG PART START
    ==============================-->
    <section id="wsus__blog">
        @if ($blogs->count()!=0)
        <div class="container">
            <div class="row">
                @foreach ($blogs as $item)
                <div class="col-xl-4 col-md-6 ">
                    <div class="wsus__single_blog">
                        <div class="wsus__blog_img">
                        <a href="{{ route('blog.details',$item->slug) }}"><img src="{{ url($item->image) }}" alt="blog images" class="img-fluid w-100"></a>
                            <p><span>{{ $item->created_at->format('d') }}</span>{{ $item->created_at->format('M Y') }}</p>
                        </div>
                        <div class="wsus__blog_top_row">
                            <h4><a href="{{ route('blog.details',$item->slug) }}"> {{ $item->title }} </a></h4>
                            <span><i class="fal fa-comment-alt-lines"></i> {{ $item->comments->where('status',1)->count() }}</span>
                        </div>
                        <p class="des">{{ $item->short_description }}</p>
                        <div class="wsus__blog_footer">
                            <img src="{{ $item->admin->image ? url($item->admin->image) : url($default_profile_image->image) }}" alt="clients" class="img-fluid">
                            <p>{{ $item->admin->name }} <a href="{{ route('blog.details',$item->slug) }}">{{ $websiteLang->where('lang_key','read_more')->first()->custom_text }} <i class="fal fa-long-arrow-right"></i></a></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $blogs->links('user.paginator') }}
        </div>
        @else
        <div class="container text-center">
            <div class="row">
                <h3 class="text-danger custom_center">{{ $websiteLang->where('lang_key','blog_not_found')->first()->custom_text }}</h3>
            </div>
        </div>
        @endif
    </section>
    <!--============================
          BLOG PART END
    ==============================-->
@endsection
