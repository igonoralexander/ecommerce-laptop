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
                        <span class="btn-quantity minus-btn" data-index="{{ $laptop_id }}">-</span>
                        <input type="text" class="quantity-input" data-index="{{ $laptop_id }}" value="{{ $item['quantity'] }}">
                        <span class="btn-quantity plus-btn" data-index="{{ $laptop_id }}">+</span>
                    </div>
                    <div class="tf-mini-cart-remove" data-index="{{ $laptop_id }}">Remove</div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No item in cart.</p>
@endif
