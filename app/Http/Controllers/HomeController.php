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
        $master = DB::table('profit')
            ->where('tahun', (int)date('Y'))
            ->get();
        foreach ($bulan as $key => $value) {
            // dd($key);
            $data[] = $master->where('pariode', $key)->first()->profit ?? 0;
        }
        $series = [
            [
                'name' => 'Bulan',
                'data' => $data,
            ],
        ];
        $series = json_encode($series);
        return view('home', compact('series'));
    }
}
