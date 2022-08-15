@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','google_recaptcha')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','google_recaptcha')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.captcha.setting') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','allow_captcha')->first()->custom_text }}</label>
                            <select name="allow_captcha" id="catpcha_type" class="form-control">
                                <option {{ $setting->allow_captcha==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                <option {{ $setting->allow_captcha==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                            </select>
                        </div>


                        @if ($setting->allow_captcha !=1)
                        <div id="hidden_captcha_info" class="d-none">
                            <div class="form-group">
                                <label for="captcha_key">{{ $websiteLang->where('lang_key','captcha_key')->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="captcha_key" id="captcha_key" value="{{ $setting->captcha_key }}">
                            </div>
                            <div class="form-group">
                                <label for="captcha_secret">{{ $websiteLang->where('lang_key','captcha_secret')->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="captcha_secret" id="captcha_secret" value="{{ $setting->captcha_secret }}">
                            </div>
                        </div>
                        @endif

                        @if ($setting->allow_captcha==1)
                            <div id="hidden_captcha_info">
                                <div class="form-group">
                                    <label for="captcha_key">{{ $websiteLang->where('lang_key','captcha_key')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="captcha_key" id="captcha_key" value="{{ $setting->captcha_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="captcha_secret">{{ $websiteLang->where('lang_key','captcha_secret')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="captcha_secret" id="captcha_secret" value="{{ $setting->captcha_secret }}">
                                </div>
                            </div>
                        @endif



                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#catpcha_type").on("change",function(e){
                var id=$(this).val()
                if(id==1){
                    $("#hidden_captcha_info").removeClass('d-none');
                }else{
                    $("#hidden_captcha_info").addClass('d-none');
                }
            })

        });

        })(jQuery);
    </script>
@endsection
