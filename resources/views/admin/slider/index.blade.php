@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','banner_section')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','banner_section')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
           <form action="{{ route('admin.banner.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="">{{ $websiteLang->where('lang_key','exist_banner_img')->first()->custom_text }}</label>
                <div class="my-2">
                    <img src="{{ $slider->image ? url($slider->image) : '' }}" alt="banner image" width="300px">
                </div>

                <label for="">{{ $websiteLang->where('lang_key','new_img')->first()->custom_text }}</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','header')->first()->custom_text }}</label>
                        <input type="text" name="header" value="{{ $slider->header }}" class="form-control">
                    </div>
                </div>
            </div>

            <button class="btn btn-success" type="submit">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>

           </form>
        </div>
    </div>


@endsection
