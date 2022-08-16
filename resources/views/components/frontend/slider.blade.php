@php
    //die($slider[0]);
@endphp
<!-- ======= Intro Section ======= -->
<div class="intro intro-carousel swiper position-relative">

    <div class="swiper-wrapper">

        @foreach($slider as $slider_single)
            <x-frontend.slide_single :sliderSingle="$slider_single"></x-frontend.slide_single>
        @endforeach


    </div>
    <div class="swiper-pagination"></div>
</div><!-- End Intro Section -->
