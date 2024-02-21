@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product: {{$product->name}}</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.product-variant.create',['product'=>request()->product])}}" class="btn btn-primary">+ Create New</a>
                            </div>
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
        $(document).ready(function (){
            $('body').on('click','.change-status',function (){
                let isChecked = $(this).is(':checked')
                let id = $(this).data('id')
                console.log(id)
                $.ajax({
                    url: '{{route('admin.product-variant.update-status')}}',
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
