                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @forelse ($products as $product)
                                        <div class="col-lg-4 col-md-6 col-12">

                                            <div class="single-product">
                                                <div class="product-image">
                                                    <img src="{{ asset($product->product_thumbnail) }}" alt="#">
                                                    <div class="button">
                                                        <a href="product-details.html" class="btn"><i
                                                                class="lni lni-cart"></i> Add to Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <span
                                                        class="category">{{ $product->category->category_name }}</span>
                                                    <h4 class="title">
                                                        <a href="product-grids.html">{{ $product->product_name }}</a>
                                                    </h4>
                                                    <ul class="review">
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><span>4.0 Review(s)</span></li>
                                                    </ul>
                                                    <div class="price">
                                                        <span>${{ $product->discount_price }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @empty
                                    @endforelse

                                </div>
                                <div class="row">
                                    <div class="col-12">

                                        <div class="pagination left">
                                            <ul class="pagination-list">
                                                <li><a href="javascript:void(0)">1</a></li>
                                                <li class="active"><a href="javascript:void(0)">2</a></li>
                                                <li><a href="javascript:void(0)">3</a></li>
                                                <li><a href="javascript:void(0)">4</a></li>
                                                <li><a href="javascript:void(0)"><i
                                                            class="lni lni-chevron-right"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
