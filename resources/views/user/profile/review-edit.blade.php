@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','my_review')->first()->custom_text }}</title>
@endsection
@section('user-dashboard')

<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__blog_comment_area" id="comment">
            <div class="wsus__rite_comment">
                <form action="{{ route('user.update-review',$review->id) }}" method="POST">
                    @csrf
                    <h3>{{ $websiteLang->where('lang_key','update_review')->first()->custom_text }}</h3>
                    <hr>
                    <div class="wsus__select_rating">
                      <div class="wsus__rating_left">
                       <div class="wsus__single_review">
                           <span>{{ $websiteLang->where('lang_key','service_rat')->first()->custom_text }}</span>
                           @for ($i = 1; $i <=5; $i++)
                                @if ($i <= $review->service_rating)
                                <i class="service_rat fas fa-star" data-service_rating="{{ $i }}" onclick="serviceReview({{ $i }})"></i>
                                @else
                                <i class="service_rat fal fa-star" data-service_rating="{{ $i }}" onclick="serviceReview({{ $i }})"></i>
                                @endif

                           @endfor
                       </div>
                       <div class="wsus__single_review blue">
                           <span>{{ $websiteLang->where('lang_key','location')->first()->custom_text }}</span>

                           @for ($i = 1; $i <=5; $i++)
                                @if ($i <= $review->location_rating)
                                <i class="location_rat fas fa-star" data-location_rating="{{ $i }}" onclick="locationReview({{ $i }})"></i>
                                @else
                                <i class="location_rat fal fa-star" data-location_rating="{{ $i }}" onclick="locationReview({{ $i }})"></i>
                                @endif

                            @endfor
                       </div>
                       <div class="wsus__single_review orange">
                           <span>{{ $websiteLang->where('lang_key','value_for_money')->first()->custom_text }}</span>
                           @for ($i = 1; $i <=5; $i++)
                                @if ($i <= $review->money_rating)
                                <i class="money_rat fas fa-star" data-money_rating="{{ $i }}" onclick="moneyReview({{ $i }})"></i>
                                @else
                                <i class="money_rat fal fa-star" data-money_rating="{{ $i }}" onclick="moneyReview({{ $i }})"></i>
                                @endif

                            @endfor
                       </div>
                       <div class="wsus__single_review red">
                           <span>{{ $websiteLang->where('lang_key','clean_rat')->first()->custom_text }} </span>
                           @for ($i = 1; $i <=5; $i++)
                                @if ($i <= $review->clean_rating)
                                <i class="clean_rat fas fa-star" data-clean_rating="{{ $i }}" onclick="cleanReview({{ $i }})"></i>
                                @else
                                <i class="clean_rat fal fa-star" data-clean_rating="{{ $i }}" onclick="cleanReview({{ $i }})"></i>
                                @endif

                            @endfor
                       </div>
                       </div>
                       <div class="wsus__rating_right">
                        <h2 id="avg_rating">{{ $review->avarage_rating }}</h2>
                        <p>{{ $websiteLang->where('lang_key','avg_rat')->first()->custom_text }}</p>
                       </div>
                    </div>

                    <input type="hidden" name="service_rating" id="service_rating" value="{{ $review->service_rating }}">
                    <input type="hidden" name="location_rating" id="location_rating" value="{{ $review->location_rating }}">
                    <input type="hidden" name="money_rating" id="money_rating" value="{{ $review->money_rating }}">
                    <input type="hidden" name="clean_rating" id="clean_rating" value="{{ $review->clean_rating }}">
                    <input type="hidden" name="avarage_rating" id="avarage_rating" value="{{ $review->avarage_rating }}">
                    <input type="hidden" name="property_id" id="property_id" value="{{ $review->property->id }}">
                    <textarea cols="2" rows="3" name="comment">{{ $review->comment }}</textarea>
                    <button class="common_btn_2" type="submit"><i class="fas fa-external-link-alt"></i> {{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function serviceReview(rating){
        $("#service_rating").val(rating);
        $(".service_rat").each(function(){
            var service_rat=$(this).data('service_rating')
            if(service_rat > rating){
                $(this).removeClass('fas fa-star').addClass('fal fa-star');
            }else{
                $(this).removeClass('fal fa-star').addClass('fas fa-star');
            }
        })

        var service_rating=$("#service_rating").val();
        var location_rating=$("#location_rating").val();
        var money_rating=$("#money_rating").val();
        var clean_rating=$("#clean_rating").val();
        var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
        avg= avg/4;
        $("#avarage_rating").val(avg);
        $("#avg_rating").text(avg)
    }

    function locationReview(rating){

        $("#location_rating").val(rating);
        $(".location_rat").each(function(){
            var location_rat=$(this).data('location_rating')
            if(location_rat > rating){
                $(this).removeClass('fas fa-star').addClass('fal fa-star');
            }else{
                $(this).removeClass('fal fa-star').addClass('fas fa-star');
            }

        })


        var service_rating=$("#service_rating").val();
        var location_rating=$("#location_rating").val();
        var money_rating=$("#money_rating").val();
        var clean_rating=$("#clean_rating").val();
        var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
        avg= avg/4;
        $("#avarage_rating").val(avg);
        $("#avg_rating").text(avg)

    }

    function moneyReview(rating){
        $("#money_rating").val(rating);
        $(".money_rat").each(function(){
            var money_rat=$(this).data('money_rating')
            if(money_rat > rating){
                $(this).removeClass('fas fa-star').addClass('fal fa-star');
            }else{
                $(this).removeClass('fal fa-star').addClass('fas fa-star');
            }

        })

        var service_rating=$("#service_rating").val();
        var location_rating=$("#location_rating").val();
        var money_rating=$("#money_rating").val();
        var clean_rating=$("#clean_rating").val();
        var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
        avg= avg/4;
        $("#avarage_rating").val(avg);
        $("#avg_rating").text(avg)

    }

    function cleanReview(rating){

        $("#clean_rating").val(rating);
        $(".clean_rat").each(function(){
            var clean_rat=$(this).data('clean_rating')
            if(clean_rat > rating){
                $(this).removeClass('fas fa-star').addClass('fal fa-star');
            }else{
                $(this).removeClass('fal fa-star').addClass('fas fa-star');
            }

        })
        var service_rating=$("#service_rating").val();
        var location_rating=$("#location_rating").val();
        var money_rating=$("#money_rating").val();
        var clean_rating=$("#clean_rating").val();
        var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
        avg= avg/4;
        $("#avarage_rating").val(avg);
        $("#avg_rating").text(avg)
    }




</script>

@endsection
