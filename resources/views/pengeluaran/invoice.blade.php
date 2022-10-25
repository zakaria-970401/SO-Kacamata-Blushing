@extends('layouts.base')

@section('title', 'Invoice Pengeluaran Material')

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
                                    <img src="{{asset('assets/images/logo-blushing.png')}}" class="card-logo card-logo-dark" alt="logo light" height="40">
                                    <div class="mt-sm-5 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold">Alamat</h6>
                                        <p class="text-muted mb-1" id="address-details"> Ruko Rose Garden, Jl. Rose Garden 3 No.20, RT.002/RW.017,</p> <p  class="text-muted mb-1">
                                            Jaka Setia, Kec. Bekasi Sel., Kota Bks, Jawa Barat 17148
                                        </p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                    <h6><span class="text-muted fw-normal">Dibuat Oleh:</span><span id="legal-register-no"> {{$data[0]->created_by ?? '-'}}</span></h6>
                                    <h6><span class="text-muted fw-normal">Detail Waktu:</span><span id="email">     {{\Carbon\carbon::parse($data[0]->created_at)->format('d-M-Y H:i') .' WIB' ?? '-'}}</span></h6>
                                    {{-- <h6><span class="text-muted fw-normal">Website:</span> <a href="https://themesbrand.com/" class="link-primary" target="_blank" id="website">www.themesbrand.com</a></h6>
                                    <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span id="contact-no"> +(01) 234 6789</span></h6> --}}
                                </div>
                            </div>
                        </div>
                        <!--end card-header-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-3">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">No. Invoice</p>
                                    <h5 class="fs-14 mb-0"><span id="invoice-no">{{$data[0]->no_invoice ?? '-'}}</span></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-3">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">TANGGAL</p>
                                    <h5 class="fs-14 mb-0"><span id="invoice-date">{{\Carbon\carbon::parse($data[0]->created_at)->format('d-M-Y') ?? '-'}}</span> </h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-3">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Status Inovice</p>
                                    @if($data[0]->type == 'in') 
                                        <span class="badge badge-soft-success fs-11" id="payment-status">
                                            KEDATANGAN ITEM
                                    @else
                                        <span class="badge badge-soft-danger fs-11" id="payment-status">
                                            PENGELUARAN ITEM
                                    @endif
                                </span>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-3">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">TOTAL ITEM</p>
                                    <h5 class="fs-14 mb-0"><span id="total-amount">{{count($data)}} ITEM</span></h5>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">FRAME</th>
                                            <th scope="col">WARNA</th>
                                            <th scope="col">QTY PENGELUARAN</th>
                                            <th scope="col">HARGA JUAL</th>
                                            <th scope="col">TOTAL</th>
                                            <th scope="col">PROFIT</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($data as $item)
                                        <tr class="text-center">
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <span class="fw-medium">{{$item->frame}}</span>
                                            </td>
                                            <td>{{$item->warna}}</td>
                                            <td>{{$item->qty . ' Pcs'}}</td>
                                            <td>{{ 'Rp ' . number_format($item->harga_jual  ,0,',','.');}}
                                            </td>
                                            @php
                                                $total_harga = $item->harga_jual * $item->qty;
                                                $qty[] = $item->qty;
                                                $sub_total[] = $item->harga_jual * $item->qty;
                                            @endphp
                                            <td>
                                                {{ 'Rp ' . number_format($total_harga  ,0,',','.');}}
                                            </td>
                                            @php
                                                $profit = ($item->harga_jual - $item->harga_pokok) * $item->qty;
                                                $total_profit[] = ($item->harga_jual - $item->harga_pokok) * $item->qty;
                                            @endphp
                                            <td>{{ 'Rp ' . number_format($profit  ,0,',','.');}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><!--end table-->
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                    <tbody>
                                        <tr class="text-center">
                                            <td colspan="2">Sub Total</td>
                                            <td>{{ 'Rp ' . number_format(array_sum($sub_total)  ,0,',','.');}}</td>
                                        </tr>
                                        <tr class="text-center">
                                            <td colspan="2">Total Profit</td>
                                            <td>{{ 'Rp ' . number_format(array_sum($total_profit)  ,0,',','.');}}</td>
                                        </tr>
                                        <tr class="border-top border-top-dashed">
                                            <th>GRAND TOTAL</th>
                                            <th>{{ 'Rp ' . number_format(ABS(array_sum($total_profit) - array_sum($sub_total))   ,0,',','.');}}</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            {{-- <div class="mt-4">
                                <div class="alert alert-info">
                                    <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                        <span id="note">All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or
                                            credit card or direct payment online. If account is not paid within 7
                                            days the credits details supplied as confirmation of work undertaken
                                            will be charged the agreed quoted fee noted above.
                                        </span>
                                    </p>
                                </div>
                            </div> --}}
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
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
    <script type="text/javascript">

    </script>
@endsection
