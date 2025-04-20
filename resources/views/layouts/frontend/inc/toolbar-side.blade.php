<!-- toolbarShopmb -->
<div class="offcanvas offcanvas-start canvas-mb toolbar-shop-mobile" id="toolbarShopmb">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    @foreach($brands as $item)
                        <li class="nav-mb-item">
                            <a href="shop-default.html" class="tf-category-link mb-menu-link">
                                <div class="image">
                                    <img src="{{ asset($item->image) }}" alt="">
                                </div>
                                <span>{{$item->name}}</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="mb-bottom">
                <a href="{{route('shop') }}" class="tf-btn fw-5 btn-line">View All Laptops <i class="icon icon-arrow1-top-left"></i></a>
            </div>
        </div>       
    </div>
    <!-- /toolbarShopmb -->