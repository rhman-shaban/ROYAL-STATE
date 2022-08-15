@extends('layouts.admin.layout')
@section('title')
<title>{{  $websiteLang->where('lang_key','terms_cond')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{  $websiteLang->where('lang_key','terms_cond')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.terms-privacy.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="terms_condition">{{  $websiteLang->where('lang_key','terms_cond')->first()->custom_text }}</label>
                            <textarea class="summernote" id="terms_condition" name="terms_condition"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="privacy_policy">{{  $websiteLang->where('lang_key','privacy_policy')->first()->custom_text }}</label>
                            <textarea class="summernote" id="privacy_policy" name="privacy_policy"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">{{  $websiteLang->where('lang_key','save')->first()->custom_text }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
