
@if($popularCategorySection !== null)
    @php
        $popularCategorySection = json_decode($popularCategorySection->value);
    @endphp
    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-profile-list">
        <div class="card border">
            <div class="card-body">
                <form action="{{route('admin.update.popular-category-section')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5>Category 1</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_one" class="form-control main-category" id="">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option {{$category->id == $popularCategorySection[0]->category ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id',$popularCategorySection[0]->category)->get();
                                @endphp
                                <label>Sub Category</label>
                                <select name="sub_cat_one" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option {{$subCategory->id == $popularCategorySection[0]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where('sub_category_id',$popularCategorySection[0]->sub_category)->get();
                                @endphp
                                <label>Child Category</label>
                                <select name="child_cat_one" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                    @foreach($childCategories as $childCategory)
                                        <option {{$childCategory->id == $popularCategorySection[0]->child_category ? 'selected': ''}}
                                                value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5>Category 2</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_two" class="form-control main-category" id="">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option {{$category->id == $popularCategorySection[1]->category ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id',$popularCategorySection[1]->category)->get();
                                @endphp
                                <label>Sub Category</label>
                                <select name="sub_cat_two" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option {{$subCategory->id == $popularCategorySection[1]->sub_category ? 'selected' : ''}}
                                                value="{{$subCategory->id}}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where('sub_category_id',$popularCategorySection[1]->sub_category)->get();
                                @endphp
                                <label>Child Category</label>
                                <select name="child_cat_two" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                    @foreach($childCategories as $childCategory)
                                        <option {{$childCategory->id == $popularCategorySection[1]->child_category ? 'selected' : ''}}
                                                value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5>Category 3</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_three" class="form-control main-category" id="">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option {{$category->id == $popularCategorySection[2]->category ? 'selected':''}}
                                                value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id',$popularCategorySection[2]->category)->get();
                                @endphp
                                <label>Sub Category</label>
                                <select name="sub_cat_three" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                    @foreach($subCategories as $subCategory)
                                        <option {{$subCategory->id == $popularCategorySection[2]->sub_category ? 'selected':''}}
                                                value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where('sub_category_id',$popularCategorySection[2]->sub_category)->get();
                                @endphp
                                <label>Child Category</label>
                                <select name="child_cat_three" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                    @foreach($childCategories as $childCategory)
                                        <option {{$childCategory->id == $popularCategorySection[2]->child_category ? 'selected' : ''}}
                                                value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5>Category 4</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_four" class="form-control main-category" id="">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option {{$category->id == $popularCategorySection[3]->category ? 'selected' : ''}}
                                                value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id',$popularCategorySection[3]->category)->get()
                                @endphp
                                <label>Sub Category</label>
                                <select name="sub_cat_four" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                    @foreach($subCategories as $subCategory)
                                        <option {{$subCategory->id == $popularCategorySection[3]->sub_category ? 'selected' : ''}}
                                                value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where('sub_category_id',$popularCategorySection[3]->sub_category)->get();
                                @endphp
                                <label>Child Category</label>
                                <select name="child_cat_four" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                    @foreach($childCategories as $childCategory)
                                        <option {{$childCategory->id == $popularCategorySection[3]->child_category ? 'selected' : ''}}
                                                value="{{$childCategory->id}}">{{$childCategory->name}}</option>
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
    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-profile-list">
        <div class="card border">
            <div class="card-body">
                <form action="{{route('admin.update.popular-category-section')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5>Category 1</h5>
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

                    <h5>Category 2</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_two" class="form-control main-category" id="">
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
                                <select name="sub_cat_two" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                <select name="child_cat_two" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5>Category 3</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_three" class="form-control main-category" id="">
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
                                <select name="sub_cat_three" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                <select name="child_cat_three" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5>Category 4</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_four" class="form-control main-category" id="">
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
                                <select name="sub_cat_four" class="form-control sub-category" id="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                <select name="child_cat_four" class="form-control child-category" id="">
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
