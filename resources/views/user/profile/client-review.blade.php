@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','client_review')->first()->custom_text }}</title>
@endsection
@section('user-dashboard')

<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <h4 class="heading">{{ $websiteLang->where('lang_key','client_review')->first()->custom_text }}</h4>
            <div class="wsus__message">
                @foreach ($clientReviews as $item)
                <div class="wsus__message_single">
                    <div class="wsus__message_img">
                        <a href="{{ route('agent.show',['user_type' => '2','user_name'=>$item->user_slug]) }}">
                            <img src="{{ $item->user_image ? url($item->user_image) : url($agent_default_profile->image) }}" alt="img">
                        </a>

                    </div>
                    <div class="wsus__message_text">
                        <h6><a href="{{ route('agent.show',['user_type' => '2','user_name'=>$item->user_slug]) }}">{{ $item->name }}</a></h6>
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                        <h5 class="pb-2"><a href="{{ route('property.details',$item->slug) }}">{{ $item->title }}</a></h5>
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
                        <span><a href="{{ route('property.details',$item->slug) }}"><i class="far fa-eye"></i></a></span>
                    </div>
                </div>
                @endforeach

                <div class="mt-5">
                    {{ $clientReviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
