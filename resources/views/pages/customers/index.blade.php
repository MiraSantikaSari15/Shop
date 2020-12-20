@extends('layouts.app')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><a href="{{ route('home') }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Customers</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
                <span class="breadcrumb-item active">Customers</span>
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
            <h5 class="card-title">List of Customers</h5>
            <a href="{{ route('customers.create') }}" class="btn btn-outline bg-teal-400 text-teal-400 border-teal-400 border-2">
                <i class="icon-database-add mr-2"></i> Add Customer
            </a>
        </div>

        @include('layouts.validation_error', [ 'errors' => $errors ])

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif

        <table class="table datatable-responsive table-striped" id="customers-table">
            <thead>
                <tr>
                    <th>No </th>
                    <th width="10%">Image</th>
                    <th width="20%">Name</th>
                    <th width="10%">Email</th>
                    <th width="10%">Phone</th>
                    <th width="40%">Address</th>
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

        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customers.table') }}",
            columns: [
            { data: 'rownum', name: 'rownum' },
            { data: 'image', name: 'image' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            { data: 'actions', name: 'actions', orderable: false }
            ]
        });

    });
</script>
@endpush

