@extends('frontend.layout.master')
@section('title')
    {{$settings->site_name}} || Cart Detail
@endsection
@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            @if(count($cartItems) === 0)
                <div>
                    <h1 class="text-center">
                        Cart is Empty!
                    </h1>
                </div>
            @else
                <div class="row">
                    <div class="col-xl-9">
                        <div class="wsus__cart_list">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_tk">
                                            unit price
                                        </th>

                                        <th class="wsus__pro_tk">
                                            total
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a class="common_btn border-radius clear-cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach($cartItems as $item)
                                        @php
                                            $product = \App\Models\Product::find($item->id)
                                        @endphp
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{asset($item->options->image)}}" alt="product"
                                                                           class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <strong>{{ limitText($item->name) }}</strong>
                                                @foreach($item->options->variants as $key => $variant)
                                                    <span>{{$key}}: {{$variant['name']}} ({{priceFormat($variant['price'])}}{{$settings->currency_icon}})</span>
                                                @endforeach

                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{priceFormat($item->price).$settings->currency_icon}}</h6>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6 id="{{$item->rowId}}">{{priceFormat(($item->price + $item->options->variants_total) * $item->qty).$settings->currency_icon}}</h6>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="input-group product-qyt-wrapper">
                                                    <button type="button" class="btn btn-secondary border-radius decrement"  data-type="minus" data-field="">-</button>
                                                    <input type="number" data-rowid="{{$item->rowId}}" name="quantity" class="form-control border-radius product-qty" value="{{$item->qty}}" readonly min="1">
                                                    <button type="button" class="btn btn-secondary border-radius increment" data-type="plus" data-field="">+</button>
                                                </div>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{route('cart.remove',$item->rowId)}}"><i class="far fa-times"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                            <h6>total cart</h6>
                            <p>subtotal: <span id="sub-total">{{priceFormat(getCartTotal())}}{{$settings->currency_icon}}</span></p>
                            @if(getCouponType() === 'percent')
                                <p>coupon(-): <span id="discount">{{priceFormat(getCartDiscount())}}%</span></p>
                            @else
                                <p>coupon(-): <span id="discount">{{priceFormat(getCartDiscount())}}{{$settings->currency_icon}}</span></p>
                            @endif
                            <p class="total"><span>total:</span> <span id="cart_total">{{priceFormat(getMainCartTotal())}}{{$settings->currency_icon}}</span></p>

                            <form id="coupon_form">
                                <input type="text" placeholder="Coupon Code" name="coupon_code"
                                       value="{{session()->has('coupon') ? session()->get('coupon')['coupon_code'] : ''}}">
                                <button type="submit" class="common_btn">apply</button>
                            </form>
                            <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">checkout</a>
                            <a class="common_btn mt-1 w-100 text-center" href="{{route('home')}}"><i
                                    class="fab fa-shopify"></i> Keep Shopping</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
   <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                            @if ($cartpage_banner_section->banner_one->status == 1)
                            <a href="{{$cartpage_banner_section->banner_one->banner_url}}">
                                <img class="img-gluid" src="{{asset($cartpage_banner_section->banner_one->banner_image)}}" alt="">
                            </a>
                            @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                            @if ($cartpage_banner_section->banner_two->status == 1)
                            <a href="{{$cartpage_banner_section->banner_two->banner_url}}">
                                <img class="img-gluid" src="{{asset($cartpage_banner_section->banner_two->banner_image)}}" alt="">
                            </a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function (){
            $('.increment').on('click',function (){
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                input.val(quantity);

                $.ajax({
                    url: "{{route('cart.update-quantity')}}",
                    method: "PUT",
                    data: {
                        rowId: rowId,
                        quantity : quantity
                    },
                    success: function (data){
                        if (data.status === 'error'){
                            toastr.error(data.message)
                        }else if (data.status === 'success'){
                            toastr.success(data.message)
                            let productId = '#'+rowId
                            let totalAmount = data.product_total + "{{$settings->currency_icon}}"
                            $(productId).text(totalAmount)
                            renderCartSubTotal()
                            couponCalculation()

                        }
                    },
                    error: function (data){
                        console.error(data);
                    }
                })
            })


            $('.decrement').on('click',function (){
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');
                if (quantity < 1){
                    quantity = 1
                    toastr.warning('Required at least 1 Product')
                }else {
                    input.val(quantity);

                    $.ajax({
                        url: "{{route('cart.update-quantity')}}",
                        method: "PUT",
                        data: {
                            rowId: rowId,
                            quantity : quantity
                        },
                        success: function (data){
                            if (data.status === 'error'){
                                toastr.error(data.message)
                            }else if (data.status === 'success'){
                                toastr.success(data.message)
                                let productId = '#'+rowId
                                let totalAmount = data.product_total+"{{$settings->currency_icon}}"
                                $(productId).text(totalAmount)
                                renderCartSubTotal()
                                couponCalculation()
                            }
                        },
                        error: function (data){
                            console.error(data);
                        }
                    })
                }
            });


            $('.clear-cart').on('click',function (e){
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action would clear your all cart items",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, clear it!"
                }).then((result) => {
                    if (result.isConfirmed) {


                        $.ajax({
                            type: 'get',
                            url: '{{route('cart.clear')}}',

                            success: function (data){
                                if (data.status == 'success'){
                                    Swal.fire(
                                        'Clear!',
                                        data.message
                                    )
                                    window.location.reload()
                                }else if(data.status == 'error'){
                                    Swal.fire(
                                        "Can't clear",
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error : function (xhr,status,error){
                                console.log(error)
                            }
                        })
                    }
                });
            })

            $('#coupon_form').on('submit',function (e){
                e.preventDefault()
                let formData = $(this).serialize();
                $.ajax({
                    method: "GET",
                    url: "{{route('apply-coupon')}}",
                    data: formData,
                    success: function (data){
                        if (data.status === 'success'){
                            toastr.success(data.message)
                            couponCalculation()
                        }else {
                            toastr.error(data.message)
                        }
                    }
                })
            })

            function couponCalculation(){
                $.ajax({
                    method: "GET",
                    url: "{{route('coupon-calculation')}}",
                    success:function (data){
                        if (data.status === 'success'){
                            if (data.coupon_type === 'percent'){
                                $('#discount').text(data.discount + '%')
                            }else {
                                $('#discount').text(data.discount + '{{$settings->currency_icon}}')
                            }
                            $('#cart_total').text(data.cart_total + '{{$settings->currency_icon}}')
                        }
                    },error:function (data){
                        console.error(data)
                    }
                })
            }

            function renderCartSubTotal(){
                $.ajax({
                    method: "GET",
                    url: '{{route('cart.sidebar-product-total')}}',
                    success: function (data){
                        $('#sub-total').text(data+"{{$settings->currency_icon}}")
                    },error: function (data){
                        console.error(data)
                    }
                })
            }
        })
    </script>
@endpush

