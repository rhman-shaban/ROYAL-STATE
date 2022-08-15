@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</title>
@endsection

@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <div class="wsus__manage_dashboard">
                <h4 class="heading">{{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</h4>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__manage_single">
                            <i class="far fa-list"></i>
                            <p><span>{{ $publishProperty }}</span>{{ $websiteLang->where('lang_key','publish_pro')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__manage_single red">
                            <i class="far fa-list"></i>
                            <p><span>{{ $expiredProperty }}</span>{{ $websiteLang->where('lang_key','expired_pro')->first()->custom_text }}</p>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__manage_single orange">
                            <i class="fas fa-star"></i>
                            <p><span>{{ $myReviews->count() }}</span>{{ $websiteLang->where('lang_key','my_review')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__manage_single blue">
                            <i class="fal fa-star"></i>
                            <p><span>{{ $clientReviews }}</span>{{ $websiteLang->where('lang_key','client_review')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__manage_single">
                            <i class="fas fa-heart"></i>
                            <p><span>{{ $wishlists->count() }}</span>{{ $websiteLang->where('lang_key','wishlist')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__manage_single orange">
                            <i class="fas fa-list"></i>
                            <p><span>{{ $orders->count() }}</span>{{ $websiteLang->where('lang_key','order')->first()->custom_text }}</p>
                        </div>
                    </div>

                </div>

                @if ($activeOrder)
                <div class="wsus__message">
                    <h4>{{ $websiteLang->where('lang_key','active_order')->first()->custom_text }}</h4>
                    @php
                        $package=$activeOrder->package;
                    @endphp
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','package_name')->first()->custom_text }}</td>
                                    <td width="50%">{{ $package->package_name }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','price')->first()->custom_text }}</td>
                                    <td width="50%">{{ $currency->currency_icon }}{{ $package->price }}</td>
                                </tr>

                                 <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','expired_date')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($activeOrder->expired_day==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $activeOrder->expired_date }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->number_of_property==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_property }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->number_of_aminities==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_aminities }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','nearest_place')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->number_of_nearest_place==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_nearest_place }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','photo')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->number_of_photo==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_photo }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->is_featured==1)
                                        {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                        @else
                                        {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->number_of_feature_property==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_feature_property }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->is_top==1)
                                        {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                        @else
                                        {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->number_of_top_property==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_top_property }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->is_urgent==1)
                                        {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                        @else
                                        {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                                    <td width="50%">
                                        @if ($package->number_of_urgent_property==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_urgent_property }}
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
