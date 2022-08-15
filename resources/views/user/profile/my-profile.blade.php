@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $user->name }}</title>
@endsection

@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <h4 class="heading">{{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</h4>
            <div class="wsus__profile_details">
                <div class="wsus__profile_text">
                    <div class="row">
                        <div class="col-xl-5 col-md-6 col-lg-5">
                            <div class="wsus__profile_single">

                                <img src="{{ $user->image ? url($user->image) : url($default_image->image) }}" alt="user" class="img-fluid">
                                <h5>{{ $user->name }}</h5>
                                <ul>
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
                                <div class="wsus__address">
                                    @if ($user->phone)
                                    <a href="callto:{{ $user->phone }}"><i class="fal fa-phone-alt"></i> {{ $user->phone }}</a>
                                    @endif
                                    @if ($user->email)
                                    <a href="mailto:{{ $user->email }}"><i class="fal fa-envelope"></i> {{ $user->email }}</a>
                                    @endif


                                    @if ($user->website)
                                    <p><i class="fas fa-globe" aria-hidden="true"></i> {{ $user->website }}</p>
                                    @endif
                                    @if ($user->address)
                                    <p><i class="fal fa-map-marker-alt"></i> {{ $user->address }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-md-6 col-lg-7">
                            <div class="wsus__request_inquiry">
                                <form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" placeholder="Name" name="name" value="{{ $user->name }}">
                                    <input type="email" placeholder="{{ $websiteLang->where('lang_key','name')->first()->custom_text }}" name="email" value="{{ $user->email }}" readonly>
                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}" name="phone" value="{{ $user->phone }}">

                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','first_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_one" value="{{ $user->icon_one }}">
                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','first_link')->first()->custom_text }}" name="link_one" value="{{ $user->link_one }}">


                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','second_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_two" value="{{ $user->icon_two }}">
                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','second_link')->first()->custom_text }}" name="link_two" value="{{ $user->link_two }}">


                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','third_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_three" value="{{ $user->icon_three }}">
                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','third_link')->first()->custom_text }}" name="link_three" value="{{ $user->link_three }}">


                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','four_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_four" value="{{ $user->icon_four }}">
                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','four_link')->first()->custom_text }}" name="link_four" value="{{ $user->link_four }}">

                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','website')->first()->custom_text }}" name="website" value="{{ $user->website }}">

                                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','address')->first()->custom_text }}" name="address" value="{{ $user->address }}">
                                    <input type="file" name="image">
                                    <textarea cols="3" rows="3" class="summernote" placeholder="{{ $websiteLang->where('lang_key','about')->first()->custom_text }}" name="about">{{ $user->about }}</textarea>
                                    <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wsus__profile_details mt-5">
                <div class="wsus__profile_text">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="wsus__request_inquiry">
                                <form action="{{ route('user.update.password') }}" method="POST">
                                    @csrf
                                    <label class="my-1" for="">{{ $websiteLang->where('lang_key','old_pass')->first()->custom_text }}</label>
                                    <input type="password" name="current_password">
                                    <label class="my-1" for="">{{ $websiteLang->where('lang_key','new_pass')->first()->custom_text }}</label>
                                    <input type="password" name="password">

                                    <label class="my-1" for="">{{ $websiteLang->where('lang_key','confirm_pass')->first()->custom_text }}</label>
                                    <input type="password" name="password_confirmation">
                                    <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','change_pass')->first()->custom_text }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="wsus__profile_details mt-5">
                <div class="wsus__profile_text">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="wsus__request_inquiry">
                                <form action="{{ route('user.update.profile.banner') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label class="my-2" for="">{{ $websiteLang->where('lang_key','exist_banner_img')->first()->custom_text }}</label>
                                    <div class="mb-2">
                                        <img class="user-public-banner" src="{{ $user->banner_image ? url($user->banner_image ) : url($agent_default_profile->image) }}" alt="">
                                    </div>
                                    <label class="my-2" for="">{{ $websiteLang->where('lang_key','new_img')->first()->custom_text }}</label>
                                    <input type="file" name="banner_image">
                                    <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
