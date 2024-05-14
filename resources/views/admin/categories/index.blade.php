@section('title', 'Admin / Categories / Index')
<x-adminLayout>
<body id="page-top">

    <div id="wrapper">

        @include('partials.admin.aside')

        <div id="content-wrapper" class="d-flex flex-column">
        
            <div id="content">

                @include('partials.admin.nav')

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-9">
                            <h1 class="h3 mb-2 text-gray-800">Listado de categorías</h1>
                            @if (isset($categoriesCount))                                            
                            <p class="mb-4">Total registradas: {{ $categoriesCount }}</p>
                            @endif
                        </div>

                        <div class="col-lg-3">
                            <a href="registro-categoria.html" class="btn btn-primary float-right">Nueva categoría</a>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            @if (!empty($categories) && count($categories) > 0 )
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Categoría</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->title }}</td>
                                                <td>
                                                    <a href="/"><i class="fa fa-edit"></i></a>

                                                    |

                                                    <a href="/"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="pagination p-4">
                                {{ $categories->links() }}
                                <div>

                            @else
                                <div class="px-4 py-4">
                                    <h4>No se encontraron categorías</h4>
                                </div>
                            @endif
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
@if (isset($scripts) && !empty($scripts))
@foreach ($scripts as $script)
    <script src="{{ asset('public/js/functions/' . $script) }}"></script>
@endforeach
@endif
@endpush
</x-adminLayout>