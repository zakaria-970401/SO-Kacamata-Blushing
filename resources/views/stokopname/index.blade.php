@extends('layouts.base')

@section('title', 'Form Stok Opanme')

@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row appendRow">
     
    </div>

    <div class="modal fade" id="modal-input" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('so/postQty') }}" method="post" id="postQty">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="number" id="qtyValue" class="form-control" placeholder="Qty" aria-describedby="helpId">
                                    <input type="hidden" id="" class="form-control idItemValue" placeholder="Qty" aria-describedby="helpId" name="id_item">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <select class="form-control" name="satuan" onchange="konversi(this.value)" required id="satuanSelect">
                                    <option value="" selected disabled>SATUAN</option>
                                    <option value="kardus">BOX</option>
                                    <option value="pcs">Pcs</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <input type="number" name="qty" id="qty" class="form-control" readonly required>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary btn-lg btnSave">Simpan </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script type="text/javascript">

    $('#postQty').submit(function(e){
        e.preventDefault();
        $('.btnSave').attr('disabled', true);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang sudah di simpan tidak dapat di ubah!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('so/compareQty') }}",
                    type: "POST",
                    data: $('#postQty').serialize(),
                    success: function(response){
                        if(response.status == 'ok'){
                              Swal.fire({
                                icon: 'success',
                                title: 'Good Joob!',
                                text: 'Tidak Ada Selisih!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                      $.ajax({
                                        url: "{{ url('so/postQty') }}",
                                        type: "POST",
                                        data: $('#postQty').serialize(),
                                        success: function(response){
                                            $('#modal-input').modal('hide');
                                            $('.btnSave').attr('disabled', false);
                                            $('#qtyValue').val('');
                                            $('#satuanSelect').val('');
                                            getList();
                                        }
                                    });
                                }
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Selisih Stok',
                                text: 'Inputan Kamu selisih dengan stok yang ada di sistem!',
                            });
                            $('.btnSave').attr('disabled', false);
                        }
                    },
                    error: function(error){
                        $('.btnSave').attr('disabled', false);
                    }
                })
            }else{
                $('.btnSave').attr('disabled', false);
            }
        })
    });

    function konversi(value){
        var qty = $('#qtyValue').val();
        if(value == 'kardus'){
            var konversi = qty * 20;
            $('#qty').val(konversi);
        }else{
            $('#qty').val(qty);
        }
    }
    getList();
    function getList() {
        $.ajax({
            url: "{{ url('so/getList') }}",
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                $('.appendRow').html('');
                $.each(response.data, function(index, value) {
                    $('.appendRow').append(`
                        <div class="col-sm-3">
                            <div class="card card-body" style="border-radius: 23px;">
                                <div class="d-flex mb-4 align-items-center">
                                    <div class="flex-grow-1 ms-2">
                                        <h3 class="mb-1">` + value.frame + `</h3>
                                        <b>
                                            <p class="text-dark mb-0">` + value.warna + `</p>
                                        </b>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" onclick="input('` + value.id_item + `', '` + value.frame + '-' +value.warna+ `')" class="btn btn-dark btn-lg"><i class="mdi mdi-plus-box"></i> Input</a>
                            </div>
                        </div>
                    `);
                });
            }
        });
    }


    function input(id_item, type){
        $('.idItemValue').val(id_item);
        $('#modal-input').modal('show')
        $('#modalTitleId').text('Kacamata ' + type);
    }
    </script>
@endsection
