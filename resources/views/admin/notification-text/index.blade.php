@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','notify_language')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','notify_language')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.notification.text') }}" method="post">
                    @csrf
                    <table class="table table-bordered">

                        @foreach ($notifications as $notification)
                        <tr>
                            <td width="50%">{{ ucwords($notification->default_text) }}</td>
                            <td width="50%"><input type="text" name="customs[]" value="{{ $notification->custom_text }}" class="form-control"></td>
                            <input type="hidden" value="{{ $notification->id }}" name="ids[]">
                            <input type="hidden" value="{{ $notification->default_text }}" name="defaults[]">
                        </tr>
                        @endforeach
                    </table>
                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
