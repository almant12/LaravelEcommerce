
@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer Info</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Footer Info</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.footer-info.update', 1)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <img src="{{asset(@$footerInfo->logo)}}" width="150px" alt="">
                                    <br>
                                    <label>Footer Logo</label>
                                    <input type="file" class="form-control" name="logo" value="{{@$footerInfo->logo}}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{@$footerInfo->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="{{@$footerInfo->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" value="{{@$footerInfo->address}}">
                                </div>

                                <div class="form-group">
                                    <label>Copyright</label>
                                    <input type="text" class="form-control" name="copyright" value="{{@$footerInfo->copyright}}">
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


{{--<div class="row">--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="form-group">--}}
{{--            <label>Show At Home?</label>--}}
{{--            <select name="show_at_home" id="" class="form-control">--}}
{{--                <option value="">Select</option>--}}
{{--                <option value="1">Yes</option>--}}
{{--                <option value="0">No</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="form-group">--}}
{{--            <label>Status</label>--}}
{{--            <select name="status" id="" class="form-control">--}}
{{--                <option value="">Select</option>--}}
{{--                <option value="1">Active</option>--}}
{{--                <option value="0">Inactive</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
