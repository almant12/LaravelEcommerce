@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pending Order</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Pending Orders</h4>
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
