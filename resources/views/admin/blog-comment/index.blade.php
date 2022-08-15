@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','blog_comment')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','blog_comment')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</th>
                            <th width="40%">{{ $websiteLang->where('lang_key','comment')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','blog')->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->comment }}</td>
                            <td><a target="_blank" href="{{ url('blog-details/'.$item->blog->slug) }}">{{ $websiteLang->where('lang_key','view')->first()->custom_text }}</a></td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="commentStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="commentStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.delete.blog.comment',$item->id) }}"  class="btn btn-danger btn-sm" onclick="return confirm('{{ $confirmNotify }}')"><i class="fas fa-trash    "></i></a>


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
            $("#deleteForm").attr("action",'{{ url("admin/blog/") }}'+"/"+id)
        }

        function commentStatus(id){
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
                url:"{{url('/admin/blog-comment-status/')}}"+"/"+id,
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
