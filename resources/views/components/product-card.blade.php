<div class="col-xl-3 col-sm-6 col-lg-4 {{@$key}}">
    <div class="wsus__product_item">
        <span class="wsus__new">{{productType($product->product_type)}}</span>
        @if(chackDiscount($product))
            <span class="wsus__minus">
                                -{{calculateDiscountPercent($product->price,$product->offer_price)}}%</span>
        @endif
        <a class="wsus__pro_link" href="{{route('product-detail',$product->slug)}}">
            <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1" />
            @if(isset($product->imageGalleries[0]->image))
                <img src="{{asset($product->imageGalleries[0]->image)}}" alt="product" class="img-fluid w-100 img_2" />
            @else
                <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_2" />
            @endif
        </a>
        <ul class="wsus__single_pro_icon">
            <li><a href="#" data-bs-toggle="modal" class="show_product_modal" data-bs-target="#exampleModal" data-id="{{ $product->id }}"><i class="far fa-eye"></i></a></li>
            <li><a class="add_to_wishlist" data-id="{{$product->id}}"><i class="far fa-heart"></i></a></li>
        </ul>
        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{$product->category->name}}</a>
            <p class="wsus__pro_rating">
                @php
                    $ratingAvg = $product->reviews->avg('rating');
                    $fullRating = round($ratingAvg);
                @endphp

                @for($i = 1 ; $i <= 5 ; $i++)
                    @if($i <= $fullRating)
                        <i class="fas fa-star"></i>
                    @else
                        <i class="fas fa-star"></i>
                    @endif
                @endfor
                <span>({{count($product->reviews)}} review)</span>
            </p>
            <a class="wsus__pro_name" href="{{route('product-detail',$product->slug)}}">{{limitText($product->name)}}</a>
            @if(chackDiscount($product))
                <p class="wsus__price">{{priceFormat($product->offer_price)}} {{$settings->currency_icon}}<del>{{priceFormat($product->price)}} {{$settings->currency_icon}}</del></p>
            @else
                <p class="wsus__price">{{priceFormat($product->price)}} {{$settings->currency_icon}}</p>
            @endif
            <form class="shopping-cart-form">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                @foreach($product->productVariants as $variant)
                    @if($variant->status != 0)
                        <select class="d-none" name="variants_items[]">
                            @foreach($variant->productVariantItems as $item)
                                <option value="{{$item->id}}"
                                    {{$item->is_default == 1 ? 'selected' : ''}}>{{$item->name}} (${{$item->price}})</option>
                            @endforeach
                        </select>
                    @endif
                @endforeach
                <input  name="qty" type="hidden" min="1" max="100" value="1" />
                <button class="add_cart" type="submit">add to cart</button>
            </form>
        </div>
    </div>
</div>
