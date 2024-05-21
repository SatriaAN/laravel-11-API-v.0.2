<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PenyimpananResource;
use App\Models\Penyimpanan;
use Illuminate\Http\Request;

class PenyimpananController extends Controller
{
    // menampilkan data
    public function index() {
        // mengambil data terbaru dari model penyimpanan
        $penyimpanan = Penyimpanan::latest()->paginate(5);

        // mengembalikan data dengan format json yang telah di custom ($status,$message,$resource)
        return new PenyimpananResource(true, 'List data penyimpanan', $penyimpanan);
    }
}