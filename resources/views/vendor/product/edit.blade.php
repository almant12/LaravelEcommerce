@extends('vendor.layouts.master')
@section('title')
    {{$settings->site_name}} || Product
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Edit Product</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form method="post" enctype="multipart/form-data" action="{{route('vendor.product.update',$product->id)}}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group wsus__input">
                                        <label>Preview</label>
                                        <img class="imageContainer" data-url="{{asset($product->thumb_image)}}" src="{{asset($product->thumb_image)}}" style="width:200px" alt="">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Image</label>
                                        <br>
                                        <input type="file" class="form-control" name="image" value="{{$product->thumb_image}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label for="inputState">Category</label>
                                                <select id="inputState" class="form-control main-category" name="category">
                                                    @foreach($categories as $category)
                                                        <option {{$category->id == $product->category_id ? 'selected' : ''}}
                                                                value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label for="inputState">Sub Category</label>
                                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                                    @foreach($subCategories as $subCategory)
                                                        <option {{$subCategory->id == $product->sub_category_id ? 'selected' : ''}}
                                                                value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label for="inputState">Child Category</label>
                                                <select id="inputState" class="form-control child-category" name="child_category">
                                                    @foreach($childCategories as $childCategory)
                                                        <option {{$childCategory->id == $product->child_category_id ? 'selected' : ''}}
                                                                value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="inputState">Brand</label>
                                        <select id="inputState" class="form-control child-category" name="brand">
                                            <option value="">Select</option>
                                            @foreach($brands as $brand)
                                                <option {{$brand->id == $product->brand_id ? 'selected' : ''}}
                                                        value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Offer Price</label>
                                        <input type="text" class="form-control" name="offer_price" value="{{$product->offer_price}}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group wsus__input">
                                                <label>Offer Start Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_start_date" value="{{$product->offer_start_date}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group wsus__input">
                                                <label>Offer End Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_end_date" value="{{$product->offer_end_date}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Stock Quantity</label>
                                        <input type="number" min="0" class="form-control" name="qty" value="{{$product->qty}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Video Link</label>
                                        <input type="text" class="form-control" name="video_link" value="{{$product->video_link}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Short Description</label>
                                        <textarea class="form-control" name="short_description">{!! $product->short_description !!}</textarea>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Long Description</label>
                                        <textarea class="form-control summernote" name="long_description">{!! $product->long_description !!}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="inputState">Product Type</label>
                                        <select id="inputState" class="form-control" name="product_type">
                                            <option value="">Select</option>
                                            <option {{$product->product_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">New Arrival</option>
                                            <option {{$product->product_type == 'featured_product' ? 'selected' : ''}} value="featured_product">Featured</option>
                                            <option {{$product->product_type == 'top_product' ? 'selected' : ''}} value="top_product">Top Product</option>
                                            <option {{$product->product_type == 'best_product' ? 'selected' : ''}} value="best_product">Best Product</option>
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Seo Title</label>
                                        <input type="text" class="form-control" name="seo_title" value="{{$product->seo_title}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Seo Description</label>
                                        <textarea class="form-control" name="seo_description">{!! $product->seo_description !!}</textarea>
                                    </div>


                                    <div class="form-group wsus__input">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                            <option {{$product->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded',function (){
            document.body.addEventListener('change',function (event){
                if (event.target.classList.contains('main-category')){
                    let id = event.target.value;
                    fetch('{{route('vendor.product.get-subCategories')}}?id=' + id)
                        .then(response=>response.json())
                        .then(data=>{
                            let subCategorySelect = document.querySelector('.sub-category');
                            subCategorySelect.innerHTML = '<option value="">Select</option>'
                            data.forEach(item=>{
                                subCategorySelect.innerHTML += `<option value="${item.id}">${item.name}</option>`
                            })
                        })
                        .catch(error=>console.error(error))
                }else if (event.target.classList.contains('sub-category')){
                    let id = event.target.value;
                    fetch('{{route('vendor.product.get-childCategories')}}?id='+id)
                        .then(response=>response.json())
                        .then(data=>{
                            let childCategory = document.querySelector('.child-category')
                            childCategory.innerHTML = '<option value="">Select</option>'
                            data.forEach(item=>{
                                childCategory.innerHTML += `<option value="${item.id}">${item.name}</option>`
                            })
                        })
                        .catch(error=>console.error(error))
                }
            })
        })
    </script>
@endpush
