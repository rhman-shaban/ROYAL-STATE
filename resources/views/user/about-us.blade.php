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
    <section id="wsus__breadcrumb" style="background-image:url({{ url($banner_image->image) }})">
        <div class="wsus_bread_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ $menus->where('id',4)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>

                                <li class="breadcrumb-item"><a>{{ $menus->where('id',4)->first()->navbar }}</a></li>
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
          ABOUT PART START
    ==============================-->
    @php
    $about_section=$sections->where('id',1)->first();
@endphp

@if ($about_section->show_homepage==1)
    <section id="wsus__about">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-10 col-lg-6 col-xxl-6 offset-md-1 offset-lg-0">
                    <div class="wsus__about_img">
                        <img src="{{ url($about->image) }}" alt="property" class="imgfluid w-100">
                    </div>
                </div>
                <div class="col-xl-6 col-md-10 col-lg-6 col-xxl-6 offset-md-1 offset-lg-0">
                    <div class="wsus__about_text">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"> {{ $websiteLang->where('lang_key','about_us')->first()->custom_text }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"> {{ $websiteLang->where('lang_key','service')->first()->custom_text }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"> {{ $websiteLang->where('lang_key','history')->first()->custom_text }}</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <p class="wsus_tab_details">{!! clean($about->about) !!}</p>

                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <p class="wsus_tab_details">{!! clean($about->service) !!}</p>

                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <p class="wsus_tab_details">{!! clean($about->history) !!}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif
    <!--============================
          ABOUT PART END
    ==============================-->


    <!--============================
          AWARDS PART START
    ==============================-->
    @php
    $award_section=$sections->where('id',2)->first();
@endphp

@if ($award_section->show_homepage==1)
    <section id="wsus__awards">
        <div class="container">
            <div class="row">
                <div class="col custom-box text-center m-auto">
                    <div class="wsus__heading_area">
                        <h2 class="wsus__medium_heading text-white">{{ $award_section->header }}</h2>
                        <p class="wsus__small_details text-white">{{ $award_section->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($awards->take($award_section->content_quantity) as $item)
                <div class="col-xl-3 col-6 col-lg-3">
                    <div class="wsus__single_awards">
                        <i class="{{ $item->icon }}"></i>
                        <span class="counter">{{ $item->qty }}</span>
                        <p>{{ $item->name }}</p>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>
    @endif
    <!--============================
          AWERD PART END
    ==============================-->


    <!--============================
          TEAM PART START
    ==============================-->

    @php
    $team_section=$sections->where('id',3)->first();
@endphp

@if ($team_section->show_homepage==1)
    <section id="wsus__team">
        <div class="container">
            <div class="row">
                <div class="col custom-box text-center m-auto">
                    <div class="wsus__heading_area">
                        <h2 class="wsus__medium_heading">{{ $team_section->header }}</h2>
                        <p class="wsus__small_details">{{ $team_section->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($partners->take($team_section->content_quantity) as $item)
                <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3 ">
                    <div class="wsus__single_team">
                        <img src="{{ $item->image }}" alt="team member" class="img-fluid">
                        <span>{{ $item->name }}</span>
                        <p>{{ $item->designation }}</p>
                        <ul>

                            @if ($item->first_icon && $item->first_link)
                            <li><a href="{{ $item->first_link }}"><i class="{{ $item->first_icon }}"></i></a></li>
                            @endif

                            @if ($item->second_icon && $item->second_link)
                            <li><a href="{{ $item->second_link }}"><i class="{{ $item->second_icon }}"></i></a></li>
                            @endif

                            @if ($item->third_icon && $item->third_link)
                            <li><a href="{{ $item->third_link }}"><i class="{{ $item->third_icon }}"></i></a></li>
                            @endif

                            @if ($item->four_icon && $item->four_link)
                            <li><a href="{{ $item->four_link }}"><i class="{{ $item->four_icon }}"></i></a></li>
                            @endif








                        </ul>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    @endif
    <!--============================
          TEAM PART END
    ==============================-->

@endsection
