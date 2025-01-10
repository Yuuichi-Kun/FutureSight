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
                    @if(Auth::user()->avatar)
                        <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; object-fit:cover;">
                    @else
                        <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
                    @endif
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