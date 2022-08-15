@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','admin')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.admin-list.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','all_admin')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','admin')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.admin-list.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                         <div class="form-group">
                            <label for="password">{{ $websiteLang->where('lang_key','pass')->first()->custom_text }}</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <div class="form-group">
                            <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                <option value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
