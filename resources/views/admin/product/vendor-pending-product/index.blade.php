@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Vendor Pending Products</h4>
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
            $('body').on('change','.is_approve',function (){
                let value = $(this).val()
                let id = $(this).data('id')

                $.ajax({
                    url: '{{route('admin.vendor-change-approve-status')}}',
                    method: 'PUT',
                    data:{
                        value: value,
                        id: id
                    },success: function (data){
                        toastr.success(data.message)
                    },error: function (xhz,status,error){
                        console.error(error)
                    }
                })
            })
        })

        document.addEventListener('DOMContentLoaded',function (){
            document.body.addEventListener('click',function (event) {
                if (event.target.classList.contains('change-status')) {
                    let isChecked = event.target.checked;
                    let id = event.target.getAttribute('data-id');

                    fetch('{{route('admin.product.update-status')}}', {
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
