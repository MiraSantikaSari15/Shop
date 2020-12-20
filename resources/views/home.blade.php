@extends('layouts.app')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span> - Home</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
                <span class="breadcrumb-item active">Home</span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
    <!-- Control position -->
        <div class="card">
            <div class="card-body">
                <div class="mb-3 py-2">
                    <h4 class="font-weight-semibold mb-1">WELCOME TO PROJECT ADMIN PANEL.</h4>
                    <span class="text-muted d-block">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Id maiores soluta provident est sunt facere,
                        officiis corporis ipsam dolorem laboriosam, vero omnis ipsum dolorum pariatur voluptatibus quas? At, aut itaque.
                    </span>
                </div>
            </div>
        </div>
</div>

@endsection
