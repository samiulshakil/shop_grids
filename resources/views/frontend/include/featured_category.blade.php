<section class="featured-categories section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Featured Categories</h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                        suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse (categories() as $category)
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-category">
                        <h3 class="heading">{{ $category->category_name }}</h3>
                        <ul>
                            @forelse ($category->subCategories as $subcategory)
                                <li><a href="product-grids.html">{{ $subcategory->sub_category_name }}</a></li>
                            @empty
                            @endforelse
                        </ul>
                        <div class="images">
                            <img src="{{ asset($category->category_image) }}" alt="#">
                        </div>
                    </div>

                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
