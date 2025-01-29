@extends('front.master')

@section('title', 'Homepage')

@section('content')



@if (app()->currentLocale() == 'ar')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');

            #men .item .down-content ul.stars {
                    position: absolute;
                    right:70% ;
                    top: 30px;

                }
        </style>
    @endif
    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>We Are Trove Shope</h4>
                                <span>Awesome, clean &amp; creative HTML5 Template</span>
                                <div class="main-border-button">
                                    <a href="{{ route('front.products') }}">Purchase Now!</a>
                                </div>
                            </div>
                            <img   src="{{ asset('assets/images/img-leftRe.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            @foreach ($categories as $category)
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>{{ $category->trans_name }}</h4>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>{{ $category->trans_name }}</h4>
                                                <p>{{ $category->trans_description }}</p>
                                                <div class="main-border-button">
                                                    <a href="{{ route('front.category', $category->id) }}">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{ asset('images/'.$category->image->path) }}">
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
    <!-- ***** Main Banner Area End ***** -->

    @foreach ($categories as $category)
        <!-- ***** Men Area Starts ***** -->
        <section class="section" id="men">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-heading">
                            <h2>{{ $category->trans_name }}</h2>
                            <span>{{ $category->trans_description }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="men-item-carousel">
                            <div class="owl-men-item owl-carousel">
                                @foreach ($category->products()->latest('id')->limit(5)->get() as $item)
                                @include('front.parts.item', ['product' => $item])
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Men Area Ends ***** -->
    @endforeach

@endsection
