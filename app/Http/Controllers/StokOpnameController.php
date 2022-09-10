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

class StokOpnameController extends Controller
{

    public function start(){
        $check = DB::table('master_stokopname')
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->count();

        if($check == 0){
            DB::table('master_stokopname')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->name,
                'status'   => 1
            ]);
        }else{
            $check = DB::table('master_stokopname')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->update([
                'status'    => 1
            ]);
        }

        Session::flash('success', 'Stok Opname Berhasil Di start');
        return back();
    }

    public function stop(){
        $check = DB::table('master_stokopname')
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->count();

        if($check == 0){
            DB::table('master_stokopname')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->name,
                'status'   => 0
            ]);
        }else{
            $check = DB::table('master_stokopname')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))->update([
                'status'    => 0
            ]);
        }
        Session::flash('success', 'Stok Opname Berhasil Di start');
        return back();
    }

    public function index()
    {
        return view('stokopname.index');
    }

    public function getList()
    {
        $item = DB::table('master_item')
        ->select(
            'master_item.frame',
            'master_item.warna',
            'master_stok_item.*',
        )
            ->join('master_stok_item', 'master_item.id', '=', 'master_stok_item.id_item')
            ->get();
        $item->map(function ($item) {
            $item->status_hitungan = DB::table('transaksi_stokopname')->where('id_item', $item->id_item)->count();
                return $item;
        });
        $item = $item->where('status_hitungan', 0);

        return response()->json([
            'status' => 'ok',
            'data' => $item
        ]);   
    }

    public function compareQty(Request $request)
    {
        $stok = DB::table('master_stok_item')
        ->where('id_item', $request->id_item)
        ->first()->stok_after;

        if((int)$stok == (int)$request->qty){
            return response()->json([
                'status' => 'ok',
                'data' => 'ok'
            ]);
        }else{
            return response()->json([
                'status' => 'diff',
                'data' => 'ok'
            ]);
        }
    }

    public function postQty(Request $request){
        $stok = DB::table('master_stok_item')
        ->where('id_item', $request->id_item)
        ->first();

        DB::table('master_stok_item')
            ->where('id_item', $request->id_item)
            ->update([
                'stok_before' => $stok->stok_before,
                'stok_after' => $request->qty,
                'count_at' => date('Y-m-d H:i:s'),
                'count_by' => Auth::user()->name
            ]);

        $id_opname = DB::table('master_stokopname')->orderBY('id', 'DESC')->first()->id;
        DB::table('transaksi_stokopname')
            ->insert([
                'id_stokopname' => $id_opname,
                'id_item'   => $request->id_item,
                'stok_after' => $request->qty,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->name
            ]);

            return response()->json([
                'status' => 'ok'
            ]);
    }

    public function cariData($tgl_mulai, $tgl_selesai){
        $data = DB::table('transaksi_stokopname')
        ->select(
            'master_item.frame',
            'master_item.warna',
            'transaksi_stokopname.qty',
            'transaksi_stokopname.created_at',
            'transaksi_stokopname.created_by',
        )
        // ->join('transaksi_stokopname', 'master_stokopname.id', '=', 'transaksi_stokopname.id_opname')
        ->join('master_item', 'transaksi_stokopname.id_item', '=', 'master_item.id')
        ->whereBetween('transaksi_stokopname.created_at', [$tgl_mulai .' 00:00:00', $tgl_selesai .' 23:59:59'])
        ->get();

        return response()->json([
            'status' => 'ok',
            'data' => $data
        ]);
    }
}
