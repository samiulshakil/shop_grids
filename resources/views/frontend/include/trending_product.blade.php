<section class="trending-product section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending Product</h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                        suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($products as $product)
                <div class="col-lg-3 col-md-6 col-12">

                    <div class="single-product">
                        <div class="product-image">
                            <img src="{{ asset($product->product_thumbnail) }}" alt="#">
                            <div class="button">
                                <button type="button" data-id="{{ $product->id }}" id="cartBtn" class="btn getcart"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                        class="lni lni-cart"></i>
                                    Add
                                    to Cart</button>
                            </div>
                        </div>
                        <div class="product-info">
                            <span class="category">{{ $product->category->category_name }}</span>
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
                                <span>$199.00</span>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
            @endforelse
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Product Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="" class="product_thumbnail" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h6 class="product_name"></h6>
                                        </div>
                                        <table class="table table-border">
                                            <th>
                                                Category:
                                            </th>
                                            <td class="category">

                                            </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Brand:
                                                </th>
                                                <td class="brand">

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Code:
                                                </th>
                                                <td class="product_code">

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Stock:
                                                </th>
                                                <td class="stock">

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="number" value="1" id="qty" class="form-control  mt-2 mb-2"
                                                max="5" min="0">
                                        </div>
                                        <div class="form-group sizeof">

                                        </div>
                                        <div class="form-group colorof">

                                        </div>
                                        <input type="hidden" id="product_id" name="product_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">X</button>
                    <button type="button" class="btn btn-primary addcart" data-id="">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
</section>
