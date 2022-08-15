@extends('layouts.user.layout')
@section('title')
    <title>{{ $page->seo_title }}</title>
@endsection
@section('user-content')
     <!--============================
          BREADCRUMB PART START
    ==============================-->
    <section id="wsus__breadcrumb" style="background-image:url({{ url($banner_image->image) }})">
        <div class="wsus_bread_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ $page->page_name }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                                <li class="breadcrumb-item"><a>{{ $page->page_name }}</a></li>
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
       BLOG DETAILS PART START
    ==============================-->
    <section id="wsus__blog_details">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__blog_right_colum">
                        <p class="wsus__blog_small_details mb-1">
                            {!! clean($page->description) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
       BLOG DETAILS PART END
    ==============================-->
@endsection
