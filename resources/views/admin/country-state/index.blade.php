@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','state')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.country-state.create') }}"  class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','state_table')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','state')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','country')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($states as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->country->name }}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="stateStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                            @else
                                <a href="" onclick="stateStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                            @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.country-state.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
                                @if ($item->cities->count()==0)
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



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/country-state/") }}'+"/"+id)
        }

        function stateStatus(id){

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
                url:"{{url('/admin/country-state-status/')}}"+"/"+id,
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
