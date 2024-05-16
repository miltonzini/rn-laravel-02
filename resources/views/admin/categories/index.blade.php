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
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary float-right">Nueva categoría</a>
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
                                                    <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}"><i class="fa fa-edit"></i></a>

                                                    |

                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#category-delete-modal-{{$category->id}}"><i class="fa fa-trash"></i></a>

                                                    <div class="modal fade" id="category-delete-modal-{{$category->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">¿Desea eliminar la categoría?</div>
                                                                <div class="modal-body">
                                                                    <p>¿Eliminar <strong>{{ $category->title }}</strong>?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-danger delete-category-button" data-category-id="{{ $category->id }}">Eliminar</button>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
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