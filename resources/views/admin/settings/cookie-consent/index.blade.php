@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','cookie_consent_modal')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','cookie_consent_modal')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.cookie.consent.setting') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','allow_cookie')->first()->custom_text }}</label>
                                    <select name="allow" id="" class="form-control">
                                        <option {{ $setting->status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $setting->status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','border')->first()->custom_text }}</label>
                                    <select name="border" id="" class="form-control">
                                        <option {{ $setting->border=='none' ? 'selected':'' }} value="none">{{ $websiteLang->where('lang_key','none')->first()->custom_text }}</option>
                                        <option {{ $setting->border=='thin' ? 'selected':'' }} value="thin">{{ $websiteLang->where('lang_key','thin')->first()->custom_text }}</option>
                                        <option {{ $setting->border=='normal' ? 'selected':'' }} value="normal">{{ $websiteLang->where('lang_key','normal')->first()->custom_text }}</option>
                                        <option {{ $setting->border=='thick' ? 'selected':'' }} value="thick">{{ $websiteLang->where('lang_key','thick')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','corners')->first()->custom_text }}</label>
                                    <select name="corners" id="" class="form-control">
                                        <option {{ $setting->corners=='none' ? 'selected':'' }} value="none">{{ $websiteLang->where('lang_key','none')->first()->custom_text }}</option>
                                        <option {{ $setting->corners=='small' ? 'selected':'' }} value="small">{{ $websiteLang->where('lang_key','small')->first()->custom_text }}</option>
                                        <option {{ $setting->corners=='normal' ? 'selected':'' }} value="normal">{{ $websiteLang->where('lang_key','normal')->first()->custom_text }}</option>
                                        <option {{ $setting->corners=='large' ? 'selected':'' }} value="large">{{ $websiteLang->where('lang_key','large')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="bg_color">{{ $websiteLang->where('lang_key','bg_color')->first()->custom_text }}</label>
                                    <input type="color" name="background_color" id="bg_color" value="{{ $setting->background_color }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="text_color">{{ $websiteLang->where('lang_key','text_color')->first()->custom_text }}</label>
                                    <input type="color" name="text_color" id="text_color" value="{{ $setting->text_color }}">
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="border_color">{{ $websiteLang->where('lang_key','border_color')->first()->custom_text }}</label>
                                    <input type="color" name="border_color" id="border_color" value="{{ $setting->border_color }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="btn_bg_color">{{ $websiteLang->where('lang_key','btn_color')->first()->custom_text }}</label>
                                    <input type="color" name="button_color" id="btn_bg_color" value="{{ $setting->btn_bg_color }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="btn_text_color">{{ $websiteLang->where('lang_key','btn_text_color')->first()->custom_text }}</label>
                                    <input type="color" name="btn_text_color" id="btn_text_color" value="{{ $setting->btn_text_color }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','link_text')->first()->custom_text }}</label>
                                    <input type="text" name="link_text" value="{{ $setting->link_text }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','btn_text')->first()->custom_text }}</label>
                                    <input type="text" name="btn_text" value="{{ $setting->btn_text }}" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="cookie_text">{{ $websiteLang->where('lang_key','msg')->first()->custom_text }}</label>
                            <textarea class="form-control" name="message" id="cookie_text" cols="30" rows="5">{{ $setting->message }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
