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
            <h5 class="card-title"><strong>Edit Product</strong></h5>
        </div>

        <div class="card-body">

            @include('layouts.validation_error', [ 'errors' => $errors ])

            <form id="form-submit" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <fieldset class="mb-3">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('title') text-danger @enderror">Title<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="text" name="title" placeholder="Input Title Here" value="{{ old('title')?: $product->title }}" class="form-control {{ $errors->has('title')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('size') text-danger @enderror">Size<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="text" name="size" placeholder="Input Size Here" value="{{ old('size')?: $product->size }}" class="form-control {{ $errors->has('size')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('price') text-danger @enderror">Price<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="number" name="price" placeholder="Input Price Here" value="{{ old('price')?: $product->price }}" class="form-control {{ $errors->has('price')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2 @error('stock') text-danger @enderror">Stock<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <input type="number" name="stock" placeholder="Input Stock Here" value="{{ old('stock')?: $product->stock }}" class="form-control {{ $errors->has('stock')? 'border-danger' : '' }}">
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('description')? 'desc-error' : '' }}">
                        <label class="col-form-label col-md-2 @error('description') text-danger @enderror">Description<span class="text-danger"> *</span></label>
                        <div class="col-md-10">
                            <textarea class="summernote" name="description">{{ old('description')?: $product->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('image')? 'desc-error' : '' }}">
                        <label class="col-form-label col-md-2 font-weight-semibold {{ $errors->has('image')? 'text-danger' : '' }}">Image<span class="text-danger"> *</span></label>
                        <div class="col-lg-4 {{ $errors->has('image')? 'has-error' : '' }}">
                            <input type="file" class="image" accept="image/*" name="image" data-fouc>
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
    var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
    '  <div class="modal-content">\n' +
    '    <div class="modal-header align-items-center">\n' +
    '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
    '      <div class="kv-zoom-actions btn-group">{close}</div>\n' +
    '    </div>\n' +
    '    <div class="modal-body">\n' +
    '      <div class="floating-buttons btn-group"></div>\n' +
    '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</div>\n';

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

        if($().fileinput){
            $(".image").fileinput({
                overwriteInitial: true,
                showCaption: false,
                autoReplace: true,
                browseLabel: '',
                removeLabel: '',
                browseIcon: '<i class="icon-folder-search"></i>',
                removeIcon: '<i class="icon-folder-remove"></i>',
                removeTitle: 'Cancel or reset changes',
                elErrorContainer: '#kv-avatar-errors-1',
                msgErrorClass: 'alert alert-block alert-danger',
                defaultPreviewContent: '<img src="/assets/img/products/{{ $product->image }}" alt="Your Avatar" style="width: 100%">',
                layoutTemplates: {
                    main2: '{preview} {remove} {browse}',
                    icon: '<i class="icon-file-check"></i>',
                    modal: modalTemplate,
                    actions: '<div class="file-actions"><div class="file-footer-buttons">{zoom}</div></div>'
                },
                previewZoomButtonClasses: {close: 'btn btn-light btn-icon btn-sm'},
                previewZoomButtonIcons: { close: '<i class="icon-cross2 font-size-base"></i>' },
                allowedFileExtensions: ["jpg", "png", "jpeg"],
                fileActionSettings: { zoomIcon: '<i class="icon-zoomin3"></i>' },
                showClose: false,
                maxFileSize: 2000
            });
        }


        $('#form-submit').on('submit', function(e){

            var btn = $(this).find('button[type=submit]'),
            initialText = btn.data('initial-text'),
            loadingText = btn.data('loading-text');
            btn.html(loadingText).addClass('disabled').attr('disabled', true);

        });

    });


</script>

@endpush

