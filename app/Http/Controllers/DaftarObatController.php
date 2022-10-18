<?php

namespace App\Http\Controllers;

use App\Models\DaftarObat;
use App\Models\Obat;
use App\Models\Parmasi;
use Illuminate\Http\Request;

class DaftarObatController extends Controller
{
    public function store(Request $request)
    {
        // add parmasi
        $parmasi = Parmasi::get();
        $parmasi_id = count($parmasi) + 1;

        // add daftar obat
        $nama_obat = $request->nama_obat;
        $jumblah_obat = $request->jumblah_obat;
        $keterangan_obat = $request->keterangan_obat;
        $type = $request->type;
        for ($i = 0; $i < count($jumblah_obat); $i++) {
            // get id obat
            $obat = Obat::firstWhere('nama_obat', $nama_obat[$i]);

            // Input Data Kartu RM
            $data = new DaftarObat();
            $data->parmasi_id = $parmasi_id;
            $data->obat_id = $obat->id;
            $data->nama_obat = $nama_obat[$i];
            $data->jumblah_obat = $jumblah_obat[$i];
            $data->keterangan_obat = $keterangan_obat[$i];
            $data->type = $type[0];

            $data->save();
        }
        Parmasi::create(['name' => $request->name, 'obat_id' => 2, 'type' => $request->type[0]]);
    }
}
