<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="wsus__mobile_menu_area">
                    <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                <div class="wsus_logo_area">
                    <a class="wsus__header_logo" href="index.html">
                        <img src="images/logo_2.png" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>
            <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                <div class="wsus__search">
                    <form>
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                <div class="wsus__call_icon_area">
                    <div class="wsus__call_area">
                        <div class="wsus__call">
                            <i class="fas fa-user-headset"></i>
                        </div>
                        <div class="wsus__call_text">
                            <p>example@gmail.com</p>
                            <p>+569875544220</p>
                        </div>
                    </div>
                    <ul class="wsus__icon_area">
                        <li><a href="wishlist.html"><i class="fal fa-heart"></i><span>05</span></a></li>
{{--                        <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li>--}}
                        <li><a class="wsus__cart_icon" href="#">
                                <i class="fal fa-shopping-bag" id="cart-count">
                                </i><span>{{Cart::content()->count()}}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul class="mini-cart-wrapper">
            @foreach(Cart::content() as $cartItem)
                @php
                $product = \App\Models\Product::find($cartItem->id)
                @endphp
                <li id="mini-cart-{{$cartItem->rowId}}">
                    <div class="wsus__cart_img">
                        <a href="#"><img src="{{asset($cartItem->options->image)}}" alt="product" class="img-fluid w-100"></a>
                        <a class="wsis__del_icon remove-sidebar-product" data-id="{{$cartItem->rowId}}"><i class="fas fa-minus-circle"></i></a>
                    </div>
                    <div class="wsus__cart_text">
                        <a class="wsus__cart_title" href="{{route('product-detail',$cartItem->options->slug_name)}}">{{$cartItem->name}}</a>
                        <p>
                            {{$settings->currency_icon}}{{$cartItem->price}}
                        </p>
                            <small>Variants total: {{$settings->currency_icon}}{{$cartItem->options->variants_total}}</small>
                        <br>
                        <small>Qty: {{$cartItem->qty}}</small>
                    </div>
                </li>
            @endforeach
            @if(Cart::content()->count() === 0)
                <li class="text-center">Cart is Empty!</li>
            @endif
        </ul>
        <div class="mini_cart_actions {{Cart::content()->count() === 0 ? 'd-none': ''}}">
        <h5>sub total <span id="mini-cart-subtotal">{{getCartTotal()}}</span></h5>
        <div class="wsus__minicart_btn_area">
            <a class="common_btn" href="{{route('cart-detail')}}">view cart</a>
            <a class="common_btn" href="check_out.html">checkout</a>
        </div>
        </div>
    </div>

</header>
