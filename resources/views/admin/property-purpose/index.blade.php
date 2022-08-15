@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','property_purpose')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','property_purpose')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','purpose')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purposes as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->custom_purpose }}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="locationStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                            @else
                                <a href="" onclick="locationStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                            @endif
                            </td>
                            <td>
                                <a href="javascript:;" data-toggle="modal" data-target="#updateCountry-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- update Location Modal -->
    @foreach ($purposes as $item)
        <div class="modal fade" id="updateCountry-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $websiteLang->where('lang_key','purpose_form')->first()->custom_text }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('admin.property-purpose.update',$item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="form-group">
                                    <label >{{ $websiteLang->where('lang_key','default_purpose')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" readonly value="{{ $item->purpose }}">
                                </div>

                                <div class="form-group">
                                    <label for="purpose">{{ $websiteLang->where('lang_key','purpose')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="purpose" id="purpose" value="{{ $item->custom_purpose }}">
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


        function locationStatus(id){

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
                url:"{{url('/admin/property-purpose-status/')}}"+"/"+id,
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
