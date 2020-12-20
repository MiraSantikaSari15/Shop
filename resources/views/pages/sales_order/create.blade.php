@extends('layouts.app')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><a href="{{ route('home') }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Sales Order</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
                <span class="breadcrumb-item active">Sales Order</span>
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
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><strong>Add Sales Order</strong></h5>
        </div>

        <div class="card-body">

            @include('layouts.validation_error', [ 'errors' => $errors ])

            <form id="form-submit" action="{{ route('sales-order.store') }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}

                <fieldset class="mb-3">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('name') text-danger @enderror">Customer's Name<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <select class="form-control select-search" name="customer" id="customer" class="form-control {{ $errors->has('customer')? 'border-danger' : '' }}" data-fouc>
                                <option disabled="" selected="">Choose Here</option>
                                @foreach($customers as $list)
                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row d-none" id="customer-detail">
                        <label class="col-form-label col-md-2 @error('date_of_birth') text-danger @enderror">Customer's Detail</label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-2 font-weight-semibold">
                                    Email
                                </div>
                                <div class="col-md-5" id="email">
                                    : mira@gmail.com
                                </div>
                                
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 font-weight-semibold">
                                    Phone
                                </div>
                                <div class="col-md-2" id="phone">
                                 : 0895347532909
                             </div>
                         </div>
                         <div class="row mt-2">
                            <div class="col-md-2 font-weight-semibold">
                                Address
                            </div>
                            <div class="col-md-10" id="address">
                                : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-2 @error('products') text-danger @enderror">Products<span class="text-danger"> *</span></label>
                    <div class="col-md-10">
                        <select multiple="multiple" class="form-control select-search" name="products[]" class="form-control {{ $errors->has('products')? 'border-danger' : '' }}" data-fouc>
                            @foreach($products as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit"
                data-initial-text="Update <i class='icon-paperplane ml-2'></i>"
                data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> Loading..."
                class="btn btn-primary btn-loading button-submit mt-4"
                >
                Submit <i class="icon-paperplane ml-2"></i> </button>
            </div>

        </form>

    </div>
</div>
</div>
@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="{{ asset('assets/js/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('assets/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/js/forms/styling/switch.min.js') }}"></script>
<script src="{{ asset('summernote/summernote.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_pages/form_select2.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#customer').change(function(){
            customerDetail();
        });

        function customerDetail() {
            var id = $('#customer').val();
            $.ajax ({
                method: "GET",
                url: "/sales-order/detail/"+id, 
                data: {"_token": "{{ csrf_token() }}"}
            }).done( function(data){
                $('#customer-detail').removeClass('d-none');
                $('#email').html(': '+data.email);
                $('#phone').html(': '+data.phone);
                $('#address').html(': '+data.address);
            }).fail(function(jqXHR, textStatus, error){
             alert(jqXHR.responseText);
         });
        }
    });
</script>
<script>

    document.addEventListener('DOMContentLoaded', function() {

        $('.multiselect').multiselect();

        if($().summernote){
            $('.summernote').summernote({disableDragAndDrop: true,toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ]});
        }

        $().select2 && $('.select').select2({
            minimumResultsForSearch : Infinity
        });

        $().bootstrapSwitch && $('.form-check-input-switch').bootstrapSwitch();

        $('.image').each(function(index, item) {
            $(item).fileinput({
                autoReplace: true,
                dropZoneEnabled: false,
                browseLabel: 'Browse',
                browseIcon: '<i class="icon-folder-search mr-2"></i>',
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    actions: '<div class="file-actions"><div class="file-footer-buttons">{zoom}</div></div>'
                },
                purifyHtml: true,
                previewZoomButtonIcons: {
                    prev: '<i class="icon-arrow-left15"></i>',
                    next: '<i class="icon-arrow-right15"></i>',
                    toggleheader: '<i class="icon-move-vertical"></i>',
                    fullscreen: '<i class="icon-screen-full"></i>',
                    borderless: '<i class="icon-screen-normal"></i>',
                    close: '<i class="icon-x"></i>'
                },
                fileActionSettings: { zoomIcon: '<i class="icon-zoomin3"></i>' },
                allowedFileExtensions: ['pdf', 'jpg', 'jpeg', 'png'],
                showClose: false,
                maxFileSize: 20000
            });
        })


        $('#form-submit').on('submit', function(e){

            var btn = $(this).find('button[type=submit]'),
            initialText = btn.data('initial-text'),
            loadingText = btn.data('loading-text');
            btn.html(loadingText).addClass('disabled').attr('disabled', true);

        });

    });


</script>

@endpush

