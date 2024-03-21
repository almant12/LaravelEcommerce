<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="dropdown {{setActive([
    'admin.category.*',
    'admin.sub-category.*',
    'admin.child-category.*'
])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Category</span></a>
                <ul class="dropdown-menu">
                    <li class="{{setActive(['admin.category.*'])}}"><a class="nav-link" href="{{route('admin.category.index')}}">Category</a></li>
                    <li class="{{setActive(['admin.sub-category.*'])}}"><a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub category</a></li>
                    <li class="{{setActive(['admin.child-category.**'])}}"><a class="nav-link" href="{{route('admin.child-category.index')}}">Child category</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive([
                    'admin.order.*',
                    'admin.pending-orders',
                    'admin.processed-orders',
                    'admin.dropped-off-orders',
                    'admin.shipped-orders',
                    'admin.out-for-delivery-orders',
                    'admin.delivered-orders',
                    'admin.canceled-orders',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cart-plus"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                                                                      href="{{ route('admin.order.index') }}">All Orders</a></li>
                    <li class="{{ setActive(['admin.pending-orders']) }}"><a class="nav-link"
                                                                             href="{{ route('admin.pending-orders') }}">All Pending Orders</a></li>
                    <li class="{{ setActive(['admin.processed-orders']) }}"><a class="nav-link"
                                                                               href="{{ route('admin.processed-orders') }}">All processed Orders</a></li>
                    <li class="{{ setActive(['admin.dropped-off']) }}"><a class="nav-link"
                                                                          href="{{ route('admin.dropped-off-orders') }}">All Dropped Off Orders</a></li>

                    <li class="{{ setActive(['admin.shipped-orders']) }}"><a class="nav-link"
                                                                             href="{{ route('admin.shipped-orders') }}">All Shipped Orders</a></li>
                    <li class="{{ setActive(['admin.out-for-delivery-orders']) }}"><a class="nav-link"
                                                                                      href="{{ route('admin.out-for-delivery-orders') }}">All Out For Delivery Orders</a></li>


                    <li class="{{ setActive(['admin.delivered-orders']) }}"><a class="nav-link"
                                                                               href="{{ route('admin.delivered-orders') }}">All Delivered Orders</a></li>

                    <li class="{{ setActive(['admin.canceled-orders']) }}"><a class="nav-link"
                                                                              href="{{ route('admin.canceled-orders') }}">All Canceled Orders</a></li>

                </ul>
            </li>

            <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link"
                                                                  href="{{ route('admin.transaction') }}"><i class="fas fa-money-bill-alt"></i>
                    <span>Transactions</span></a>
            </li>


            <li class="dropdown {{setActive(['admin.brand.*','admin.product.*'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{setActive(['admin.brand.*'])}}"><a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a></li>
                    <li class="{{setActive(['admin.product.*'])}}"><a class="nav-link" href="{{route('admin.product.index')}}">Products</a></li>
                    <li class="{{setActive(['admin.vendor-products.*'])}}"><a class="nav-link" href="{{route('admin.vendor-products.index')}}">Vendor Products</a></li>
                    <li class="{{setActive(['admin.vendor-pending-products.*'])}}"><a class="nav-link" href="{{route('admin.vendor-pending-products.index')}}">Vendor Pending Products</a></li>
                </ul>
            </li>
            <li class="dropdown {{setActive(['admin.vendor-profile.*','admin.coupon.*','admin.shipping-rule.*','payment-setting.*'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{setActive(['admin.vendor-profile.*'])}}"><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a></li>
                    <li class="{{setActive(['admin.coupon.*'])}}"><a class="nav-link" href="{{route('admin.coupon.index')}}">Coupons</a></li>
                    <li class="{{setActive(['admin.shipping-rule.*'])}}"><a class="nav-link" href="{{route('admin.shipping-rule.index')}}">Shipping Rule</a></li>
                    <li class="{{setActive(['admin.flash-sale.*'])}}"><a class="nav-link" href="{{route('admin.flash-sale.index')}}">Flash Sale</a></li>
                    <li class="{{setActive(['admin.payment-setting.*'])}}"><a class="nav-link" href="{{route('admin.payment-setting.index')}}">Payment Settings</a></li>
                </ul>
            </li>
            <li class="dropdown {{setActive(['admin.slider.*','admin.home-page-setting.*'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{setActive(['admin.slider.*'])}}"><a  class="nav-link" href="{{route('admin.slider.index')}}">Slider</a></li>
                    <li class="{{setActive(['admin.home-page-setting.*'])}}"><a  class="nav-link" href="{{route('admin.home-page-setting.index')}}">Home Page Setting</a></li>
                </ul>
            </li>
            <li class="dropdown {{setActive(['admin.footer-info.*',
                      'admin.footer-socials.*',
                      'admin.footer-grid-one.*'.
                      'admin.footer-grid-two.*'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Footer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{setActive(['admin.footer-info.*'])}}"><a  class="nav-link"  href="{{route('admin.footer-info.index')}}">Footer Info</a></li>
                    <li class="{{setActive(['admin.footer-socials.*'])}}"><a  class="nav-link"  href="{{route('admin.footer-socials.index')}}">Footer Social</a></li>
                    <li class="{{setActive(['admin.footer-grid-one.*'])}}"><a  class="nav-link"  href="{{route('admin.footer-grid-one.index')}}">Footer Grid One</a></li>
                    <li class="{{setActive(['admin.footer-grid-two.*'])}}"><a  class="nav-link"  href="{{route('admin.footer-grid-two.index')}}">Footer Grid Two</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="{{route('admin.settings.index')}}"><i class="far fa-square"></i> <span>Settings</span></a></li>
        </ul>


    </aside>
</div>
