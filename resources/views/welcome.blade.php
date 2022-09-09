<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>

    <meta charset="utf-8" />
    <title>FORM LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('assets/images/favico.ico') }}">
    <!-- Layout config Js -->
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <style type="text/css">
        .hide {
            display: none;
        }
    </style>

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-light.png" alt="" height="90">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Indonesian 1st Fashion Eyewear</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            @auth
                                <script>
                                    location.href = "{{ url('/home ') }}"
                                </script>
                            @else
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <p class="text-muted">Form Sign in</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form id="doLogin">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" required class="form-control" id="username"
                                                    placeholder="Enter username" autofocus="on">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" required class="form-control pe-5"
                                                        placeholder="Enter password" id="password-input">
                                                    <button
                                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100 btnSubmit" type="submit">Sign
                                                    In</button>
                                                <button type="button" class="btn btn-success btn-load hide w-100">
                                                    <span class="d-flex align-items-center">
                                                        <span class="spinner-border flex-shrink-0" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Loading...
                                                        </span>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- end Footer -->
        </div>
        <!-- end auth-page-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ url('assets/js/plugins.js') }}"></script>

        <!-- particles js -->
        <script src="{{ url('assets/libs/particles.js/particles.js') }}"></script>
        <!-- particles app js -->
        <script src="{{ url('assets/js/pages/particles.app.js') }}"></script>
        <!-- password-addon init -->
        <script src="{{ url('assets/js/pages/password-addon.init.js') }}"></script>
        <script src="{{ url('assets/js/pages/notifications.init.js') }}"></script>
        <script src="{{ url('assets/libs/prismjs/prism.js') }}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#doLogin').submit(function(e) {
                e.preventDefault();
                var username = $('#username').val();
                var password = $('#password-input').val();
                $('.btnSubmit').addClass('hide');
                $('.btn-load').removeClass('hide');
                $.ajax({
                    url: "{{ route('login') }}",
                    type: "POST",
                    datatype: "JSON",
                    data: {
                        username: username,
                        password: password,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == '1') {
                            window.location.href = "{{ route('home') }}";
                        } else {
                            Toastify({
                                text: "Tidak Di Kenali, Periksa Kembali Username dan Password Anda",
                                duration: 5000,
                                newWindow: true,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "right", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "red",
                                },
                            }).showToast();
                            $('.btn-load').addClass('hide');
                            $('.btnSubmit').removeClass('hide');
                        }
                    },
                    error: function(error) {
                        $('.btn-load').addClass('hide');
                        $('.btnSubmit').removeClass('hide');
                        Toastify({
                            text: "Tidak Di Kenali, Periksa Kembali Username dan Password Anda",
                            duration: 5000,
                            newWindow: true,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "red",
                            },
                        }).showToast();
                    }
                });
            });
        </script>
    </body>

    </html>
    {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> --}}
