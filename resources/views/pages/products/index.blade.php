@extends('layouts.app')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><a href="{{ route('home') }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Products</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
                <span class="breadcrumb-item active">Products</span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
    <!-- Control position -->
    <div id="user-content" class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">List of Product</h5>
            <a href="{{ route('products.create') }}" class="btn btn-outline bg-teal-400 text-teal-400 border-teal-400 border-2">
                <i class="icon-database-add mr-2"></i> Add Product
            </a>
        </div>

        @include('layouts.validation_error', [ 'errors' => $errors ])

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif

        <table class="table datatable-responsive table-striped" id="products-table">
            <thead>
                <tr>
                    <th>No </th>
                    <th width="100">Image</th>
                    <th>Title</th>
                    <th>Size</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th >Description</th>
                    <th><span class="nobr">Actions</span></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')

<script src="/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="/global_assets/js/demo_pages/datatables_basic.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {

        $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.table') }}",
            columns: [
            { data: 'rownum', name: 'rownum' },
            { data: 'image', name: 'image' },
            { data: 'title', name: 'title' },
            { data: 'size', name: 'size' },
            { data: 'stock', name: 'stock' },
            { data: 'price', name: 'price' },
            { data: 'description', name: 'description' },
            { data: 'actions', name: 'actions', orderable: false }
            ]
        });

    });
</script>
@endpush

