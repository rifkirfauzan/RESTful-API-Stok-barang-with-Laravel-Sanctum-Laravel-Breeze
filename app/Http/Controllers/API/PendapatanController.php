<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Models\Pendapatan;


class PendapatanController extends Controller
{
    public function create(Request $request)
    {
        $gudang = new Gudang;
        $gudang->nama_barang = $request->nama_barang;
        $gudang->jenis_barang = $request->jenis_barang;
        $gudang->harga_barang = $request->harga_barang;
        $gudang->save();

        foreach ($request->list_pendapatan as $key => $value)
        {
            $pendapatan = array(
                'gudang_id'=> $gudang->id,
                'hari'=>$value['hari'],
                'barang_masuk'=>$value['barang_masuk'],
                'barang_keluar'=>$value['barang_keluar'],
                'jumlah_barang'=>$value['jumlah_barang'],
                'pendapatan'=>$value['pendapatan']
            );
            $pendapatan = Pendapatan::create($pendapatan);
        }

        return response()->json([
            'message'=>'Success',
        ],200);
    }

    public function getGudang($id)
    {
        $gudang = Gudang::with('pendapatans')->where('id',$id)->first();
        return response()->json([
            'message'=>'Success',
            'data_gudang'=>$gudang
        ],200);
    }

    public function update(Request $request, $id)
    {
        $gudang = Gudang::find($id);
        $gudang->update([
            'nama_barang'=>$request->nama_barang,
            'jenis_barang'=>$request->jenis_barang,
            'harga_barang'=>$request->harga_barang,
        ]);

        Pendapatan::where('gudang_id', $id)->delete();

        foreach ($request->list_pendapatan as $key => $value)
        {
            $pendapatan = array(
                'gudang_id'=> $id,
                'hari'=>$value['hari'],
                'barang_masuk'=>$value['barang_masuk'],
                'barang_keluar'=>$value['barang_keluar'],
                'jumlah_barang'=>$value['jumlah_barang'],
                'pendapatan'=>$value['pendapatan']
            );
            $pendapatans = Pendapatan::create($pendapatan);
        }

        return response()->json([
            'message'=>'Success',
        ],200);

    }

    public function delete($id)
    {
        $pendapatan = Pendapatan::find($id)->delete();
        return response()->json([
            'message'=>'Data Pendapatan berhasil dihapus',
        ],200);
    }
}
