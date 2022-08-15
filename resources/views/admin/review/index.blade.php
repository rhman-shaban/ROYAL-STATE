@extends('layouts.admin.layout')
@section('title')
<title>{{  $websiteLang->where('lang_key','review')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{  $websiteLang->where('lang_key','review_table')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{  $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="15%">{{  $websiteLang->where('lang_key','name')->first()->custom_text }}</th>
                            <th width="25%">{{  $websiteLang->where('lang_key','comment')->first()->custom_text }}</th>
                            <th width="20%">{{  $websiteLang->where('lang_key','rating')->first()->custom_text }}</th>
                            <th width="20%">{{  $websiteLang->where('lang_key','property')->first()->custom_text }}</th>
                            <th width="15%">{{  $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th width="5%">{{  $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td><a href="{{ route('agent.show',['user_type' => '2','user_name'=>$item->user->slug]) }}">{{ $item->user->name }}</a></td>
                            <td>{{ $item->comment }}</td>
                            <td>
                                {{  $websiteLang->where('lang_key','service_rat')->first()->custom_text }}= {{ $item->service_rating }} <i class="fas fa-star" aria-hidden="true"></i>
                                <br>
                                {{  $websiteLang->where('lang_key','location_rat')->first()->custom_text }}= {{ $item->location_rating }} <i class="fas fa-star" aria-hidden="true"></i>
                                <br>
                                {{  $websiteLang->where('lang_key','value_rat')->first()->custom_text }}= {{ $item->money_rating }} <i class="fas fa-star" aria-hidden="true"></i>
                                <br>
                                {{  $websiteLang->where('lang_key','clean_rat')->first()->custom_text }}= {{ $item->clean_rating }} <i class="fas fa-star" aria-hidden="true"></i>
                                <br>
                                {{  $websiteLang->where('lang_key','avg')->first()->custom_text }}= {{ $item->avarage_rating }} <i class="fas fa-star" aria-hidden="true"></i>
                            </td>
                            <td><a target="_blank" href="{{ route('property.details',$item->property->slug) }}">{{ $item->property->title }}</a></td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="reviewStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="reviewStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{  $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.review.delete',$item->id) }}" onclick="return confirm('{{ $confirmNotify }}')"class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        function reviewStatus(id){

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
                url:"{{url('/admin/review-status/')}}"+"/"+id,
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

