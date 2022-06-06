<section class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 custom-padding-right">
                <div class="slider-head">

                    <div class="hero-slider">
                        @forelse ($banners as $banner)
                            <div class="single-slider"
                                style="background-image: url({{ asset($banner->banner_image) }});">
                                <div class="content">
                                    <h2><span>{{ $banner->banner_sub_title }}</span>
                                        {{ $banner->banner_title }}
                                    </h2>
                                    <p>{{ $banner->banner_description }}</p>
                                    <h3><span>Now Only</span> ${{ $banner->banner_price }}</h3>
                                    <div class="button">
                                        <a href="product-grids.html"
                                            class="btn">{{ $banner->banner_button_text }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-12 md-custom-padding">

                        <div class="hero-small-banner"
                            style="background-image: url('{{ asset('frontend/assets/images/hero/slider-bnr.jpg') }}');">
                            <div class="content">
                                <h2>
                                    <span>New line required</span>
                                    iPhone 12 Pro Max
                                </h2>
                                <h3>$259.99</h3>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12 col-md-6 col-12">

                        <div class="hero-small-banner style2">
                            <div class="content">
                                <h2>Weekly Sale!</h2>
                                <p>Saving up to 50% off all online store items this week.</p>
                                <div class="button">
                                    <a class="btn" href="product-grids.html">Shop Now</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
