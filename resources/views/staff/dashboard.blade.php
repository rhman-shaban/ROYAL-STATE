@extends('layouts.staff.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</title>
@endsection
@section('staff-content')
 <!-- Page Heading -->
 <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('staff.property.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }}</a></h1>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">{{  $websiteLang->where('lang_key','property_table')->first()->custom_text }}</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th width="5%">{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                         <th width="25%">{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</th>
                         <th width="10%">{{ $websiteLang->where('lang_key','price')->first()->custom_text }}</th>
                         <th width="15%">{{ $websiteLang->where('lang_key','type')->first()->custom_text }}</th>
                         <th width="10%">{{ $websiteLang->where('lang_key','purpose')->first()->custom_text }}</th>
                         <th width="10%">{{ $websiteLang->where('lang_key','views')->first()->custom_text }}</th>
                         <th width="10%">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                         <th width="15%">{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($properties as $index => $item)
                     <tr>
                         <td>{{ ++$index }}</td>
                         <td>{{ $item->title }}</td>
                         <td>{{ $settings->currency_icon }}{{ $item->price }}</td>
                         <td>{{ $item->propertyType->type }}</td>
                         <td>{{ $item->propertyPurpose->custom_purpose }}</td>
                         <td>{{ $item->views }}</td>
                         <td>
                             @if ($item->status==1)
                             <a href="" onclick="propertyStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                             @else
                                 <a href="" onclick="propertyStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                             @endif
                         </td>
                         <td>
                             <a target="_blank" href="{{ route('property.details',$item->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                             <a href="{{ route('staff.property.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                             <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>



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
         $("#deleteForm").attr("action",'{{ url("staff/property/") }}'+"/"+id)
     }

     function propertyStatus(id){
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
             url:"{{url('/staff/property-status/')}}"+"/"+id,
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
