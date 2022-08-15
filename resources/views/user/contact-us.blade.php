
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
                            <h4>{{ $menus->where('id',8)->first()->navbar }}</h4>
                            <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>

                                    <li class="breadcrumb-item"><a>{{ $menus->where('id',8)->first()->navbar }}</a></li>
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
              CONTACT PART START
        ==============================-->
        <section id="wsus__contact">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-12">
                                <div class="wsus__contact_text">
                                    <i class="fal fa-user-alt"></i>
                                    <h4>{{ $websiteLang->where('lang_key','contact_support')->first()->custom_text }}</h4>
                                    {!! clean(nl2br($contact->phones)) !!}
                                    {!! clean(nl2br($contact->emails)) !!}
                                    {!! clean(nl2br($contact->address)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <form method="POST" action="{{ route('contact.message') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h4>{{ $websiteLang->where('lang_key','contact_us')->first()->custom_text }}</h4>
                                </div>
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__contact_form">
                                        <input type="text" placeholder="{{ $websiteLang->where('lang_key','name')->first()->custom_text }}*" name="name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__contact_form">
                                        <input type="email" placeholder="{{ $websiteLang->where('lang_key','email')->first()->custom_text }}*" name="email">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__contact_form">
                                        <input type="text" placeholder="{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}*" name="subject">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__contact_form">
                                        <input type="text" placeholder="{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}" name="phone">
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <div class="wsus__contact_form text-center">
                                        <textarea cols="2" rows="3" placeholder="{{ $websiteLang->where('lang_key','msg')->first()->custom_text }}*" name="message"></textarea>
                                    </div>
                                </div>

                                @if($contactSetting->allow_captcha==1)
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <div class="g-recaptcha" data-sitekey="{{ $contactSetting->captcha_key }}"></div>
                                    </div>
                                </div>

                                @endif

                            </div>

                            <button class="common_btn_2">{{ $websiteLang->where('lang_key','send_msg')->first()->custom_text }}</button>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="wsus__maps">
                            {!! $contact->map_embed_code !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--============================
              CONTACT PART END
        ==============================-->

    @endsection
