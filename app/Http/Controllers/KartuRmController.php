<?php

namespace App\Http\Controllers;

use App\Models\KartuRm;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class KartuRmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('rekam_medis');
        $data = KartuRm::with('pasien')->orderBy('name', 'asc')->paginate(100)->withQueryString();
        return view('rekammedis.card.index', [
            'data' => $data,
            'link' => '/Kartu-RM'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rekammedis.card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // get Code RM
        $huruf = strtoupper(substr($request->name, 0, 1));
        $dataRm = KartuRm::withTrashed()->where('abjad', $huruf)->count();
        if ($dataRm == 0) {
            $codeRm = 1;
        } else {
            $codeRm = ++$dataRm;
        }
        $data['abjad'] = $huruf;
        $data['no_rm'] = $huruf . sprintf('%05d', $codeRm);

        // input data pasien
        $get_rm = KartuRm::withTrashed()->count();
        if ($get_rm) {
            $rekammedis_id = $get_rm + 1;
        } else {
            $rekammedis_id = 1;
        }
        $dataRegister = [
            'kartu_rm_id' => $rekammedis_id,
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address
        ];

        // dd($data, $dataRegister);
        KartuRm::create($data);
        Pasien::create($dataRegister);
        return redirect('/Kartu-RM')->with('success', 'Kartu Rekam Medis berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KartuRm  $kartuRm
     * @return \Illuminate\Http\Response
     */
    public function show(KartuRm $kartuRm, $id)
    {
        $this->authorize('rekam_medis');
        return view('rekammedis.card.show', [
            'data' => KartuRm::with('pasien')->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KartuRm  $kartuRm
     * @return \Illuminate\Http\Response
     */
    public function edit(KartuRm $kartuRm, $id)
    {
        $this->authorize('rekam_medis');
        return view('rekammedis.card.edit', [
            'data' => KartuRm::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KartuRm  $kartuRm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KartuRm $kartuRm, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'code_ds' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);
        $RM = KartuRm::find($id);
        if ($request->name != $RM->name) {
            $huruf = strtoupper(substr($request->name, 0, 1));
            if ($huruf != $RM->abjad) {
                $dataRm = KartuRm::withTrashed()->where('abjad', $huruf)->count();
                if ($dataRm == 0) {
                    $codeRm = 1;
                } else {
                    $codeRm = ++$dataRm;
                }
                $data['abjad'] = $huruf;
                $data['no_rm'] = $huruf . sprintf('%05d', $codeRm);
            }
        }

        // update data pasien
        $dataPasien = [
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address
        ];

        KartuRm::where('id', $id)->update($data);
        Pasien::where('kartu_rm_id', $RM->id)->update($dataPasien);
        return redirect('/Kartu-RM')->with('success', 'Kartu Rekam Medis berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KartuRm  $kartuRm
     * @return \Illuminate\Http\Response
     */
    public function destroy(KartuRm $kartuRm, Request $request, $id)
    {
        KartuRm::destroy($id);
        Pasien::where('kartu_rm_id', $id)->delete();
        // Pasien::onlyTrashed()->forceDelete();
        return redirect('/Kartu-RM')->with('success', 'Data berhasil dihapus!');
    }

    public function formSearch(Request $request)
    {
        $this->authorize('rekam_medis');
        if ($request->type === 'card') {
            $huruf = substr($request->keyword, 0, 1);
            $codeRm = substr($request->keyword, 1);
            $data = KartuRm::with('pasien')->where('abjad', $huruf)
                ->where('no_rm', 'like', '%' . $codeRm . '%')
                ->orWhere('name', 'like', '%' . $request->keyword . '%')->orderBy('name', 'asc')->paginate(100)->withQueryString();
        } else {
            if ($request->fromDate === $request->toDate) {
                $data = KartuRm::whereDate('created_at', '=', $request->fromDate)->orderBy('name', 'asc')->paginate(100)->withQueryString();
            } else {
                $data = KartuRm::whereBetween('created_at', [$request->fromDate, $request->toDate])->orderBy('name', 'asc')->paginate(100)->withQueryString();
            }
        }

        if (count($data) == 0) {
            return redirect('/Kartu-RM')->with('kosong', 'Maaf Data tidak ditemukan..');
        } else {
            return view('rekammedis.card.index', [
                'data' => $data,
                'link' => '/Kartu-RM'
            ]);
        }
    }

    public function searchByDate(Request $request)
    {
        $this->authorize('rekam_medis');
        if ($request->fromDate === $request->toDate) {
            $data = KartuRm::whereDate('created_at', '=', $request->fromDate)->get();
        } else {
            $data = KartuRm::whereBetween('created_at', [$request->fromDate, $request->toDate])->get();
        }
        if (count($data) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rekammedis.card.search', [
                'data' => $data,
                'link' => '/Kartu-RM'
            ]);
        }
    }

    public function downloadKartuRM()
    {
        $this->authorize('rekam_medis');
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $dompdf = new Dompdf($options);
        $data = KartuRm::orderBy('name', 'asc')->get();
        $html = view('prints.rekam_medis.kartu_rm', [
            'data' => $data
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data-kartu-rm.pdf', array('Attachment' => FAlSE));
    }

    public function downloadPasien($date = '')
    {
        $this->authorize('rekam_medis');
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $dompdf = new Dompdf($options);
        if ($date == 'all') {
            $data = Pasien::with('kartuRm')->orderBy('name', 'asc')->get();
        } else {
            $data = Pasien::with('kartuRm')->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->orderBy('name', 'asc')->get();
        }
        $html = view('prints.rekam_medis.pasien', [
            'data' => $data
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data-pasien.pdf', array('Attachment' => FAlSE));
    }

    public function printRegister($id)
    {
        $this->authorize('rekam_medis');
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $dompdf = new Dompdf($options);
        $data = Pasien::with(['kartuRm', 'register'])->find($id);
        $html = view('prints.rekam_medis.register', [
            'data' => $data
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data-' . $data->name . '.pdf', array('Attachment' => FAlSE));
    }

    public function tambahData(Request $request)
    {
        $no_rm = $request->no_rm;
        $code_ds = $request->code_ds;
        $name = $request->name;
        $age = $request->age;
        $gender = $request->gender;
        $address = $request->address;
        $get_rm = KartuRm::withTrashed()->latest()->first();

        for ($i = 0; $i < count($name); $i++) {

            // Input Data Kartu RM
            $huruf = strtoupper(substr($name[$i], 0, 1));
            $data = new KartuRm();
            $data->no_rm = $no_rm[$i];
            $data->abjad = $huruf;
            $data->code_ds = $code_ds[$i];
            $data->name = $name[$i];
            $data->age = $age[$i];
            $data->gender = $gender[$i];
            $data->address = $address[$i];

            // Input Data Pasien
            if ($get_rm) {
                $rekammedis_id = $get_rm->id  + $i + 1;
            } else {
                $rekammedis_id = $i + 1;
            }
            $data_pasien = new Pasien();
            $data_pasien->kartu_rm_id = $rekammedis_id;
            $data_pasien->name = $name[$i];
            $data_pasien->gender = $gender[$i];
            $data_pasien->address = $address[$i];

            $data->save();
            $data_pasien->save();
        }
    }
}
