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

class KedatanganController extends Controller
{

    public function index()
    {
        $data = DB::table('master_item')
            ->get();
        return view('kedatangan.index', compact('data'));
    }

    public function postKedatangan(Request $request)
    {
        $id_item = DB::table('master_item')
            ->whereIn('frame', $request->frame)
            ->whereIn('warna', $request->warna)
            ->get()->pluck('id')->toArray();
        $kode_kedatangan = Str::random(10);

        for ($i = 0; $i < count($id_item); $i++) {
            DB::table('master_stok_item')
                ->insert([
                    'id_item' => $id_item[$i],
                    'kode_kedatangan' => $kode_kedatangan,
                    'stok' => $request->qty_kedatangan[$i],
                    // 'vendor' => $request->vendor[$i],
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
                    'kode_kedatangan' => $kode_kedatangan,
                    'type' => 'in',
                    'qty' => $request->qty_kedatangan[$i],
                    'balance' => $last + $request->qty_kedatangan[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->name
                ]);
        }

        return response()->json([
            'data' => $kode_kedatangan,
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

    public function getUpdateQty()
    {
        $data = DB::table('master_item')
            ->select(
                'master_item.frame',
                'master_item.warna',
                'master_stok_item.*',
            )
            ->join('master_stok_item', 'master_item.id', '=', 'master_stok_item.id_item')
            ->whereDate('updated_count_at', date('Y-m-d'))
            ->where('updated_count_by', Auth::user()->name)
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function postUpdateQty(Request $request)
    {
        $data = DB::table('master_stok_item')
            ->whereIn('id', $request->id_transaksi)
            ->get();
        $id_item = $data->pluck('id_item')->toArray();
        $kode_kedatangan = $data->pluck('kode_kedatangan')->toArray();

        for ($i = 0; $i < count($id_item); $i++) {
            DB::table('master_stok_item')
                ->where('id', $id_item[$i])
                ->update([
                    'stok' => $request->qty[$i],
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
                ->where('id', $id_item[$i])
                ->where('kode_kedatangan', $kode_kedatangan[$i])
                ->update([
                    'qty' => $request->qty[$i],
                    'balance' => $last + $request->qty[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->name
                ]);
        }

        Session::flash('success', 'Data berhasil Di Update..');
        return redirect('kedatangan/report/' . $data->first()->kode_kedatangan);
    }

    public function showItem($id)
    {
        $data = DB::table('master_item')
            ->where('id', $id)
            ->first();

        return response()->json([
            'data' => $data
        ]);
    }

    public function updateUser(Request $request)
    {
        DB::table('users')->where('id', $request->id_user)->update([
            'name' => $request->name,
            'username' => $request->username,
            'auth_group' => $request->auth_group,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->name,
        ]);
        Session::flash('success', 'User berhasil diubah');
        return back();
    }

    public function updateItem(Request $request)
    {
        DB::table('master_item')->where('id', $request->id)->update([
            'frame' => $request->frame,
            'warna' => $request->warna,
            'harga_jual' => $request->harga_jual,
            'harga_pokok' => $request->harga_pokok,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->name,
        ]);

        Session::flash('success', 'Data berhasil diubah');
        return back();
    }

    public function resetPassword($id)
    {
        DB::table('users')->where('id', $id)->update([
            'password' => bcrypt('123456'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->name,
        ]);
        Session::flash('success', 'Password berhasil diubah');
        return back();
    }

    public function masterItem()
    {
        $data = DB::table('master_item')->get();
        $warna = $data->groupBy('warna');
        return view('database.item', compact('data', 'warna'));
    }

    public function postItem(Request $request)
    {
        DB::table('master_item')->insert([
            'frame' => $request->frame,
            'warna' => $request->warna,
            'harga_jual' => $request->harga_jual,
            'harga_pokok' => $request->harga_pokok,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->name,
        ]);
        Session::flash('success', 'Data berhasil ditambahkan');
        return back();
    }

    public function deleteItem($id)
    {
        DB::table('master_item')->where('id', $id)->delete();
        Session::flash('success', 'Data berhasil dihapus');
        return back();
    }

    public function deleteUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        Session::flash('success', 'User berhasil dihapus');
        return back();
    }

    public function change_password(Request $request)
    {
        $validate = $request->password != $request->password_konfirm;
        if ($validate) {
            return response()->json([
                'status' => 'gagal',
            ]);
        } else if (strlen($request->password) < 6) {
            return response()->json([
                'status' => 'kurang',
            ]);
        } else {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'password' => bcrypt($request->password),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::user()->name,
            ]);
            Auth::logout();
            return response()->json([
                'status' => 'ok',
            ]);
            // return back();
        }
    }

    public function masterStok()
    {
        $data = DB::table('master_stok_item')
            ->select('master_stok_item.*', 'master_item.frame', 'master_item.warna')
            ->join('master_item', 'master_stok_item.id_item', '=', 'master_item.id')
            ->get();
        return view('database.stok', compact('data'));
    }

    public function updateStok($qty, $id)
    {
        $stok_before = DB::table('master_stok_item')->where('id', $id)->first()->stok_before;
        DB::table('master_stok_item')->where('id', $id)->update([
            'stok_after' => $qty,
            'stok_before' => $stok_before,
            'updated_count_at' => date('Y-m-d H:i:s'),
            'updated_count_by' => Auth::user()->name,
        ]);
        Session::flash('success', 'Stok berhasil diubah');
        return back();
    }

    public function report($params)
    {
        $data = DB::table('master_stok_item')
            ->where('kode_kedatangan', $params)
            ->get();
        $data->map(function ($value) {
            $value->master_item = DB::table('master_item')->where('id', $value->id_item)->first() ?? '-';
            return $value;
        });

        return view('kedatangan.report', compact('data'));
    }
}
