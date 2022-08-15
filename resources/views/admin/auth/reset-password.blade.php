@include('layouts.admin.header')
<body id="page-top" class="body_bg">
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg mt_100">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image:url({{ $image->image ? url($image->image) :'' }});"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ $websiteLang->where('lang_key','reset_pass')->first()->custom_text }}</h1>
                                </div>
                                <form class="user" action="{{ route('admin.store.reset.password',$token) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            value="{{ $admin->email }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="{{ $websiteLang->where('lang_key','pass')->first()->custom_text }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="{{ $websiteLang->where('lang_key','confirm_pass')->first()->custom_text }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ $websiteLang->where('lang_key','reset_pass')->first()->custom_text }}
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center">
                                    <a class="small" href="{{ route('admin.login') }}">{{ $websiteLang->where('lang_key','login_here')->first()->custom_text }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
</body>
@include('layouts.admin.footer')
