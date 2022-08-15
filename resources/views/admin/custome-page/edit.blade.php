@extends('layouts.admin.layout')
@section('title')
<title>{{  $websiteLang->where('lang_key','custom_page')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.custom-page.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','all_custom_page')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','custom_page_form')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.custom-page.update',$page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="page_name">{{ $websiteLang->where('lang_key','page_name')->first()->custom_text }}</label>
                            <input type="text" name="page_name" class="form-control" id="page_name" value="{{ $page->page_name }}">
                        </div>

                        <div class="form-group">
                            <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                            <textarea class="summernote" id="description" name="description">{{ $page->description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $page->status==1?'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                        <option {{ $page->status==0?'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_title">{{ $websiteLang->where('lang_key','seo_title')->first()->custom_text }}</label>
                            <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ $page->seo_title }}">
                        </div>
                        <div class="form-group">
                            <label for="seo_description">{{ $websiteLang->where('lang_key','seo_des')->first()->custom_text }}</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control">{{ $page->seo_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
