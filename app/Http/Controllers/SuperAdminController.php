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

class SuperAdminController extends Controller
{

    public function masterUser()
    {
        $data = DB::table('users')->get();
        return view('database.user', compact('data'));
    }

    public function postUser(Request $request)
    {
        $validasi = DB::table('users')->where('username', $request->username)->first();
        if ($validasi) {
            Session::flash('error', 'Username ' . $request->username . ' Sudah dimiliki oleh ' . $validasi->name);
            return back();
        } else {
            DB::table('users')->insert([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'auth_group' => $request->auth_group,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->name,
            ]);
        }
        Session::flash('success', 'Data berhasil ditambahkan');
        return back();
    }

    public function showUser($id)
    {
        $data = DB::table('users')
            ->join('auth_group', 'users.auth_group', '=', 'auth_group.id')
            ->select('users.*', 'auth_group.name as group_name')
            ->where('users.id', $id)
            ->first();
        return response()->json([
            'data' => $data
        ]);
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

    public function masterInvoice(){
        $data = DB::table('invoice')->groupBy('no_invoice')->get();
        return view('database.invoice', compact('data'));
    }
}
