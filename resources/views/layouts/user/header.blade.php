@php
    $topbar_contact=App\ContactUs::first();
    $setting=App\Setting::first();
    $customPages=App\CustomPage::all();
    $navigations=App\Navigation::all();
    $websiteLang=App\ManageText::all();
@endphp


<!DOCTYPE html>
<html lang="en">
<head>

    @yield('title')
    @yield('meta')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

    <link rel="icon" type="image/png" href="{{ url($setting->favicon) }}">
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <!--jquery library js-->
    <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    @if ($setting->google_analytic==1)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->google_analytic_code }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $setting->google_analytic_code }}');
    </script>
    @endif


    <style>

        /* Color: One */
        .wsus__main_menu,
        .wsus__single_top_text,
        .wsus__single_property .overlay,
        .wsus_bread_overlay,
        .wsus__list_item_img .overlay {
            background: {{ $setting->theme_three."80" }} !important;
        }

        .wsus__banner_overlay {
            background: {{ $setting->theme_three."70" }} !important;
        }

        .wsus__footer_overlay {
            background: {{ $setting->theme_three."150" }} !important;
        }

        header,
        .wp_search_area button,
        .common_btn,
        .wsus__single_agents ul,
        .common_btn_2::after,
        .wsus__about_text button,
        #wsus__awards,
        #wsus__checkout ul li button,
        .wsus__property_sidebar h3,
        .wsus__agent_prolile_sidebar h5,
        .wsus_copywrite,
        .menu_fix {
            background: {{ $setting->theme_three }} !important;
        }

        .wsus__property_topbar_left ul li a {
            color: {{ $setting->theme_three }} !important;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: {{ $setting->theme_one }} !important;
            color: white !important;
        }

        /* Color: Two */
        .wsus__about_single:hover {
            border-left: 5px solid transparent !important;
        }
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
        .wsus__sidebar_property .wsus_single_feature span,
        .wsus__map_icon {
            color: {{ $setting->theme_one }} !important;
        }
        .wsus__single_awards{
            background: {{ $setting->theme_one }} !important;
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
        #wsus__checkout .nav-pills .nav-link:hover,
        .wsus__banner_text .nav-link,
        .wsus__list_item_img .mark
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


        .wsus__agent_overlay,
        .testimonial_overlay{
            background: {{ $setting->theme_three."98" }} !important;
        }



        /* Color: Two */
        .wsus__single_property .urgent,
        .wsus__list_item_img .urgent
        {
            background: {{ $setting->theme_two }} !important;
        }
        .wsus__banner_text .nav-pills .nav-link:hover,
        .wsus__banner_text .nav-pills .nav-link.active{
            color:  {{ $setting->theme_one }} !important;
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


        .wsus__dropdown{
            border-top: 3px solid {{ $setting->theme_one }} !important;
        }


    </style>


<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

</head>

<body>

    <!--============================
          HEADER PART START
    ==============================-->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-7 col-xl-6 col-md-8">
                    <div class="wsus__header_text">
                        <a href="mailto:{{ $topbar_contact->topbar_phone }}"><i class="fal fa-envelope"></i>{{ $topbar_contact->topbar_email }}</a>
                        <a class="d-none d-md-block" href="callto:{{ $topbar_contact->topbar_phone }}"><i class="fal fa-phone-alt"></i>{{ $topbar_contact->topbar_phone }}</a>
                    </div>
                </div>
                <div class="col-5 col-xl-6 col-md-4">
                    <ul class="wsus__header_icon">
                        @if ($topbar_contact->facebook)
                            <li><a href="{{ $topbar_contact->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if ($topbar_contact->twitter)
                        <li><a href="{{ $topbar_contact->twitter }}"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if ($topbar_contact->linkedin)
                        <li><a href="{{ $topbar_contact->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                        @endif
                        @if ($topbar_contact->instagram)
                        <li><a href="{{ $topbar_contact->instagram }}"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if ($topbar_contact->youtube)
                        <li><a href="{{ $topbar_contact->youtube }}"><i class="fab fa-youtube"></i></a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!--============================
          HEADER PART END
    ==============================-->


    <!--============================
          MENU PART START
    ==============================-->
    <nav class="navbar navbar-expand-lg wsus__main_menu">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ url($setting->logo) }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    @php
                        $home_menu=$navigations->where('id',1)->first();
                    @endphp
                    @if ($home_menu->status==1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">{{ $home_menu->navbar }}</a>
                    </li>
                    @endif


                    @php
                        $about_menu=$navigations->where('id',4)->first();
                    @endphp
                    @if ($about_menu->status==1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about.us') ? 'active' : '' }}" href="{{ route('about.us') }}">{{ $about_menu->navbar }}</a>
                    </li>
                    @endif

                    @php
                        $property_menu=$navigations->where('id',2)->first();
                    @endphp
                    @if ($property_menu->status==1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('properties') || Route::is('agents') ? 'active' : '' }}" href="javascript:;">{{ $property_menu->navbar }} <i class="fas fa-sort-down custom_icon"></i></a>
                        <ul class="wsus__dropdown">
                            @php
                                $all_property_menu=$navigations->where('id',3)->first();
                            @endphp
                            @if ($all_property_menu->status==1)
                            <li><a href="{{ route('properties',['page_type' => 'list_view']) }}">{{ $all_property_menu->navbar }}</a></li>
                            @endif

                            @php
                                $featured_property_menu=$navigations->where('id',19)->first();
                            @endphp

                            @if ($featured_property_menu->status==1)
                            <li><a href="{{ route('properties',['page_type' => 'list_view','sorting_id'=>3]) }}">{{ $featured_property_menu->navbar }}</a></li>
                            @endif

                            @php
                                $top_property_menu=$navigations->where('id',20)->first();
                            @endphp
                            @if ($top_property_menu->status==1)
                            <li><a href="{{ route('properties',['page_type' => 'list_view','sorting_id'=>4]) }}">{{ $top_property_menu->navbar }}</a></li>
                            @endif

                            @php
                                $urgent_property_menu=$navigations->where('id',21)->first();
                            @endphp
                            @if ($urgent_property_menu->status==1)
                            <li><a href="{{ route('properties',['page_type' => 'list_view','sorting_id'=>6]) }}">{{ $urgent_property_menu->navbar }}</a></li>
                            @endif
                            @php
                                $agent_menu=$navigations->where('id',6)->first();
                            @endphp
                            @if ($agent_menu->status==1)
                            <li><a href="{{ route('agents') }}">{{ $agent_menu->navbar }}</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @php
                        $pricing_menu=$navigations->where('id',5)->first();
                    @endphp
                    @if ($pricing_menu->status==1)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('pricing.plan') ? 'active' : '' }}" href="{{ route('pricing.plan') }}">{{ $pricing_menu->navbar }}</a>
                        </li>
                    @endif


                    @php
                        $pages_menu=$navigations->where('id',18)->first();
                    @endphp
                    @if ($pages_menu->status==1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('faq') || Route::is('custom.page') ? 'active':'' }}" href="javascript:;">{{ $pages_menu->navbar }} <i class="fas fa-sort-down"></i></a>
                        <ul class="wsus__dropdown">

                            @php
                                $faq_menu=$navigations->where('id',17)->first();
                            @endphp
                            @if ($faq_menu->status==1)
                            <li><a href="{{ route('faq') }}">{{ $faq_menu->navbar }}</a></li>
                            @endif
                            @if ($customPages->count() !=0)
                                @foreach ($customPages as $custom_item)
                                    <li><a href="{{ route('custom.page',$custom_item->slug) }}">{{ $custom_item->page_name }}</a></li>
                                @endforeach
                            @endif


                        </ul>
                    </li>
                    @endif


                    @php
                        $blog_menu=$navigations->where('id',7)->first();
                    @endphp
                    @if ($blog_menu->status==1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('blog') || Route::is('blog.details') ? 'active' : '' }}" href="{{ route('blog') }}">{{ $blog_menu->navbar }}</a>
                    </li>
                    @endif

                    @php
                        $contact_menu=$navigations->where('id',8)->first();
                    @endphp
                    @if ($contact_menu->status==1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact-us')? 'active' : '' }}" href="{{ route('contact.us') }}">{{  $contact_menu->navbar }}</a>
                    </li>
                    @endif
                </ul>
                @php
                    $login_menu=$navigations->where('id',12)->first();
                @endphp
                @if ($login_menu->status==1)

                @auth
                    <ul class="menu_icon">
                        <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-user-circle"></i></a>
                        </li>
                    </ul>
                @else
                    <ul class="menu_icon">
                        <li><a href="{{ route('login') }}"><i class="fas fa-user-circle"></i></a>
                        </li>
                    </ul>
                @endauth

                @endif
            </div>
        </div>
    </nav>
    <!--============================
          MENU PART END
    ==============================-->

