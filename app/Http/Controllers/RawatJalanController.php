<?php

namespace App\Http\Controllers;

use App\Models\DaftarObat;
use App\Models\Month;
use App\Models\Obat;
use App\Models\Parmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\RawatJalan;
use App\Models\Year;
use Dompdf\Dompdf;
use Dompdf\Options;

class RawatJalanController extends Controller
{
    public function pendaftaran()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.pendaftaran.index', [
            'data' => RawatJalan::where('type', 'pendaftaran')->get(),
            'tahun' => Year::all(),
        ]);
    }

    public function upload(Request $request)
    {
        $this->authorize('rawat_jalan');
        $data = $request->validate([
            'file' => 'required|unique:rawat_jalans|mimes:doc,docx,pdf,xls,xlsx|file|max:5120'
        ]);

        $data['moon'] = Carbon::parse()->translatedFormat('F');
        $data['year'] = Carbon::parse()->translatedFormat('Y');
        $file = $request->file;
        $name = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
        $data['file'] = $name;

        if ($request->menu === 'pendaftaran') {
            $data['type'] = 'pendaftaran';
            $data['method'] = $request->method;
        } else {
            $data['type'] = $request->menu;
        }
        $file->move('file/rawat_jalan', $name);
        RawatJalan::create($data);

        return redirect()->back()->with('success', 'Data berhasil di upload.');
    }

    public function formPendaftaran()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.pendaftaran.form');
    }

    public function view($id)
    {
        $this->authorize('rawat_jalan');
        $data = RawatJalan::find($id);
        return view('rawat_jalan.view', compact('data'));
    }

    public function delete($id)
    {
        $this->authorize('rawat_jalan');
        $data = RawatJalan::find($id);
        unlink('file/rawat_jalan/' . $data->file);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function download($file)
    {
        $this->authorize('rawat_jalan');
        return response()->download(public_path('/file/rawat_jalan/' . $file));
    }

    public function poliUmum()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.index', [
            'data' => RawatJalan::where('type', 'poli-umum')->get(),
            'tahun' => Year::all(),
            'title' => 'Poli Umum',
            'type' => 'poli-umum'
        ]);
    }

    public function poliGigi()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.index', [
            'data' => RawatJalan::where('type', 'poli-gigi')->get(),
            'tahun' => Year::all(),
            'title' => 'Poli Gigi',
            'type' => 'poli-gigi'
        ]);
    }

    public function poliKia()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.index', [
            'data' => RawatJalan::where('type', 'poli-kia')->get(),
            'tahun' => Year::all(),
            'title' => 'Poli KIA',
            'type' => 'poli-kia'
        ]);
    }

    public function poliLansia()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.index', [
            'data' => RawatJalan::where('type', 'poli-lansia')->get(),
            'tahun' => Year::all(),
            'title' => 'Poli Lansia',
            'type' => 'poli-lansia'
        ]);
    }

    public function ruangKonseling()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.index', [
            'data' => RawatJalan::where('type', 'ruang-konseling')->get(),
            'tahun' => Year::all(),
            'title' => 'Ruang Konseling',
            'type' => 'ruang-konseling'
        ]);
    }

    public function poliTb()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.index', [
            'data' => RawatJalan::where('type', 'poli-tb')->get(),
            'tahun' => Year::all(),
            'title' => 'Poli TB',
            'type' => 'poli-tb'
        ]);
    }

    public function poliLaboratorium()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.index', [
            'data' => RawatJalan::where('type', 'poli-laboratorium')->get(),
            'tahun' => Year::all(),
            'title' => 'Poli Laboratorium',
            'type' => 'poli-laboratorium'
        ]);
    }

    public function parmasi()
    {
        $this->authorize('rawat_jalan');
        $select = Obat::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->orderBy('nama_obat', 'asc')->get();
        return view('rawat_jalan.parmasi', [
            'dataParmasi' => Parmasi::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get(),
            'dataFile' => RawatJalan::where('type', 'parmasi')->get(),
            'bulan' => Month::all(),
            'tahun' => Year::all(),
            'select' => $select,
            'title' => 'Farmasi',
            'type' => 'parmasi'
        ]);
    }

    public function createParmasi(Request $request)
    {
        $this->authorize('rawat_jalan');
        $data = $request->all();
        $obat = Obat::firstWhere('nama_obat', $request->obat_id);
        $data['obat_id'] = $obat->id;
        $data['nama_obat'] = $request->obat_id;
        $data['keterangan'] = $request->keterangan;
        // dd($data);
        Parmasi::create($data);
        return back()->with('success', 'Data Berhasil ditambahkan!');
    }

    public function filterParmasi(Request $request)
    {
        $this->authorize('rawat_jalan');;
        $dataParmasi = Parmasi::whereYear('created_at', $request->tahun)->whereMonth('created_at', $request->bulan)->where('type', $request->type)->get();
        if (count($dataParmasi) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rawat_jalan.parmasi.filterParmasi', compact('dataParmasi'));
        }
    }

    public function filterObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        $obat = Obat::whereYear('created_at', $request->tahun)->whereMonth('created_at', $request->bulan)->get();
        if (count($obat) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rawat_jalan.parmasi.filterObat', compact('obat'));
        }
    }

    public function filterObatParmasi(Request $request)
    {
        $this->authorize('rawat_jalan');
        $obat = Obat::whereYear('created_at', $request->tahun)->whereMonth('created_at', $request->bulan)->get();
        $month = $request->bulan;
        $year = $request->tahun;
        $type = $request->type;
        if (count($obat) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rawat_jalan.parmasi.filterObatParmasi', compact('obat', 'type'));
        }
    }

    public function daftarObat()
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.parmasi.obat', [
            'data' => Obat::orderBy('nama_obat', 'asc')->get()
        ]);
    }

    public function searchObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        $data = Obat::where('nama_obat', 'like', '%' . $request->key . '%')->take(3)->get();
        if (count($data) == 0) {
            return 'Maaf Data tidak ditemukan';
        } else {
            if ($request->type === 'Pasien') {
                return view('rawat_jalan.parmasi.searchObatPasien', compact('data'));
            } elseif ($request->type === 'Perawat') {
                return view('rawat_jalan.parmasi.searchObatPerawat', compact('data'));
            } elseif ($request->type === 'Poned') {
                return view('rawat_jalan.parmasi.searchObatPoned', compact('data'));
            } else {
                return view('rawat_jalan.parmasi.searchEditObat', compact('data'));
            }
        }
    }

    public function pengeluaranObat($type)
    {
        $this->authorize('rawat_jalan');
        $month = date('m');
        $year = date('Y');
        $data = Obat::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
        $tahun = Year::all();
        $bulan = Month::all();
        $type = $type;
        return view('rawat_jalan.parmasi.pengeluaran', compact('data', 'tahun', 'bulan', 'type'));
    }

    public function createObat()
    {
        return view('rawat_jalan.parmasi.createObat');
    }

    public function storeObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        $data = $request->all();
        Obat::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function tambahObat(Request $request)
    {
        $nama_obat = $request->nama_obat;
        $jenis = $request->jenis;
        for ($i = 0; $i < count($jenis); $i++) {

            // Input Data Kartu RM
            $data = new Obat();
            $data->nama_obat = $nama_obat[$i];
            $data->jenis = $jenis[$i];

            $data->save();
        }
    }

    public function editObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        $data = Obat::firstWhere('id', $request->id);
        return view('rawat_jalan.parmasi.editObat', compact('data'));
    }

    public function updateObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        $data = [
            'nama_obat' => $request->nama_obat,
            'jenis' => $request->jenis,
        ];
        Obat::where('id', $request->id)->update($data);
        return back()->with('success', 'Data Berhasil di Update!');
    }

    public function searchObatParmasi(Request $request)
    {
        $this->authorize('rawat_jalan');
        $data = Obat::all();
        $parmasi = Parmasi::whereDate('created_at', $request->key)->where('type', $request->type)->get();
        if (count($parmasi) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rawat_jalan.parmasi.search-pengeluaran-obat', [
                'data' => $parmasi,
                'key' => $request->key,
                'type' => $request->type
            ]);
        }
    }

    public function deleteParmasi($id)
    {
        $this->authorize('rawat_jalan');
        Parmasi::where('id', $id)->delete();
        DaftarObat::where('parmasi_id', $id)->delete();
        return back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function editParmasi($id)
    {
        $this->authorize('rawat_jalan');
        $data = Parmasi::find($id);
        return view('rawat_jalan.parmasi.edit', compact('data'));
    }

    public function updateParmasi(Request $request, $id)
    {
        $this->authorize('rawat_jalan');
        $obat = Obat::firstWhere('nama_obat', $request->obat_id);
        $data['name'] = $request->name;
        $data['obat_id'] = $obat->id;
        $data['nama_obat'] = $request->obat_id;
        $data['keterangan'] = $request->keterangan;
        $data['jumblah'] = $request->jumblah;
        Parmasi::where('id', $id)->update($data);

        return redirect('/rawat-jalan/parmasi')->with('success', 'Data Berhasil Diubah!');
    }

    public function deleteObat($id)
    {
        $this->authorize('rawat_jalan');
        Obat::where('id', $id)->delete();
        return back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function formPoliUmum(Request $request)
    {
        $this->authorize('rawat_jalan');
        return view('rawat_jalan.poli_umum.form', [
            'menu' => $request->type
        ]);
    }

    // Print
    public function printPengeluaranObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $dompdf = new Dompdf($options);
        $data = Obat::whereYear('created_at', $request->tahun)->whereMonth('created_at', $request->bulan)->get();
        $month = Month::firstWhere('moon', $request->bulan);
        $html = view('prints.rawat_jalan.pengeluaranObat', [
            'data' => $data,
            'type' => $request->type,
            'bulan' => $month->bulan,
            'tahun' => $request->tahun,
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data-pengeluaran-obat-' . $request->type . '-' . $request->bulan . '-' . $request->tahun . '.pdf', array('Attachment' => FAlSE));
    }

    public function printFilterPengeluaranObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $dompdf = new Dompdf($options);
        $data = Obat::whereYear('created_at', $request->tahun)->whereMonth('created_at', $request->bulan)->get();
        $bulan = Month::firstWhere('moon', $request->bulan);
        $html = view('prints.rawat_jalan.filterPengeluaranObat', [
            'data' => $data,
            'bulan' => $bulan->bulan,
            'tahun' => $request->tahun,
            'type' => $request->type
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data-total-pengeluaran-obat-' . $request->type . '-' . $request->bulan . '-' . $request->tahun . '.pdf', array('Attachment' => FAlSE));
    }

    public function printTotalPengeluaranObat(Request $request)
    {
        $this->authorize('rawat_jalan');
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $dompdf = new Dompdf($options);
        $data = Obat::whereYear('created_at', $request->tahun)->whereMonth('created_at', $request->bulan)->get();
        $bulan = Month::firstWhere('moon', $request->bulan);
        $html = view('prints.rawat_jalan.totalPengeluaranObat', [
            'data' => $data,
            'bulan' => $bulan->bulan,
            'moon' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data-total-pengeluaran-obat-' . $request->type . '-' . $request->bulan . '-' . $request->tahun . '.pdf', array('Attachment' => FAlSE));
    }
}
