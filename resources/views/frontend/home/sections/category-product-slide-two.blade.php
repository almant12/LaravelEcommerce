@php
$productSectionTwo = json_decode($categoryProductSectionTwo->value);
$lastKey = [];

foreach ($productSectionTwo as $key => $category){
    if ($category === null){
        break;
    }
    $lastKey = [$key => $category];
}

if (array_keys($lastKey)[0] === 'category'){
    $category = \App\Models\Category::find($lastKey['category']);
    $products = \App\Models\Product::withAvg('reviews','rating')->withCount('reviews')
    ->with(['productVariants','category','imageGalleries'])
    ->where('category_id',$category->id)->orderBy('id','DESC')->take(12)->get();
}elseif (array_keys($lastKey)[0] === 'sub_category'){
    $category = \App\Models\SubCategory::find($lastKey['sub_category']);
  $products = \App\Models\Product::withAvg('reviews','rating')->withCount('reviews')
    ->with(['productVariants','category','imageGalleries'])
    ->where('sub_category_id',$category->id)->orderBy('id','DESC')->take(12)->get();
}else{
    $category = \App\Models\ChildCategory::find($lastKey['child_category']);
    $products = \App\Models\Product::withAvg('reviews','rating')->withCount('reviews')
    ->with(['productVariants','category','imageGalleries'])
    ->where('child_category_id',$category->id)->orderBy('id','DESC')->take(12)->get();
}
@endphp

<section id="wsus__electronic2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                    <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4">
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
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$product->id}}"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a class="add_to_wishlist" data-id="{{$product->id}}"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{$product->category->name}}</a>
                            <p class="wsus__pro_rating">
                                @for($i = 0 ; $i <= 5 ; $i++)
                                    @if($i <= $product->reviews_avg_rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="fas fa-star"></i>
                                    @endif
                                @endfor
                                <span>({{$product->reviews_count}} review)</span>
                            </p>
                            <a class="wsus__pro_name" href="{{route('product-detail',$product->slug)}}">{{$product->name}}</a>
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
            @endforeach
        </div>
        @foreach($products as $product)
            <section class="product_popup_modal">
                <div class="modal fade" id="exampleModal-{{$product->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="far fa-times"></i></button>
                                <div class="row">
                                    <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                        <div class="wsus__quick_view_img">
                                            @if($product->video_link)
                                                <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                                   href="{{$product->video_link}}">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            @endif
                                            <div class="row modal_slider">
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100">
                                                    </div>
                                                </div>
                                                @if(count($product->imageGalleries)===0)
                                                    <div class="col-xl-12">
                                                        <div class="modal_slider_img">
                                                            <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100">
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach($product->imageGalleries as $imageGallery)
                                                        <div class="col-xl-12">
                                                            <div class="modal_slider_img">
                                                                <img src="{{asset($imageGallery->image)}}" alt="product" class="img-fluid w-100">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="wsus__pro_details_text">
                                            <a class="title" href="{{route('product-detail',$product->slug)}}">{{$product->name}}</a>
                                            @if($product->qty === 0)
                                                <p class="wsus__stock_area"><span class="stock_out">in stock</span> ({{$product->qty}} item)</p>
                                            @elseif($product->qty > 0)
                                                <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{$product->qty}} item)</p>
                                            @endif
                                            @if(chackDiscount($product))
                                                <h4>{{priceFormat($product->offer_price)}} {{$settings->currency_icon}}
                                                    <del>{{priceFormat($product->price)}} {{$settings->currency_icon}}</del></h4>
                                            @else
                                                <h4>{{priceFormat($product->price)}} {{$settings->currency_icon}}</h4>
                                            @endif
                                            <p class="review">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>20 review</span>
                                            </p>
                                            <p class="description">{!! $product->short_description !!}</p>

                                            <form class="shopping-cart-form">
                                                <div class="wsus__selectbox">
                                                    <div class="row">
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        @foreach($product->productVariants as $variant)
                                                            @if($variant->status != 0)
                                                                <div class="col-xl-6 col-sm-6">
                                                                    <h5 class="mb-2">{{$variant->name}}</h5>
                                                                    <select class="select_2" name="variants_items[]">
                                                                        @foreach($variant->productVariantItems as $item)
                                                                            @if($item->status != 0)
                                                                                <option value="{{$item->id}}"
                                                                                    {{$item->is_default == 1 ? 'selected' : ''}}>{{$item->name}} ({{priceFormat($item->price)}}{{$settings->currency_icon}})</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="wsus__quentity">
                                                    <h5>quentity :</h5>
                                                    <div class="select_number">
                                                        <input class="number_area" name="qty" type="text" min="1" max="100" value="1" />
                                                    </div>
                                                </div>
                                                <ul class="wsus__button_area">
                                                    <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                                    <li><a class="buy_now" href="#">buy now</a></li>
                                                    <li><a class="add_to_wishlist" data-id="{{$product->id}}"><i class="far fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="far fa-random"></i></a></li>
                                                </ul>
                                            </form>
                                            <p class="brand_model"><span>brand :</span> {{$product->brand->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    </div>
</section>
