@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','contact_msg')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','contact_msg')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#viewMessage-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>

                                <a href="{{ route('admin.delete-contact-message',$item->id) }}" onclick="return confirm('{{ $websiteLang->where('lang_key','are_you_sure')->first()->custom_text }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @foreach ($messages as $item)
    <!-- Modal -->
    <div class="modal fade" id="viewMessage-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('lang_key','msg_from')->first()->custom_text }} {{ $item->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {{ $item->message }}
                    </div>
                </div>

            </div>
        </div>
    </div>


    @endforeach
@endsection
