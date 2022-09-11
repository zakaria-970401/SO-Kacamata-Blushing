@extends('layouts.base')

@section('title', 'Management Stok Material')

@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row">
        @foreach ($data as $item)
            <div class="col-sm-3">
                <div class="card card-body" style="border-radius: 23px;">
                    <div class="d-flex mb-4 align-items-center">
                        <div class="flex-grow-1 ms-2">
                            <h3 class="card-title mb-1">{{ $item->frame }}</h3>
                            <b>
                                <p class="text-dark mb-0">{{ $item->warna }}</p>
                            </b>
                        </div>
                    </div>
                    <h6 class="mb-1">STOK : {{ $item->stok_after }} Pcs</h6>
                    <input type="hidden" value="{{ $item->stok_after }}" class="itemValue-{{ $item->id }}">
                    <p class="card-text text-muted">Update Terakhir : {{ formatTanggalIndonesia2($item->count_at) }}
                    </p>
                    <p class="card-text text-muted">By : {{ $item->count_by }}
                    </p>
                    @if(Auth::user()->auth_group == 1)
                    <a href="javascript:void(0)" onclick="editStok('{{ $item->id }}')"
                        class="btn btn-primary btn-sm">Edit</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#itemTable').DataTable();
        });

        function editStok(id) {
            var stok = $('.itemValue-' + id).val();
            let qty = prompt("Stok Terakhir : ", stok);
            if (qty != null) {
                location.href = "{{ url('master/updateStok') }}/" + qty + "/" + id;
            } else {
                return false;
            }
        }
    </script>
@endsection
