<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('assets/images/favico.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ url('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ url('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

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
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                @include('layouts.header')
            </div>
        </header>
        <div class="app-menu navbar-menu">
            @include('layouts.sidebar')
        </div>
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div id="loader" class="lds-dual-ring hide overlay"></div>
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            @include('layouts.footer')
        </div>

    </div>

    <div class="modal fade" id="ganti-pw" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Ganti Password</h5>
                </div>
                <form action="{{ url('change-password') }}" method="post" id="change-password">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="password" name="password" id="" class="form-control Password"
                                        placeholder="Masukan Password Baru" aria-describedby="helpId" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <input type="password" name="password_konfirm" id=""
                                        class="form-control Password" placeholder="Konfirmasi Password"
                                        aria-describedby="helpId" required>
                                </div>
                                <input type="checkbox" class="ml-4 mr-4 mt-4" id="showPass"> Show Password
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ url('assets/js/plugins.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- App js -->
    <script src="{{ url('assets/js/app.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#showPass').on('click', function() {
            var passInput = $(".Password");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });

        $('#change-password').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'gagal') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Password tidak sama!',
                        });
                    } else if (response.status == 'kurang') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Password minimal 6 karakter!',
                        });
                        // toastr.error(data.message);
                    } else {
                        Toastify({
                            text: "Password Berhasil Di Ubah",
                            duration: 5000,
                            newWindow: true,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "green",
                            },
                        }).showToast();
                        $('#ganti-pw').modal('hide');
                        window.location.href = "{{ url('/') }}";
                    }
                }
            });
        });

        function logout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to logout!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('logout') }}",
                        type: "POST",
                        success: function(data) {
                            window.location.href = "{{ url('/') }}";
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            })
        }

        function kasihNol($data) {
            if ($data < 10) {
                return '0' + $data;
            } else {
                return $data;
            }
        }

        function get_time() {
            const today = new Date();
            const time = kasihNol(today.getHours()) + ":" + kasihNol(today.getMinutes()) + ":" + kasihNol(today
                .getSeconds());
            const date = kasihNol(today.getDate()) + '/' + kasihNol((today.getMonth() + 1)) + '/' + kasihNol(today
                .getFullYear());
            // $('.date').text(date);
            $('.time').text(time);
        }

        get_time();

        setInterval(function() {
            get_time();
        }, 1000);
    </script>
</body>

</html>
