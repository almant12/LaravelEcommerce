@php
    $currentDate = \Carbon\Carbon::now();
    $flashDate = \Carbon\Carbon::parse(@$flashSaleDate->end_date);
@endphp

<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        @if ($flashDate > $currentDate)
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url(images/flash_sell_bg.jpg)">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sell</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{route('flash-sale.index')}}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row flash_sell_slider">
            @php
            $products = \App\Models\Product::withAvg('reviews','rating')->withCount('reviews')
            ->with(['category','productVariants','imageGalleries'])->whereIn('id',$flashSaleItems)->get();
            @endphp
            @foreach($products as $product)
            <x-product-card :product="$product"></x-product-card>
            @endforeach

        </div>
    </div>
</section>
@if(isset($flashSaleDate))
    @push('scripts')
        <script>
            $(document).ready(function (){
                simplyCountdown('.simply-countdown-one', {
                    year: {{date('Y',strtotime(@$flashSaleDate->end_date))}},
                    month: {{date('m',strtotime(@$flashSaleDate->end_date))}},
                    day: {{date('d',strtotime(@$flashSaleDate->end_date))}},
                });
            })
        </script>
    @endpush
@endif
