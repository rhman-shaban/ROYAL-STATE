@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','email_template')->first()->custom_text }}</title>
@endsection
@section('admin-content')
@if ($setting->text_direction=='RTL')
<a href="{{ route('admin.email.template') }}" class="btn btn-success mb-2"><i class="fas fa-forward" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','go_back')->first()->custom_text }}</a>
@else
<a href="{{ route('admin.email.template') }}" class="btn btn-success mb-2"><i class="fas fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','go_back')->first()->custom_text }}</a>
@endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">'{{ ucfirst($email->name) }}' {{ $websiteLang->where('lang_key','email_template')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>{{ $websiteLang->where('lang_key','variable')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}</th>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $name="{{user_name}}";
                                @endphp
                                <td>{{ $name }}</td>
                                <td>{{ $websiteLang->where('lang_key','user_name')->first()->custom_text }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">

                    <form action="{{ route('admin.email.update',$email->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','subject')->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $email->subject }}" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','des')->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea name="description" cols="30" rows="10" class="form-control summernote">{{ $email->description }}</textarea>

                        </div>

                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

