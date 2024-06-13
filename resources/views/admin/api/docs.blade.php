@section('title', 'Admin | API')
<x-adminLayout>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.admin.aside')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('partials.admin.nav')

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Documentación API Pública</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row api-docs">
                                <div>
                                    <h2>Introducción</h2>
                                    <p>Actualmente se trata de una api pública, sin autenticación. Se pueden probar los diferentes endopoints en el navegador o con Postman</p>

                                    <h2>Api Key</h2>
                                    <p class="text-muted">{{ $apiKey }}</p>

                                    <h2>Endpoints</h2>
                                    @php
                                        $productsEndpoint = 'http://localhost/rn-laravel-02/api/v1/products';
                                        $categoriesEndpoint = 'http://localhost/rn-laravel-02/api/v1/categories';
                                        $productTagsEndpoint = 'http://localhost/rn-laravel-02/api/v1/product-tags';
                                    @endphp
                                    <p class="endpoint"><span class="http-method-tag get-method">GET</span> {{ $productsEndpoint }} <a href="{{ $productsEndpoint }}" target="_blank"><i class="fa fa-arrow-alt-circle-right" aria-hidden="true"></i></a></p>
                                    <p class="endpoint"><span class="http-method-tag get-method">GET</span> {{ $categoriesEndpoint }} <a href="{{ $categoriesEndpoint }}" target="_blank"><i class="fa fa-arrow-alt-circle-right" aria-hidden="true"></i></a></p>
                                    <p class="endpoint"><span class="http-method-tag get-method">GET</span> {{ $productTagsEndpoint }} <a href="{{ $productTagsEndpoint }}" target="_blank"><i class="fa fa-arrow-alt-circle-right" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere salir del sistema?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seleccionar "Salir" para cerrar la sesión de su cuenta.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="login.html">Salir</a>
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
