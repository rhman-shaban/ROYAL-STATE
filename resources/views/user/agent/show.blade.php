@extends('layouts.user.layout')
@section('title')
    <title>{{ $user->name }}</title>
@endsection
@section('user-content')
    <!--============================
          BREADCRUMB PART START
    ==============================-->
    <section id="wsus__breadcrumb" style="background-image:url({{  $user->banner_image  ? url($user->banner_image):   url($banner_image->image) }})">
        <div class="wsus_bread_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ $user->name }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>


                                <li class="breadcrumb-item"><a>{{ $user->name }}</a></li>

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
        AGENT PROFILE START
    ==============================-->
    <section id="wsus__agent_prolile">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__main_agent">
                        <div class="row">
                            <div class="col-xl-5 col-lg-5">
                                <div class="wsus__main_agent_img">
                                    <img src="{{ $user->image ? url($user->image) : url($default_profile_image->image) }}" alt="agent img" class="img-fluid w-100">
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7">
                                <div class="wsus__main_agent_text">
                                    <h2>{{ $user->name }}</h2>
                                    <div class="agent_description">{!! clean($user->about) !!}</div>
                                    <div class="wsus__main_agent_address">
                                        @if ($user->phone)
                                        <a href="callto:{{ $user->phone }}"><i class="fal fa-phone-alt"></i> {{ $user->phone }}</a>
                                        @endif
                                        @if ($user->email)
                                        <a href="mailto:{{ $user->email }}"><i class="fal fa-envelope"></i> {{ $user->email }}</a>
                                        @endif


                                        @if ($user->website)
                                        <a href="{{ $user->website }}"><i class="fas fa-globe" aria-hidden="true"></i> {{ $user->website }}</a>
                                        @endif
                                        @if ($user->address)
                                        <p><i class="fal fa-map-marker-alt"></i> {{ $user->address }}</p>
                                        @endif

                                    </div>

                                    @if ($user_type==1)
                                    <ul class="agent_profile_link">
                                        @if ($user->facebook)
                                        <li><a href="{{ $user->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif

                                        @if ($user->twitter)
                                        <li><a href="{{ $user->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                        @endif

                                        @if ($user->linkedin)
                                        <li><a href="{{ $user->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                        @endif
                                        @if ($user->whatsapp)
                                        <li><a href="{{ $user->whatsapp }}"><i class="fab fa-whatsapp"></i></a></li>
                                        @endif
                                    </ul>

                                    @else

                                    <ul class="agent_profile_link">
                                        @if ($user->icon_one && $user->link_one)
                                        <li><a href="{{ $user->link_one }}"><i class="{{ $user->icon_one }}"></i></a></li>
                                        @endif

                                        @if ($user->icon_two && $user->link_two)
                                        <li><a href="{{ $user->link_two }}"><i class="{{ $user->icon_two }}"></i></a></li>
                                        @endif

                                        @if ($user->icon_three && $user->link_three)
                                        <li><a href="{{ $user->link_three }}"><i class="{{ $user->icon_three }}"></i></a></li>
                                        @endif

                                        @if ($user->icon_four && $user->link_four)
                                        <li><a href="{{ $user->link_four }}"><i class="{{ $user->icon_four }}"></i></a></li>
                                        @endif
                                    </ul>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wsus__agent_prolile_details">
                    <div class="row">


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

                        <div class="col-xl-12 col-sm-12">
                            <div class="wsus__agent_properties">
                                <h6>{{ $websiteLang->where('lang_key','properties')->first()->custom_text }}</h6>
                                @if ($isActivePropertyQty > 0)
                                <div class="row">
                                    @foreach ($properties as $item)
                                    @if ($item->expired_date==null)
                                        <div class="col-xl-4">
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

                                                    <span class="overlay"></span>
                                                </a>
                                                <div class="wsus__single_pro_text">
                                                    <p>{{ $item->propertyType->type }}

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
                                                    <h4>{{ $item->title }}</h4>
                                                    <ul>
                                                        <li><i class="fal fa-bed"></i> {{ $item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                                        <li><i class="fal fa-shower"></i> {{ $item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                                        <li><i class="fal fa-draw-square"></i> {{ $item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                                    </ul>
                                                    <div class="wsus__single_pro_bottom">
                                                        @if ($item->property_purpose_id==1)
                                                            <span>{{ $currency->currency_icon }}{{ $item->price }}</span>
                                                        @elseif ($item->property_purpose_id==2)
                                                        <span>{{ $currency->currency_icon }}{{ $item->price }}/<small class="property-period">{{ $item->period }}</small> </span>
                                                        @endif
                                                        <a class="common_btn" href="{{ route('property.details',$item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($item->expired_date >= date('Y-m-d'))

                                    <div class="col-xl-4">
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

                                                <span class="overlay"></span>
                                            </a>
                                            <div class="wsus__single_pro_text">
                                                <p>{{ $item->propertyType->type }}

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
                                                <h4>{{ $item->title }}</h4>
                                                <ul>
                                                    <li><i class="fal fa-bed"></i> {{ $item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-shower"></i> {{ $item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                                    <li><i class="fal fa-draw-square"></i> {{ $item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                                </ul>
                                                <div class="wsus__single_pro_bottom">
                                                    @if ($item->property_purpose_id==1)
                                                        <span>{{ $currency->currency_icon }}{{ $item->price }}</span>
                                                    @elseif ($item->property_purpose_id==2)
                                                    <span>{{ $currency->currency_icon }}{{ $item->price }}/<small class="property-period">{{ $item->period }}</small> </span>
                                                    @endif
                                                    <a class="common_btn" href="{{ route('property.details',$item->slug) }}">{{ $websiteLang->where('lang_key','view_detail')->first()->custom_text }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @else
                                    <h3 class="text-danger text-center mt-5">{{ $websiteLang->where('lang_key','property_not_found')->first()->custom_text }}</h3>
                                @endif
                                @if ($isActivePropertyQty > 0)
                                <div class="mt-3">
                                    {{ $properties->links('user.paginator') }}
                                </div>
                                @endif


                            </div>
                        </div>


                        <div class="col-xl-12 col-sm-12">
                            <div class="wsus__agent_prolile_sidebar">
                                <h5>{{ $websiteLang->where('lang_key','quick_contact')->first()->custom_text }}</h5>
                                <form class="enquiry_form" id="listingAuthContactForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6">
                                            <label>{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                                            <input type="text" name="name">
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <label>{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</label>
                                            <input type="email" name="email">
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <label>{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                                            <input type="text" name="phone">
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <label>{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}</label>
                                            <input type="text" name="subject">
                                        </div>

                                        <div class="col-xl-12">
                                            <label>{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                            <textarea cols="3" rows="5" name="message"></textarea>
                                            <input type="hidden" name="user_type" value="{{ $user_type }}">
                                            @if ($user_type==1)
                                            <input type="hidden" name="admin_id" value="{{ $user->id }}">
                                            @else
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            @endif
                                            @if($setting->allow_captcha==1)
                                            <div class="form-group mb-3">
                                                <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                                            </div>
                                            @endif
                                            <button class="common_btn" type="submit" id="listingAuthorContctBtn"><i id="listcontact-spinner" class="loading-icon fa fa-spin fa-spinner d-none"></i> {{ $websiteLang->where('lang_key','send_msg')->first()->custom_text }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        AGENT PROFILE END
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

                        if(response.responseJSON.errors.g-recaptcha-response){
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
    </script>

@endsection
