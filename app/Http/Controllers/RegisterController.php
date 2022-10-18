<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('rekam_medis');
        $id = $request->id;
        return view('rekammedis.edit', [
            'data' =>  Register::find($id)
        ]);
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
        $data['pasien_id'] = $request->pasien_id;
        if ($request->name_pasien) {
            $data['name_pasien'] = $request->name_pasien;
        } else {
            $data_pasien = Pasien::find($request->pasien_id);
            $data['name_pasien'] = $data_pasien->name;
        }
        if ($request->subject === 'diisi' && $request->object === 'diisi' && $request->analisa === 'diisi' && $request->penata_laksana === 'diisi') {
            $data['complited'] = 'lengkap';
        } else {
            $data['complited'] = 'tidak lengkap';
        }
        Register::create($data);
        return Redirect::back()->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function show(Register $register, Request $request)
    {
        $this->authorize('rekam_medis');
        return view('rekammedis.show', [
            'data' => Register::find($request->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Register $register, $id)
    {
        $data = $request->validate([
            'subject' => 'required',
            'object' => 'required',
            'analisa' => 'required',
            'penata_laksana' => 'required',
            'name' => 'required',
            'poli' => 'required',
            'desc' => 'required',
            'created_at' => 'required',
            'tanggal_kembali' => 'required',
        ]);
        if ($request->subject === 'diisi' && $request->object === 'diisi' && $request->analisa === 'diisi' && $request->penata_laksana === 'diisi') {
            $data['complited'] = 'lengkap';
        } else {
            $data['complited'] = 'tidak lengkap';
        }

        Register::where('id', $id)->update($data);
        return Redirect::back()->with('success', 'Data berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Register $register, $id)
    {
        Register::destroy($id);
        return Redirect::back()->with('success', 'Data berhasil dihapus.');
    }

    public function searchNamePasien(Request $request)
    {
        $this->authorize('rekam_medis');
        $data = Pasien::where('name', 'like', '%' . $request->keyword . '%')->take(3)->get();
        if (count($data) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rekammedis.register.searchNamePasien', [
                'data' => $data
            ]);
        }
    }

    public function formSearch(Request $request)
    {
        $this->authorize('rekam_medis');
        if ($request->type === 'register') {
            $data = Register::with('pasien')->where('name_pasien', 'like', '%' . $request->keyword . '%')->orderBy('name_pasien', 'asc')->paginate(100)->withQueryString();
        } elseif ($request->type === 'date') {
            if ($request->fromDate === $request->toDate) {
                $data = Register::with('pasien')->whereDate('created_at', '=', $request->fromDate)->orderBy('name_pasien', 'asc')->paginate(100)->withQueryString();
            } else {
                $data = Register::with('pasien')->whereBetween('created_at', array($request->fromDate, $request->toDate))->orderBy('name_pasien', 'asc')->paginate(100)->withQueryString();
            }
        }
        if (count($data) != 0) {
            return view('rekammedis.register.register', [
                'data' => $data,
                'link' => '/Pasien'
            ]);
        } else {
            return redirect('/register')->with('kosong', 'Maaf Data tidak ditemukan..');
        }
    }
}
