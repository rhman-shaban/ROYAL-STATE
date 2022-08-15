@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection


@section('user-content')

        <!--============================
          BANNER PART END
    ==============================-->
    <section id="wsus__banner" style="background-image:url({{ url($banner->image) }})">
        <div class="wsus__banner_overlay">
            <div class="container">
                <div class="wsus__banner_text">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-xxl-12">
                            <h1>{{ $banner->header }}</h1>
                        </div>

                        <div class="col-xl-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-any-tab" data-bs-toggle="pill" data-bs-target="#pills-any" type="button" role="tab" aria-controls="pills-any" aria-selected="true">{{ $websiteLang->where('lang_key','any')->first()->custom_text }}</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ $websiteLang->where('lang_key','sell')->first()->custom_text }}</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $websiteLang->where('lang_key','rent')->first()->custom_text }}</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-any" role="tabpanel" aria-labelledby="pills-any-tab">
                                    <form method="GET" action="{{ route('search-property') }}">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area home_page_search_box">
                                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search">
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <select class="select_2" name="city_id">
                                                        <option value="">{{ $websiteLang->where('lang_key','select_location')->first()->custom_text }}</option>
                                                        @foreach ($cities as $city_item)
                                                        <option value="{{ $city_item->id }}">{{ $city_item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <select class="select_2" name="property_type">
                                                        <option value="">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</option>
                                                        @foreach ($propertyTypes as $property_type_item)
                                                            <option value="{{ $property_type_item->id }}">{{ $property_type_item->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="page_type" value="list_view">
                                            <input type="hidden" name="purpose_type" value="">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','search_property')->first()->custom_text }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <form method="GET" action="{{ route('search-property') }}">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area home_page_search_box">
                                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search">
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <select class="select_2" name="city_id">
                                                        <option value="">{{ $websiteLang->where('lang_key','select_location')->first()->custom_text }}</option>
                                                        @foreach ($cities as $city_item)
                                                        <option value="{{ $city_item->id }}">{{ $city_item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <select class="select_2" name="property_type">
                                                        <option value="">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</option>
                                                        @foreach ($propertyTypes as $property_type_item)
                                                            <option value="{{ $property_type_item->id }}">{{ $property_type_item->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="page_type" value="list_view">
                                            <input type="hidden" name="purpose_type" value="1">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','search_property')->first()->custom_text }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <form method="GET" action="{{ route('search-property') }}">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area home_page_search_box">
                                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <select class="select_2" name="city_id">
                                                        <option value="">{{ $websiteLang->where('lang_key','select_location')->first()->custom_text }}</option>
                                                        @foreach ($cities as $city_item)
                                                        <option value="{{ $city_item->id }}">{{ $city_item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <select class="select_2" name="property_type">
                                                        <option value="">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</option>
                                                        @foreach ($propertyTypes as $property_type_item)
                                                            <option value="{{ $property_type_item->id }}">{{ $property_type_item->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="page_type" value="list_view">
                                            <input type="hidden" name="purpose_type" value="2">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="wp_search_area">
                                                    <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','search_property')->first()->custom_text }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          BANNER PART END
    ==============================-->


    <!--============================
          COUNTER PART START
    ==============================-->

    @php
        $award_section=$sections->where('id',11)->first();
    @endphp

    @if ($award_section->show_homepage==1)
    <section id="wsus__counter_part">
        <div class="container">
            <div class="col-xl-12">
                <div class="wsus__counter_area">
                    <div class="row">
                        @foreach ($awards->take($award_section->content_quantity) as $item)
                        <div class="col-sm-6 col-lg-3 col-xl-3">
                            <div class="wsus__single_counter">
                                <div class="wsus__counter_img">
                                    <img src="{{ url($item->image) }}" alt="logo" class="img-fluid">
                                </div>
                                <div class="wsus__counter_text">
                                    <span class="counter">{{ $item->qty }}</span>
                                    <p>{{ $item->name }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--============================
          COUNTER PART END
    ==============================-->


    <!--============================
          ABOUT PART START
    ==============================-->

@php
    $feature_section=$sections->where('id',2)->first();
@endphp

@if ($feature_section->show_homepage==1)
    <section id="wsus__about">
        <div class="container">
            <div class="row">
            <div class="col custom-box m-auto">
                <div class="wsus__heading_area">
                        <h4 class="wsus__small_heading">{{ $feature_section->header }}</h4>
                        <h2 class="wsus__medium_heading">{{ $feature_section->description }}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-xl-6 col-lg-6 col-xxl-6">
                    <div class="wsus__about_img">
                        <img src="{{ url($feature_image->image) }}" alt="property" class="imgfluid w-100">
                    </div>
                </div>
                <div class="col-12 col-md-12 col-xl-6 col-lg-6 col-xxl-6">
                    <div class="wsus__about_text">
                        @foreach ($features->take($feature_section->content_quantity) as $feature)
                        <div class="wsus__about_single">
                            <div class="wsus__about_icon">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                            <div class="wsus__about_details">
                                <h3>{{ $feature->title }}</h3>
                                <p>{{ $feature->description }}</p>
                            </div>
                        </div>
                        @endforeach


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
       TOP PROPERTY PART START
    ==============================-->

    @php
    $top_property_section=$sections->where('id',3)->first();
@endphp

@if ($top_property_section->show_homepage==1)
    <section id="wsus__top_property">
        <div class="container">
            <div class="row">
                <div class="col custom-box text-center m-auto">
                    <div class="wsus__heading_area">
                        <h2 class="wsus__medium_heading">{{ $top_property_section->header }}</h2>
                        <p class="wsus__small_details">{{ $top_property_section->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($properties->where('top_property',1)->take($top_property_section->content_quantity) as $top_item)
                    @if ($top_item->expired_date==null)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <a class="wsus__single_top_pro" href="{{ route('property.details',$top_item->slug) }}">
                            <img src="{{ url($top_item->thumbnail_image) }}" alt="property" class="img-fluid w-100">
                            <div class="wsus__single_top_text">
                                <div class="wsus__center_text">
                                    <i class="fa fa-map-marker mb-3 wsus__map_icon" aria-hidden="true"></i>
                                    <h4>{{ $top_item->title }}</h4>
                                    <div class="box-details mt-5">
                                        <div class="box-text">
                                            <i class="fal fa-bed" aria-hidden="true"></i><span>{{ $top_item->number_of_bedroom }} <br> {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</span>
                                        </div>
                                        <div class="box-text">
                                            <i class="fal fa-shower" aria-hidden="true"></i><span>{{ $top_item->number_of_bathroom }} <br> {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</span>
                                        </div>
                                        <div class="box-text">
                                            <i class="fal fa-draw-square" aria-hidden="true"></i><span>{{ $top_item->area }} <br> {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                    @elseif($top_item->expired_date >= date('Y-m-d'))
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <a class="wsus__single_top_pro" href="{{ route('property.details',$top_item->slug) }}">
                            <img src="{{ url($top_item->thumbnail_image) }}" alt="property" class="img-fluid w-100">
                            <div class="wsus__single_top_text">
                                <div class="wsus__center_text">
                                    <i class="fa fa-map-marker mb-3 wsus__map_icon" aria-hidden="true"></i>
                                    <h4>{{ $top_item->title }}</h4>
                                    <div class="box-details mt-5">
                                        <div class="box-text">
                                            <i class="fal fa-bed" aria-hidden="true"></i><span>{{ $top_item->number_of_bedroom }} <br> {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</span>
                                        </div>
                                        <div class="box-text">
                                            <i class="fal fa-shower" aria-hidden="true"></i><span>{{ $top_item->number_of_bathroom }} <br> {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</span>
                                        </div>
                                        <div class="box-text">
                                            <i class="fal fa-draw-square" aria-hidden="true"></i><span>{{ $top_item->area }} <br> {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!--============================
       TOP PROPERTY PART END
    ==============================-->

    @php
    $feature_property=$sections->where('id',4)->first();
@endphp

@if ($feature_property->show_homepage==1)
    <section id="wsus__recent_property">
        <div class="container">
            <div class="row">
                <div class="col custom-box text-center m-auto">
                    <div class="wsus__heading_area">
                        <h2 class="wsus__medium_heading">{{ $feature_property->header }}</h2>
                        <p class="wsus__small_details">{{ $feature_property->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($properties->where('is_featured',1)->take($feature_property->content_quantity) as $featured_item)
                    @if ($featured_item->expired_date==null)
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="wsus__single_property">
                                <a class="wsus__single_pro_img" href="{{ route('property.details',$featured_item->slug) }}">
                                    <img src="{{ $featured_item->thumbnail_image }}" alt="property" class="img-fluid w-100">
                                    @if ($featured_item->property_purpose_id==1)
                                    <span class="mark">{{ $featured_item->propertyPurpose->custom_purpose }}</span>
                                    @elseif($featured_item->property_purpose_id==2)
                                    <span class="mark">{{ $featured_item->propertyPurpose->custom_purpose }}</span>
                                    @endif

                                    @if ($featured_item->urgent_property==1)
                                        <span class="urgent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                    @endif

                                    {{-- <span class="overlay"></span> --}}
                                </a>
                                <div class="wsus__single_pro_text">
                                    <p>{{ $featured_item->propertyType->type }}
                                        @php
                                            $total_review=$featured_item->reviews->where('status',1)->count();
                                            if($total_review > 0){
                                                $avg_sum=$featured_item->reviews->where('status',1)->sum('avarage_rating');

                                                $avg=$avg_sum/$total_review;
                                                $intAvg=intval($avg);
                                                $nextVal=$intAvg+1;
                                                $reviewPoint=$intAvg;
                                                $halfReview=false;
                                                if($intAvg < $avg && $avg < $nextVal){
                                                    $reviewPoint= $intAvg + 0.5;
                                                    $halfReview=true;
                                                }
                                            }
                                        @endphp

                                        @if ($total_review > 0)
                                        <span class="middle_rating">
                                            <b>{{ sprintf("%.1f", $reviewPoint) }}</b>
                                            @for ($i = 1; $i <=5; $i++)
                                                @if ($i <= $reviewPoint)
                                                    <i class="fas fa-star"></i>
                                                @elseif ($i> $reviewPoint )
                                                    @if ($halfReview==true)
                                                    <i class="fas fa-star-half-alt"></i>
                                                        @php
                                                            $halfReview=false
                                                        @endphp
                                                    @else
                                                    <i class="fal fa-star"></i>
                                                    @endif
                                                @endif
                                            @endfor
                                        </span>

                                        @else
                                        <span class="middle_rating">
                                            <b>0.0</b>
                                            @for ($i = 1; $i <=5; $i++)
                                            <i class="fal fa-star"></i>
                                            @endfor
                                        </span>

                                        @endif
                                    </p>
                                    <a href="{{ route('property.details',$featured_item->slug) }}"><h4>{{ $featured_item->title }}</h4></a>
                                    <ul>
                                        <li><i class="fal fa-bed"></i> {{ $featured_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                        <li><i class="fal fa-shower"></i> {{ $featured_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                        <li><i class="fal fa-draw-square"></i> {{ $featured_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                    </ul>
                                    <div class="wsus__single_pro_bottom">
                                        @if ($featured_item->property_purpose_id==1)
                                            <span>{{ $currency->currency_icon }}{{ $featured_item->price }}</span>
                                        @elseif ($featured_item->property_purpose_id==2)
                                        <span>{{ $currency->currency_icon }}{{ $featured_item->price }}/

                                            @if ($featured_item->period=='Daily')
                                            <small class="property-period">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</small>
                                            @elseif ($featured_item->period=='Monthly')
                                            <small class="property-period">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</small>
                                            @elseif ($featured_item->period=='Yearly')
                                            <small class="property-period">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</small>
                                            @endif

                                        </span>
                                        @endif
                                        <a class="common_btn" href="{{ route('property.details',$featured_item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @elseif($featured_item->expired_date >= date('Y-m-d'))
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="wsus__single_property">
                            <a class="wsus__single_pro_img" href="{{ route('property.details',$featured_item->slug) }}">
                                <img src="{{ $featured_item->thumbnail_image }}" alt="property" class="img-fluid w-100">
                                @if ($featured_item->property_purpose_id==1)
                                <span class="mark">{{ $featured_item->propertyPurpose->custom_purpose }}</span>
                                @elseif($featured_item->property_purpose_id==2)
                                <span class="mark">{{ $featured_item->propertyPurpose->custom_purpose }}</span>
                                @endif

                                @if ($featured_item->urgent_property==1)
                                    <span class="urgent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                @endif

                                {{-- <span class="overlay"></span> --}}
                            </a>
                            <div class="wsus__single_pro_text">
                                <p>{{ $featured_item->propertyType->type }}

                                    @php
                                        $total_review=$featured_item->reviews->where('status',1)->count();
                                        if($total_review > 0){
                                            $avg_sum=$featured_item->reviews->where('status',1)->sum('avarage_rating');

                                            $avg=$avg_sum/$total_review;
                                            $intAvg=intval($avg);
                                            $nextVal=$intAvg+1;
                                            $reviewPoint=$intAvg;
                                            $halfReview=false;
                                            if($intAvg < $avg && $avg < $nextVal){
                                                $reviewPoint= $intAvg + 0.5;
                                                $halfReview=true;
                                            }
                                        }
                                    @endphp


                                    @if ($total_review > 0)
                                    <span class="middle_rating">
                                        <b>{{ sprintf("%.1f", $reviewPoint) }}</b>
                                        @for ($i = 1; $i <=5; $i++)
                                            @if ($i <= $reviewPoint)
                                                <i class="fas fa-star"></i>
                                            @elseif ($i> $reviewPoint )
                                                @if ($halfReview==true)
                                                <i class="fas fa-star-half-alt"></i>
                                                    @php
                                                        $halfReview=false
                                                    @endphp
                                                @else
                                                <i class="fal fa-star"></i>
                                                @endif
                                            @endif
                                        @endfor
                                    </span>

                                    @else
                                    <span class="middle_rating">
                                        <b>0.0</b>
                                        @for ($i = 1; $i <=5; $i++)
                                        <i class="fal fa-star"></i>
                                        @endfor
                                    </span>

                                    @endif
                                </p>
                                <a href="{{ route('property.details',$featured_item->slug) }}"><h4>{{ $featured_item->title }}</h4></a>
                                <ul>
                                    <li><i class="fal fa-bed"></i> {{ $featured_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                    <li><i class="fal fa-shower"></i> {{ $featured_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                    <li><i class="fal fa-draw-square"></i> {{ $featured_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                </ul>
                                <div class="wsus__single_pro_bottom">
                                    @if ($featured_item->property_purpose_id==1)
                                        <span>{{ $currency->currency_icon }}{{ $featured_item->price }}</span>
                                    @elseif ($featured_item->property_purpose_id==2)
                                    <span>{{ $currency->currency_icon }}{{ $featured_item->price }}/

                                        @if ($featured_item->period=='Daily')
                                        <small class="property-period">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</small>
                                        @elseif ($featured_item->period=='Monthly')
                                        <small class="property-period">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</small>
                                        @elseif ($featured_item->period=='Yearly')
                                        <small class="property-period">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</small>
                                        @endif

                                    </span>
                                    @endif
                                    <a class="common_btn" href="{{ route('property.details',$featured_item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    @endif
    <!--============================
       RECENT PROPERTY PART END
    ==============================-->


    <!--============================
          AGENTS PART START
    ==============================-->

    @php
    $agent_section=$sections->where('id',5)->first();
@endphp

@if ($agent_section->show_homepage==1)
    <section id="wsus__agents" style="background-image:url({{ url($agent_bg->image) }})">
        <div class="wsus__agent_overlay">
            <div class="container">
                <div class="row">
                    <div class="col custom-box text-center m-auto">
                        <div class="wsus__heading_area">
                            <h2 class="wsus__medium_heading text-white">{{ $agent_section->header }}</h2>
                            <p class="wsus__small_details text-white">{{ $agent_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($agents->take($agent_section->content_quantity) as $agent)
                    @php
                        $isOrder=$orders->where('user_id',$agent->id)->count();
                    @endphp
                    @if ($isOrder >0)
                    <div class="col-sm-6 col-lg-3 col-xl-3">
                        <div class="wsus__single_agents">
                            <div class="wsus__single_agents_img">
                                <a href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}"><img src="{{ $agent->image ? url($agent->image) : url($default_profile_image->image) }}" alt="team" class="img-fluid w-100"></a>
                            </div>
                            @php
                                $isSocialNull=true;
                                if($agent->icon_one && $agent->link_one){
                                    $isSocialNull=false;
                                }else if($agent->icon_two && $agent->link_two){
                                    $isSocialNull=false;
                                }else if($agent->icon_three && $agent->link_three){
                                    $isSocialNull=false;
                                }else if($agent->icon_four && $agent->link_four){
                                    $isSocialNull=false;
                                }

                            @endphp
                            <ul class="{{ $isSocialNull ? 'remove_padding' : '' }} ">
                                @if ($agent->icon_one && $agent->link_one)
                                <li><a href="{{ $agent->link_one }}"><i class="{{ $agent->icon_one }}"></i></a></li>
                                @endif

                                @if ($agent->icon_two && $agent->link_two)
                                <li><a href="{{ $agent->link_two }}"><i class="{{ $agent->icon_two }}"></i></a></li>
                                @endif

                                @if ($agent->icon_three && $agent->link_three)
                                <li><a href="{{ $agent->link_three }}"><i class="{{ $agent->icon_three }}"></i></a></li>
                                @endif

                                @if ($agent->icon_four && $agent->link_four)
                                <li><a href="{{ $agent->link_four }}"><i class="{{ $agent->icon_four }}"></i></a></li>
                                @endif
                            </ul>
                            <h5><a class="agent_name" href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}">{{ $agent->name }}</a></h5>
                            <p><i class="fal fa-map-marker-alt"></i> {{ $agent->address }}</p>
                            <div class="wsus__agent_button ">
                                <a class="common_btn_2" href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}"><i class="fas fa-eye"></i> {{ $featured_item->number_of_bed }} {{ $websiteLang->where('lang_key','view_profile')->first()->custom_text }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach

            </div>
        </div>
    </section>

    @endif
    <!--============================
          AGENTS PART END
    ==============================-->


    <!--============================
          SERVICES PART START
    ==============================-->

@php
    $service_section=$sections->where('id',6)->first();
@endphp

@if ($service_section->show_homepage==1)
    <section id="wsus__services">
        <div class="container">
            <div class="row">
                <div class="col custom-box text-center m-auto">
                    <div class="wsus__heading_area">
                        <h2 class="wsus__medium_heading">{{ $service_section->header }}</h2>
                        <p class="wsus__small_details">{{ $service_section->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($services->take($service_section->content_quantity) as $item)
                    <div class="col-sm-6 col-lg-3 col-xl-3">
                        <div class="wsus__single_service">
                            <i class="{{ $item->icon }}"></i>
                            <h5>{{ $item->title }}</h5>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @endif
    <!--============================
          SERVICES PART END
    ==============================-->

    <!--============================
        TESTIMONIAL PART START
    ==============================-->

@php
    $testimonial_section=$sections->where('id',8)->first();
@endphp


@if ($testimonial_section->show_homepage==1)
    <section id="wsus__testimonial" style="background-image:url({{ url($testimonial_bg->image) }})">
        <div class="testimonial_overlay">
            <div class="container">
                <div class="row">
                    <div class="col custom-box text-center m-auto">
                        <div class="wsus__heading_area">
                            <h2 class="wsus__medium_heading text-white">{{ $testimonial_section->header }}</h2>
                            <p class="wsus__small_details text-white">{{ $testimonial_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row testi_slider">
                    @foreach ($testimonials->take($testimonial_section->content_quantity) as $item)
                        <div class="col-xl-6">
                            <div class="wsus__single_clients">
                                <p><i class="fal fa-quote-left" id="top_icon"></i> {{ $item->description }}</p>
                                <img src="{{ url($item->image) }}" alt="clients" class="img-fluid">
                                <span class="c_name">{{ $item->name }}</span>
                                <span class="c_det">{{ $item->designation }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
    </section>
    @endif
    <!--============================
        TESTIMONIAL PART END
    ==============================-->


    

    <!--============================
          BLOG PART START
    ==============================-->
    @php
    $blog_section=$sections->where('id',7)->first();
@endphp

@if ($blog_section->show_homepage==1)
    <section id="wsus__blog">
        <div class="container">
            <div class="row">
                <div class="col custom-box text-center m-auto">
                    <div class="wsus__heading_area">
                        <h2 class="wsus__medium_heading">{{ $blog_section->header }}</h2>
                        <p class="wsus__small_details">{{ $blog_section->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs->take($blog_section->content_quantity) as $item)
                <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="wsus__single_blog">
                        <div class="wsus__blog_img">
                            <img src="{{ url($item->image) }}" alt="blog images" class="img-fluid w-100">
                            <p><span>{{ $item->created_at->format('d') }}</span>{{ $item->created_at->format('M Y') }}</p>
                        </div>
                        <div class="wsus__blog_top_row">
                            <h4><a href="{{ route('blog.details',$item->slug) }}">{{ $item->title }}</a></h4>
                            <span><i class="fal fa-comment-alt-lines"></i> {{ $item->comments->count() }}</span>
                        </div>
                        <p class="des">{{ $item->short_description }}</p>
                        <div class="wsus__blog_footer">
                            <img src="{{ $item->admin->image ? url($item->admin->image) : url($default_profile_image->image) }}" alt="clients" class="img-fluid">
                            <p>{{ $item->admin->name }} <a href="{{ route('blog.details',$item->slug) }}">{{ $featured_item->number_of_bed }} {{ $websiteLang->where('lang_key','read_more')->first()->custom_text }} <i class="fal fa-long-arrow-right"></i></a></p>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>
    @endif
    <!--============================
          BLOG PART END
    ==============================-->


@endsection
