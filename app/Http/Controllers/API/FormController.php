<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nama_barang'=>'required',
            'jenis_barang'=>'required',
            'harga_barang'=>'required',
        ]);

        //proses isi data
        $gudang = new Gudang();
        $gudang->nama_barang = $request->nama_barang;
        $gudang->jenis_barang = $request->jenis_barang;
        $gudang->harga_barang = $request->harga_barang;
        $gudang->save();

        return response()->json([
            'message'=>'Data Gudang berhasil disimpan',
            'data_gudang'=> $gudang
        ],200);
    }

    public function edit($id)
    {
        $gudang =Gudang::find($id);
        return response()->json([
            'message'=>'Berhasil masuk ke halaman edit',
            'data_penduduk'=> $gudang
        ],200);
    }

    public function update(Request $request, $id)
    {
        $gudang = Gudang::find($id);

        $request->validate([
            'nama_barang'=>'required',
            'jenis_barang'=>'required',
            'harga_barang'=>'required',
        ]);

        $gudang->update([
            'nama_barang'=>$request->nama_barang,
            'jenis_barang'=>$request->jenis_barang,
            'harga_barang'=>$request->harga_barang,
        ]);

        return response()->json([
            'message'=>'Success',
            'data_gudang'=> $gudang
        ],200);
    }

    public function delete($id)
    {
        $gudang = Gudang::find($id)->delete();
        return response()->json([
            'message'=>'Data Berhasil Gudang dihapus',
        ],200);
    }
}
