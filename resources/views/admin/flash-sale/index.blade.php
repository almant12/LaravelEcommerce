@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash Sale End Date</h4>
                        </div>
                            <div class="card-body">
                                <form action="{{route('admin.flash-sale.update')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sale End Date</label>
                                            <input type="text" class="form-control datepicker" name="end_date" value="{{@$flashSaleDate->end_date}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Products</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.flash-sale.add-product')}}" method="POST">
                                    <div class="form-group">
                                        <label>Add Product</label>
                                        <select type="text" class="form-control select2" name="product">
                                            <option value="">Select</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Show At Home?</label>
                                            <select name="show_at_home" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash Sale Products</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        document.addEventListener('DOMContentLoaded',function (){
            document.body.addEventListener('click',function (event) {
                if (event.target.classList.contains('change-show-at-home')) {
                    let isChecked = event.target.checked;
                    let id = event.target.getAttribute('data-id');

                    fetch('{{route('admin.flash-sale.update-show-at-home')}}', {
                        method: 'PUT',
                        headers: {
                            'Content-type': 'application/json',
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        body: JSON.stringify({
                            show_at_home: isChecked,
                            id: id
                        })
                    })
                        .then(response=>response.json())
                        .then(data=>{
                            toastr.success(data.message)
                        }).catch(error=>{
                        toastr.error(error)
                    })
                }
            })
            document.body.addEventListener('click',function (event) {
                if (event.target.classList.contains('change-status')) {
                    let isChecked = event.target.checked;
                    let id = event.target.getAttribute('data-id');

                    fetch('{{route('admin.flash-sale.update-status')}}', {
                        method: 'PUT',
                        headers: {
                            'Content-type': 'application/json',
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        body: JSON.stringify({
                            status: isChecked,
                            id: id
                        })
                    })
                        .then(response=>response.json())
                        .then(data=>{
                            toastr.success(data.message)
                        }).catch(error=>{
                        toastr.error(error)
                    })
                }
            })
        });

    </script>
@endpush
