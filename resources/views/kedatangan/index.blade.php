@extends('layouts.base')

@section('title', 'Form Kedatangan Material')

@section('content')
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row g-5 g-xl-8">
        <div class="col-sm-12">
            <div class="card mb-5 mb-xl-8">
                 <div class="card-header">
                    <h3 class="card-title">Form Kedatangan Material</h3>
                </div>
                <div class="card-body mb-4">
                    <form action="{{ url('kedatangan/postKedatangan') }}" method="post" id="postKedatangan">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="float-end">
                                <a href="javascript:void(0)" class="btn btn-dark btn-lg mb-4" onclick="getUpdateQty()">Update Qty</a>
                            </div>
                            <table class="table table-bordered table-scroll mt-3" id="productTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Frame</th>
                                        <th scope="col">Warna</th>
                                        <th scope="col">Qty Kedatangan</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">
                                            <a class="btn btn-info" id="addProduct"><i
                                                    class="mdi mdi-plus-box mdi-2x"></i> Add
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="float-end hide">
                        <button type="submit" class="btn btn-primary btn-lg btnSave"><i class="mdi mdi-check-circle-outline"></i> Simpan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-revisi" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ url('kedatangan/postUpdateQty') }}" method="post" id="formUpdateQty" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-boredred" id="table-revisi">
                                <thead>
                                    <tr class="text-center">
                                        <th>NO</th>
                                        <th>FRAME</th>
                                        <th>WARNA</th>
                                        <th>QTY KEDATANGAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnUpdate btn-lg"> Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">

    $('#formUpdateQty').on('submit', function(){
        $('.btnUpdate').attr('disabled', true)
    });

    function getUpdateQty(){
        $.ajax({
            url: "{{ url('kedatangan/getUpdateQty') }}",
            type: "GET",
            success: function (response) {
                if(response.data.length == 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Data Tidak Di temukan..',
                    });
                }else{
                    $('#modal-revisi').modal('show');
                    $('#table-revisi tbody').html('');
                    $.each(response.data, function (i, item) {
                        $('#table-revisi tbody').append(`
                            <tr class="text-center">
                                <td>${i+1}</td>
                                <td>${item.frame}</td>
                                <td>${item.warna}</td>
                                <td>
                                    <input type="text" name="qty[]" class="form-control" value="${item.stok_after}">
                                    <input type="hidden" name="id_transaksi[]" class="form-control" value="${item.id}">
                                </td>
                            </tr>
                        `);
                    });
                }
            },
            error: function(error){
                    $('.btnUpdate').attr('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Please Refresh Your Page..',
                    });
                }
        });
    }
    $('#postKedatangan').submit(function(e) {
        e.preventDefault();
        $('.btnSave').attr('disabled', true);
        $.ajax({
            url : "{{ url('kedatangan/checkInputan') }}",
            type : "POST",
            data : $('#postKedatangan').serialize(),
            dataType : 'json',
            success : function(response) {
                if (response.status == 'ok') {
                     $.ajax({
                            url : "{{ url('kedatangan/postKedatangan') }}",
                            type : "POST",
                            data : $('#postKedatangan').serialize(),
                            dataType : 'json',
                            success : function(response) {
                                if (response.status == 'ok') {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data berhasil Di simpan!',
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                }
                            },
                            error: function(error) {
                                $('.btnSave').attr('disabled', false);
                            }
                     });
                } else {
                    $('.btnSave').attr('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Ada Double Data, Periksa Kembali inputan kamu..',
                    })
                }
            },
            error : function(error){
                $('.btnSave').attr('disabled', false);
                 Swal.fire({
                        icon: 'error',
                        title: 'Please Refresh Your Page..',
                    })
            }
        })
    });

        $(document).ready(function() {
            var html =
                `<tr>
                    <td>
                        <select class="form-control" name="frame[]" required>
                            <option value="" disabled selected>SILAHKAN PILIH</option>
                            @foreach($data->groupBy('frame') as $list => $key)
                                <option value="{{ $list }}">{{ $list }}</option>
                            @endforeach
                        </select>
                        </td>
                        <td>
                            <select class="form-control" name="warna[]" required>
                                <option value="" disabled selected>SILAHKAN PILIH</option>
                                @foreach($data->groupBy('warna') as $item => $key)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="form-group">
                              <input type="number"
                                class="form-control" name="qty_kedatangan[]" id="" aria-describedby="helpId" placeholder="Silahkan isi" required>
                            </div>
                        </td>
                    <td>
                        Pcs
                    </td>
                    <td>
                        <button class="btn btn-danger remove"><i class="mdi mdi-trash-can-outline" aria-hidden="true"></i> Delete</button>
                    </td>
                </tr>
                `;
            $("#addProduct").click(function() {
                $('tbody').append(html);
                $('.float-end').removeClass('hide')
            });

            $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
            });
        });
    </script>
@endsection
