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
                        <h4>{{ $menus->where('id',17)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                                <li class="breadcrumb-item"><a>{{ $menus->where('id',17)->first()->navbar }}</a></li>
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


    <!--============================
        FAQS PART START
    ==============================-->
    <section id="wsus__faqs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__faq_accordian">
                        <div id="wsus__accordian">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($faqs as $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading-{{ $item->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $item->id }}" aria-expanded="false" aria-controls="flush-collapse-{{ $item->id }}">
                                            {{ $item->question }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $item->id }}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p>{{ $item->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        FAQS PART END
    ==============================-->

@endsection
