@section('title', 'Admin / Users / Edit')
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
                            <h1 class="h3 mb-2 text-gray-800">Editar usuario</h1>
                        </div>

                        <div class="col-lg-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary float-right">Volver</a>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', ['id' => $userData->id])}}" method="post" id="edit-user-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Nombre *</label>
                                        <input type="text" name="name" placeholder="nombre *" class="form-control" value="{{ $userData->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Apellido *</label>
                                        <input type="text" name="surname" placeholder="apellido *" class="form-control" value="{{ $userData->surname }}">
                                    </div>

                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="control-label">email *</label>
                                        <input type="email" name="email" placeholder="Email *" class="form-control"  value="{{ $userData->email }}">
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="control-label">Contraseña</label>
                                        <input type="password" name="password" placeholder="Contraseña" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Confirmar Contraseña</label>
                                        <input type="password" name="repeat-password" placeholder="Confirmar contraseña" class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4 float-end">
                                        <button type="submit" class="btn btn-info btn-sm" id="update-user-button">Actualizar usuario</button>
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