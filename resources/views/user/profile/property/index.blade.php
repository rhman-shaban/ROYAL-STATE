@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','my_property')->first()->custom_text }}</title>
@endsection


@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <h4 class="heading">{{ $websiteLang->where('lang_key','my_property')->first()->custom_text }} <a href="{{ route('user.create.property') }}" class="btn btn-success custom-create-property"><i class="fas fa-plus    "></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }}</a></h4>
                <div class="wsus__my_property">
                    <div class="table-responsive">
                        <table class="table">
                            <tr class="d-flex">
                                <th class="image">
                                    <p>{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</p>
                                </th>

                                <th class="title">
                                    <p>{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</p>
                                </th>

                                <th class="add_date">
                                    <p>{{ $websiteLang->where('lang_key','purpose')->first()->custom_text }}</p>
                                </th>

                                <th class="view">
                                    <p>{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</p>
                                </th>

                                <th class="actions">
                                    <p>{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</p>
                                </th>

                            </tr>
                            @foreach ($properties as $item)
                            <tr class="d-flex">
                                <td class="image">
                                    <a href="{{ route('property.details',$item->slug) }}">
                                        <img   class="wishlist-image" src="{{ url($item->thumbnail_image) }}" alt="img" class="img-fluid">
                                    </a>
                                </td>

                                <td class="title custom_wishlist">
                                    <h5><a href="{{ route('property.details',$item->slug) }}">{{ $item->title }}</a></h5>
                                    <p class="address">{{ $item->address.', '.$item->city->name }}</p>

                                    @php
                                    $total_review=$item->reviews->where('status',1)->count();
                                    if($total_review > 0){
                                        $avg_sum=$item->reviews->where('status',1)->sum('avarage_rating');


                                        $avg=$avg_sum/$total_review;
                                        $intAvg=intval($avg);
                                        $nextVal=$intAvg+1;
                                        $reviewPoint=$intAvg;
                                        $halfReview=false;
                                        if($intAvg < $avg && $avg < $nextVal){
                                            $reviewPoint= $intAvg + 0.5;
                                            $halfReview=true;
                                        }

                                    }
                                @endphp



                                @if ($total_review > 0)
                                <p>
                                    <span>{{ sprintf("%.1f", $reviewPoint) }}</span>
                                    @for ($i = 1; $i <=5; $i++)
                                        @if ($i <= $reviewPoint)
                                            <i class="fas fa-star"></i>
                                        @elseif ($i> $reviewPoint )
                                            @if ($halfReview==true)
                                            <i class="fas fa-star-half-alt"></i>
                                                @php
                                                    $halfReview=false
                                                @endphp
                                            @else
                                            <i class="fal fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                    <span>({{ $total_review }} {{ $websiteLang->where('lang_key','review')->first()->custom_text }})</span>
                                </p>
                                @else
                                    <p>
                                        <span>0.0</span>
                                        @for ($i = 1; $i <=5; $i++)
                                        <i class="fal fa-star"></i>
                                        @endfor
                                        <span>({{ 0 }} {{ $websiteLang->where('lang_key','review')->first()->custom_text }})</span>
                                    </p>
                                @endif

                                </td>

                                <td class="add_date">
                                    <p>{{ $item->propertyPurpose->custom_purpose }}</p>
                                </td>

                                <td class="view">
                                    <p>
                                        @if ($item->status==1)
                                            @if ($item->expired_date==null)
                                            <span class="custom-badge">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</span>
                                            @elseif($item->expired_date >= date('Y-m-d'))
                                            <span class="custom-badge">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</span>
                                            @else
                                            <span class="custom-error-badge">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</span>
                                            @endif
                                        @else
                                        <span class="custom-error-badge">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</span>
                                        @endif

                                    </p>
                                </td>

                                <td class="actions">
                                    <a href="{{ route('property.details',$item->slug) }}" ><i class="far fa-eye"></i></a>
                                    <a href="{{ route('user.property.edit',$item->id) }}"><i class="far fa-edit"></i></a>
                                    <a  href="{{ route('user.property.delete',$item->id) }}" onclick="return confirm('are you sure?')" ><i class="far fa-trash-alt    "></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>


                    </div>

                    {{ $properties->links() }}
                </div>
        </div>
    </div>
</div>
@endsection
