@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',163)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',163)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.preloader.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',126)->first()->custom_text }}</label>
                                    @if ($setting->preloader_image)
                                    <img src="{{ url($setting->preloader_image) }}" alt="preloader icon" width="100px">
                                    @else
                                    <img src="" alt="preloader icon">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',204)->first()->custom_text }}</label>
                            <input type="file" name="preloader_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',204)->first()->custom_text }}</label>
                            <select name="preloader" id="" class="form-control">
                                <option {{ $setting->preloader==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                <option {{ $setting->preloader==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
