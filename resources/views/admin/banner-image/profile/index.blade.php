@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','default_profile_img')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','default_profile_img')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        @foreach ($images as $image)
                        <tr>
                            <form action="{{ route('admin.update-profile-image',$image->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $image->location }}</td>
                            <td><img width="100px" src="{{ $image->image ? url($image->image) :'' }}" alt=""></td>
                            <td><input type="file" class="form-control" name="image" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                            </td>
                        </form>
                        </tr>

                        @endforeach


                    </table>

                </div>
            </div>
        </div>
    </div>




@endsection
