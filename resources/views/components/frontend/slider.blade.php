
<!-- ======= Intro Section ======= -->
<div class="intro intro-carousel swiper position-relative">

    <div class="swiper-wrapper">

        @foreach($slider as $slider_single)
            <x-frontend.slide_single :slider_single="$slider_single"></x-frontend.slide_single>
        @endforeach


    </div>
    <div class="swiper-pagination"></div>
</div><!-- End Intro Section -->
