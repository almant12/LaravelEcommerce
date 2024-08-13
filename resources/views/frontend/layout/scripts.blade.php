<script>
    $(document).ready(function (){

        $('.show_product_modal').on('click', function(){
            let id = $(this).data('id');
            $.ajax({
                mehtod: 'GET',
                url: '{{ route("show-product-modal", ":id" ) }}'.replace(":id", id),
                beforeSend: function(){
                    $('.product-modal-content').html('<span class="loader"></span>')
                },
                success: function(response){
                    $('.product-modal-content').html(response)
                },
                error: function(xhr, status, error){

                },
                complete: function(){

                }
            })
        });

        $('.shopping-cart-form').on('submit',function (e){
            e.preventDefault();
            let formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                method:'POST',
                url: "{{route('add-to-cart')}}",
                data: formData,

                success: function (data){
                    if (data.status === 'error'){
                        toastr.error(data.message)
                    }else if (data.status === 'success'){
                        toastr.success(data.message)
                        getCartCount();
                        fetchCartItemProduct();
                        $('.mini_cart_actions').removeClass('d-none')
                    }
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
                        let price = Number(product.price).toLocaleString(undefined,{minimumFractionDigits:0})
                        let variants_total = Number(product.options.variants_total).toLocaleString(undefined,{minimumFractionDigits:0})
                        html += `
                        <li id="mini-cart-${product.rowId}">
                            <div class="wsus__cart_img">
                                <a href="{{ url('product-detail') }}/${product.options.slug}"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                <a class="wsis__del_icon remove-sidebar-product" data-id="${product.rowId}"><i class="fas fa-minus-circle"></i></a>
                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a>
                                <p>${price}{{$settings->currency_icon }}</p>
                                <small>Variants total: ${variants_total}{{ $settings->currency_icon }}</small>
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
                    $('#mini-cart-subtotal').text(data+"{{$settings->currency_icon}}")
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

        $('.add_to_wishlist').on('click',function (e){
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: '{{route('wishlist.add-product')}}',
                data:{
                    id:id
                },success:function (data){
                    if(data.status == 'success'){
                        $('#wishlist_count').text(data.count)
                        toastr.success(data.message);
                    }
                },error:function (data){
                    toastr.error(data.message);
                }
            })
        })

        $('#newsletter').on('submit',function (e){
            e.preventDefault();
            let data = $(this).serialize();


            $.ajax({
                method: 'POST',
                url: '{{route('newsletter-signup')}}',
                data: data,
                beforeSend: function (){
                    $('.subscribe_btn').text('Loading...')
                },
                success: function (data){
                    if (data.status === 'success'){
                        $('.subscribe_btn').text('Subscribe')
                        $('.newsletter_email').val('')
                        toastr.success(data.message);
                    }else if (data.status === 'error'){
                        $('.subscribe_btn').text('Subscribe')
                        toastr.error(data.message)
                    }
                },
                error: function (data){
                    let errors = data.responseJSON.errors;
                    if (errors){
                        $.each(errors,function (key,value){
                            toastr.error(value)
                        })
                        $('.subscribe_btn').text('Subscribe')
                    }
                }
            })
        })
    })

</script>
