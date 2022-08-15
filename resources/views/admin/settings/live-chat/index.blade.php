@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','live_chat')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','live_chat')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.livechat.setting') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','allow_live_chat')->first()->custom_text }}</label>
                            <select name="live_chat" id="live_chat" class="form-control">
                                <option {{ $setting->live_chat==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                <option {{ $setting->live_chat==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                            </select>
                        </div>

                        @if ($setting->live_chat !=1)
                        <div class="form-group d-none" id="live_chat_hidden_script">
                            <label for="livechat_script">{{ $websiteLang->where('lang_key','chat_link')->first()->custom_text }}</label>
							<input type="text" class="form-control" name="livechat_script" id="livechat_script" value="{{ $setting->livechat_script }}">
                        </div>
                        @endif

                        @if ($setting->live_chat==1)
                            <div class="form-group" id="live_chat_hidden_script">
                                <label for="livechat_script">{{ $websiteLang->where('lang_key','chat_link')->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="livechat_script" id="livechat_script" value="{{ $setting->livechat_script }}">
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
            $("#live_chat").on("change",function(e){
                var id=$(this).val()
                if(id==1){
                    $("#live_chat_hidden_script").removeClass('d-none');
                }else{
                    $("#live_chat_hidden_script").addClass('d-none');
                }
            })

        });

        })(jQuery);
    </script>
@endsection
