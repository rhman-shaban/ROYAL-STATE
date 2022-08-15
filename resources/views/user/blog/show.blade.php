@extends('layouts.user.layout')
@section('title')
    <title>{{ $blog->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $blog->seo_description }}">
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
                        <h4>{{ $blog->title }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog') }}">{{ $menus->where('id',7)->first()->navbar }}</a></li>
                                <li class="breadcrumb-item"><a>{{ $blog->title }}</a></li>
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
                <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                    <div class="wsus__blog_left_colum">
                        <div class="wsus__blog_bar">
                            <p>search</p>
                            <form action="{{ route('blog.search') }}" method="GET">
                                <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search" required>
                                <button class="common_btn_2" type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="wsus__blog_bar">
                            <p>{{ $websiteLang->where('lang_key','categories')->first()->custom_text }}</p>
                            <ul>
                                @foreach ($blogCategories as $item)
                                <li><a href="{{ route('blog.category',$item->slug) }}">{{ $item->name }} <span>{{ $item->blogs->count() }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wsus__blog_bar">
                            <p>{{ $websiteLang->where('lang_key','trend_post')->first()->custom_text }}</p>
                            @foreach ($popularBlogs as $item)
                                <a href="{{ route('blog.details',$item->slug) }}">
                                    <img src="{{ url($item->image) }}" alt="post img" class="img-fluid">
                                    <div class="wsus__trend_text">
                                        <p>{{ $item->title }}</p>
                                        <span><i class="far fa-clock"></i> {{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="wsus__blog_right_colum">
                        <img src="{{ url($blog->image) }}" alt="blog photo" class="img-fluid w-100">
                        <p class="wsus__blog_small_text"><span><i class="fal fa-user-edit"></i> {{ $blog->admin->name }}</span> <span><i class="fal fa-comment-alt-dots"></i> {{ $blog->comments->where('status',1)->count() }} {{ $websiteLang->where('lang_key','comments')->first()->custom_text }}</span> <span><i class="fal fa-eye"></i> {{ $blog->view }} {{ $websiteLang->where('lang_key','views')->first()->custom_text }}</span> </p>
                        <h4>{{ $blog->title }}</h4>



                        <p class="wsus__blog_small_details">
                            {!! clean($blog->description) !!}
                        </p>
                    </div>
                    @if ($commentSetting->comment_type==1)
                    <div class="wsus__blog_comment_area">
                        <h3>{{ $blog->comments->where('status',1)->count() }} {{ $websiteLang->where('lang_key','comments')->first()->custom_text }}</h3>
                        @foreach ($blog->comments->where('status',1) as $item)
                        <div class="wsus__blog_1st_comment">
                            <div class="wsus__comm_img">
                                <img src="{{ url($default_profile_image->image) }}" alt="comment person" class="img-fluid">
                            </div>
                            <div class="wsus__comm_text">
                                <h5>{{ $item->name }}</h5>
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                                <p>{{ $item->comment }}</p>

                            </div>
                        </div>

                        @endforeach

                        <div class="wsus__rite_comment">
                            <form action="{{ route('blog.comment',$blog->id) }}" method="POST">
                                @csrf
                                <h3>{{ $websiteLang->where('lang_key','submit_comment')->first()->custom_text }}</h3>
                                <input type="text" placeholder="{{ $websiteLang->where('lang_key','name')->first()->custom_text }}" name="name">
                                <input class="wsus_form_mar" type="email" placeholder="{{ $websiteLang->where('lang_key','email')->first()->custom_text }}" name="email">
                                <textarea cols="2" rows="3" placeholder="{{ $websiteLang->where('lang_key','comment')->first()->custom_text }}" name="comment"></textarea>
                                @if($commentSetting->allow_captcha==1)
                                <p class="g-recaptcha mb-3" data-sitekey="{{ $commentSetting->captcha_key }}"></p>
                                @endif
                                <button class="common_btn" type="submit"><i class="fas fa-external-link-alt"></i> {{ $websiteLang->where('lang_key','submit')->first()->custom_text }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="wsus__blog_comment_area">
                        <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>


                    </div>

                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--============================
       BLOG DETAILS PART END
    ==============================-->

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ $commentSetting->facebook_comment_script }}&autoLogAppEvents=1" nonce="MoLwqHe5"></script>




@endsection
