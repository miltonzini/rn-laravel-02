@section('title', 'Admin | Dashboard')
<x-adminLayout>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.admin.aside')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('partials.admin.nav')

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h2>Resumen</h2>
                            <div class="row dashboard-info">
                                <div class="item bg-primary col-md-3 p-3 m-2 text-light rounded-4"><p><strong class="d-block text-large">{{ $productsCount }}</strong> Productos</p></div>
                                <div class="item bg-primary col-md-3 p-3 m-2 text-light rounded-4"><p><strong class="d-block text-large">{{ $categoriesCount }}</strong> Categorías</p></div>
                                <div class="item bg-primary col-md-3 p-3 m-2 text-light rounded-4"><p><strong class="d-block text-large">{{ $usersCount }}</strong> Usuarios registrados</p></div>
                                <div class="item bg-primary col-md-3 p-3 m-2 text-light rounded-4"><p><strong class="d-block text-large">{{ $sessionsCount }}</strong> Sesiones</p></div>
                                <div class="item bg-primary col-md-3 p-3 m-2 text-light rounded-4"><p><strong class="d-block text-large">{{ $onlineUsersCount }}</strong> Usuarios online</p></div>
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