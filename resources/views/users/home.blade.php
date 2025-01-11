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

    
@endsection