            <div class="container">
                <div class="cart-list-head">

                    <div class="cart-list-title  text-center">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-12">
                                <p>Image</p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-12">
                                <p>Name</p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-12">
                                <p>Quantity</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <p>Update</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>Price</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <p>Remove</p>
                            </div>
                        </div>
                    </div>

                    @php
                        $total = 0;
                    @endphp

                    @forelse ($contents as $content)
                        <div class="cart-single-list text-center hide-{{ $content->rowId }}">
                            <div class="row align-items-center">
                                <div class="col-lg-2 col-md-2 col-12">
                                    <a href="#!"><img src="{{ asset($content->options['image']) }}" alt="#"></a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-12">
                                    <h5 class="product-name"><a href="#!">{{ $content->name }}</a>
                                    </h5>
                                </div>
                                <div class="col-lg-3 col-md-3 col-12">
                                    <button class="value-button decrease decrease-button{{ $content->id }}"
                                        onclick="decreaseValue({{ $content->id }})" data-id="{{ $content->id }}"
                                        id="minus" value="Decrease Value">
                                        <i class="lni lni-circle-minus"></i>
                                    </button>
                                    <input type="number" min="1" max="5" class="number{{ $content->id }}" readonly
                                        id="number" value="{{ $content->qty }}" />
                                    <button class="value-button increase increase-button{{ $content->id }}"
                                        onclick="increaseValue({{ $content->id }})" data-id="{{ $content->id }}"
                                        id="plus" value="Increase Value"><i class="lni lni-circle-plus"></i>
                                    </button>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <form action="{{ route('cart.update') }}" method="post">
                                        @csrf
                                        <i class="lni lni-cog updateCart" row-id="{{ $content->rowId }}"></i>
                                    </form>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p class="total_price{{ $content->id }}">
                                        ${{ $content->price * $content->qty }}
                                    </p>
                                    <input type="hidden" value="{{ $content->price }}"
                                        class="price{{ $content->id }}">
                                    @php
                                        $total += $content->price * $content->qty;
                                    @endphp
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <form action="{{ route('cart.delete') }}" method="post">
                                        @csrf
                                        <a class="remove-item deleteCart" row-id="{{ $content->rowId }}"
                                            href="javascript:void(0)"><i class="lni lni-close"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse


                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-8 col-md-6 col-12">
                                    <div class="left">
                                        <div class="coupon">
                                            <form action="#" target="_blank">
                                                <input name="Coupon" placeholder="Enter Your Coupon">
                                                <div class="button">
                                                    <button class="btn">Apply Coupon</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Cart Subtotal<span class="sub_total">${{ $total }}</span>
                                            </li>
                                            <input type="hidden" value="{{ $total }}" class="sub_total_input">
                                            <li>Shipping<span>Free</span></li>
                                            <li>You Save<span>$29.00</span></li>
                                            <li class="last">You Pay<span>$2531.00</span></li>
                                        </ul>
                                        <div class="button">
                                            <a href="checkout.html" class="btn">Checkout</a>
                                            <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
