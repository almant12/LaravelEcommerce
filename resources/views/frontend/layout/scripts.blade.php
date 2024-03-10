<script>
    $(document).ready(function (){
        $('.shopping-cart-form').on('submit',function (e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method:'POST',
                url: "{{route('add-to-cart')}}",
                data: formData,

                success: function (data){
                    if (data.status === 'error'){
                        toastr.error(data.message)
                    }
                    getCartCount();
                    fetchCartItemProduct();
                    $('.mini_cart_actions').removeClass('d-none')
                },
                error: function (data){
                    console.error(data)
                }
            })
        })

        function getCartCount(){
            $.ajax({
                method: "GET",
                url: "{{route('cart.count')}}",
                success: function (data){
                    $('#cart-count').text(data)
                },
                error: function (data){
                    console.error(data)
                }
            })
        }

        function fetchCartItemProduct(){
            $.ajax({
                method: "GET",
                url: "{{route('cart.products')}}",
                success: function (data){
                    $('.mini-cart-wrapper').html('')
                    var html = '';
                    for (let item in data){
                        let product = data[item];
                        html += `
                        <li id="mini-cart-${product.rowId}">
                            <div class="wsus__cart_img">
                                <a href="{{ url('product-detail') }}/${product.options.slug}"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                <a class="wsis__del_icon remove-sidebar-product" data-id="${product.rowId}"><i class="fas fa-minus-circle"></i></a>
                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a>
                                <p>{{ $settings->currency_icon }}${product.price}</p>
                                <small>Variants total: {{ $settings->currency_icon }}${product.options.variants_total}</small>
                                <br>
                                <small>Qty: ${product.qty}</small>
                            </div>
                        </li>`
                    }
                    $('.mini-cart-wrapper').html(html)
                    getSidebarCartTotal()

                },error: function (data){
                    console.error(data)
                }
            })
        }

        function getSidebarCartTotal(){
            $.ajax({
                method: "GET",
                url: "{{route('cart.sidebar-product-total')}}",
                success: function (data){
                    console.log(data)
                    $('#mini-cart-subtotal').text("{{$settings->currency_icon}}" + data)
                },error: function (data){
                    console.error(data)
                }
            })
        }

        $('body').on('click','.remove-sidebar-product',function (e){
            e.preventDefault()
            let rowId = $(this).data('id');
            console.log(rowId)
            $.ajax({
                method: "POST",
                url: "{{route('cart.sidebar-remove-product')}}",
                data: {
                    rowId:rowId
                },
                success: function (data){
                    let productId = '#mini-cart-'+rowId
                    $(productId).remove()
                    getSidebarCartTotal()
                    getCartCount()

                    if ($('.mini-cart-wrapper').find('li').length === 0){
                        $('#cart-count').text(0)
                        $('.mini_cart_actions').addClass('d-none');
                        $('.mini-cart-wrapper').html(
                            '<li class="text-center">Cart is Empty!</li>'
                        )
                    }
                },
                error:function (data){
                    console.error(data)
                }
            })
        })
    })
</script>
