@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="javascript:;" data-toggle="modal" data-target="#newLocation" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aminities as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->aminity }}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="aminityStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                            @else
                                <a href="" onclick="aminityStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                            @endif
                            </td>
                            <td>
                                <a href="javascript:;" data-toggle="modal" data-target="#updateLocation-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>

                                @if ($item->propertyAminities->count()==0)
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                                @endif




                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Location Modal -->
    <div class="modal fade" id="newLocation" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('lang_key','aminity_form')->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form action="{{ route('admin.aminity.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="aminity">{{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="aminity" id="aminity" value="{{ old('aminity') }}">
                            </div>

                            <div class="form-group">
                                <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('lang_key','close')->first()->custom_text }}</button>
                    <button type="submit" class="btn btn-primary">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- update Location Modal -->
    @foreach ($aminities as $item)
        <div class="modal fade" id="updateLocation-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $websiteLang->where('lang_key','aminity_form')->first()->custom_text }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('admin.aminity.update',$item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="aminity">{{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="aminity" id="aminity" value="{{ $item->aminity }}">
                                </div>

                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $item->status==1 ? 'selected' :'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                        <option {{ $item->status==0 ? 'selected' :'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('lang_key','close')->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-primary">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endforeach



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/aminity/") }}'+"/"+id)
        }

        function aminityStatus(id){

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            $.ajax({
                type:"get",
                url:"{{url('/admin/aminity-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection
