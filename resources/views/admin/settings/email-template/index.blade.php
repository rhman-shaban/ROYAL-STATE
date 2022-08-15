@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','email_template')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','email_template')->first()->custom_text }}</h6>
        </div>
        <div class="card-body" id="search-appointment">
            <div class="table-responsive printArea">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','email_template')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->name) }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>
                                <a  href="{{ route('admin.email-edit',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

