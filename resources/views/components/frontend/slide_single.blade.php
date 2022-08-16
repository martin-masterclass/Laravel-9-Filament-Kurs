@php
    $img = $sliderSingle->media[0];
@endphp


<div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url({{ "/storage/".$img->id."/".$img->file_name }})">
    <div class="overlay overlay-a"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="intro-body">
                            <h1 class="intro-title mb-4 " style="font-size: 190%; font-weight: 300; text-shadow: 2px 2px 2px #000;">
                                {{ $sliderSingle->title }}
                            </h1>
                            <p class="intro-subtitle intro-price">
                                <a href="#"><span class="price-a">€ {{ $sliderSingle->price }}</span></a>
                            </p>
                            <p>
                                {{ $sliderSingle->city }} | {{ $sliderSingle->country }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

