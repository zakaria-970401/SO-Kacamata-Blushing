@extends('layouts.base')

@section('title', 'Report Pengeluaran Material')

@section('content')
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <img src="{{ asset('assets/images/logo-blushing.png') }}"
                                        class="card-logo card-logo-dark" alt="logo light" height="40">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="4">Report Pengeluaran Item</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th scope="col" style="width: 50px;">No.</th>
                                            <th scope="col">FRAME</th>
                                            <th scope="col">WARNA</th>
                                            <th scope="col">QTY PENGELUARAN</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($data as $item)
                                            @php
                                                $summary[] = $item->qty;
                                            @endphp
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-start">
                                                    <span class="fw-medium">{{ $item->master_item->frame }}</span>
                                                </td>
                                                <td>{{ $item->master_item->warna }}</td>
                                                <td>{{ $item->qty . ' Pcs' }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="text-center">
                                            <td class="" colspan="3">SUMMARY</td>
                                            <td row="col" class="">{{ array_sum($summary) . ' Pcs' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-success"><i
                                        class="ri-printer-line align-bottom me-1"></i> Print</a>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <script type="text/javascript"></script>
@endsection
