@extends('layouts.up')

@section('content')
<section class="about">
    <div class="row">
        <div class="image">
            <img src="{{ asset('images/about-img.svg') }}" alt="">
        </div>
        <div class="content">
            <h3>Why choose us?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam veritatis minus et similique doloribus? Harum molestias tenetur eaque illum quas? Obcaecati nulla in itaque modi magnam ipsa molestiae ullam consequuntur.</p>
            <a href="{{ url('contact') }}" class="btn">Contact us</a>
        </div>
    </div>
</section>

<section class="reviews">
    <h1 class="heading">Client's reviews</h1>
    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            @foreach(range(1, 6) as $i)
            <div class="swiper-slide slide">
                <img src="{{ asset('images/pic-' . $i . '.png') }}" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>John Doe</h3>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
@endsection
