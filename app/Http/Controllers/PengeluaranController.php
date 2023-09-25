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
use Illuminate\Support\Str;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = DB::table('master_item')
            ->join('master_stok_item', 'master_item.id', '=', 'master_stok_item.id_item')
            ->get();
        return view('pengeluaran.index', compact('data'));
    }

    public function postPengeluaran(Request $request)
    {
        $master = DB::table('master_item')
            ->whereIn('frame', $request->frame)
            ->whereIn('warna', $request->warna)
            ->get();

        $id_item = $master->pluck('id')->toArray();
        $stock = DB::table('master_stok_item')
            ->whereIn('id_item', $id_item)
            ->get();

        $kode_pengeluaran = Str::random(10);

        for ($i = 0; $i < count($master); $i++) {
            DB::table('master_pengeluaran_item')
                ->insert([
                    'kode_pengeluaran' => $kode_pengeluaran,
                    'id_item' => $master[$i]->id,
                    'qty' => $request->qty_pengeluaran[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->name,
                ]);

            DB::table('master_stok_item')
                ->where('id_item', $id_item[$i])
                ->update([
                    'stok' => $stock[$i]->stok - $request->qty_pengeluaran[$i],
                    'updated_count_at' => date('Y-m-d H:i:s'),
                    'updated_count_by' => Auth::user()->name
                ]);

            $lasting = DB::table('report_transaksi')
                ->where('id_item', $id_item[$i])
                ->orderBy('id', 'DESC')
                ->first();

            if (is_null($lasting)) {
                $last = 0;
            } else {
                $last = $lasting->balance;
            }

            DB::table('report_transaksi')
                ->insert([
                    'id_item' => $id_item[$i],
                    'kode_pengeluaran' => $kode_pengeluaran,
                    'type' => 'out',
                    'qty' => $request->qty_pengeluaran[$i],
                    'balance' => ABS($last - $request->qty_pengeluaran[$i]),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->name
                ]);
        }

        return response()->json([
            'data' => $kode_pengeluaran,
            'status' => 'ok'
        ]);
    }

    public function checkInputan(Request $request)
    {
        for ($i = 0; $i < count($request->frame); $i++) {
            $data[] = $request->frame[$i] . '-' . $request->warna[$i];
        }
        $check = max(array_count_values($data));
        if ($check > 1) {
            return response()->json(['status' => 'double']);
        } else {
            return response()->json(['status' => 'ok']);
        }
    }

    public function report($params)
    {
        $data = DB::table('master_pengeluaran_item')
            ->where('kode_pengeluaran', $params)
            ->get();

        $data->map(function ($value) {
            $value->master_item = DB::table('master_item')->where('id', $value->id_item)->first() ?? '-';
            return $value;
        });

        return view('pengeluaran.report', compact('data'));
    }
}
