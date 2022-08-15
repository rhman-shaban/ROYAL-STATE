@include('layouts.staff.header')
<body id="page-top" class="body_bg">
    @php
        $websiteLang=App\ManageText::all();
        $app_setting=App\Setting::first();
    @endphp

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="{{ $app_setting->dashbaord_header_icon }}"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ $app_setting->dashboard_header }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

             <!-- Nav Item - Dashboard -->
             <li class="nav-item {{ Route::is('staff.dashboard')?'active':'' }}">
                <a class="nav-link" href="{{ route('staff.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</span></a>
            </li>

            <li class="nav-item {{ Route::is('staff.property.*')?'active':'' }}">
                <a class="nav-link" href="{{ route('staff.property.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php
                                    $adminInfo=Auth::guard('staff')->user();
                                    $default_profile=App\BannerImage::find(15);
                                @endphp
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ ucfirst($adminInfo->name) }}</span>

                                <img class="img-profile rounded-circle"
                                    src="{{ $adminInfo->image ? asset($adminInfo->image) : asset($default_profile->image) }}">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('staff.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('staff.logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ $websiteLang->where('lang_key','logout')->first()->custom_text }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                   @yield('staff-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@include('layouts.staff.footer')
