@php
    $setting=App\Setting::first();
    $websiteLang=App\ManageText::all();
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    @yield('title')
    <link rel="icon" type="image/png" href="{{ url($setting->favicon) }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/add_row.css') }}">

    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/dev.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">

    @if ($setting->text_direction=="RTL")
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/RTL.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-bs4.css') }}">


    <link rel="stylesheet" href="{{ asset('backend/iconpicker/fontawesome-iconpicker.min.css') }}">


    <!--jquery library js-->
    <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('backend/summernote/summernote-bs4.js') }}"></script>



    <style>
            .fade.in {
                opacity: 1 !important;
            }

            /* black color */

            header,
            .wsus__main_menu,
            .wp_search_area button,
            .common_btn,
            .wsus__single_agents ul,
            .common_btn_2::after,
            .wsus__about_text button,
            #wsus__awards,
            #wsus__checkout ul li button,
            .wsus__property_sidebar h3,
            .wsus__agent_prolile_sidebar h5,
            .wsus__dashboard_side_bar,
            .wsus__my_property table th,
            .wsus__dashboard_logo
            {
                background: {{ $setting->theme_three }} !important;
            }


            .wsus__property_topbar_left ul li a{
                color: {{ $setting->theme_three }} !important;
            }



            /* green color */
            .navbar-nav li:hover>a, .navbar-nav li a.active,
            .wsus__small_heading,
            .wsus__about_icon i,
            .wsus__single_pro_text p,
            .wsus__single_pro_bottom span,
            .wsus__single_service i,
            .wsus__blog_footer a,
            .wsus__blog_top_row span,
            .wsus__single_clients p i,
            .wsus__single_clients .c_det,
            .wsus__short_link li a:hover,
            .wsus__footer_address i,
            .wsus__social_link li a,
            .breadcrumb-item.active,
            .wsus__single_awards i,
            .wsus__single_awards span,
            .wsus__single_team:hover span,
            .wsus__single_team:hover p,
            .wsus__contact_text i,
            .wsus__blog_bar ul li a:hover,
            .wsus__blog_bar ul li a:hover span,
            .wsus__comm_text span,
            .wsus__single_pricing ul li::after,
            .wsus__list_item_text p b,
            .wsus__list_item_text p span,
            #wsus_pagination .page-link,
            .wsus__single_details .wsus__sale,
            .wsus__single_details .wsus__bold_text span,
            #wsus__accordian .accordion-body ul li::after,
            #wsus__checkout h4 i,
            .wsus__list_item_text p i,
            .wsus__total_rev p i,
            .wsus__sidebar_property .wsus_single_feature span
            {
                color: {{ $setting->theme_one }} !important;
            }



            .menu_icon li a:hover,
            .menu_icon li a.active_icon {
                background: #fff !important;
                color: {{ $setting->theme_one }} !important;
            }


            #wsus__property_details .slick-dots li.slick-active button {
                border-color: {{ $setting->theme_one }} !important;
            }


            #wsus_pagination .page-item.active .page-link {
                color: #fff !important;
                background-color: {{ $setting->theme_one }} !important;
                border-color: {{ $setting->theme_one }} !important;
            }



            #wsus_pagination .page-link:hover {
                color: #fff !important;
                background-color: {{ $setting->theme_one }} !important;
                border-color: {{ $setting->theme_one }} !important;
            }

            .wsus__blog_top_row span,
            .wsus__single_team:hover,
            .wsus__single_pricing .wsus_price_head,
            #wsus_pagination .page-link
            {
                border: 1px solid {{ $setting->theme_one }} !important;
            }

            .wsus__blog_footer a,
            .wsus__footer_text h5{
                border-bottom: 1px solid {{ $setting->theme_one }} !important;
            }

            .wsus__single_service i,
            .wsus__social_link li a{
                border: 1px solid {{ $setting->theme_one }} !important;
            }

            .wsus__about_single {
                border-left: 5px solid {{ $setting->theme_one }} !important;
            }

            .navbar-nav li a::before,
            .navbar-nav li a::after,
            .menu_icon>li>a,
            .common_btn::after,
            .wsus__single_property .mark,
            .common_btn_2,
            .wsus__single_service::before,
            .wsus__single_service::after,
            .wsus__blog_img p span,
            .wsus__social_link li a:hover,
            .wsus__scroll_btn,
            .wsus__about_text .nav-pills .nav-link:hover,
            .wsus__about_text .nav-pills .nav-link.active,
            .wsus__single_pricing .wsus_price_head,
            #wsus__property_details .slick-dots li.slick-active button::after,
            .wsus__agent_area,
            .wsus__agent_properties h6,
            #wsus__checkout .nav-pills .nav-link.active,
            #wsus__checkout .nav-pills .nav-link:hover

            {
                background: {{ $setting->theme_one }} !important;
            }

            .wsus__agent_img img{
                border: 4px solid {{ $setting->theme_one }} !important;
            }
            .wsus__single_pricing:hover .wsus_price_head {
                color: white !important;
                background: {{ $setting->theme_three }} !important;
            }

            .wsus__single_service:hover::after,
            .wsus__single_service:hover::before {
                background: {{ $setting->theme_three }} !important;
            }
            .wsus__single_service:hover i {
                background: {{ $setting->theme_three }} !important;
                border-color: {{ $setting->theme_three }} !important;
                color: #fff !important;
            }
            .wsus__blog_footer a:hover {
            color: {{ $setting->theme_three }} !important;
            border-color: {{ $setting->theme_three }} !important;
            }

            .wsus__social_link li a:hover {
                background: {{ $setting->theme_one }} !important;
                color: #fff !important;
            }


            .wsus__header_text a i,
            .wsus__header_text a:hover{
                color: {{ $setting->theme_one }} !important;
            }

            .wsus__header_icon li a{
                border: 2px solid {{ $setting->theme_one }} !important;
            }

            .wsus__header_icon a:hover {
                background: {{ $setting->theme_one }} !important;
                border-color: {{ $setting->theme_one }} !important;
            }




            /* blue color */

            .wsus__banner_text .nav-link,
            .wsus__single_property .urgent{
                background: {{ $setting->theme_two }} !important;
            }
            .wsus__banner_text .nav-pills .nav-link:hover,
            .wsus__banner_text .nav-pills .nav-link.active{
                color:  {{ $setting->theme_two }} !important;
                background: #fff !important;
            }

            .wsus__property_topbar_left ul li a.wsus_active_bar,
            .wsus__rating_right h2,
            .wsus__main_agent_address a:hover{
                color:  {{ $setting->theme_two }} !important;
            }


            .form-check-input:checked {
                background-color: {{ $setting->theme_two }} !important;
                border-color: {{ $setting->theme_two }} !important;
            }

            .agent_profile_link li a:hover {
                background: {{ $setting->theme_two }} !important;
                color: #fff;
            }


    </style>

</head>

<body>

    @php
        $user=Auth::guard('web')->user();
        $default_image=App\BannerImage::find(15);
    @endphp
    <!--============================
         DASHBOARD PAGE START
    ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            <span class="wsus__menu_icon"><i class="fas fa-bars"></i></span>
            <div class="wsus__dashboard_side_bar">
                <span class="wsus__close_icon"><i class="fas fa-times"></i></span>
                <a class="wsus__dashboard_logo" href="{{ route('home') }}"><img src="{{ url($setting->logo) }}" alt=""></a>
                <div class="wsus__agent_img">
                    <img src="{{ $user->image ? url($user->image) : url($default_image->image) }}" alt="agent" class="img-fluid">
                    <h5>{{ $user->name }}</h5>
                </div>
                <ul class="wsus__deshboard_menu">
                    <li><a class="{{ Route::is('user.dashboard') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.dashboard') }}"><i class="fal fa-fw fa-tachometer-alt"></i> {{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.my.properties') || Route::is('user.property.edit') || Route::is('user.create.property') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.my.properties') }}"><i class="far fa-list"></i> {{ $websiteLang->where('lang_key','my_property')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.my-profile') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.my-profile') }}"><i class="fas fa-user-tie"></i> {{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</a></li>

                    <li><a  class="{{ Route::is('user.my-order') || Route::is('user.order.details') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.my-order') }}"><i class="far fa-list"></i> {{ $websiteLang->where('lang_key','order')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.my-wishlist') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.my-wishlist') }}"><i class="fas fa-heart"></i> {{ $websiteLang->where('lang_key','wishlist')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.pricing.plan') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.pricing.plan') }}"><i class="fas fa-box-full"></i> {{ $websiteLang->where('lang_key','pricing_plan')->first()->custom_text }}</a></li>



                    <li><a class="{{ Route::is('user.my-review') || Route::is('user.edit-review') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.my-review') }}"><i class="fas fa-star"></i> {{ $websiteLang->where('lang_key','my_review')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.client-review') ? 'wsus__dboard_active' : '' }}" href="{{ route('user.client-review') }}"><i class="fas fa-star"></i> {{ $websiteLang->where('lang_key','client_review')->first()->custom_text }}</a></li>

                    <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> {{ $websiteLang->where('lang_key','logout')->first()->custom_text }}</a></li>


                </ul>
            </div>
