@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Brand</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="{{route('admin.brand.update',$brand->id)}}">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img width="200px" src="{{asset($brand->logo)}}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$brand->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Is Featured</label>
                                    <select id="inputState" class="form-control" name="is_featured">
                                        <option {{$brand->is_featured == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$brand->is_featured == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$brand->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$brand->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
