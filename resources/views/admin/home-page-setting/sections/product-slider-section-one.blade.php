
@if($productSectionOne !== null)
    @php
        $productSectionOne = json_decode($productSectionOne->value);
    @endphp
    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="general-settings">
        <div class="card border">
            <div class="card-body">
                <form action="{{route('admin.update.product-slider-section-one')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5>Product Section One</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_one" class="form-control main-category" id="">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option {{$category->id == $productSectionOne->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $sub_categories = \App\Models\SubCategory::where('category_id',$productSectionOne->category)->get();
                                @endphp
                                <label>Sub Category</label>
                                <select name="sub_cat_one" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                    @foreach($sub_categories as $sub_category)
                                        <option {{$sub_category->id == $productSectionOne->sub_category ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $child_categories = \App\Models\ChildCategory::where('sub_category_id',$productSectionOne->sub_category)->get();
                                @endphp
                                <label>Child Category</label>
                                <select name="child_cat_one" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                    @foreach($child_categories as $child_category)
                                        <option {{$child_category->id == $productSectionOne->child_category ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@else
    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="general-settings">
        <div class="card border">
            <div class="card-body">
                <form action="{{route('admin.update.product-slider-section-one')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5>Product Section One</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_one" class="form-control main-category" id="">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <label>Sub Category</label>
                                <select name="sub_cat_one" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                <select name="child_cat_one" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endif

@push('scripts')
    <script>
        $(document).ready(function (){
            $('body').on('change','.main-category',function (){
                let id = $(this).val()
                let row = $(this).closest('.row')

                $.ajax({
                    method: "GET",
                    url: '{{route('admin.get-subcategories')}}',
                    data: {
                        id: id
                    },success:function (data){
                        let selector = row.find('.sub-category')
                        selector.html('<option value="">Select</option>')
                        $.each(data,function (i,item){
                            selector.append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },error:function (data){
                    }
                })
            })
            //Get Child-Categories
            $('body').on('change','.sub-category',function (){
                let id = $(this).val();
                let row = $(this).closest('.row');
                $.ajax({
                    method: "GET",
                    url: '{{route('admin.product.get-childCategories')}}',
                    data: {
                        id : id
                    },success:function (data){
                        let selector = row.find('.child-category');
                        selector.html('<option value="">Select</option>');

                        $.each(data,function (i,item){
                            selector.append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },error:function (data){
                        console.error(data)
                    }
                })
            })
        })
    </script>
@endpush
