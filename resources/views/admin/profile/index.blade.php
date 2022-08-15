@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</title>
@endsection

@section('admin-content')
       <!-- DataTales Example -->
       <div class="row">
           <div class="col-md-12">
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</h6>
                   </div>
                   <div class="card-body">
                    <form action="{{ route('admin.update.profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','exist_banner_img')->first()->custom_text }}</label>
                                    @if ($admin->banner_image)
                                    <div class="banner-image">
                                        <img src="{{ asset($admin->banner_image) }}" alt="">
                                    </div>
                                     @else
                                     <div class="banner-image">
                                        <img src="{{ asset($image->image) }}" alt="">
                                    </div>
                                    @endif

                                    <label class="mt-1">{{ $websiteLang->where('lang_key','banner_img')->first()->custom_text }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control-file wt-form-control" name="banner_image" type="file">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','exist_img')->first()->custom_text }}</label>
                                    <div>
                                        @if ($admin->image)
                                        <img class="img-thumbnail" src="{{ url($admin->image) }}" alt="default user image" width="100px">

                                        @else
                                        <img class="img-thumbnail" src="{{ url($default_profile->image) }}" alt="default user image" width="100px">

                                        @endif
                                    </div>
                                    <label for="" class="mt-2">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                                    <input type="file" class="form-control-file" name="image">

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" value="{{ $admin->name }}" name="name">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" value="{{ $admin->email }}" name="email">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" value="{{ $admin->phone }}" name="phone">

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">{{ $websiteLang->where('lang_key','facebook')->first()->custom_text }}</label>
                                    <input type="text" name="facebook" value="{{ $admin->facebook }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">{{ $websiteLang->where('lang_key','twitter')->first()->custom_text }}</label>
                                    <input type="text" name="twitter" value="{{  $admin->twitter }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">{{ $websiteLang->where('lang_key','linkedin')->first()->custom_text }}</label>
                                    <input type="text" name="linkedin" value="{{  $admin->linkedin }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp">{{ $websiteLang->where('lang_key','whatsapp')->first()->custom_text }}</label>
                                    <input type="text" name="whatsapp" value="{{  $admin->whatsapp }}" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="webiste">{{ $websiteLang->where('lang_key','website')->first()->custom_text }}</label>
                                    <input type="text" name="website" value="{{  $admin->website }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">{{ $websiteLang->where('lang_key','address')->first()->custom_text }}</label>
                                    <input type="text" name="address" value="{{  $admin->address }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about">{{ $websiteLang->where('lang_key','about')->first()->custom_text }}</label>
                                   <textarea name="about" id="about" cols="30" rows="2" class="form-control">{{  $admin->about }}</textarea>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','new_pass')->first()->custom_text }}</label>
                                    <input  type="password" class="form-control" name="password">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','confirm_pass')->first()->custom_text }}</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                        </div>










                        <button class="btn btn-success" type="submit">{{  $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                   </div>
               </div>
           </div>
       </div>
@endsection

