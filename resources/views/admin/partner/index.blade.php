@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','partner')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="#" data-toggle="modal" data-target="#createFeature" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','partner_table')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('lang_key','designation')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td><img width="120px" src="{{ url($item->image) }}" alt="blog image"></td>
                            <td>{{ $item->designation }}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="partnerStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="partnerStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateFeature-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit  "></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- create feature Modal -->
    <div class="modal fade" id="createFeature" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('lang_key','partner_form')->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                    <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="image">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                        </div>

                        <div class="form-group">
                            <label for="name">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="designation">{{ $websiteLang->where('lang_key','designation')->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="designation" id="designation">
                        </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_icon">{{ $websiteLang->where('lang_key','first_icon')->first()->custom_text }}</label>
                                <input type="text" name="first_icon" class="form-control custom-icon-picker" id="first_icon" value="{{ old('first_icon') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_link">{{ $websiteLang->where('lang_key','first_link')->first()->custom_text }}</label>
                                <input type="text" name="first_link" class="form-control" id="first_link" value="{{ old('first_link') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="second_icon">{{ $websiteLang->where('lang_key','second_icon')->first()->custom_text }}</label>
                                <input type="text" name="second_icon" class="form-control custom-icon-picker" id="second_icon" value="{{ old('second_icon') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="second_link">{{ $websiteLang->where('lang_key','second_link')->first()->custom_text }}</label>
                                <input type="text" name="second_link" class="form-control" id="second_link" value="{{ old('second_link') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="third_icon">{{ $websiteLang->where('lang_key','third_icon')->first()->custom_text }}</label>
                                <input type="text" name="third_icon" class="form-control custom-icon-picker" id="third_icon" value="{{ old('third_icon') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="third_link">{{ $websiteLang->where('lang_key','third_link')->first()->custom_text }}</label>
                                <input type="text" name="third_link" class="form-control" id="third_link" value="{{ old('third_link') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="four_icon">{{ $websiteLang->where('lang_key','four_icon')->first()->custom_text }}</label>
                                <input type="text" name="four_icon" class="form-control custom-icon-picker" id="four_icon" value="{{ old('four_icon') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="four_link">{{ $websiteLang->where('lang_key','four_link')->first()->custom_text }}</label>
                                <input type="text" name="four_link" class="form-control" id="four_link" value="{{ old('four_link') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                            <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                        </select>
                    </div>


                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('lang_key','close')->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- create feature Modal -->
    @foreach ($partners as $item)
        <div class="modal fade" id="updateFeature-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $websiteLang->where('lang_key','partner_form')->first()->custom_text }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('admin.partner.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="image">{{ $websiteLang->where('lang_key','exist_img')->first()->custom_text }}</label>
                                    <div class="my-2">
                                        <img src="{{ url($item->image) }}" alt="partner image" width="100px">
                                    </div>
                                    <label for="image">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                                    <input type="file" class="form-control-file" name="image" id="image">
                                </div>


                                <div class="form-group">
                                    <label for="name">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="designation">{{ $websiteLang->where('lang_key','designation')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="designation" id="designation" value="{{ $item->designation }}">
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_icon">{{ $websiteLang->where('lang_key','first_icon')->first()->custom_text }}</label>
                                            <input type="text" name="first_icon" class="form-control custom-icon-picker" id="first_icon" value="{{ $item->first_icon }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_link">{{ $websiteLang->where('lang_key','first_link')->first()->custom_text }}</label>
                                            <input type="text" name="first_link" class="form-control" id="first_link" value="{{ $item->first_link }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="second_icon">{{ $websiteLang->where('lang_key','second_icon')->first()->custom_text }}</label>
                                            <input type="text" name="second_icon" class="form-control custom-icon-picker" id="second_icon" value="{{ $item->second_icon }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="second_link">{{ $websiteLang->where('lang_key','second_link')->first()->custom_text }}</label>
                                            <input type="text" name="second_link" class="form-control" id="second_link" value="{{ $item->second_link }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="third_icon">{{ $websiteLang->where('lang_key','third_icon')->first()->custom_text }}</label>
                                            <input type="text" name="third_icon" class="form-control custom-icon-picker" id="third_icon" value="{{ $item->third_icon }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="third_link">{{ $websiteLang->where('lang_key','third_link')->first()->custom_text }}</label>
                                            <input type="text" name="third_link" class="form-control" id="third_link" value="{{ $item->third_link }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="four_icon">{{ $websiteLang->where('lang_key','four_icon')->first()->custom_text }}</label>
                                            <input type="text" name="four_icon" class="form-control custom-icon-picker" id="four_icon" value="{{ $item->four_icon }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="four_link">{{ $websiteLang->where('lang_key','four_link')->first()->custom_text }}</label>
                                            <input type="text" name="four_link" class="form-control" id="four_link" value="{{ $item->four_link }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $item->status==1 ? 'selected' : '' }} value="1">{{$websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $item->status==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>


                                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('lang_key','close')->first()->custom_text }}</button>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/partner/") }}'+"/"+id)
        }

        function partnerStatus(id){
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
                url:"{{url('/admin/partner-status/')}}"+"/"+id,
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
