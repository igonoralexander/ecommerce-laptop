    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">

                    <li class="nav-mb-item">
                        <a href="/" class="collapsed mb-menu-link current" aria-expanded="true" aria-controls="dropdown-menu-one">
                            <span>Home</span>
                        </a>                        
                    </li>
                   
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-five" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-five">
                            <span>Brands</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-five" class="collapse">
                            <ul class="sub-nav-menu" >
                                @foreach($brands as $item)
                                    <li><a href="blog-grid.html" class="sub-nav-link">{{$item->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        
                    </li>

                    <li class="nav-mb-item">
                        <a href="/shop" class="collapsed mb-menu-link current" aria-expanded="true" aria-controls="dropdown-menu-one">
                            <span>Laptops</span>
                        </a>                        
                    </li>

                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-pages" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-four">
                            <span>Pages</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-pages" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation">
                                
                                <li>
                                    <a href="/about" class="menu-link-text link text_black-2">About us</a>
                                </li>
                                            
                                <li>
                                    <a href="/contact" class="menu-link-text link text_black-2">Contact</a>
                                </li>
                                                
                                <li>
                                    <a href="/faq" class="menu-link-text link text_black-2">FAQ</a>
                                </li>
                            
                            </ul>
                        </div>
                        
                    </li>

                    @auth

                        <li class="nav-mb-item">
                            <a href="#dropdown-menu-four" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-four">
                                <span> Hi, {{ Auth::user()->first_name }} </span>
                                <span class="btn-open-sub"></span>
                            </a>
                            <div id="dropdown-menu-four" class="collapse">
                                <ul class="sub-nav-menu" id="sub-menu-navigation">
                                        <li>
                                            <a href="wishlist.html" class="site-nav-icon"><i class="icon icon-account"></i>My Account</a>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                                        </li>

                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" class="site-nav-icon"><i class="icon icon-account"></i>Logout</a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>                    
                        </li>
                    @else
                            <li class="nav-mb-item">
                                <a href="#dropdown-menu-four" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-four">
                                    <span>My Account</span>
                                    <span class="btn-open-sub"></span>
                                </a>
                                <div id="dropdown-menu-four" class="collapse">
                                    <ul class="sub-nav-menu" id="sub-menu-navigation">
                                        
                                        <li>
                                            <a href="/login" class="site-nav-icon"><i class="icon icon-account"></i>Login/Register</a>
                                        </li>

                                        <li>
                                            <a href="wishlist.html" class="site-nav-icon"><i class="icon icon-account"></i>My Account</a>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                                        </li>
                                    </ul>
                                </div>                    
                            </li>
                    @endauth
                </ul>
                <div class="mb-other-content">
                    <div class="d-flex group-icon">
                        
                        
                    </div>
                    <div class="mb-notice">
                        <a href="/contact" class="text-need">Need help ?</a>
                    </div>
                    <ul class="mb-info">
                        <li>Address: 1234 Fashion Street, Suite 567, <br> New York, NY 10001</li>
                        <li>Email: <b>info@fashionshop.com</b></li>
                        <li>Phone: <b>(212) 555-1234</b></li>
                    </ul>
                </div>
            </div>
        </div>       
    </div>
    <!-- /mobile menu -->