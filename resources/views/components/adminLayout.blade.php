<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('resources/vendor/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('resources/vendor/sb-admin-2/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/vendor/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <title>RedNodo Laravel 01 | @yield('title')</title>

</head>
{{-- Don´t add body opening tag --}}

{{ $slot }}
    
    <script type="text/javascript">
        var url = '{{ url("/") }}';
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('resources/vendor/sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('resources/vendor/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('resources/vendor/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('resources/vendor/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    @stack('scripts')

</body> {{-- Don´t delete body closing tag --}}
</html> 