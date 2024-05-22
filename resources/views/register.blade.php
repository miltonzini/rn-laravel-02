@section('title', 'Registrarse')
<x-adminLayout>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crear una cuenta</h1>
                            </div>
                            <form class="user" action="{{ route('store-user') }}" method="post" id="register-form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Nombre" name="name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" placeholder="Apellido" name="surname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" placeholder="Email" name="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" placeholder="Contraseña" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" placeholder="Repetir contraseña" name="repeat-password">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block" id="register-button">Registrarme</button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@push('scripts')
@if (isset($scripts) && !empty($scripts))
@foreach ($scripts as $script)
    <script src="{{ asset('public/js/functions/' . $script) }}"></script>
@endforeach
@endif
@endpush
</x-adminLayout>