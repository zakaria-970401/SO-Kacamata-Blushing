@extends('layouts.base')
@section('title', 'Transcation Report')
@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <div class="row g-5 g-xl-8">
        <div class="col-sm-12">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Form Transaction Report</h3>
                </div>
                <div class="card-body mb-4">
                    <form action="{{ url('report/result_transaction_report') }}" method="post" id="searchTransactionReport">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="my-addon">Start Date</span>
                                    </div>
                                    <input class="form-control" type="date" name="start" required
                                        placeholder="Recipient's text" aria-label="Recipient's text"
                                        aria-describedby="my-addon">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="my-addon">End Date</span>
                                    </div>
                                    <input class="form-control" type="date" name="end" required
                                        placeholder="Recipient's text" aria-label="Recipient's text"
                                        aria-describedby="my-addon">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="float-end mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg "><i
                                            class="mdi mdi-check-circle-outline"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @isset($data)
                        <table class="table table-bordered" id="tableResult">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Frame</th>
                                    <th>Warna</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Stock Balance</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $keys => $value)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->item->frame }}</td>
                                        <td>{{ $value->item->warna }}</td>
                                        <td>{{ Str::upper($value->type) }}</td>
                                        <td>{{ $value->qty }}</td>
                                        <td>{{ $value->balance }}</td>
                                        <td>{{ \Carbon\carbon::parse($value->created_at)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    @isset($data)
        <script>
            $(document).ready(function() {
                $('#tableResult').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>
    @endisset

@endsection
