@section('title', 'Admin | Crear Producto')
<x-adminLayout>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.admin.aside')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('partials.admin.nav')

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-9">
                            <h1 class="h3 mb-2 text-gray-800">Registrar nuevo producto</h1>
                        </div>

                        <div class="col-lg-3">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary float-right">Volver</a>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="post" id="create-product-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Título *</label>
                                        <input type="text" name="title" placeholder="Título *" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Categoría *</label>
                                        <select name="category" class="form-control">
                                            <option value="">Seleccionar...</option>
                                            @foreach ($categories as $category )
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="control-label">Descripción *</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="control-label">Precio *</label>
                                        <input type="text" name="price" placeholder="Precio *" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">% Descuento</label>
                                        <input type="text" name="discount" placeholder="Descuento" class="form-control">
                                        <small>(sólo valor numérico)</small>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="control-label">Imagen *</label>
                                        <input type="file" name="image-1" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="control-label">Etiquetas</label>
                                        <div class="checkboxes-wrapper">
                                            @foreach ($productTags as $productTag )
                                            <label class="product-tag"><input type="checkbox" name="product-tags[]" value="{{ $productTag->id }}"> {{ $productTag->tag }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 float-end">
                                        <button type="submit" class="btn btn-info btn-sm" id="create-product-button">Registrar producto</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('resources/vendor/sb-admin-2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/vendor/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('resources/vendor/sb-admin-2/js/demo/datatables-demo.js') }}"></script>
@if (isset($scripts) && !empty($scripts))
@foreach ($scripts as $script)
    <script src="{{ asset('public/js/functions/' . $script) }}"></script>
@endforeach
@endif
@endpush
</x-adminLayout>