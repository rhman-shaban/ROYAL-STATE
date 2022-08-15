@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.property.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','all_property')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <form action="{{ route('admin.property.update',$property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','basic_info')->first()->custom_text }}</h4>
                        <hr>
                        <div class="form-group">
                            <label for="title">{{ $websiteLang->where('lang_key','title')->first()->custom_text }}<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $property->title }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ $websiteLang->where('lang_key','slug')->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $property->slug }}">
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{ $websiteLang->where('lang_key','property_type')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="property_type" id="property_type" class="form-control select2">
                                        <option value="">{{ $websiteLang->where('lang_key','select_property_type')->first()->custom_text }}</option>
                                        @foreach ($propertyTypes as $item)
                                        <option {{ $property->property_type_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->type }}</option>
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
                                        <option {{ $property->city_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name.', '.$item->countryState->name.', '.$item->countryState->country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ $websiteLang->where('lang_key','address')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{ $property->address }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                                    <input type="text" name="phone" value="{{ $property->phone }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ $websiteLang->where('lang_key','email')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ $property->email }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">{{ $websiteLang->where('lang_key','website')->first()->custom_text }}</label>
                                    <input type="url" name="website" value="{{ $property->website }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">{{ $websiteLang->where('lang_key','purpose')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="purpose" id="purpose" class="form-control">
                                        @foreach ($purposes as $item)
                                        <option {{ $property->property_purpose_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->custom_purpose }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">{{ $websiteLang->where('lang_key','price')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="price" class="form-control" value="{{ $property->price }}">
                                </div>
                            </div>


                            @if ($property->property_purpose_id==1)
                            <div class="col-md-6 d-none period_box" >
                                <div class="form-group">
                                    <label for="period">{{ $websiteLang->where('lang_key','period')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="period" id="period" class="form-control">
                                        <option value="Daily">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</option>
                                        <option value="Monthly">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</option>
                                        <option value="Yearly">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if ($property->property_purpose_id==2)
                                <div class="col-md-6 period_box" >
                                    <div class="form-group">
                                        <label for="period">{{ $websiteLang->where('lang_key','period')->first()->custom_text }} <span class="text-danger">*</span></label>
                                        <select name="period" id="period" class="form-control">
                                            <option {{ $property->period=='Daily' ? 'selected' : '' }} value="Daily">{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</option>
                                            <option {{ $property->period=='Monthly' ? 'selected' : '' }} value="Monthly">{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</option>
                                            <option {{ $property->period=='Yearly' ? 'selected' : '' }} value="Yearly">{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
                            @endif


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
                                    <input type="text" name="area" value="{{ $property->area }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_unit')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="unit" value="{{ $property->number_of_unit }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_room')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="room" value="{{ $property->number_of_room }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_bedroom')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="bedroom" value="{{ $property->number_of_bedroom }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_bathroom')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="bathroom" value="{{ $property->number_of_bathroom }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_floor')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="number" name="floor" value="{{ $property->number_of_floor }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','total_kitchen')->first()->custom_text }} </label>
                                    <input type="number" name="kitchen" value="{{ $property->number_of_kitchen }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','parking_place')->first()->custom_text }}</label>
                                    <input type="number" name="parking" value="{{ $property->number_of_parking }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','slider_img')->first()->custom_text }} </h4>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-bordered">
                                    @foreach ($property->propertyImages as $item)
                                    <tr class="slider-tr-{{ $item->id }}">
                                        <td> <img class="property-slider-img" src="{{ asset($item->image) }}"  alt=""> </td>
                                        <td><a onclick="deleteSliderImg('{{ $item->id }}')" href="javascript:;" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a></td>
                                    </tr>
                                    @endforeach

                                </table>
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
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>{{ $websiteLang->where('lang_key','img_pdf_video')->first()->custom_text }}</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($property->file)
                                    <div class="form-group pdf-file-col-{{ $property->id }}">
                                        <label for="file">{{ $websiteLang->where('lang_key','exist_pdf')->first()->custom_text }} : </label>
                                        <div>
                                            <a href="{{ route('download-listing-file',$property->file) }}">{{ $property->file }}</a> <a onclick="deletePdfFile('{{ $property->id }}')" href="javascript:;" class="text-danger ml-3"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','pdf_file')->first()->custom_text }}</label>
                                    <input type="file" name="pdf_file" class="form-control-file">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','exist_banner_img')->first()->custom_text }}</label>
                                    <br>
                                    <img class="property-slider-img" src="{{ asset($property->banner_image) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','banner_img')->first()->custom_text }}</label>
                                    <input type="file" name="banner_image" class="form-control-file">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','exist_thumb')->first()->custom_text }}</label>
                                    <br>
                                    <img class="property-slider-img" src="{{ asset($property->thumbnail_image) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','thumb_img')->first()->custom_text }} </label>
                                    <input type="file" name="thumbnail_image" class="form-control-file">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if ($property->video_link)
                                    <div class="form-group">
                                        <label for="">{{ $websiteLang->where('lang_key','exist_video')->first()->custom_text }}</label>
                                        <br>
                                        @php
                                            $video_id=explode("=",$property->video_link);
                                        @endphp

                                        <iframe width="350" height="180"
                                        src="https://www.youtube.com/embed/{{ $video_id[1] }}">
                                        </iframe>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('lang_key','video_link')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="video_link" value="{{ $property->video_link }}">
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
                                            @php
                                                $isChecked=false;
                                            @endphp
                                            @foreach ($property->propertyAminities as $amnty)
                                                @if ($aminity->id==$amnty->aminity_id)
                                                    @php
                                                    $isChecked=true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input id="{{ $aminity->slug }}" {{ $isChecked ? 'checked' :'' }} value="{{ $aminity->id }}" type="checkbox" name="aminities[]" >
                                            <label class="mx-1" for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>
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
                                    @if ($property->propertyNearestLocations->count()>0)
                                        @foreach ($property->propertyNearestLocations as $property_item)
                                            <div class="row" id="exist-nearest-location-{{ $property_item->id }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{ $websiteLang->where('lang_key','nearest_loc')->first()->custom_text }}</label>
                                                        <select name="nearest_locations[]" id="" class="form-control">
                                                            <option value="">{{ $websiteLang->where('lang_key','select_nearest_loc')->first()->custom_text }}</option>
                                                            @foreach ($nearest_locatoins as $item)
                                                            <option {{ $property_item->nearest_location_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->location }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">{{ $websiteLang->where('lang_key','distance')->first()->custom_text }}({{ $websiteLang->where('lang_key','km')->first()->custom_text }})</label>
                                                        <input type="text" class="form-control" name="distances[]" value="{{ $property_item->distance }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button onclick="existNearestLocation('{{ $property_item->id }}')" type="button" class="btn btn-danger btn-sm nearest-row-btn"><i class="fas fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
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
                                    <textarea class="form-control" rows="5" name="google_map_embed_code">{{ $property->google_map_embed_code }}</textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <textarea class="summernote" id="description" name="description">{{ $property->description }}</textarea>
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
                                        <option {{ $property->status==1 ? 'selected' : '' }}  value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                        <option {{ $property->status==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="featured">{{ $websiteLang->where('lang_key','featured')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="featured" id="featured" class="form-control">
                                        <option {{ $property->is_featured==0 ? 'selected': '' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                        <option {{ $property->is_featured==1 ? 'selected': '' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="top_property">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}<span class="text-danger">*</span></label>
                                    <select name="top_property" id="top_property" class="form-control">
                                        <option {{ $property->top_property==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $property->top_property==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="urgent_property">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="urgent_property" id="urgent_property" class="form-control">
                                        <option {{ $property->urgent_property==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $property->urgent_property==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_title">{{ $websiteLang->where('lang_key','seo_title')->first()->custom_text }}</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ $property->seo_title }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_description">{{ $websiteLang->where('lang_key','seo_des')->first()->custom_text }}</label>
                                    <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control" >{{ $property->seo_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
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
                    $(".period_box").removeClass('d-none');
                }else if(purposeId==1){
                    $(".period_box").addClass('d-none');
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

        function deleteSliderImg(id){
            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            $.ajax({
                type: 'GET',
                url: "{{ url('admin/property-slider-img/') }}"+"/"+ id,
                success: function (response) {
                    if(response.success){
                        toastr.success(response.success)
                        $(".slider-tr-"+id).remove()
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        function deletePdfFile(id){

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            $.ajax({
                type: 'GET',
                url: "{{ url('admin/property-delete-pdf/') }}"+"/"+ id,
                success: function (response) {
                    if(response.success){
                        toastr.success(response.success)
                        $(".pdf-file-col-"+id).remove()
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }


        function existNearestLocation(id){
            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            $.ajax({
                type: 'GET',
                url: "{{ url('admin/exist-nearest-location/') }}"+"/"+ id,
                success: function (response) {
                    if(response.success){
                        toastr.success(response.success)
                        $("#exist-nearest-location-"+id).remove()
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    </script>

@endsection
