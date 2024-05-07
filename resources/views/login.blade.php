@section('title', 'Login')
<x-adminLayout>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 m-auto">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Iniciar sesión</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"placeholder="Contraseña">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>

                                    <hr>

                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Crear una cuenta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</x-adminLayout>