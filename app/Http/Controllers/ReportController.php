<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Imports\CycleCount\CycleCountImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use Session;

class ReportController extends Controller
{

    public function index()
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $master = DB::table('profit')
            ->where('tahun', (int)date('Y'))
            ->get();

        $counting = DB::table('master_pengeluaran_item')
            ->whereYear('created_at', (int)date('Y'))
            ->get();

        foreach ($bulan as $key => $value) {
            $data[]               = $master->where('pariode', $key)->first()->profit ?? 0;
            $counting_penjualan[] = $counting->where('pariode', $key)->sum('qty') ?? 0;
        }

        $series = [
            [
                'name' => 'Bulan',
                'data' => $data,
            ],
        ];
        $series = json_encode($series);

        $series_count_penjualan = [
            [
                'name' => 'Bulan',
                'data' => $counting_penjualan,
            ],
        ];
        $series_count_penjualan = json_encode($series_count_penjualan);

        $my_chart = [];
        $dataChart = DB::table('master_pengeluaran_item')
            ->whereYear('created_at', (int)date('Y'))
            ->get()->groupBy('id_item');

        foreach ($dataChart as $key => $value) {
            $d = DB::table('master_item')
                ->select('frame', 'warna',  DB::raw('SUM(qty) as qty'))
                ->join('master_pengeluaran_item', 'master_item.id', '=', 'master_pengeluaran_item.id_item')
                ->where('id_item', $key)
                ->groupBy('id_item')
                ->get();
            foreach ($d as $y) {
                $my_chart[] = [
                    'name' => $y->frame . ' ' . $y->warna,
                    'y' => (int)$y->qty
                ];

                $frame[] =
                    [
                        'name' => $y->frame . ' ' . $y->warna,
                        'data' => [
                            (int)$y->qty,
                        ],
                    ];
            }
        }

        foreach ($bulan as $key =>  $value) {
            $check[] = DB::table('master_item')
                ->select('frame', 'warna',  DB::raw('SUM(qty) as qty'))
                ->join('master_pengeluaran_item', 'master_item.id', '=', 'master_pengeluaran_item.id_item')
                ->whereMonth('master_pengeluaran_item.created_at', $key)
                ->groupBy('id_item')
                ->get();
            // foreach ($check as $y) {
            //     $frame[] = 
            //     [
            //         'name' => $y->frame . ' ' . $y->warna ?? '-',
            //         'data' => [
            //             (int)$y->qty ?? 0,
            //         ],
            //     ];
            // }
        }
        // dd($check);
        $my_chart = json_encode($my_chart);

        return view('report.index', compact('series', 'series_count_penjualan', 'my_chart'));
    }

    public function transaction_report()
    {
        return view('report.transaction_report');
    }

    public function result_transaction_report(Request $request)
    {
        $data = DB::table('report_transaksi')
            ->whereBetween('created_at', [$request->start . ' 00:00:00', $request->end . ' 23:59:59'])
            ->orderBy('id_item', 'asc')
            ->get();
        $data->map(function ($value) {
            $value->item = DB::table('master_item')->where('id', $value->id_item)->first();
            return $value;
        });
        return view('report.transaction_report', compact('data'));
    }
}
