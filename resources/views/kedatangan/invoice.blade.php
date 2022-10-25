@extends('layouts.base')

@section('title', 'Inovice Kedatangan Material')

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
                                            <th scope="col">QTY KEDATANGAN</th>
                                            <th scope="col" class="text-end">HARGA POKOK</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($data as $item)
                                        <tr class="text-center">
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-start">
                                                <span class="fw-medium">{{$item->frame}}</span>
                                            </td>
                                            <td>{{$item->warna}}</td>
                                            <td>{{$item->qty . ' Pcs'}}</td>
                                            <td class="text-end">{{ 'Rp ' . number_format($item->harga  ,0,',','.');}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><!--end table-->
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                    <tbody>
                                        {{-- <tr>
                                            <td>Sub Total</td>
                                            <td class="text-end">$699.96</td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Tax (12.5%)</td>
                                            <td class="text-end">$44.99</td>
                                        </tr>
                                        <tr>
                                            <td>Discount <small class="text-muted">(VELZON15)</small></td>
                                            <td class="text-end">- $53.99</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge</td>
                                            <td class="text-end">$65.00</td>
                                        </tr> --}}
                                        <tr class="border-top border-top-dashed fs-15">
                                            <th scope="row">GRAND TOTAL</th>
                                            <th class="text-end">{{ 'Rp ' . number_format($total_harga  ,0,',','.');}}</th>
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
