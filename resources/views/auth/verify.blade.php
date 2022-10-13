<html lang="en"><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Verifica tu correo electrónico</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('Landing/assets/favicon.ico')}}" />
    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <br><br>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        @if (session('resent'))
                                            <div class="alert alert-success" role="alert">
                                                {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                                            </div>
                                        @endif

                                        {{ __('Antes de continuar, verifique su correo electrónico para ver si hay un enlace de verificación.') }}
                                        {{ __('Si no recibió el correo electrónico') }},
                                    </div>
                                    <form class="d-inline user" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline btn-user btn-block">{{ __('haga clic aquí para solicitar otro') }}</button>.
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>
</body>
</html>