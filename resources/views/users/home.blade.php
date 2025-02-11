@extends('layouts.user')

@section('title', 'Home - Otakuspace')

@section('content')

@if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

<section class="home" id="home">
    <div class="container home-wrapper">
        <div class="content-left" data-aos="fade-right">
            <h1 class="heading">Bangun Jaringan Alumni dan Kembangkan Karir <span>Bersama Kami</span></h1>
            <p class="subheading">Kami membantu alumni untuk tetap terhubung dengan almamater, mengembangkan jejaring
                profesional,
                dan membuka peluang karir melalui tracer study yang komprehensif.</p>



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
            <img src="{{ asset('img/Arona-stats.png') }}" alt="Statistics Image">
        </div>
        <div class="content-statis" data-aos="fade-left">
            <p class="label-statis">STATISTIK ALUMNI</p>
            <h1 class="heading-statis">Data Keberhasilan Alumni Kami</h1>
            <p class="subheading-statis">Berikut adalah pencapaian alumni berdasarkan data tracer study</p>

            <div class="number-wrapper">
                <div class="box-angka">
                    <h1>85%</h1>
                    <p>Tingkat Keterserapan Kerja</p>
                </div>

                <div class="box-angka">
                    <h1>70%</h1>
                    <p>Bekerja Sesuai Bidang</p>
                </div>

                <div class="box-angka">
                    <h1>25%</h1>
                    <p>Melanjutkan Studi</p>
                </div>

                <div class="box-angka">
                    <h1>20%</h1>
                    <p>Menjadi Wirausaha</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testi">
    <div class="container testimoni-wrapper">
        <div class="col-heading" data-aos="fade-down-right" data-aos-duration="3000">
            <p class="label-testimoni">Apa yang mereka katakan ?</p>
            <h1 class="heading-testimoni">Apa yang para Alumni katakan tentang kami</h1>
            <p class="subheading testimoni"></p>
        </div>
        <div class="col-slider-testimoni" data-aos="fade-up-left" data-aos-duration="3000">
            <div class="swiper mySwiperTestimoni">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $testimoni)
                    <div class="swiper-slide card-testimoni">
                        @if($testimoni->alumni->user->avatar)
                        <img class="rounded-circle me-2" src="/avatars/{{ $testimoni->alumni->user->avatar }}"
                            style="width:40px; height:40px; object-fit:cover;">
                        @else
                        <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}"
                            style="width:40px; height:40px; object-fit:cover;">
                        @endif
                        <div class="text-testimoni">
                            <i class='bx bxs-quote-left'></i>
                            <p>{{ $testimoni->testimoni }}</p>
                            <i class='bx bxs-quote-right'></i>
                        </div>
                        <p class="username">Oleh {{ $testimoni->alumni->user->name }}</p>
                        <p class="status">Alumni</p>
                    </div>
                    @empty
                    <div class="swiper-slide card-testimoni">
                        <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}"
                            style="width:40px; height:40px; object-fit:cover;">
                        <div class="text-testimoni">
                            <i class='bx bxs-quote-left'></i>
                            <p>Belum ada testimoni</p>
                            <i class='bx bxs-quote-right'></i>
                        </div>
                        <p class="username">System</p>
                        <p class="status">No testimonials yet</p>
                    </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

@endsection
