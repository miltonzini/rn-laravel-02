@section('title', 'Admin | Listado de Usuarios')
<x-adminLayout>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.admin.aside')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('partials.admin.nav')

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Listado de usuarios</h1>
                    @if (isset($usersCount) && !isset($search))
                        <p class="mb-4">Total registrados: <span class="info-primary-soft">{{ $usersCount }}</span></p>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('admin.users.index') }}" method="post" class="search-form ">
                                @csrf
                                <div class="input-group input-group-sm" style="">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Buscar usuario (nombre, apellido ó email)" value="{{ isset($search) ? $search : '' }}">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            @if (isset($search) && isset($usersCount))
                            <p class="mb-4">Resultados: <span class="info-primary-soft">{{ $usersCount }}</span></p>
                            @endif

                            @if (!empty($users) && count($users) > 0 )
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nombre y apellido</th>
                                                <th>Email</th>
                                                <th>Fecha de registro</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->name . ' ' . $user->surname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                                    |
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#user-delete-modal-{{$user->id}}"><i class="fa fa-trash"></i></a>

                                                    <div class="modal fade" id="user-delete-modal-{{$user->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">¿Desea eliminar el usuario?</div>
                                                                <div class="modal-body">
                                                                    <p>¿Eliminar <strong>{{ $user->name . ' ' . $user->surname }}</strong>?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-danger delete-user-button" data-user-id="{{ $user->id }}">Eliminar</button>
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
                                {{ $users->links() }}
                                <div>
                            @else
                                <div class="px-4 py-4">
                                    <h4>No se encontraron usuarios</h4>
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