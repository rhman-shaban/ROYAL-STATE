@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','menu_section')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','menu_section')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.menu-update') }}" method="POST">
                        @csrf
                    <table class="table table-bordered">
                        @foreach ($navigations as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td><input type="text" class="form-control" name="navbars[]" value="{{ $item->navbar }}"></td>
                                <input type="hidden" value="{{ $item->id }}" name="ids[]">
                                <input type="hidden" value="{{ $item->name }}" name="names[]">
                                <td>
                                    @if ($item->status==1)
                                <a href="" onclick="menuStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="menuStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>


<script>
    function menuStatus(id){
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
                url:"{{url('/admin/menu-status/')}}"+"/"+id,
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
