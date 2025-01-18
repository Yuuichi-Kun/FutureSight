@extends('layouts.user')

@section('title', 'Home - Otakuspace')

@section('content')
    <section class="home" id="home">
        <div class="container home-wrapper">
            <div class="content-left" data-aos="fade-right">
                <h1 class="heading">Meet Your Favorite Character Being Cosplayed In Any <span>Convention</span></h1>
                <p class="subheading">We have partners with several conventions that you
                    might feel at home there, we will guide you with our best service.</p>
                
                
                
            </div>
            <div class="content-right" data-aos="fade-left">
                <div class="img-wrapper">
                    <img src="{{ asset('img/Animek.png') }}" alt="Anime character">
                </div>
            </div>
        </div>
    </section>

    <section class="statistic">
    <div class="container statistic-wrapper">
        <div class="content-img" data-aos="fade-right" data-aos-offset="500" data-aos-duration="500">
            <img src="{{ asset('img/Content-Animek.png') }}" alt="Statistics Image">
        </div>
        <div class="content-statis" data-aos="fade-left">
            <p class="label-statis">OUR PERFORMANCE</p>
            <h1 class="heading-statis">Most people are satisfied with our service</h1>
            <p class="subheading-statis"></p>

            <div class="number-wrapper">
                
                <div class="box-angka">
                    <h1></h1>
                    <p></p>
                </div>
                
            </div>
        </div>
    </div>
</section>

    <section class="testi">
    <div class="container testimoni-wrapper">
        <div class="col-heading" data-aos="fade-down-right" data-aos-duration="3000">
            <p class="label-testimoni">WHAT THEY SAID ?</p>
            <h1 class="heading-testimoni">What customers say about their experience with us</h1>
            <p class="subheading testimoni"></p>
        </div>
        <div class="col-slider-testimoni" data-aos="fade-up-left" data-aos-duration="3000">
            <div class="swiper mySwiperTestimoni">
                <div class="swiper-wrapper">
                    <div class="swiper-slide card-testimoni">
                    @auth
                        @if(Auth::user()->avatar)
                            <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; object-fit:cover;">
                        @else
                            <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
                        @endif
                    @else
                        <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
                    @endauth
                        <div class="text-testimoni">
                            <i class='bx bxs-quote-left'></i>
                            <p></p>
                            <i class='bx bxs-quote-right'></i>
                        </div>
                        <p class="username">by </p>
                        <p class="status"></p>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
    
@endsection