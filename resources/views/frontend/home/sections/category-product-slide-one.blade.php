@php

$productSectionOne = json_decode($categoryProductSectionOne->value);
$firstCategory = \App\Models\Category::find($productSectionOne->category);
$lastKey = [];

foreach ($productSectionOne as $key => $category){
    if ($category === null){
        break;
    }
    $lastKey = [$key=>$category];
}
if (array_keys($lastKey)[0] === 'category'){
    $category = \App\Models\Category::find($lastKey['category']);
    $products = \App\Models\Product::withAvg('reviews','rating')->withCount('reviews')
    ->with(['productVariants','category','imageGalleries'])
    ->where('category_id',$category->id)->orderBy('id','DESC')->take(12)->get();
}
elseif (array_keys($lastKey)[0] === 'sub_category'){
 $category = \App\Models\SubCategory::find($lastKey['sub_category']);
    $products = \App\Models\Product::withAvg('reviews','rating')->withCount('reviews')
    ->with(['productVariants','category','imageGalleries'])
    ->where('sub_category_id',$category->id)->orderBy('id','DESC')->take(12)->get();
}
else{
 $category = \App\Models\ChildCategory::find($lastKey['child_category']);
    $products = \App\Models\Product::withAvg('reviews','rating')->withCount('reviews')
    ->with(['productVariants','category','imageGalleries'])
    ->where('child_category_id',$category->id)->orderBy('id','DESC')->take(12)->get();
}
@endphp
<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                    <a class="see_btn" href="{{route('products.index',['category'=>$firstCategory->slug])}}">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach($products as $product)
                <x-product-card :product="$product"></x-product-card>
            @endforeach
        </div>
    </div>
</section>
