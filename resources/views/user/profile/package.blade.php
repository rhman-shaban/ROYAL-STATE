@extends('layouts.user.profile.layout')

@section('title')
    <title>{{ $websiteLang->where('id',86)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',86)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',86)->first()->custom_text }}</span></div>
        </div>


        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 p-b0 bg-white m-b30">
                <div class="section-content">
                    <div class="pricingtable-row m-b30">
                        <div class="row d-flex justify-content-center mt-5">
                            @foreach ($listingPackages as $index=> $listingPackage)
                            <div class="col-lg-4 col-md-6 col-sm-12 m-b100">
                                <div class="pricingtable-wrapper pricingtable-highlight-outer">
                                    <div class="pricingtable-inner pricingtable-highlight dot2-left-top-img">
                                        <div class="pricing-table-top-section">
                                            <div class="pricingtable-title">
                                                <h4>{{ $listingPackage->package_name }}</h4>
                                            </div>

                                            @php
                                                $unlimited=$websiteLang->where('id',425)->first()->custom_text;
                                            @endphp

                                            <div class="pricingtable-price">
                                                <span class="pricingtable-bx"><sup class="pricingtable-sign">{{ $currency->currency_icon }}</sup>{{ $listingPackage->price }}</span>
                                                <span class="pricingtable-type">{{ $listingPackage->number_of_days == -1 ? $unlimited : $listingPackage->number_of_days }} {{ $websiteLang->where('id',14)->first()->custom_text }}</span>
                                            </div>

                                        </div>

                                        <ul class="pricingtable-features">
                                            <li>{{ $listingPackage->number_of_listing==-1 ? $unlimited : $listingPackage->number_of_listing  }} {{ $websiteLang->where('id',15)->first()->custom_text }}</li>
                                            @if ($listingPackage->number_of_days != -1)
                                            <li>{{ $listingPackage->number_of_days }} {{ $websiteLang->where('id',16)->first()->custom_text }}</li>
                                            @else
                                            <li>{{ $unlimited }} {{ $websiteLang->where('id',16)->first()->custom_text }}</li>
                                            @endif

                                            <li>{{ $listingPackage->number_of_aminities== -1 ? $unlimited : $listingPackage->number_of_aminities }} {{ $websiteLang->where('id',17)->first()->custom_text }}</li>
                                            <li>{{ $listingPackage->number_of_photo == -1 ? $unlimited : $listingPackage->number_of_photo }} {{ $websiteLang->where('id',18)->first()->custom_text }}</li>
                                            <li>{{ $listingPackage->number_of_video ==-1 ? $unlimited : $listingPackage->number_of_video }} {{ $websiteLang->where('id',19)->first()->custom_text }}</li>
                                            @if ($listingPackage->is_featured ==1)
                                            <li>{{ $websiteLang->where('id',20)->first()->custom_text }}</li>
                                            <li>{{ $listingPackage->number_of_feature_listing == -1 ? $unlimited : $listingPackage->number_of_feature_listing }} {{ $websiteLang->where('id',21)->first()->custom_text }}</li>
                                            @else
                                            <li>{{ $websiteLang->where('id',441)->first()->custom_text }}</li>
                                            <li>0 {{ $websiteLang->where('id',21)->first()->custom_text }}</li>
                                            @endif
                                        </ul>

                                        <div class="pricingtable-footer">
                                            @auth
                                            <a href="javascript:;" data-toggle="modal" data-target=".confirmation-modal-{{ $listingPackage->id }}" class="site-button-secondry  site-button-gradient">{{ $websiteLang->where('id',13)->first()->custom_text }}</a>
                                            @else
                                                <a href="javascript:;" data-toggle="modal" data-target=".sign-in-modal" class="site-button-secondry  site-button-gradient">{{ $websiteLang->where('id',13)->first()->custom_text }}</a>
                                            @endauth

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach





                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
