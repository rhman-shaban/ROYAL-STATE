@extends('layouts.staff.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</title>
@endsection
@section('staff-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('staff.property.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','all_property')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <form action="{{ route('staff.property.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','basic_info')->first()->custom_text }}</h4>
                        <hr>
                        <div class="form-group">
                            <label for="title">{{ $websiteLang->where('lang_key','title')->first()->custom_text }}<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ $websiteLang->where('lang_key','slug')->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}">
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{ $websiteLang->where('lang_key','property_type')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="property_type" id="property_type" class="form-control select2">
                                        <option value="">{{ $websiteLang->where('lang_key','select_property_type')->first()->custom_text }}</option>
                                        @foreach ($propertyTypes as $item)
                                        <option {{ old('property_type')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">{{ $websiteLang->where('lang_key','city')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="city" id="city" class="form-control select2">
                                        <option value="">{{ $websiteLang->where('lang_key','select_city')->first()->custom_text }}</option>
                                        @foreach ($cities as $item)
                                        <option {{ old('city')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name.', '.$item->countryState->name.', '.$item->countryState->country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ $websiteLang->where('lang_key','address')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ $websiteLang->where('lang_key','email')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">{{ $websiteLang->where('lang_key','website')->first()->custom_text }}</label>
                                    <input type="url" name="website" value="{{ old('website') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">{{ $websiteLang->where('lang_key','purpose')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="purpose" id="purpose" class="form-control">
                                        @foreach ($purposes as $item)
                                        <option value="{{ $item->id }}">{{ $item->custom_purpose }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">{{ $websiteLang->where('lang_key','price')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                                </div>
                            </div>

                            <div class="col-md-6 d-none" id="period_box">
                                <div class="form-group">
                                    <label for="period">{{ $websiteLang->where('lang_key','period')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="period" id="period" class="form-control">
                                        <option value="Daily">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</option>
                                        <option value="Monthly">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</option>
                                        <option value="Yearly">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','others_info')->first()->custom_text }}</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_area')->first()->custom_text }}({{ $websiteLang->where('lang_key','sqft')->first()->custom_text }}) <span class="text-danger">*</span></label>
                                    <input type="text" name="area" value="{{ old('area') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_unit')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="unit" value="{{ old('unit') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_room')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="room" value="{{ old('room') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_bedroom')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="bedroom" value="{{ old('bedroom') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_bathroom')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="bathroom" value="{{ old('bathroom') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_floor')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="floor" value="{{ old('floor') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_kitchen')->first()->custom_text }} </label>
                                    <input type="number" name="kitchen" value="{{ old('kitchen') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','parking_place')->first()->custom_text }}</label>
                                    <input type="number" name="parking" value="{{ old('parking') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','img_pdf_video')->first()->custom_text }}</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','pdf_file')->first()->custom_text }}</label>
                                    <input type="file" name="pdf_file" class="form-control-file">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','banner_img')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="file" name="banner_image" class="form-control-file">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','thumb_img')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="file" name="thumbnail_image" class="form-control-file">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','slider_img')->first()->custom_text }} ({{ $websiteLang->where('lang_key','multiple')->first()->custom_text }}) <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file" name="slider_images[]" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','video_link')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="video_link" value="{{ old('video_link') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}</h4>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div>
                                        @foreach ($aminities as $aminity)
                                            @if (old('aminities'))
                                                @php
                                                    $isChecked=false;
                                                @endphp
                                                @foreach (old('aminities') as $old_aminity)
                                                    @if ($aminity->id==$old_aminity)
                                                    @php
                                                    $isChecked=true;
                                                @endphp
                                                    @endif
                                                @endforeach
                                                <input id="{{ $aminity->slug }}" {{ $isChecked ? 'checked' :'' }} value="{{ $aminity->id }}" type="checkbox" name="aminities[]" >
                                                <label class="mx-1" for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>

                                            @else
                                                <input value="{{ $aminity->id }}" type="checkbox" name="aminities[]" id="{{ $aminity->slug }}">
                                                <label class="mx-1" for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','nearest_loc')->first()->custom_text }}</h4>
                        <hr>
                        <div class="row">
                            <div class="col-8" id="nearest-place-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ $websiteLang->where('lang_key','nearest_loc')->first()->custom_text }}</label>
                                            <select name="nearest_locations[]" id="" class="form-control">
                                                <option value="">{{ $websiteLang->where('lang_key','select_nearest_loc')->first()->custom_text }}</option>
                                                @foreach ($nearest_locatoins as $item)
                                                <option value="{{ $item->id }}">{{ $item->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ $websiteLang->where('lang_key','distance')->first()->custom_text }}({{ $websiteLang->where('lang_key','km')->first()->custom_text }})</label>
                                            <input type="text" class="form-control" name="distances[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="addNearestPlaceRow" type="button" class="btn btn-success btn-sm nearest-row-btn"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="hidden-location-box" class="d-none">
                    <div class="delete-dynamic-location">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','nearest_loc')->first()->custom_text }}</label>
                                    <select name="nearest_locations[]" id="" class="form-control">
                                        <option value="">{{ $websiteLang->where('lang_key','select_nearest_loc')->first()->custom_text }}</option>
                                        @foreach ($nearest_locatoins as $item)
                                        <option value="{{ $item->id }}">{{ $item->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','distance')->first()->custom_text }}({{ $websiteLang->where('lang_key','km')->first()->custom_text }})</label>
                                    <input type="text" class="form-control" name="distances[]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm nearest-row-btn removeNearestPlaceRow"><i class="fas fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>


                </div>


                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','detail_google_map')->first()->custom_text }}</h4>
                        <hr>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $websiteLang->where('lang_key','google_map')->first()->custom_text }}</label>
                                    <textarea class="form-control" rows="5" name="google_map_embed_code">{{ old('google_map_embed_code') }}</textarea>
                                </div>


                                <div class="form-group mt-3">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <textarea class="summernote" id="description" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="featured">{{ $websiteLang->where('lang_key','featured')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="featured" id="featured" class="form-control">
                                        <option {{ old('featured')==0 ? 'selected': '' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                        <option {{ old('featured')==1 ? 'selected': '' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="top_property">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="top_property" id="top_property" class="form-control">
                                        <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="urgent_property">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="urgent_property" id="urgent_property" class="form-control">
                                        <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_title">{{ $websiteLang->where('lang_key','seo_title')->first()->custom_text }}</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ old('seo_title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_description">{{ $websiteLang->where('lang_key','seo_des')->first()->custom_text }}</label>
                                    <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control" >{{ old('seo_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#title").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            $("#purpose").on("change",function(){
                var purposeId=$(this).val()
                if(purposeId==2){
                    $("#period_box").removeClass('d-none');
                }else if(purposeId==1){
                    $("#period_box").addClass('d-none');
                }
            })



             //start dynamic nearest place add and remove

             $("#addNearestPlaceRow").on("click",function(){
                var new_row=$("#hidden-location-box").html();
                $("#nearest-place-box").append(new_row)

            })
            $(document).on('click', '.removeNearestPlaceRow', function () {
                $(this).closest('.delete-dynamic-location').remove();
            });
            //end dynamic nearest place add and remove



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
