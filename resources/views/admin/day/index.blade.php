@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',132)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',397)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th >{{ $websiteLang->where('id',399)->first()->custom_text }}</th>
                            <th >{{ $websiteLang->where('id',400)->first()->custom_text }}</th>
                            <th >{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->day }}</td>
                            <td>{{ $item->custom_day }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#edit-day-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @foreach ($days as $item)
    <!-- Modal -->
    <div class="modal fade" id="edit-day-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('id',398)->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.day.update',$item->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('id',399)->first()->custom_text }}</label>
                                <input type="text" value="{{ $item->day }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('id',400)->first()->custom_text }}</label>
                                <input type="text" value="{{ $item->custom_day }}" name="custom_day" class="form-control" required>

                            </div>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-primary">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
