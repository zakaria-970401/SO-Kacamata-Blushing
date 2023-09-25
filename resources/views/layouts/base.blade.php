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
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.css" />


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
                                    <input type="password" name="password" class="form-control Password"
                                        placeholder="Masukan Password Baru" aria-describedby="helpId" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <input type="password" name="password_konfirm" class="form-control Password"
                                        placeholder="Konfirmasi Password" aria-describedby="helpId" required>
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

    <div class="modal fade" id="hasil-stokopname" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hasil Stok Opaname</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="date" class="form-control" name="" id="tanggalMulai"
                                    aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Tanggal Mulai</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="date" class="form-control" name="" id="tanggalSelesai"
                                    aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Tanggal Mulai</small>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-4">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap" id="itemTable">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>NO.</th>
                                            <th>STATUS</th>
                                            <th>FRAME</th>
                                            <th>WARNA</th>
                                            <th>STOCK ON SISTEM</th>
                                            <th>STOCK ON ACTUAL</th>
                                            <th>SELISIH</th>
                                            <th>COUNT TIME</th>
                                            <th>COUNT BY</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btnCari btn-lg" onclick="cariHasil()">
                        Cari</button>
                </div>
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
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <!-- App js -->
    <script src="{{ url('assets/js/app.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table_so = $('#itemTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });

        function cariHasil() {
            $('.btnCari').attr('disabled', true);
            var tanggalMulai = $('#tanggalMulai').val();
            var tanggalSelesai = $('#tanggalSelesai').val();
            if (tanggalMulai == '' || tanggalSelesai == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tanggal Mulai dan Tanggal Selesai Harus Diisi!',
                });
                $('.btnCari').attr('disabled', false);
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ url('so/cariData/') }}/" + tanggalMulai + "/" + tanggalSelesai,
                    data: {
                        tanggalMulai: tanggalMulai,
                        tanggalSelesai: tanggalSelesai
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.data.length > 0) {
                            $('.btnCari').attr('disabled', false);
                            table_so.clear()
                            var no = 1;
                            var status_selisih = '';
                            $.each(response.data, function(index, value) {
                                if (value.stok_sistem == value.stok_actual) {
                                    status_selisih =
                                        `<span class="badge border border-success text-success">SESUAI</span>`
                                } else {
                                    status_selisih =
                                        `<span class="badge border border-danger text-danger">SELISIH</span>`
                                }
                                table_so.row.add([
                                    no++,
                                    status_selisih,
                                    value.frame,
                                    value.warna,
                                    value.stok_sistem + ' Pcs',
                                    value.stok_actual + ' Pcs',
                                    value.stok_actual - value.stok_sistem + ' Pcs',
                                    formatTanggalWaktuIndonesia2(value.created_at),
                                    value.created_by
                                ]).draw();
                            });
                        } else {
                            $('.btnCari').attr('disabled', false);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Data Tidak Ditemukan!',
                            });
                        }
                    },
                    error: function(error) {
                        $('.btnCari').attr('disabled', false);
                    }
                });
            }
        }


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

        function formatTanggalWaktuIndonesia2(tanggal) {
            var formated;
            const today = new Date(tanggal);
            const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            formated = kasihNol(today.getDate()) + ' ' + bulan[today.getMonth()] + ' ' + kasihNol(today.getFullYear()) +
                ' ' + kasihNol(today.getHours()) + ':' + kasihNol(today.getMinutes()) + ':' + kasihNol(today.getSeconds());

            if (tanggal == null || tanggal == '') {
                formated = '';
            }

            return formated;
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
