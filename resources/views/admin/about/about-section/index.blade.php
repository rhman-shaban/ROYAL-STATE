@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','about_section')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','about_section')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $websiteLang->where('lang_key','award_section')->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('lang_key','team_section')->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ $websiteLang->where('lang_key','main_section')->first()->custom_text }}</a>
                </li>

              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @php
                        $awardSection=$sections->where('id',2)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.section-feature.update',$awardSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" name="header" value="{{ $awardSection->header }}"   class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $awardSection->description }}</textarea>
                                </div>

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
                    $teamSection=$sections->where('id',3)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.section-feature.update',$teamSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                                    <input type="text" name="header" value="{{ $teamSection->header }}"   class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $teamSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('lang_key','content_qty')->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $teamSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $teamSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $teamSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @php
                    $aboutSection=$sections->where('id',1)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.section-about.update',$aboutSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('lang_key','show_homepage')->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $aboutSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $aboutSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
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
