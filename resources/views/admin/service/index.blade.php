@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','services')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="#" data-toggle="modal" data-target="#addTestimonial" class="btn btn-success"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }} </a></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','service_table')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%" >{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="20%" >{{ $websiteLang->where('lang_key','title')->first()->custom_text }}</th>
                            <th width="10%" >{{ $websiteLang->where('lang_key','icon')->first()->custom_text }}</th>
                            <th width="30%" >{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</th>
                            <th width="10%" >{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th width="10%" >{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->title }}</td>
                            <td><i class="{{ $item->icon }}"></i></td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @if ($item->status==1)
                                    <a href="" onclick="testimonialStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="testimonialStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateFaq-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- create new testimonial Modal -->
    <div class="modal fade" id="addTestimonial" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('lang_key','service_form')->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                    <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ $websiteLang->where('lang_key','title')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('lang_key','icon')->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ old('icon') }}">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" cols="30">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('lang_key','close')->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

     <!-- update testimonial Modal -->
     @foreach ($services as $item)
    <div class="modal fade" id="updateFaq-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('lang_key','service_form')->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form action="{{ route('admin.service.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">{{ $websiteLang->where('lang_key','title')->first()->custom_text }}</label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ $item->title }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="icon">{{ $websiteLang->where('lang_key','icon')->first()->custom_text }}</label>
                                        <input type="text" class="form-control custom-icon-picker" id="icon" name="icon" value="{{ $item->icon }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" cols="30">{{ $item->description }}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option {{ $item->status==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                            <option {{ $item->status==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
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
            $("#deleteForm").attr("action",'{{ url("/admin/service/") }}'+"/"+id)
        }

        function testimonialStatus(id){
            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            $.ajax({
                type:"get",
                url:"{{url('/admin/service-status/')}}"+"/"+id,
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
