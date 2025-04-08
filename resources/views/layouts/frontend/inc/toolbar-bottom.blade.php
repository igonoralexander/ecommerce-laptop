<!-- toolbar-bottom -->
<div class="tf-toolbar-bottom type-1150">
        <div class="toolbar-item">
            <a href="/gallery" >
                <div class="toolbar-icon">
                    <i class="icon-shop"></i>
                </div>
                <div class="toolbar-label">Gallery</div>
            </a>
        </div>
        
        <div class="toolbar-item">
            @if(auth()->check()) <!-- Check if the user is logged in -->
                <a href="{{ route('client.bookings.create', ['user_prefix' => $user_prefix]) }}">
                    <div class="toolbar-icon">
                        <i class="icon-search"></i>
                    </div>
                    <div class="toolbar-label">Book Now</div>
                </a>
            @else
                <a href="/booking">
                    <div class="toolbar-icon">
                        <i class="icon-search"></i>
                    </div>
                    <div class="toolbar-label">Book Now</div>
                </a>
            @endif
        </div>

        <div class="toolbar-item">
            <a href="#login" data-bs-toggle="modal">
                <div class="toolbar-icon">
                    <i class="icon-account"></i>
                </div>
                <div class="toolbar-label">Account</div>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="wishlist.html">
                <div class="toolbar-icon">
                    <i class="icon-heart"></i>
                    <div class="toolbar-count">0</div>
                </div>
                <div class="toolbar-label">Wishlist</div>
            </a>
        </div>
       
    </div>
    <!-- /toolbar-bottom -->