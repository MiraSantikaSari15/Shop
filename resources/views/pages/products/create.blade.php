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
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><strong>Add Award</strong></h5>
        </div>

        <div class="card-body">

            @include('layouts.validation_error', [ 'errors' => $errors ])

            <form id="form-submit" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}

                <fieldset class="mb-3">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('title') text-danger @enderror">Title<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="text" name="title" placeholder="Input Title Here" value="{{ old('title') }}" class="form-control {{ $errors->has('title')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('size') text-danger @enderror">Size<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="text" name="size" placeholder="Input Size Here" value="{{ old('size') }}" class="form-control {{ $errors->has('size')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('price') text-danger @enderror">Price<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="number" name="price" placeholder="Input Price Here" value="{{ old('price') }}" class="form-control {{ $errors->has('price')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('stock') text-danger @enderror">Stock<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="number" name="stock" placeholder="Input Stock Here" value="{{ old('stock') }}" class="form-control {{ $errors->has('stock')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('description')? 'desc-error' : '' }}">
                        <label class="col-form-label col-md-2 @error('description') text-danger @enderror">Description<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <textarea class="summernote" name="description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('image')? 'desc-error' : '' }}">
                        <label class="col-form-label col-md-2 font-weight-semibold {{ $errors->has('image')? 'text-danger' : '' }}">Image<span class="text-danger"> *</span></label>
                        <div class="col-lg-8 single-image {{ $errors->has('image')? 'has-error' : '' }}">
                            <input type="file" class="file-input image" data-show-caption="false" data-show-upload="false" accept="image/*" name="image" data-fouc>
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

<script src="{{ asset('assets/js/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('assets/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/js/forms/styling/switch.min.js') }}"></script>
<script src="{{ asset('summernote/summernote.min.js') }}"></script>
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

