@extends('layouts.user.layout')
@section('title')
<title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
    <!--============================
          BREADCRUMB PART START
    ==============================-->
    <section id="wsus__breadcrumb" style="background-image:url({{ url($banner_image->image) }})">
        <div class="wsus_bread_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ $menus->where('id',6)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>


                                <li class="breadcrumb-item"><a>{{ $menus->where('id',6)->first()->navbar }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          BREADCRUMB PART END
    ==============================-->
    <section id="wsus__blog">
        <div class="container">
            <div class="row">
                @foreach ($agents as $agent)
                    @php
                        $isOrder=$orders->where('user_id',$agent->id)->count();
                    @endphp
                    @if ($isOrder >0)
                        <div class="col-sm-6 col-lg-3 col-xl-3">
                            <div class="wsus__single_agents">
                                <div class="wsus__single_agents_img">
                                    <a href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}"><img src="{{ $agent->image ? url($agent->image) : url($default_profile_image->image) }}" alt="team" class="img-fluid w-100"></a>
                                </div>
                                @php
                                    $isSocialNull=true;
                                    if($agent->icon_one && $agent->link_one){
                                        $isSocialNull=false;
                                    }else if($agent->icon_two && $agent->link_two){
                                        $isSocialNull=false;
                                    }else if($agent->icon_three && $agent->link_three){
                                        $isSocialNull=false;
                                    }else if($agent->icon_four && $agent->link_four){
                                        $isSocialNull=false;
                                    }

                                @endphp
                            <ul class="{{ $isSocialNull ? 'remove_padding' : '' }} ">
                                @if ($agent->icon_one && $agent->link_one)
                                <li><a href="{{ $agent->link_one }}"><i class="{{ $agent->icon_one }}"></i></a></li>
                                @endif

                                @if ($agent->icon_two && $agent->link_two)
                                <li><a href="{{ $agent->link_two }}"><i class="{{ $agent->icon_two }}"></i></a></li>
                                @endif

                                @if ($agent->icon_three && $agent->link_three)
                                <li><a href="{{ $agent->link_three }}"><i class="{{ $agent->icon_three }}"></i></a></li>
                                @endif

                                @if ($agent->icon_four && $agent->link_four)
                                <li><a href="{{ $agent->link_four }}"><i class="{{ $agent->icon_four }}"></i></a></li>
                                @endif
                            </ul>
                                <h5><a class="agent_name" href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}">{{ $agent->name }}</a></h5>
                                <p><i class="fal fa-map-marker-alt"></i> {{ $agent->address }}</p>
                                <div class="wsus__agent_button ">
                                    <a class="common_btn_2" href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}"><i class="fas fa-eye"></i> {{ $websiteLang->where('lang_key','view_profile')->first()->custom_text }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row">

                {{ $agents->links('user.paginator') }}
            </div>
        </div>
    </section>


@endsection
