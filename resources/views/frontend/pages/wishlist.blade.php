
@extends('frontend.layout.master')
@section('title')
    {{$settings->site_name}} || Wishlist
@endsection
@section('content')

    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__cart_list wishlist">
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

                                    <th class="wsus__pro_status">
                                       In Stock
                                    </th>

                                    <th class="wsus__pro_tk" style="width:238px" >
                                        price
                                    </th>

                                    <th class="wsus__pro_icon">
                                        action
                                    </th>
                                </tr>
                                @foreach ($wishlistProducts as $item)

                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{asset($item->product->thumb_image)}}" alt="product"
                                                                       class="img-fluid w-100">
                                            <a href="{{route('user.wishlist.destroy', $item->id)}}"><i class="far fa-times"></i></a>
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{{$item->product->name}}</p>
                                        </td>

                                        <td class="wsus__pro_status">
                                            <p>{{$item->product->qty}}</p>
                                        </td>

                                        <td class="wsus__pro_tk" style="width:238px">
                                            <h6>
                                                {{priceFormat($item->product->price)}} {{$settings->currency_icon}}
                                            </h6>
                                        </td>

                                        <td class="">
                                            <a class="common_btn" href="{{route('product-detail', $item->product->slug)}}">View Product</a>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART VIEW PAGE END
    ==============================-->


@endsection
