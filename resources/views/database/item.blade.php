@extends('layouts.base')

@section('title', 'Management Item Material')

@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row g-5 g-xl-8">
        <div class="col-xxl-4">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#add-item" data-bs-toggle="modal" class="btn btn-lg btn-primary mb-4 text-white"><i
                                    class="mdi mdi-database-check-outline mdi-lg"></i> Add Item</a>
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap" id="itemTable">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>NO.</th>
                                            <th>FRAME</th>
                                            <th>WARNA</th>
                                            <th>HARGA POKOK</th>
                                            <th>HARGA JUAL</th>
                                            <th>Update Terakhir</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr class="text-center">
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $item->frame }}
                                                </td>
                                                <td>
                                                    {{ $item->warna }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format($item->harga_pokok, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if($item->updated_at != null)
                                                    {{ formatTanggalIndonesia2($item->updated_at) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-lg btn-info"
                                                        onclick="showItem('{{ $item->id }}')"><i
                                                            class="mdi mdi-note-edit-outline"></i> Edit
                                                    </a>
                                                    <a href="{{ url('master/deleteItem/' . $item->id) }}"
                                                        class="btn btn-lg btn-danger"><i class="mdi mdi-delete-circle"></i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-item" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ url('master/postItem') }}" method="post" id="post_user">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <input type="text" name="frame" id="" class="form-control"
                                        placeholder="Masukan Frame" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control mt-4" name="warna" onchange="selectWarna(this.value)"
                                        id="" required>
                                        <option value="" disabled selected>WARNA</option>
                                        @foreach ($data->groupBy('warna') as $item => $key)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                        <option value="dll">Free Text</option>
                                    </select>
                                </div>
                                <div class="appendWarna">
                                </div>
                                <hr>
                                <div class="mb-3 mt-3">
                                    <input type="number" name="harga_pokok" id="" class="form-control hargaPokok"
                                        placeholder="harga Pokok" aria-describedby="helpId" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <input type="number" name="harga_jual" id="" class="form-control hargaJual"
                                        placeholder="harga Jual" aria-describedby="helpId" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btnSave"><i class="fas fa-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-item" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ url('master/updateItem') }}" method="post" id="updateUser">
                    @csrf
                    <input type="hidden" name="id" class="idItemValue">
                    <div class="modal-body">
                        <div class="row appendItem">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btnUpdate"><i class="fas fa-save"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#itemTable').DataTable();
        });

        function selectWarna(value) {
            if (value == 'dll') {
                $('.appendWarna').append(
                    '<input type="text" name="warna" id="" class="form-control mt-4" placeholder="Masukan Warna" aria-describedby="helpId" required>'
                );
            } else {
                $('.appendWarna').empty();
            }
        }

        function showItem(id) {
            $.ajax({
                url: "{{ url('master/showItem') }}/" + id,
                type: "GET",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#show-item').modal('show');
                    $('.idItemValue').val(response.data.id);
                    $('.appendItem').html("");
                    $('.appendItem').append(`
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label>Frame</label>
                                    <input type="text" name="frame" id="" class="form-control"
                                        placeholder="Masukan Frame" value="${response.data.frame}" required>
                                </div>
                                <div class="form-group">
                                    <label>Warna</label>
                                    <select class="form-control" name="warna" onchange="selectWarna(this.value)"
                                        id="" required>
                                        <option value="${response.data.warna}" selected>${response.data.warna}</option>
                                        @foreach ($data->groupBy('warna') as $item => $key)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                        <option value="dll">Free Text</option>
                                    </select>
                                </div>
                                <div class="appendWarna">
                                </div>
                                <hr>
                                <div class="form-group mb-3 mt-3">
                                    <label>Harga Pokok</label>
                                    <input type="number" name="harga_pokok" id="" class="form-control hargaPokok"
                                        placeholder="harga Pokok" value="${response.data.harga_pokok}" required>
                                </div>
                                <div class="form-group mb-3 mt-3">
                                    <label>Harga Jual</label>
                                    <input type="number" name="harga_jual" id="" class="form-control hargaJual"
                                        placeholder="harga Jual" value="${response.data.harga_jual}" required>
                                </div>
                            </div>
                    `);
                }
            });
        }

        $('#post_user').on('submit', function() {
            $('.btnSave').html('<i class="mdi mdi-spin"></i> Saving...');
            $('.btnSave').attr('disabled', true);
        });

        $('#updateUser').on('submit', function() {
            $('.btnUpdate').html('<i class="mdi mdi-spin"></i> Saving...');
            $('.btnUpdate').attr('disabled', true);
        });
    </script>
@endsection
