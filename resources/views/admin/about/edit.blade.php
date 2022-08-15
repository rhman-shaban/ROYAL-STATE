@extends('layouts.admin.layout')
@section('title')
<title>{{  $websiteLang->where('lang_key','about_us')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.about.update',$about->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{  $websiteLang->where('lang_key','exist_img')->first()->custom_text }}</label>
                                    <div><img class="w_200" src="{{ $about->image ? url($about->image) : '' }}" alt=""></div>

                                </div>
                                <div class="form-group">
                                    <label for="">{{  $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                                    <div><input type="file" name="image" class="form-control-file"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="about">{{  $websiteLang->where('lang_key','about')->first()->custom_text }}</label>
                            <textarea name="about" id="about" class="summernote">{{ $about->about }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="service">{{  $websiteLang->where('lang_key','service')->first()->custom_text }}</label>
                            <textarea name="service" id="service" class="summernote">{{ $about->service }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="history">{{  $websiteLang->where('lang_key','history')->first()->custom_text }}</label>
                            <textarea name="history" id="history" class="summernote">{{ $about->history }}</textarea>
                        </div>




                        <button class="btn btn-success" type="submit">{{  $websiteLang->where('lang_key','update')->first()->custom_text }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

