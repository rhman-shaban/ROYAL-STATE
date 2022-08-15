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
                        <h4>{{ $menus->where('id',2)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>

                                <li class="breadcrumb-item"><a>{{ $menus->where('id',2)->first()->navbar }}</a></li>

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

        @php
            $search_url = request()->fullUrl();
            $get_url = substr($search_url, strpos($search_url, "?") + 1);

            $grid_url='';
            $list_url='';
            $isSortingId=0;

            $page_type=request()->get('page_type') ;
            if($page_type=='list_view'){
                $grid_url=str_replace('page_type=list_view','page_type=grid_view',$search_url);
                $list_url=str_replace('page_type=list_view','page_type=list_view',$search_url);
            }else if($page_type=='grid_view'){
                $grid_url=str_replace('page_type=grid_view','page_type=grid_view',$search_url);
                $list_url=str_replace('page_type=grid_view','page_type=list_view',$search_url);
            }
            if(request()->has('sorting_id')){
                $isSortingId=1;
            }
        @endphp

    <!--============================
        PROPERTY LIST VIEW START
    ==============================-->
    <section id="wsus__property_list_view">
        <div class="container">
            <div class="row">
               <div class="col-xl-4 col-md-4 col-lg-3">
                    <div class="wsus__property_sidebar">
                        <h3>{{ $websiteLang->where('lang_key','find_property')->first()->custom_text }} <i class="far fa-search"></i></h3>
                        <!--added new section for small device start-->
                        <span class="wsus__filter_icon">
                            <i class="far fa-minus" id="minus_1"></i>
                            <i class="far fa-minus minus_2"></i>
                        </span>
                        <!--added new section for small device end-->

                        <div class="wsus__filter_body">
                            <!--added new section for small device start with php-->
                            <div class="wsus__sidebar_center">
                                <form method="GET" action="{{ route('search-property') }}">
                                    <div class="wsus__single_input">
                                        <label for="#">{{ $websiteLang->where('lang_key','keyword')->first()->custom_text }}</label>
                                        <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search">
                                    </div>

                                    <div class="wp_search_area">
                                        <label for="#">{{ $websiteLang->where('lang_key','location')->first()->custom_text }}</label>
                                        <select class="select_2" name="city_id">
                                            <option value="">{{ $websiteLang->where('lang_key','location')->first()->custom_text }}</option>
                                            @foreach ($cities as $city_item)
                                            <option value="{{ $city_item->id }}">{{ $city_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="page_type" value="{{ $page_type }}">
                                    <div class="wp_search_area">
                                        <label for="#">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</label>
                                        <select class="select_2" name="property_type">
                                            <option value="">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</option>
                                            @foreach ($propertyTypes as $property_type_item)
                                                <option value="{{ $property_type_item->id }}">{{ $property_type_item->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="wp_search_area">
                                        <label for="#">{{ $websiteLang->where('lang_key','property_purpose')->first()->custom_text }}</label>
                                        <select class="select_2" name="purpose_type">
                                            <option value="">{{ $websiteLang->where('lang_key','any')->first()->custom_text }}</option>
                                            <option value="1">{{ $websiteLang->where('lang_key','sell')->first()->custom_text }}</option>
                                            <option value="2">{{ $websiteLang->where('lang_key','rent')->first()->custom_text }}</option>
                                        </select>
                                    </div>



                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    {{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="wsus__accordian_body">
                                                        @foreach ($aminities as $aminity)
                                                        <div class="form-check">
                                                            <input name="aminity[]" value="{{ $aminity->id }}" class="form-check-input" type="checkbox" id="aminity_id-{{ $aminity->id }}">


                                                            <label class="form-check-label" for="aminity_id-{{ $aminity->id }}">
                                                                {{ $aminity->aminity }}
                                                            </label>

                                                        </div>
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="common_btn_2 mt-3" type="submit">{{ $websiteLang->where('lang_key','search')->first()->custom_text }}</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-8 col-md-8 col-lg-9">
                    <div class="wsus__property_item">
                        <div class="col-xl-12">
                            <div class="wsus__property_topbar mar d-none d-lg-block">
                                <div class="wsus__property_topbar_left">

                                    <ul>
                                        <li><a class="{{ $page_type=='grid_view' ? 'wsus_active_bar' :''  }}" href="{{ $grid_url }}"><i class="fas fa-th"></i></a></li>
                                        <li class="custom-r-border"><a class="{{ $page_type=='list_view' ? 'wsus_active_bar' :''  }}" href="{{ $list_url }}"><i class="fas fa-list-ul"></i></a></li>
                                    </ul>
                                </div>
                                <div class="wsus__property_topbar_right">
                                    @if ($isSortingId==1)
                                    <div class="wp_search_area">
                                        <select class="select_2" id="sortingId">
                                            <option {{ request()->get('sorting_id')==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('lang_key','default_order')->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==2 ? 'selected' : '' }} value="2">{{ $websiteLang->where('lang_key','most_views')->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==3 ? 'selected' : '' }} value="3">{{ $websiteLang->where('lang_key','featured')->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==4 ? 'selected' : '' }} value="4">{{ $websiteLang->where('lang_key','top')->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==5 ? 'selected' : '' }} value="5">{{ $websiteLang->where('lang_key','new')->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==6 ? 'selected' : '' }} value="6">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==7 ? 'selected' : '' }} value="7">{{ $websiteLang->where('lang_key','oldest')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                    @else
                                        <div class="wp_search_area">
                                            <select class="select_2" id="sortingId">
                                                <option value="1">{{ $websiteLang->where('lang_key','default_order')->first()->custom_text }}</option>
                                                <option value="2">{{ $websiteLang->where('lang_key','most_views')->first()->custom_text }}</option>
                                                <option value="3">{{ $websiteLang->where('lang_key','featured')->first()->custom_text }}</option>
                                                <option value="4">{{ $websiteLang->where('lang_key','top')->first()->custom_text }}</option>
                                                <option value="5">{{ $websiteLang->where('lang_key','new')->first()->custom_text }}</option>
                                                <option value="6">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</option>
                                                <option value="7">{{ $websiteLang->where('lang_key','oldest')->first()->custom_text }}</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @php
                            $isActivePropertyQty=0;
                            foreach ($properties as $value) {
                                if($value->expired_date==null){
                                    $isActivePropertyQty +=1;
                                }else if($value->expired_date >= date('Y-m-d')){
                                    $isActivePropertyQty +=1;
                                }
                            }
                        @endphp

                        @if ($isActivePropertyQty > 0)
                        <div class="row">
                            @if ($page_type=='list_view')
                            <div class="col-xl-12">
                                @foreach ($properties as $item)
                                    @if ($item->expired_date==null)
                                        <div class="wsus__list_item">
                                            <a href="{{ route('property.details',$item->slug) }}" class="wsus__list_item_img">
                                                <img src="{{ $item->thumbnail_image }}" alt="property" class="img-fluid w-100">
                                                @if ($item->property_purpose_id==1)
                                                <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                @elseif($item->property_purpose_id==2)
                                                <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                @endif

                                                @if ($item->urgent_property==1)
                                                    <span class="urgent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                                @endif
                                                {{-- <span class="overlay"></span> --}}
                                            </a>
                                            <div class="wsus__list_item_text">
                                                <p><b>{{ $item->propertyType->type }}</b>
                                                        @if ($item->property_purpose_id==1)
                                                            <span>{{ $currency->currency_icon }}{{ $item->price }}</span>
                                                        @elseif ($item->property_purpose_id==2)
                                                        <span>{{ $currency->currency_icon }}{{ $item->price }}/
                                                            @if ($item->period=='Daily')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</small>
                                                            @elseif ($item->period=='Monthly')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</small>
                                                            @elseif ($item->period=='Yearly')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</small>
                                                            @endif


                                                        </span>
                                                        @endif

                                                </p>
                                                <h4> <a href="{{ route('property.details',$item->slug) }}">{{ $item->title }}</a></h4>
                                                <ul>
                                                    <li><i class="fal fa-bed"></i> {{ $item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-shower"></i> {{ $item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-draw-square"></i> {{ $item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                                </ul>
                                                <div class="wsus__rating_n_btn">
                                                    @php
                                                        $total_review=$item->reviews->where('status',1)->count();
                                                        if($total_review > 0){
                                                            $avg_sum=$item->reviews->where('status',1)->sum('avarage_rating');

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
                                                    <p>
                                                        <span>{{ sprintf("%.1f", $reviewPoint) }}</span>
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
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>0.0</span>
                                                        @for ($i = 1; $i <=5; $i++)
                                                            <i class="fal fa-star"></i>
                                                        @endfor
                                                    </p>
                                                    @endif
                                                    <a class="common_btn" href="{{ route('property.details',$item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($item->expired_date >= date('Y-m-d'))
                                        <div class="wsus__list_item">
                                            <a href="{{ route('property.details',$item->slug) }}" class="wsus__list_item_img">
                                                <img src="{{ $item->thumbnail_image }}" alt="property" class="img-fluid w-100">
                                                @if ($item->property_purpose_id==1)
                                                <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                @elseif($item->property_purpose_id==2)
                                                <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                @endif

                                                @if ($item->urgent_property==1)
                                                    <span class="urgent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                                @endif
                                                {{-- <span class="overlay"></span> --}}
                                            </a>
                                            <div class="wsus__list_item_text">
                                                <p><b>{{ $item->propertyType->type }}</b>
                                                        @if ($item->property_purpose_id==1)
                                                            <span>{{ $currency->currency_icon }}{{ $item->price }}</span>
                                                        @elseif ($item->property_purpose_id==2)
                                                        <span>{{ $currency->currency_icon }}{{ $item->price }}/
                                                            @if ($item->period=='Daily')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</small>
                                                            @elseif ($item->period=='Monthly')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</small>
                                                            @elseif ($item->period=='Yearly')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</small>
                                                            @endif
                                                        </span>
                                                        @endif

                                                </p>
                                                <a href="{{ route('property.details',$item->slug) }}"><h4>{{ $item->title }}</h4></a>
                                                <ul>
                                                    <li><i class="fal fa-bed"></i> {{ $item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-shower"></i> {{ $item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-draw-square"></i> {{ $item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                                </ul>
                                                <div class="wsus__rating_n_btn">
                                                    @php
                                                        $total_review=$item->reviews->where('status',1)->count();
                                                        if($total_review > 0){
                                                            $avg_sum=$item->reviews->where('status',1)->sum('avarage_rating');

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
                                                    <p>
                                                        <span>{{ sprintf("%.1f", $reviewPoint) }}</span>
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
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>0.0</span>
                                                        @for ($i = 1; $i <=5; $i++)
                                                            <i class="fal fa-star"></i>
                                                        @endfor
                                                    </p>
                                                    @endif
                                                    <a class="common_btn" href="{{ route('property.details',$item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @elseif($page_type=='grid_view')
                                @foreach ($properties as $item)
                                    @if ($item->expired_date==null)
                                        <div class="col-xl-6 col-lg-6 ">
                                            <div class="wsus__single_property">
                                                <a class="wsus__single_pro_img" href="{{ route('property.details',$item->slug) }}">
                                                    <img src="{{ $item->thumbnail_image }}" alt="property" class="img-fluid w-100">
                                                    @if ($item->property_purpose_id==1)
                                                    <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                    @elseif($item->property_purpose_id==2)
                                                    <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                    @endif

                                                    @if ($item->urgent_property==1)
                                                        <span class="urgent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                                    @endif
                                                    {{-- <span class="overlay"></span> --}}
                                                </a>
                                                <div class="wsus__single_pro_text">

                                                    @php
                                                        $total_review=$item->reviews->where('status',1)->count();
                                                        if($total_review > 0){
                                                            $avg_sum=$item->reviews->where('status',1)->sum('avarage_rating');

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

                                                    <p>{{ $item->propertyType->type }}
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

                                                    <a href="{{ route('property.details',$item->slug) }}"><h4>{{ $item->title }}</h4></a>


                                                    <ul>
                                                        <li><i class="fal fa-bed"></i> {{ $item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                                        <li><i class="fal fa-shower"></i> {{ $item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                                        <li><i class="fal fa-draw-square"></i> {{ $item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                                    </ul>
                                                    <div class="wsus__single_pro_bottom">

                                                        @if ($item->property_purpose_id==1)
                                                            <span>{{ $currency->currency_icon }}{{ $item->price }}</span>
                                                        @elseif ($item->property_purpose_id==2)
                                                        <span>{{ $currency->currency_icon }}{{ $item->price }}/
                                                            @if ($item->period=='Daily')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</small>
                                                            @elseif ($item->period=='Monthly')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</small>
                                                            @elseif ($item->period=='Yearly')
                                                            <small class="property-period">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</small>
                                                            @endif

                                                        </span>
                                                        @endif
                                                        <a class="common_btn" href="{{ route('property.details',$item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($item->expired_date >= date('Y-m-d'))
                                    <div class="col-xl-6 col-lg-6 ">
                                        <div class="wsus__single_property">
                                            <a class="wsus__single_pro_img" href="{{ route('property.details',$item->slug) }}">
                                                <img src="{{ $item->thumbnail_image }}" alt="property" class="img-fluid w-100">
                                                @if ($item->property_purpose_id==1)
                                                <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                @elseif($item->property_purpose_id==2)
                                                <span class="mark">{{ $item->propertyPurpose->custom_purpose }}</span>
                                                @endif

                                                @if ($item->urgent_property==1)
                                                    <span class="urgent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                                @endif
                                                {{-- <span class="overlay"></span> --}}
                                            </a>
                                            <div class="wsus__single_pro_text">
                                                @php
                                                    $total_review=$item->reviews->where('status',1)->count();
                                                    if($total_review > 0){
                                                        $avg_sum=$item->reviews->where('status',1)->sum('avarage_rating');

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

                                                <p>{{ $item->propertyType->type }}
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

                                                <a href="{{ route('property.details',$item->slug) }}"><h4>{{ $item->title }}</h4></a>


                                                <ul>
                                                    <li><i class="fal fa-bed"></i> {{ $item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-shower"></i> {{ $item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-draw-square"></i> {{ $item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                                </ul>
                                                <div class="wsus__single_pro_bottom">

                                                    @if ($item->property_purpose_id==1)
                                                        <span>{{ $currency->currency_icon }}{{ $item->price }}</span>
                                                    @elseif ($item->property_purpose_id==2)
                                                    <span>{{ $currency->currency_icon }}{{ $item->price }}/

                                                        @if ($item->period=='Daily')
                                                        <small class="property-period">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</small>
                                                        @elseif ($item->period=='Monthly')
                                                        <small class="property-period">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</small>
                                                        @elseif ($item->period=='Yearly')
                                                        <small class="property-period">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</small>
                                                        @endif

                                                    </span>
                                                    @endif
                                                    <a class="common_btn" href="{{ route('property.details',$item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                            @if ($isActivePropertyQty > 0)
                                {{ $properties->links('user.paginator') }}
                            @endif

                        </div>
                        @else
                            <div class="row">
                                <div class="col">
                                    <h3 class="text-danger text-center">{{ $websiteLang->where('lang_key','property_not_found')->first()->custom_text }}</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
         PROPERTY LIST VIEW END
    ==============================-->


    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#sortingId").on("change",function(){
                var id=$(this).val();

                var isSortingId='<?php echo $isSortingId; ?>'
                var query_url='<?php echo $search_url; ?>';

                if(isSortingId==0){
                    var sorting_id="&sorting_id="+id;
                    query_url += sorting_id;
                }else{
                     var href = new URL(query_url);
                    href.searchParams.set('sorting_id', id);
                    query_url=href.toString()
                }

                window.location.href = query_url;
            })

        });

        })(jQuery);
    </script>


@endsection
