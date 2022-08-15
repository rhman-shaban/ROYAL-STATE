@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','my_review')->first()->custom_text }}</title>
@endsection
@section('user-dashboard')

<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <h4 class="heading">{{ $websiteLang->where('lang_key','my_review')->first()->custom_text }}</h4>
            <div class="wsus__message">
                @foreach ($myReviews as $item)
                <div class="wsus__message_single">
                    <div class="wsus__message_img">
                        <a href="{{ route('property.details',$item->property->slug) }}">
                            <img src="{{ url($item->property->thumbnail_image) }}" alt="img">
                        </a>

                    </div>
                    <div class="wsus__message_text">
                        <h6><a href="{{ route('property.details',$item->property->slug) }}">{{ $item->property->title }}</a></h6>
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                        <p>{{ $item->comment }}</p>

                        @php
                            $avg=$item->avarage_rating;
                            $intAvg=intval($avg);
                            $nextVal=$intAvg+1;
                            $reviewPoint=$intAvg;
                            $halfReview=false;
                            if($intAvg < $avg && $avg < $nextVal){
                                $reviewPoint= $intAvg + 0.5;
                                $halfReview=true;
                            }
                        @endphp

                        <p>
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
                        </p>
                    </div>
                    <div class="wsus__message_icon">
                        <span><a href="{{ route('user.delete-review',$item->id) }}" onclick="return confirm('{{ $websiteLang->where('lang_key','are_you_sure')->first()->custom_text }}')"><i class="far fa-trash-alt"></i></a></span>
                        <span><a href="{{ route('user.edit-review',$item->id) }}"><i class="far fa-edit"></i></a></span>
                    </div>
                </div>
                @endforeach

                <div class="mt-5">
                    {{ $myReviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
