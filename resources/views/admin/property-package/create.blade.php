@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','package')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.package.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','all_package')->first()->custom_text }}</a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','package_form')->first()->custom_text }} <span class="text-danger">({{ $websiteLang->where('lang_key','unlimited_qty')->first()->custom_text }} = -1 )</span> </h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.package.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="package_type">{{ $websiteLang->where('lang_key','package_type')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="package_type" id="package_type" class="form-control">
                                        <option value="1">{{ $websiteLang->where('lang_key','premium')->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('lang_key','free')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="package_name">{{ $websiteLang->where('lang_key','package_name')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="package_name" class="form-control" id="package_name" value="{{ old('package_name') }}">
                                </div>
                            </div>
                            <div class="col-md-4" id="price-row">
                                <div class="form-group">
                                    <label for="price">{{ $websiteLang->where('lang_key','price')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="price" class="form-control" id="price" value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_days">{{ $websiteLang->where('lang_key','number_of_day')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_days" class="form-control" id="number_of_days" value="{{ old('number_of_days') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_property">{{ $websiteLang->where('lang_key','number_of_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_property" class="form-control" id="number_of_property" value="{{ old('number_of_property') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_aminities">{{ $websiteLang->where('lang_key','number_of_aminities')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_aminities" class="form-control" id="number_of_aminities" value="{{ old('number_of_aminities') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_nearest_place">{{ $websiteLang->where('lang_key','number_of_nearest_place')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_nearest_place" class="form-control" id="number_of_nearest_place" value="{{ old('number_of_nearest_place') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_photo">{{ $websiteLang->where('lang_key','number_of_photo')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_photo" class="form-control" id="number_of_photo" value="{{ old('number_of_photo') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="feature">{{ $websiteLang->where('lang_key','allow_feature')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="feature" id="feature" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="feature-row">
                                <div class="form-group">
                                    <label for="number_of_feature_property">{{ $websiteLang->where('lang_key','number_of_featured_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_feature_property" id="number_of_feature_property" class="form-control" value="{{ old('number_of_feature_property') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="top_property">{{ $websiteLang->where('lang_key','allow_top_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="top_property" id="top_property" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4" id="top-row">
                                <div class="form-group">
                                    <label for="number_of_top_property">{{ $websiteLang->where('lang_key','number_of_top_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_top_property" id="number_of_top_property" class="form-control" value="{{ old('number_of_top_property') }}">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="urgent">{{ $websiteLang->where('lang_key','allow_urgent_property')->first()->custom_text }}<span class="text-danger">*</span></label>
                                    <select name="urgent" id="urgent" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4" id="urgent-row">
                                <div class="form-group">
                                    <label for="number_of_urgent_property">{{ $websiteLang->where('lang_key','number_of_urgent_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_urgent_property" id="number_of_urgent_property" class="form-control" value="{{ old('number_of_urgent_property') }}">
                                </div>
                            </div>




                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','package_order')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" id="package_order"name="package_order" class="form-control">
                                    <span class="text-danger d-none" id="order-error"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>


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
            $("#package_type").on('change',function(){
                var type=$("#package_type").val()
                if(type==0){
                    $("#price-row").addClass('d-none')
                }
                if(type==1){
                    $("#price-row").removeClass('d-none')
                }

            })

            $("#feature").on('change',function(){
                var type=$("#feature").val()
                if(type==0){
                    $("#feature-row").addClass('d-none')
                }
                if(type==1){
                    $("#feature-row").removeClass('d-none')
                }

            })

            $("#top_property").on('change',function(){
                var type=$("#top_property").val()
                if(type==0){
                    $("#top-row").addClass('d-none')
                }
                if(type==1){
                    $("#top-row").removeClass('d-none')
                }

            })

            $("#urgent").on('change',function(){
                var type=$("#urgent").val()
                if(type==0){
                    $("#urgent-row").addClass('d-none')
                }
                if(type==1){
                    $("#urgent-row").removeClass('d-none')
                }

            })

            $("#package_order").on('keyup',function(){
                var text=$("#package_order").val()
                if(isNaN(text)){
                    $("#order-error").text('Please insert positive number')
                    $("#order-error").removeClass('d-none')
                }else{
                    if(text<0){
                        $("#order-error").text('Please insert positive number')
                        $("#order-error").removeClass('d-none')
                    }else{
                        $("#order-error").addClass('d-none')
                    }
                }
            })


        });

        })(jQuery);
    </script>

@endsection
