@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','property_type')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.property-type.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','all_property_type')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.property-type.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="type">{{ $websiteLang->where('lang_key','type')->first()->custom_text }}</label>
                            <input type="text" name="type" class="form-control" id="type" value="{{ old('type') }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ $websiteLang->where('lang_key','slug')->first()->custom_text }}</label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}">
                        </div>


                        <div class="form-group">
                            <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                            <select name="status" id="status" class="form-control">
                                <option  value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                <option  value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#type").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })
        });

        })(jQuery);

        function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-');
            }
    </script>

@endsection
