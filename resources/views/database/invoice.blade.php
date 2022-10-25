@extends('layouts.base')

@section('title', 'Master Invoice')

@section('content')
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row">
        <div class="col-xxl-6">
            <h5 class="mb-3">MASTER INVOICE</h5>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light active" data-bs-toggle="tab" href="#animation-home" role="tab">
                                Kedatangan Item
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" data-bs-toggle="tab" href="#animation-profile" role="tab">
                                Pengeluaran Item
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="animation-home" role="tabpanel">
                            <div class="d-flex">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO.</th>
                                            <th>#</th>
                                            <th>TANGGAL INVOICE</th>
                                            <th>CREATED BY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->where('type', 'in') as $item)
                                            <tr class="text-center">
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{url('kedatangan/invoice/' . $item->no_invoice)}}" class="btn btn-sm btn-info"><i
                                                            class="fas fa-eye"></i> Show
                                                    </a>
                                                </td>
                                                <td>{{ \Carbon\carbon::parse($item->created_at)->format('d M Y H:i') . ' WIB' }}</td>
                                                <td>{{$item->created_by}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="animation-profile" role="tabpanel">
                            <div class="d-flex">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO.</th>
                                            <th>#</th>
                                            <th>TANGGAL INVOICE</th>
                                            <th>CREATED BY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->where('type', 'out') as $item)
                                            <tr class="text-center">
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{url('pengeluaran/invoice/' . $item->no_invoice)}}" class="btn btn-sm btn-info"><i
                                                            class="fas fa-eye"></i> Show
                                                    </a>
                                                </td>
                                                <td>{{ \Carbon\carbon::parse($item->created_at)->format('d M Y H:i') . ' WIB' }}</td>
                                                <td>{{$item->created_by}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
      
    </script>
@endsection
