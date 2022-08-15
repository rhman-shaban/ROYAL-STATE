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
                        <h4>{{ $menus->where('id',5)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>


                                <li class="breadcrumb-item"><a>{{ $menus->where('id',5)->first()->navbar }}</a></li>
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
        PRICING PART START
    ==============================-->
    <section id="wsus__pricing">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($packages as $item)
                    <div class="col-xl-4 col-sm-6 ">
                        <div class="wsus__single_pricing">
                        <span class="wsus_price_head">{{ $item->package_name }}</span>
                            <p class="wsus__pricing_tk">{{ $currency->currency_icon }} <span>{{ $item->price }}</span></p>
                            @if ($item->number_of_days==-1)
                            <p class="wsus__price_duration">{{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}</p>
                            @else
                            <p class="wsus__price_duration">{{ $item->number_of_days }} {{ $websiteLang->where('lang_key','days')->first()->custom_text }}</p>
                            @endif
                            <ul>
                                @if ($item->number_of_property==-1)
                                <li>{{ $websiteLang->where('lang_key','unlimited_pro_submission')->first()->custom_text }}</li>
                                @else
                                <li>{{ $item->number_of_property }} {{ $websiteLang->where('lang_key','pro_submission')->first()->custom_text }}</li>
                                @endif

                                @if ($item->number_of_aminities==-1)
                                <li>{{ $websiteLang->where('lang_key','unlimited_aminity')->first()->custom_text }}</li>
                                @else
                                <li>{{ $item->number_of_aminities }} {{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</li>
                                @endif

                                @if ($item->number_of_nearest_place==-1)
                                <li>{{ $websiteLang->where('lang_key','unlimited_nearest_place')->first()->custom_text }}</li>
                                @else
                                <li>{{ $item->number_of_nearest_place }} {{ $websiteLang->where('lang_key','nearest_place')->first()->custom_text }}</li>
                                @endif
                                @if ($item->number_of_photo==-1)
                                <li>{{ $websiteLang->where('lang_key','unlimited_photo')->first()->custom_text }}</li>
                                @else
                                <li>{{ $item->number_of_photo }} {{ $websiteLang->where('lang_key','photo')->first()->custom_text }}</li>
                                @endif

                                @if ($item->is_featured==1)
                                    <li>{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</li>
                                @else
                                <li class="wsus__add_before">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</li>
                                @endif

                                @if ($item->number_of_feature_property==-1)
                                <li>{{ $websiteLang->where('lang_key','unlimited_feature_property')->first()->custom_text }}</li>
                                @else
                                <li>{{ $item->number_of_feature_property }} {{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</li>
                                @endif


                                @if ($item->is_top==1)
                                    <li>{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</li>
                                @else
                                <li class="wsus__add_before">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</li>
                                @endif
                                @if ($item->number_of_top_property==-1)
                                <li>{{ $websiteLang->where('lang_key','unlimited_top_property')->first()->custom_text }}</li>
                                @else
                                <li>{{ $item->number_of_top_property }} {{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</li>
                                @endif


                                @if ($item->is_urgent==1)
                                    <li>{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</li>
                                @else
                                <li class="wsus__add_before">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</li>
                                @endif
                                @if ($item->number_of_urgent_property==-1)
                                <li>{{ $websiteLang->where('lang_key','unlimited_urgent_property')->first()->custom_text }}</li>
                                @else
                                <li>{{ $item->number_of_urgent_property }} {{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</li>
                                @endif
                            </ul>
                            <a class="common_btn_2" href="{{ route('user.purchase.package',$item->id) }}">{{ $websiteLang->where('lang_key','start_with')->first()->custom_text }} {{ $item->package_name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--============================
        PRICING PART END
    ==============================-->


@endsection
