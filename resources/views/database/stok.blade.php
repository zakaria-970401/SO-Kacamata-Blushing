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
        <div class="card">
            <div class="card-body">
                <div class="col-sm-8">
                    <input type="text" class="form-control searchbox" placeholder="Pencarian Item...">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($data as $item)
            <div class="col-sm-3" id="myitem">
                <div class="card card-body card-item" style="border-radius: 23px;">
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
                    @if (Auth::user()->auth_group == 1)
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

        var $targets = $('.card-item');

        $('.searchbox').on('input', function() {
            $targets.show();

            var text = $(this).val().toLowerCase();
            if (text) {
                $targets.filter(':visible').each(function() {
                    var $target = $(this);
                    var $matches = 0;
                    // Search only in targeted element
                    $target.find('card-title').add($target).each(function() {
                        if ($(this).text().toLowerCase().indexOf("" + text + "") !== -1) {
                            $matches++;
                        }
                    });
                    if ($matches === 0) {
                        $target.hide();
                    }
                });
            }
        })
    </script>
@endsection
