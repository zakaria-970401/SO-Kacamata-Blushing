<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $counting = DB::table('master_pengeluaran_item')
            ->whereYear('created_at', (int)date('Y'))
            ->get();

        $master = DB::table('profit')
            ->where('tahun', (int)date('Y'))
            ->get();

        foreach ($bulan as $key => $value) {
            $counting_penjualan[] = $counting->where('pariode', $key)->sum('qty') ?? 0;
            $data[]               = $master->where('pariode', $key)->first()->profit ?? 0;
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
            }
        }
        $my_chart = json_encode($my_chart);

        return view('home', compact('series', 'series_count_penjualan', 'my_chart'));
    }
}
