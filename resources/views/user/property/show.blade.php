@extends('layouts.user.layout')
@section('title')
    <title>{{ $property->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $property->seo_description }}">
@endsection
@section('user-content')
    <!--============================
          BREADCRUMB PART START
    ==============================-->
    <section id="wsus__breadcrumb" style="background-image:url({{ url($property->banner_image) }})">
        <div class="wsus_bread_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ $menus->where('id',2)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('properties',['page_type' => 'list_view']) }}">{{ $menus->where('id',2)->first()->navbar }}</a></li>

                                <li class="breadcrumb-item"><a>{{ $property->title }}</a></li>

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
        PROPERTY DETAILS PAGE START
    ==============================-->
    <section id="wsus__property_details">
        <div class="container">
            <div class="row pro_details_slider">
                @foreach ($property->propertyImages as $imag_item)
                    <div class="col-12">
                        <div class="wsus_property_img">
                            <img src="{{ url($imag_item->image) }}" alt="property" class="img-fluid w-100">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="wsus__pro_left_det">
                            <div class="wsus__single_details">
                                <span class="wsus__sale">{{ $property->propertyPurpose->custom_purpose }}</span>
                                @if ($property->urgent_property==1)
                                <span class="wsus__sale">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                @endif

                                <h3>{{ $property->title }}</h3>
                                <p><i class="fal fa-map-marker-alt"></i> {{ $property->address.', '. $property->city->name.', '.$property->city->countryState->name.', '.$property->city->countryState->country->name }}</p>
                                @if ($property->property_purpose_id==1)
                                <p class="wsus__bold_text"><span>{{ $currency->currency_icon }}{{ $property->price }}</span></p>
                                @elseif($property->property_purpose_id==2)
                                <p class="wsus__bold_text"><span>{{ $currency->currency_icon }}{{ $property->price }}</span> /
                                    @if ($property->period=='Daily')
                                    {{ $websiteLang->where('lang_key','daily')->first()->custom_text }}
                                    @elseif ($property->period=='Monthly')
                                    {{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}
                                    @elseif ($property->period=='Yearly')
                                    {{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}
                                    @endif
                                </p>
                                @endif

                                <ul>
                                    <li><i class="fal fa-bed"></i> {{ $property->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                    <li><i class="fal fa-shower"></i> {{ $property->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                    <li><i class="fal fa-draw-square"></i> {{ $property->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                </ul>
                                <div class="wsus__pro_track_area">
                                    <ul>
                                        @if ($property->is_featured==1)
                                        <li><a href="javascript:;"><i class="fas fa-check"></i> {{ $websiteLang->where('lang_key','featured')->first()->custom_text }}</a></li>
                                        @endif


                                        <li><a href="javascript:;"><i class="fas fa-eye"></i> {{ $property->views }}</a></li>
                                        <li><a href="#comment"><i class="fas fa-comment-dots"></i> {{ $websiteLang->where('lang_key','add_review')->first()->custom_text }}</a></li>

                                    </ul>
                                    <a class="common_btn_2" href="{{ route('user.add.to.wishlist',$property->id) }}"><i class="fas fa-heart"></i> {{ $websiteLang->where('lang_key','add_wishlist')->first()->custom_text }}</a>
                                </div>
                            </div>
                            <div class="wsus__single_column">
                                <h6>{{ $websiteLang->where('lang_key','detail_and_feature')->first()->custom_text }}</h6>
                                <div class="wsus__single_div">
                                    <p><span>{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}:</span> {{ $property->propertyType->type }}</p>
                                    <p><span>Areas:</span> {{ $property->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</p>
                                    <p><span>{{ $websiteLang->where('lang_key','bedrooms')->first()->custom_text }}:</span> {{ $property->number_of_bedroom }}</p>
                                    <p><span>{{ $websiteLang->where('lang_key','bathrooms')->first()->custom_text }}:</span> {{  $property->number_of_bathroom  }}</p>
                                    <p><span>{{ $websiteLang->where('lang_key','rooms')->first()->custom_text }}:</span> {{ $property->number_of_room }}</p>

                                </div>
                                <div class="wsus__single_div">
                                    <p><span>{{ $websiteLang->where('lang_key','units')->first()->custom_text }}:</span> {{ $property->number_of_unit }}</p>
                                    <p><span>{{ $websiteLang->where('lang_key','floors')->first()->custom_text }}:</span> {{ $property->number_of_floor }}</p>
                                    <p><span>{{ $websiteLang->where('lang_key','kitchens')->first()->custom_text }}:</span> {{ $property->number_of_kitchen }}</p>
                                    <p><span>{{ $websiteLang->where('lang_key','parking_place_s')->first()->custom_text }}:</span> {{ $property->number_of_parking }}</p>
                                </div>
                            </div>
                            <div id="wsus__accordian">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            {{ $websiteLang->where('lang_key','des')->first()->custom_text }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                           {!! clean($property->description) !!}
                                            @if ($property->file)
                                            <a class="common_btn_2 mt-3" href="{{ route('download-listing-file',$property->file) }}">{{ $websiteLang->where('lang_key','download_pdf')->first()->custom_text }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($property->video_link)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            {{ $websiteLang->where('lang_key','property_video')->first()->custom_text }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="wsus__video">
                                                <div class="wsus__single_video">
                                                    @php
                                                        $video_id=explode("=",$property->video_link);
                                                    @endphp
                                                    <img width="100%" src="https://img.youtube.com/vi/{{ $video_id[1] }}/0.jpg" alt="about_video" class="img-fluid">
                                                    <a class="venobox" data-autoplay="true" data-vbtype="video" href="{{ $property->video_link }}"><i class=" fas fa-play"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($property->propertyAminities->count() !=0)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            {{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            @foreach ($property->propertyAminities as $aminity_item)
                                            <ul>
                                                <li>{{ $aminity_item->aminity->aminity }}</li>
                                            </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if ($property->propertyNearestLocations->count() !=0)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">
                                                {{ $websiteLang->where('lang_key','nearest_place')->first()->custom_text }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                @foreach ($property->propertyNearestLocations as $item)
                                                <div class="wsus__single_div">
                                                    <p><span>{{ $item->nearestLocation->location }}:</span> {{ $item->distance }}{{ $websiteLang->where('lang_key','km')->first()->custom_text }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            </div>
                            @if ($property->google_map_embed_code)
                                <div class="wsus__single_column">
                                    <div class="wsus__property_mape_single">
                                        {!! $property->google_map_embed_code !!}
                                    </div>
                                </div>
                            @endif


                            @php
                                $total_review=$property->reviews->where('status',1)->count();
                                if($total_review>0){
                                    $avg_sum=$property->reviews->where('status',1)->sum('avarage_rating');

                                    $service_sum=$property->reviews->where('status',1)->sum('service_rating');
                                    $service_avg=$service_sum/$total_review;
                                    $service_progress= ($service_avg*100)/5;

                                    $location_sum=$property->reviews->where('status',1)->sum('location_rating');
                                    $location_avg=$location_sum/$total_review;
                                    $location_progress= ($location_avg*100)/5;

                                    $money_sum=$property->reviews->where('status',1)->sum('money_rating');
                                    $money_avg=$money_sum/$total_review;
                                    $money_progress= ($money_avg*100)/5;


                                    $clean_sum=$property->reviews->where('status',1)->sum('clean_rating');
                                    $clean_avg=$clean_sum/$total_review;
                                    $clean_progress= ($clean_avg*100)/5;



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

                            @if ($total_review >0 )
                            <div class="wsus__single_column">


                                <div class="wsus__total_rev">
                                    <h4>{{ sprintf("%.1f", $reviewPoint) }}</h4>
                                    <span>{{ $websiteLang->where('lang_key','out_of_5')->first()->custom_text }}</span>
                                    <p>

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
                                </div>
                                <div class="wsus__single_pro_bar">
                                    <p>{{ $websiteLang->where('lang_key','service_rat')->first()->custom_text }} <span>{{ sprintf("%.1f", $service_avg) }}</span></span></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $service_progress }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>{{ $websiteLang->where('lang_key','location')->first()->custom_text }} <span>{{ sprintf("%.1f", $location_avg) }}</span></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $location_progress }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="wsus__single_pro_bar">
                                    <p>{{ $websiteLang->where('lang_key','value_for_money')->first()->custom_text }}  <span>{{ sprintf("%.1f", $money_avg) }}</span></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $money_progress }}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>{{ $websiteLang->where('lang_key','clean_rat')->first()->custom_text }}  <span>{{ sprintf("%.1f", $clean_avg) }}</span></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $clean_progress }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="wsus__pro_det_rev">
                            <div class="wsus__blog_comment_area" id="comment">
                                @if ($total_review > 0)
                                <h3>{{ $total_review }} {{ $websiteLang->where('lang_key','review')->first()->custom_text }}</h3>

                                    @foreach ($property->reviews->where('status',1) as $review_item)
                                        <div class="wsus__blog_1st_comment">
                                            <div class="wsus__comm_img">
                                                <img src="{{ $review_item->user->image ? url($review_item->user->image) : url($default_image->image) }}" alt="comment person" class="img-fluid">
                                            </div>
                                            <div class="wsus__comm_text">


                                                @php
                                                    $avg=$review_item->avarage_rating;
                                                    $intAvg=intval($avg);
                                                    $nextVal=$intAvg+1;
                                                    $reviewPoint=$intAvg;
                                                    $halfReview=false;
                                                    if($intAvg < $avg && $avg < $nextVal){
                                                        $reviewPoint= $intAvg + 0.5;
                                                        $halfReview=true;
                                                    }
                                                @endphp

                                                <p class="rev_display">
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


                                                <h5>{{ $review_item->user->name }}</h5>
                                                <span>{{ $review_item->created_at->format('d M Y') }}</span>
                                                <p>{{ $review_item->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                @endif


                                <div class="wsus__rite_comment">
                                    <form action="{{ route('user.store-review') }}" method="POST">
                                        @csrf
                                        <h3>{{ $websiteLang->where('lang_key','write_review')->first()->custom_text }}</h3>
                                        <div class="wsus__select_rating">
                                          <div class="wsus__rating_left">
                                           <div class="wsus__single_review">
                                               <span>{{ $websiteLang->where('lang_key','service')->first()->custom_text }}</span>
                                               <i class="service_rat fas fa-star" data-service_rating="1" onclick="serviceReview(1)"></i>
                                               <i class="service_rat fas fa-star" data-service_rating="2" onclick="serviceReview(2)"></i>
                                               <i class="service_rat fas fa-star" data-service_rating="3" onclick="serviceReview(3)"></i>
                                               <i class="service_rat fas fa-star" data-service_rating="4" onclick="serviceReview(4)"></i>
                                               <i class="service_rat fas fa-star" data-service_rating="5" onclick="serviceReview(5)"></i>
                                           </div>
                                           <div class="wsus__single_review blue">
                                               <span>{{ $websiteLang->where('lang_key','location')->first()->custom_text }}</span>
                                               <i class="location_rat fas fa-star" data-location_rating="1" onclick="locationReview(1)"></i>
                                               <i class="location_rat fas fa-star" data-location_rating="2" onclick="locationReview(2)"></i>
                                               <i class="location_rat fas fa-star" data-location_rating="3" onclick="locationReview(3)"></i>
                                               <i class="location_rat fas fa-star" data-location_rating="4" onclick="locationReview(4)"></i>
                                               <i class="location_rat fas fa-star" data-location_rating="5" onclick="locationReview(5)"></i>
                                           </div>
                                           <div class="wsus__single_review orange">
                                               <span>{{ $websiteLang->where('lang_key','value_for_money')->first()->custom_text }}</span>
                                               <i class="money_rat fas fa-star" data-money_rating="1" onclick="moneyReview(1)"></i>
                                               <i class="money_rat fas fa-star" data-money_rating="2" onclick="moneyReview(2)"></i>
                                               <i class="money_rat fas fa-star" data-money_rating="3" onclick="moneyReview(3)"></i>
                                               <i class="money_rat fas fa-star" data-money_rating="4" onclick="moneyReview(4)"></i>
                                               <i class="money_rat fas fa-star" data-money_rating="5" onclick="moneyReview(5)"></i>
                                           </div>
                                           <div class="wsus__single_review red">
                                               <span>{{ $websiteLang->where('lang_key','clean_rat')->first()->custom_text }} </span>
                                               <i class="clean_rat fas fa-star" data-clean_rating="1" onclick="cleanReview(1)"></i>
                                               <i class="clean_rat fas fa-star" data-clean_rating="2" onclick="cleanReview(2)"></i>
                                               <i class="clean_rat fas fa-star" data-clean_rating="3" onclick="cleanReview(3)"></i>
                                               <i class="clean_rat fas fa-star" data-clean_rating="4" onclick="cleanReview(4)"></i>
                                               <i class="clean_rat fas fa-star" data-clean_rating="5" onclick="cleanReview(5)"></i>
                                           </div>
                                           </div>
                                           <div class="wsus__rating_right">
                                               <h2 id="avg_rating">5</h2>
                                               <p>{{ $websiteLang->where('lang_key','avg_rat')->first()->custom_text }}</p>
                                           </div>
                                        </div>
                                        <input type="hidden" name="service_rating" id="service_rating" value="5">
                                        <input type="hidden" name="location_rating" id="location_rating" value="5">
                                        <input type="hidden" name="money_rating" id="money_rating" value="5">
                                        <input type="hidden" name="clean_rating" id="clean_rating" value="5">
                                        <input type="hidden" name="avarage_rating" id="avarage_rating" value="5">
                                        <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
                                        <textarea cols="2" rows="3" placeholder="{{ $websiteLang->where('lang_key','comment')->first()->custom_text }}" name="comment"></textarea>
                                        @if($setting->allow_captcha==1)
                                        <p class="g-recaptcha mb-3" data-sitekey="{{ $setting->captcha_key }}"></p>
                                        @endif
                                        @auth
                                            @php
                                                $activeUser=Auth::guard('web')->user();
                                            @endphp
                                            @if ($activeUser->id !=$property->user_id)
                                            <button class="common_btn_2" type="submit">{{ $websiteLang->where('lang_key','submit')->first()->custom_text }}</button>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="text-danger">{{ $websiteLang->where('lang_key','before_review')->first()->custom_text }}</a>
                                        @endauth


                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-10 offset-md-1 offset-lg-0">
                        <div class="wsus__pro_right_det">
                            <div class="wsus__right_sin_det">
                                @if ($property->user_type==1)
                                    <div class="wsus__agent_area">
                                        <div class="wsus__agent_img">
                                            <img src="{{ $property->admin->image ? url($property->admin->image) :  url($default_image->image) }}" alt="agent images" class="img-fluid">
                                        </div>
                                        <div class="wsus__agent_text">
                                            <h5><a href="{{ route('agent.show',['user_type' => '1','user_name'=>$property->admin->slug]) }}">{{ $property->admin->name }}</a></h5>
                                            <a href="javascript:;"><i class="fas fa-envelope"></i> {{ $property->admin->email }}</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="wsus__agent_area">
                                        <div class="wsus__agent_img">
                                            <img src="{{ $property->user->image ? url($property->user->image) : url($default_image->image) }}" alt="agent images" class="img-fluid">
                                        </div>
                                        <div class="wsus__agent_text">
                                            <h5><a href="{{ route('agent.show',['user_type' => '2','user_name'=>$property->user->slug]) }}">{{ $property->user->name }}</a></h5>
                                            <a href="javascript:;"><i class="fas fa-envelope"></i> {{ $property->user->email }}</a>
                                        </div>
                                    </div>
                                @endif

                                <form id="listingAuthContactForm" class="wsus__agent_form">
                                    @csrf
                                    <label>{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                                    <input type="text" name="name">
                                    <label>{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</label>
                                    <input type="email" name="email">
                                    <label>{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                                    <input type="text" name="phone">
                                    <label>{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}</label>
                                    <input type="text" name="subject">
                                    <label>{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea cols="3" rows="5" name="message"></textarea>
                                    <input type="hidden" name="user_type" value="{{ $property->user_type }}">
                                    @if ($property->user_type==1)
                                    <input type="hidden" name="admin_id" value="{{ $property->admin_id }}">
                                    @else
                                    <input type="hidden" name="user_id" value="{{ $property->user_id }}">
                                    @endif
                                    @if($setting->allow_captcha==1)
                                        <div class="form-group mb-3">
                                            <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                                        </div>

                                    @endif

                                    <button class="common_btn" type="submit" id="listingAuthorContctBtn"><i id="listcontact-spinner" class="loading-icon fa fa-spin fa-spinner d-none"></i> {{ $websiteLang->where('lang_key','send_msg')->first()->custom_text }}</button>
                                </form>
                            </div>


                            @php
                                $isActivePropertyQty=0;
                                foreach ($similarProperties as $value) {
                                    if($value->expired_date==null){
                                        $isActivePropertyQty +=1;
                                    }else if($value->expired_date >= date('Y-m-d')){
                                        $isActivePropertyQty +=1;
                                    }
                                }
                            @endphp
                            @if ($isActivePropertyQty !=0)
                                <div class="wsus__sidebar_property">
                                    <div class="wsus__sidebar_center">
                                        <h3>{{ $websiteLang->where('lang_key','related_pro')->first()->custom_text }}</h3>
                                        @foreach ($similarProperties as $similar_item)
                                        @if ($similar_item->expired_date==null)
                                        <a href="{{ route('property.details',$similar_item->slug) }}">
                                            <div class="wsus_single_feature">
                                                <img src="{{ url($similar_item->thumbnail_image) }}" alt="property" class="img-fluid">
                                                <h4>{{ $similar_item->title }}</h4>
                                                <p>{{ $similar_item->address.', '.$similar_item->city->name }}</p>
                                                <span>{{ $currency->currency_icon. $similar_item->price }}</span>
                                            </div>
                                        </a>
                                        @elseif($similar_item->expired_date >= date('Y-m-d'))
                                            <a href="{{ route('property.details',$similar_item->slug) }}">
                                                <div class="wsus_single_feature">
                                                    <img src="{{ url($similar_item->thumbnail_image) }}" alt="property" class="img-fluid">
                                                    <h4>{{ $similar_item->title }}</h4>
                                                    <p>{{ $similar_item->address.', '.$similar_item->city->name }}</p>
                                                    <span>{{ $currency->currency_icon. $similar_item->price }}</span>
                                                </div>
                                            </a>
                                        @endif

                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--============================
        PROPERTY DETAILS PAGE END
    ==============================-->


    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#listingAuthorContctBtn").on('click',function(e) {
                e.preventDefault();
                // project demo mode check
                var isDemo="{{ env('PROJECT_MODE') }}"
                var demoNotify="{{ env('NOTIFY_TEXT') }}"
                if(isDemo==0){
                    toastr.error(demoNotify);
                    return;
                }
                // end

                $("#listcontact-spinner").removeClass('d-none')
                $("#listingAuthorContctBtn").addClass('custom-opacity')
                $("#listingAuthorContctBtn").attr('disabled',true);
                $("#listingAuthorContctBtn").removeClass('site-btn-effect')

                $.ajax({
                    url: "{{ route('user.contact.message') }}",
                    type:"post",
                    data:$('#listingAuthContactForm').serialize(),
                    success:function(response){
                        if(response.success){
                            $("#listingAuthContactForm").trigger("reset");
                            toastr.success(response.success)
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }
                        if(response.error){
                            toastr.error(response.error)
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')

                        }
                    },
                    error:function(response){
                        if(response.responseJSON.errors.name){
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')

                            toastr.error(response.responseJSON.errors.name[0])

                        }

                        if(response.responseJSON.errors.email){
                            toastr.error(response.responseJSON.errors.email[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')

                        }

                        if(response.responseJSON.errors.phone){
                            toastr.error(response.responseJSON.errors.phone[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }

                        if(response.responseJSON.errors.subject){
                            toastr.error(response.responseJSON.errors.subject[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }

                        if(response.responseJSON.errors.message){
                            toastr.error(response.responseJSON.errors.message[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }else{
                            toastr.error('Please Complete the recaptcha to submit the form')
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }

                        if(response.responseJSON.errors.g-recaptcha){
                            toastr.error('Please Complete the recaptcha to submit the form')
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }


                    }

                });


            })
        });

        })(jQuery);


        function serviceReview(rating){

            $("#service_rating").val(rating);
            $(".service_rat").each(function(){
                var service_rat=$(this).data('service_rating')
                if(service_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }
            })

            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)
        }

        function locationReview(rating){

            $("#location_rating").val(rating);
            $(".location_rat").each(function(){
                var location_rat=$(this).data('location_rating')
                if(location_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }

            })


            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)

        }

        function moneyReview(rating){
            $("#money_rating").val(rating);
            $(".money_rat").each(function(){
                var money_rat=$(this).data('money_rating')
                if(money_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }

            })

            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)

        }

        function cleanReview(rating){

            $("#clean_rating").val(rating);
            $(".clean_rat").each(function(){
                var clean_rat=$(this).data('clean_rating')
                if(clean_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }

            })
            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)
        }




    </script>
@endsection
