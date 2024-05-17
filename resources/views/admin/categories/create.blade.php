@section('title', 'Admin / Categories / Create')
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
                            <h1 class="h3 mb-2 text-gray-800">Registrar nueva categoría</h1>
                        </div>

                        <div class="col-lg-3">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary float-right">Volver</a>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('admin.categories.store') }}" method="post" id="create-category-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Categoría *</label>
                                        <input type="text" name="title" placeholder="Categoría *" class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4 float-end">
                                        <button type="submit" class="btn btn-info btn-sm">Registrar categoría</button>
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