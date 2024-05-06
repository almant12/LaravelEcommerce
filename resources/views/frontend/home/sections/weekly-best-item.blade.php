@php
    $categoryProductSliderSectionThree = json_decode($categoryProductSectionThree->value,true);
@endphp
<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            @foreach($categoryProductSliderSectionThree as $productSectionThree)

              @php
              $lastKey = [];

              foreach ($productSectionThree as $key => $category){
                  if ($category === null){
                      break;
                  }
                  $lastKey = [$key => $category];
              }

              if (array_keys($lastKey)[0] === 'category') {
                        $category = \App\Models\Category::find($lastKey['category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
                        ->where('category_id', $category->id)
                            ->orderBy('id', 'DESC')
                            ->take(6)
                            ->get();
                    } elseif (array_keys($lastKey)[0] === 'sub_category') {
                        $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
                        ->where('sub_category_id', $category->id)
                            ->orderBy('id', 'DESC')
                            ->take(6)
                            ->get();
                    } else {
                        $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
                        ->where('child_category_id', $category->id)
                            ->orderBy('id', 'DESC')
                            ->take(6)
                            ->get();
                    }
              @endphp
            <div class="col-xl-6 col-sm-6">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                </div>
                <div class="row weekly_best2">
                    @foreach($products as $item)
                        <div class="col-xl-4 col-lg-4">
                            <a class="wsus__hot_deals__single" href="{{route('product-detail',$item->slug)}}">
                                <div class="wsus__hot_deals__single_img">
                                    <img src="{{asset($item->thumb_image)}}" alt="bag" class="img-fluid w-100">
                                </div>
                                <div class="wsus__hot_deals__single_text mt-2">
                                    <h5>{!! limitText($item->name) !!}</h5>
                                    <p class="wsus__rating">
                                        @for($i = 1 ; $i <= 5 ; $i++)
                                            @if($i <= $item->reviews_avg_rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="fas fa-star"></i>
                                            @endif
                                        @endfor
                                    </p>
                                    @if(chackDiscount($item))
                                        <p class="wsus__tk">{{priceFormat($item->offer_price)}} {{$settings->currency_icon}} <del>{{priceFormat($item->price)}}</del></p>
                                    @else
                                        <p class="wsus__tk">{{priceFormat($item->price)}} {{$settings->currency_icon}}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
