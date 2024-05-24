<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PenyimpananResource;
use App\Models\Penyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenyimpananController extends Controller
{
    // menampilkan data
    public function index() {
        // mengambil data terbaru dari model penyimpanan
        $penyimpanan = Penyimpanan::latest()->paginate(5);

        // mengembalikan data dengan format json yang telah di custom ($status,$message,$resource)
        return new PenyimpananResource(true, 'List data penyimpanan', $penyimpanan);
    }

    public function store(Request $request) {
        // validasi saat menginput data
        $validator = Validator::make($request->all(), [
            'isian' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'moto_kerja' => 'required',
        ],[
            'isian.required'=> 'Isian tidak boleh kosong!',
            'nama.required'=> 'Nama tidak boleh kosong!',
            'no_hp.required'=> 'Nomor Hp tidak boleh kosong!',
            'alamat.required'=> 'Alamat tidak boleh kosong!',
            'moto_kerja.required'=> 'moto kerja tidak boleh kosong!',
        ]);

        // cek validasi jika gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $penyimpanan = Penyimpanan::create([
            'isian'=> $request->isian,
            'nama'=> $request->nama,
            'no_hp'=> $request->no_hp,
            'alamat'=> $request->alamat,
            'moto_kerja'=> $request->moto_kerja,
        ]);

        // mengembalikan response
        return new PenyimpananResource(true,'Data penyimpanan baru berhasil di tambahkan', $penyimpanan);

    }

    public function show($id) {
        $penyimpanan = Penyimpanan::find($id);
        return new PenyimpananResource(true, 'Detail data penyimpanan!' ,$penyimpanan);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'isian' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'moto_kerja' => 'required',
        ], [
            'isian.required'=> 'Isian tidak boleh kosong!',
            'nama.required'=> 'Nama tidak boleh kosong!',
            'no_hp.required'=> 'Nomor Hp tidak boleh kosong!',
            'alamat.required'=> 'Alamat tidak boleh kosong!',
            'moto_kerja.required'=> 'moto kerja tidak boleh kosong!',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $penyimpanan = Penyimpanan::find($id);

        $penyimpanan->update([
            'isian'=> $request->isian,
            'nama'=> $request->nama,
            'no_hp'=> $request->no_hp,
            'alamat'=> $request->alamat,
            'moto_kerja'=> $request->moto_kerja,
        ]);

        return new PenyimpananResource(true,'Data penyimpanan berhasil di perbaharui', $penyimpanan);

    }

}
