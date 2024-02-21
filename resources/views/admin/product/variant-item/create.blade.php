@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Variant</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.product-variant-item.store')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name" value="{{$variant->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" name="price">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="variant" value="{{$variant->id}}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="product" value="{{$product->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

