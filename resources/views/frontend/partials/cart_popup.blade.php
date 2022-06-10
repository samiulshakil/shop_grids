<a href="javascript:void(0)" class="main-btn">
    <i class="lni lni-cart"></i>
    <span class="total-items">{{ cartcount() }}</span>
</a>

<div class="shopping-item">
    <div class="dropdown-cart-header">
        <span class="total-items">{{ cartcount() }}
            {{ Illuminate\Support\Str::plural('Item', cartcount()) }}</span>
        <a href="{{ route('cart.show') }}">View Cart</a>
    </div>
    @php
        $subtotal = 0;
    @endphp
    <ul class="shopping-list">
        @forelse (cartcontents() as $content)
            <li>
                <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                        class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="product-details.html"><img
                            src="{{ asset($content->options['image']) }}" alt="#"></a>
                </div>
                <div class="content">
                    <h4><a href="#!">{{ $content->name }}</a></h4>
                    <p class="quantity">{{ $content->qty }}x - <span
                            class="amount">${{ $content->price }}</span></p>
                </div>
                @php
                    $subtotal += $content->price * $content->qty;
                @endphp
            </li>
        @empty
        @endforelse
    </ul>
    <div class="bottom">
        <div class="total">
            <span>Total</span>
            <span class="total-amount">${{ $subtotal }}</span>
        </div>
        <div class="button">
            <a href="checkout.html" class="btn animate">Checkout</a>
        </div>
    </div>
</div>
