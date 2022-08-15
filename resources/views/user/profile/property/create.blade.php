@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','my_property')->first()->custom_text }}</title>
@endsection


@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <h4 class="heading">{{ $websiteLang->where('lang_key','my_property')->first()->custom_text }} <a href="{{ route('user.my.properties') }}" class="btn btn-success custom-create-property"><i class="fas fa-list    "></i> {{ $websiteLang->where('lang_key','all_property')->first()->custom_text }}</a></h4>
                <form action="{{ route('user.property.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="wsus__add_property">
                    <div class="wsus__input_property">
                        <h5>{{ $websiteLang->where('lang_key','basic_info')->first()->custom_text }}</h5>
                        <hr>
                            <div class="row">
                                <div class="col-12">
                                    <label for="#">{{ $websiteLang->where('lang_key','title')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}">
                                    <input type="hidden" name="expired_date" value="{{ $expired_date }}">
                                </div>
                                <div class="col-12">
                                    <label for="#" for="slug">{{ $websiteLang->where('lang_key','slug')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
                                </div>

                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','property_type')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="select_2" name="property_type" id="property_type">
                                            <option value="">{{ $websiteLang->where('lang_key','select_property_type')->first()->custom_text }}</option>
                                                @foreach ($propertyTypes as $item)
                                                <option {{ old('property_type')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->type }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','city')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="select_2" name="city">
                                            <option value="">{{ $websiteLang->where('lang_key','select_city')->first()->custom_text }}</option>
                                            @foreach ($cities as $item)
                                            <option {{ old('city')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name.', '.$item->countryState->name.', '.$item->countryState->country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','address')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','email')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','website')->first()->custom_text }}</label>
                                    <input type="url" name="website" value="{{ old('website') }}">
                                </div>

                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','purpose')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="select_2" name="purpose" id="purpose">
                                            @foreach ($purposes as $item)
                                            <option value="{{ $item->id }}">{{ $item->custom_purpose }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 ">
                                    <label for="#">{{ $websiteLang->where('lang_key','price')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="price" value="{{ old('price') }}">
                                </div>

                                <div class="col-xl-6 col-md-6 d-none" id="period_box">
                                    <label for="#">{{ $websiteLang->where('lang_key','period')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="select_2" name="period" id="period">
                                            <option value="Daily">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</option>
                                            <option value="Monthly">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</option>
                                            <option value="Yearly">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>

                <div class="wsus__add_property mt-3">
                    <div class="wsus__input_property">
                        <h5>{{ $websiteLang->where('lang_key','others_info')->first()->custom_text }}</h5>
                        <hr>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','total_area')->first()->custom_text }}({{ $websiteLang->where('lang_key','sqft')->first()->custom_text }}) <span class="text-danger">*</span></label>
                                <input type="text" name="area" value="{{ old('area') }}">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','total_unit')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="text" name="unit" value="{{ old('unit') }}">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','total_room')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="text" name="room" value="{{ old('room') }}">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','total_bedroom')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="text" name="bedroom" value="{{ old('bedroom') }}">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','total_bathroom')->first()->custom_text }}<span class="text-danger">*</span></label>
                                <input type="text" name="bathroom" value="{{ old('bathroom') }}">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','total_floor')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="text" name="floor" value="{{ old('floor') }}">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','total_kitchen')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="text" name="kitchen" value="{{ old('kitchen') }}">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','parking_place')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="text" name="parking" value="{{ old('parking') }}">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="wsus__add_property mt-3">
                    <div class="wsus__input_property">
                        <h5>{{ $websiteLang->where('lang_key','img_pdf_video')->first()->custom_text }}</h5>
                        <hr>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','pdf_file')->first()->custom_text }}</label>
                                <input type="file" name="pdf_file">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','banner_img')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="file" name="banner_image">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','thumb_img')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <input type="file" name="thumbnail_image">
                            </div>
                            <div class="col-xl-6 col-md-6 ">
                                <label for="#">{{ $websiteLang->where('lang_key','video_link')->first()->custom_text }}</label>
                                <input type="text" name="video_link">
                            </div>


                            <div class="col-xl-8 col-md-8 ">
                                <div id="dynamic-img-box">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label for="#">{{ $websiteLang->where('lang_key','img')->first()->custom_text }} <span class="text-danger">*</span></label>
                                            <input type="file" name="slider_images[]">
                                        </div>
                                        <div class="col-md-3 custom_add_row_btn">
                                            <input class="common_btn_2" type="button" value="{{ $websiteLang->where('lang_key','new')->first()->custom_text }}" id="addDynamicImgBtn" />
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @if ($package->number_of_aminities==-1)
                <div class="wsus__add_property mt-3">
                    <div class="wsus__input_property">
                        <h5>{{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}</h5>
                        <hr>
                        <div class="row">
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

                                    <div class="col-xl-4 col-md-4 col-sm-6 ">
                                        <div class="wsus__pro_check">
                                            <div class="form-check">
                                                <input class="form-check-input" {{ $isChecked ? 'checked' : '' }} type="checkbox" value="{{ $aminity->id }}" name="aminities[]" id="aminityId-{{ $aminity->id }}">
                                                <label class="form-check-label" for="aminityId-{{ $aminity->id }}">
                                                    {{ $aminity->aminity }}
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                @else
                                <div class="col-xl-4 col-md-4 col-sm-6 ">
                                    <div class="wsus__pro_check">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="aminities[]" id="un-aminityId-{{ $aminity->id }}" value="{{ $aminity->id }}">
                                            <label class="form-check-label" for="un-aminityId-{{ $aminity->id }}">
                                                {{ $aminity->aminity }}
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                @endif



                            @endforeach
                        </div>

                        @php
                            $aminityList=[];
                            foreach ($aminities as $index => $aminity) {
                                $aminityList[]=$aminity->id;
                            }
                        @endphp
                    </div>
                </div>
                @else
                <div class="wsus__add_property mt-3">
                    <div class="wsus__input_property">
                        <h5>{{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}</h5>
                        <hr>
                        <div class="row">
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

                                    <div class="col-xl-4 col-md-4 col-sm-6 ">
                                        <div class="wsus__pro_check">
                                            <div class="form-check">
                                                <input class="form-check-input is-check" {{ $isChecked ? 'checked' : '' }} type="checkbox" value="{{ $aminity->id }}" name="aminities[]" id="aminityId-{{ $aminity->id }}">
                                                <label class="form-check-label" for="aminityId-{{ $aminity->id }}">
                                                    {{ $aminity->aminity }}
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                @else
                                <div class="col-xl-4 col-md-4 col-sm-6 ">
                                    <div class="wsus__pro_check">
                                        <div class="form-check">
                                            <input class="form-check-input is-check" type="checkbox" name="aminities[]" id="aminityId-{{ $aminity->id }}" value="{{ $aminity->id }}">
                                            <label class="form-check-label" for="aminityId-{{ $aminity->id }}">
                                                {{ $aminity->aminity }}
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                @endif



                            @endforeach
                        </div>

                        @php
                            $aminityList=[];
                            foreach ($aminities as $index => $aminity) {
                                $aminityList[]=$aminity->id;
                            }
                        @endphp
                    </div>
                </div>

                @endif

                <div class="wsus__add_property mt-3">
                    <div class="wsus__input_property">
                        <h5>{{ $websiteLang->where('lang_key','nearest_loc')->first()->custom_text }}</h5>
                        <hr>
                        <div class="row">
                            <div class="col-xl-10 col-md-10 ">
                                <div id="dyamic-nearest-place-box">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="#">{{ $websiteLang->where('lang_key','nearest_loc')->first()->custom_text }}</label>
                                            <div class="wp_search_area">
                                                <select class="custom-select-box" name="nearest_locations[]">
                                                    <option value="">{{ $websiteLang->where('lang_key','select_nearest_loc')->first()->custom_text }}</option>
                                                    @foreach ($nearest_locatoins as $item)
                                                    <option value="{{ $item->id }}">{{ $item->location }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="#">{{ $websiteLang->where('lang_key','distance')->first()->custom_text }}({{ $websiteLang->where('lang_key','km')->first()->custom_text }})</label>
                                            <input type="text" name="distances[]">
                                        </div>

                                        <div class="col-md-2 custom_add_row_btn">
                                            <input class="common_btn_2" type="button" value="{{ $websiteLang->where('lang_key','new')->first()->custom_text }}" id="addDybanamicLocationBtn"/>
                                        </div>
                                    </div>
                                </div>

                                <div id="hidden-location-box" class="d-none">
                                    <div class="delete-dynamic-location">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="#">{{ $websiteLang->where('lang_key','nearest_loc')->first()->custom_text }}</label>
                                                <div class="wp_search_area">
                                                    <select class="custom-select-box" name="nearest_locations[]">
                                                        <option value="">{{ $websiteLang->where('lang_key','select_nearest_loc')->first()->custom_text }}</option>
                                                        @foreach ($nearest_locatoins as $item)
                                                        <option value="{{ $item->id }}">{{ $item->location }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="#">{{ $websiteLang->where('lang_key','distance')->first()->custom_text }}({{ $websiteLang->where('lang_key','km')->first()->custom_text }})</label>
                                                <input type="text" name="distances[]">
                                            </div>

                                            <div class="col-md-2 custom_add_row_btn">
                                                <input class="danger_btn_2 removeNearstPlaceBtnId" type="button" value="{{ $websiteLang->where('lang_key','remove')->first()->custom_text }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="wsus__add_property mt-3">
                    <div class="wsus__input_property">
                        <h5>{{ $websiteLang->where('lang_key','detail_google_map')->first()->custom_text }}
                        </h5>
                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <label for="#">{{ $websiteLang->where('lang_key','google_map')->first()->custom_text }}</label>
                                <textarea cols="3" rows="3" name="google_map_embed_code">{{ old('google_map_embed_code') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="#">{{ $websiteLang->where('lang_key','des')->first()->custom_text }} <span class="text-danger">*</span></label>
                                <textarea class="summernote" cols="3" rows="3" name="description">{{ old('description') }}</textarea>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="wsus__add_property mt-3">
                    <div class="wsus__input_property">
                        <div class="row">
                            @if ($package->is_featured)
                                @if ($package->number_of_feature_property==-1)
                                    <div class="col-12">
                                        <label for="#">{{ $websiteLang->where('lang_key','featured')->first()->custom_text }} <span class="text-danger">*</span></label>
                                        <div class="wp_search_area">
                                            <select class="custom-select-box" name="featured">
                                                <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                                <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                            </select>
                                        </div>
                                    </div>
                                @elseif($package->number_of_feature_property > $existFeaturedProperty)
                                    <div class="col-12">
                                        <label for="#">{{ $websiteLang->where('lang_key','featured')->first()->custom_text }} <span class="text-danger">*</span></label>
                                        <div class="wp_search_area">
                                            <select class="custom-select-box" name="featured">
                                                <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                                <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if ($package->is_top)
                                @if ($package->number_of_top_property==-1)
                                <div class="col-12">
                                    <label for="#">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="custom-select-box" name="top_property">
                                            <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                            <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
                                @elseif($package->number_of_top_property > $existTopProperty)
                                <div class="col-12">
                                    <label for="#">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="custom-select-box" name="top_property">
                                            <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                            <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                            @endif

                            @if ($package->is_urgent)
                                @if ($package->number_of_urgent_property==-1)
                                <div class="col-12">
                                    <label for="#">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="custom-select-box" name="urgent_property">
                                            <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                            <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
                                @elseif($package->number_of_urgent_property > $existUrgentProperty)
                                <div class="col-12">
                                    <label for="#">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <div class="wp_search_area">
                                        <select class="custom-select-box" name="urgent_property">
                                            <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                            <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                            @endif
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="#">{{ $websiteLang->where('lang_key','seo_title')->first()->custom_text }}</label>
                                    <input type="text" name="seo_title" value="{{ old('seo_title') }}">
                                </div>
                                <div class="col-12">
                                    <label for="#">{{ $websiteLang->where('lang_key','seo_des')->first()->custom_text }}</label>
                                    <textarea cols="3" rows="3" name="seo_description">{{ old('seo_description') }}</textarea>
                                </div>

                            </div>
                        </div>
                        <button class="common_btn_2" type="submit">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>












<script>
    (function($) {
    "use strict";
    $(document).ready(function () {

        var image=1;
        var maxImage='{{ $package->number_of_photo }}';
        var location=1;
        var maxLocation='{{ $package->number_of_nearest_place }}';
        $("#addDynamicImgBtn").on('click',function(e) {
            e.preventDefault();
            var newRow='';
            newRow += '<div class="row delete-dynamic-img-row">';
            newRow += '<div class="col-md-9">';
            newRow += '<label for="#">Image</label>';
            newRow += '<input type="file" name="slider_images[]">';
            newRow += ' </div>';
            newRow += '<div class="col-md-3 custom_add_row_btn">';
            newRow += '<input class="danger_btn_2 removeDynamicImgId" type="button" value="{{ $websiteLang->where("lang_key","remove")->first()->custom_text }}"/>';
            newRow += '</div>';
            newRow += '</div>';

            if(maxImage==-1){
                $("#dynamic-img-box").append(newRow);
            }else if(image < maxImage){
                image++;
                $("#dynamic-img-box").append(newRow);
            }



        })

        $(document).on('click', '.removeDynamicImgId', function () {
                $(this).closest('.delete-dynamic-img-row').remove();
                image--;
        });

        $("#addDybanamicLocationBtn").on('click',function(e) {
            e.preventDefault();
            var newRow=$("#hidden-location-box").html()

            if(maxLocation == -1){
                $("#dyamic-nearest-place-box").append(newRow);
            }else if(location < maxLocation){
                location++;
                $("#dyamic-nearest-place-box").append(newRow);
            }

        })

        $(document).on('click', '.removeNearstPlaceBtnId', function () {
                $(this).closest('.delete-dynamic-location').remove();
                location--;
        });

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


        //start handle aminity
        $(".is-check").on("click",function(e){
            var ids = [];
            var aminityList=<?= json_encode($aminityList)?>;
            var maxAminity= <?= $package->number_of_aminities ?>;
            $('input[name="aminities[]"]:checked').each(function() {
                ids.push(this.value);
            });
            var idsLenth=ids.length;

            const checkedIds = ids.map((i) => Number(i));

            var unCheckedIds=aminityList.filter(d => !checkedIds.includes(d))


            if( maxAminity > idsLenth){
                for(var j=0; j< unCheckedIds.length ; j++){
                    $("#aminityId-"+unCheckedIds[j]).prop("disabled", false);
                }

            }else{
                for(var j=0; j< unCheckedIds.length ; j++){
                    $("#aminityId-"+unCheckedIds[j]).prop("disabled", true);
                }

            }

        })
        //end handle aminity



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
