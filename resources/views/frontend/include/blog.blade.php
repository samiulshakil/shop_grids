<section class="blog-section section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Our Latest News</h2>
                    <p>There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="{{ route('blog.details', $blog->id) }}">
                                <img src="{{ asset($blog->image) }}" alt="#">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category"
                                href="javascript:void(0)">{{ $blog->category->category_name }}</a>
                            <h4>
                                <a href="{{ route('blog.details', $blog->id) }}">{{ $blog->title }}</a>
                            </h4>
                            <p>{{ $blog->description }}</p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
