@extends('vendor.layouts.master')

@section('title')
    {{$settings->site_name}} || Variant Item
@endsection
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-10 col-xxl-10 col-lg-10 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Product Variant Item</h3>
                        <p>Variant: {{$productVariant->name}}</p>
                        <div class="create_button">
                            <a href="{{route('vendor.product-variant-item.create',['productId'=>$product->id,'variantId'=>$productVariant->id])}}" class="btn btn-primary"><i class="fas fa-plus m-1"></i>Create Variant</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{$dataTable->table()}}
                            </div>
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
        $(document).ready(function (){
            $('body').on('click','.change-status',function (){
                let isChecked = $(this).is(':checked')
                let id = $(this).data('id')

                $.ajax({
                    url: '{{route('vendor.product-variant.update-status')}}',
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success:function (data){
                        toastr.success(data.message)
                    },
                    error:function (xhr,status,error){
                        console.log(error)
                    }
                })
            })
        })
    </script>
@endpush
