@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','home_section')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','home_section')->first()->custom_text }}</h6>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $websiteLang->where('lang_key','banner_award')->first()->custom_text }}
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','feature')->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','top_properties')->first()->custom_text }}</a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#category" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','featured_properties')->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#location" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','agent_s')->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#listings" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','service')->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#package" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','blog')->first()->custom_text }}</a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#blog" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','testimonial')->first()->custom_text }}</a>
                </li>
              </ul>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @php
                    $awardSection=$sections->where('id',11)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.banner-award-in-homepage',$awardSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $awardSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $awardSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $awardSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @php
                    $featureSection=$sections->where('id',2)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$featureSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $featureSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $featureSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $featureSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $featureSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $featureSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade mt-5" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    @php
                    $overviewSection=$sections->where('id',3)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$overviewSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $overviewSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $overviewSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $overviewSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $overviewSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $overviewSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade mt-5" id="category" role="tabpanel" aria-labelledby="category-tab">
                    @php
                    $featuredProperties=$sections->where('id',4)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$featuredProperties->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $featuredProperties->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $featuredProperties->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $featuredProperties->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $featuredProperties->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $featuredProperties->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade mt-5" id="location" role="tabpanel" aria-labelledby="location-tab">
                    @php
                    $agent=$sections->where('id',5)->first();
                    @endphp
                     <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$agent->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $agent->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $agent->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $agent->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $agent->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $agent->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade mt-5" id="listings" role="tabpanel" aria-labelledby="listings-tab">
                     @php
                    $serviceSection=$sections->where('id',6)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$serviceSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $serviceSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $serviceSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $serviceSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $serviceSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $serviceSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade mt-5" id="package" role="tabpanel" aria-labelledby="package-tab">
                    @php
                    $blogSection=$sections->where('id',7)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$blogSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $blogSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $blogSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $blogSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $blogSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $blogSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-5" id="blog" role="tabpanel" aria-labelledby="blog-tab">
                    @php
                    $testimonialSection=$sections->where('id',8)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$testimonialSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $testimonialSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $testimonialSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $testimonialSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $testimonialSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $testimonialSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

              </div>

        </div>

    </div>

@endsection
