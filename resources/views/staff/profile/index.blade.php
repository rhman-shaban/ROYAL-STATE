@extends('layouts.staff.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</title>
@endsection
@section('staff-content')
       <!-- DataTales Example -->
       <div class="row">
           <div class="col-md-6">
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</h6>
                   </div>
                   <div class="card-body">
                    <form action="{{ route('staff.update.profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','exist_img')->first()->custom_text }}</label>
                            <br>
                            @if ($admin->image)
                            <img class="img-thumbnail ml-3" src="{{ $admin->image ? url($admin->image) : '' }}" alt="default user image" width="100px">
                            <input type="hidden" name="old_image" value="{{ $admin->image }}">
                            @else
                            <img class="img-thumbnail ml-3" src="{{ $default_profile->image ? url($default_profile->image) : '' }}" alt="default user image" width="100px">
                            <input type="hidden" name="old_image" value="default-user.jpg">
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','new_img')->first()->custom_text }}</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                            <input type="text" class="form-control" value="{{ ucfirst($admin->name) }}" name="name">

                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</label>
                            <input type="text" class="form-control" value="{{ $admin->email }}" name="email">

                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','pass')->first()->custom_text }}</label>
                            <input  type="password" class="form-control" name="password">

                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','confirm_pass')->first()->custom_text }}</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                   </div>
               </div>
           </div>
       </div>
@endsection
