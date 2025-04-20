@if(!empty($cartItems))
    @foreach ($cartItems as $laptop_id => $item)
        <div class="tf-mini-cart-item" data-index="{{ $laptop_id }}">
            <div class="tf-mini-cart-image">
                <a href="#">
                    @auth
                        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}">
                    @else
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                    @endauth
                </a>
            </div>
            <div class="tf-mini-cart-info">
                <a class="title link" href="#">{{ $item['name'] }}</a>
                <div class="price fw-6">₦{{ $item['sale_price'] ?? $item['price'] }}</div>
                <div class="tf-mini-cart-btns">
                    <div class="wg-quantity small">
                        <span class="btn-quantity minusbtn" data-index="{{ $laptop_id }}">-</span>
                        <input type="text" class="quantity-input" data-index="{{ $laptop_id }}" value="{{ $item['quantity'] }}">
                        <span class="btn-quantity plusbtn" data-index="{{ $laptop_id }}">+</span>
                    </div>
                    <div class="tf-mini-cart-remove" data-index="{{ $laptop_id }}">Remove</div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center p-4">
        <p class="fw-6 fs-5 mb-3">🛒 No items found in your cart.</p>
        <a href="{{ route('shop') }}" class="tf-btn btn-fill radius-3">Return to Shop</a>
    </div>
@endif
