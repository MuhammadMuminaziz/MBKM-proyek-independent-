<?php

namespace App\Http\Controllers;

use App\Models\KartuRm;
use App\Models\Pasien;
use App\Models\Register;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('rekam_medis');
        $data = Pasien::with('kartuRm')->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->orderBy('name', 'asc')->paginate(100)->withQueryString();
        $data->withPath('/Pasien');
        return view('rekammedis.register.index', [
            'data' => $data,
            'link' => '/Pasien'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // get RM ID
        $huruf = substr($request->rekam_medis_id, 0, 1);
        $codeRm = substr($request->rekam_medis_id, 1, 5);
        $rmID = KartuRm::where('abjad', $huruf)
            ->where('no_rm', 'like', '%' . $codeRm . '%')->first();
        // get slug
        $data['kartu_rm_id'] = $rmID->id;
        Pasien::create($data);
        return redirect('/Pasien')->with('success', 'Register berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien, $id)
    {
        $this->authorize('rekam_medis');
        $data = Pasien::find($id);
        return view('rekammedis.register.show', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasien $pasien, $id)
    {
        $this->authorize('rekam_medis');
        return view('rekammedis.register.edit', [
            'data' => Pasien::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasien $pasien, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'job' => 'required',
            'religion' => 'required',
            'blood' => 'required',
            'allergy' => 'required',
            'address' => 'required',
        ]);

        Pasien::where('id', $id)->update($data);
        return redirect('/Pasien')->with('success', 'Data berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien, $id)
    {
        $data = Pasien::find($id);
        $data->forceDelete();
        return redirect('/Pasien')->with('success', 'Data berhasil dihapus!');
    }

    public function formSearch(Request $request)
    {
        $this->authorize('rekam_medis');
        if ($request->type === 'pasien') {
            $data = Pasien::with('kartuRm')->where('name', 'like', '%' . $request->keyword . '%')->orderBy('name', 'asc')->paginate(100)->withQueryString();
        } elseif ($request->type === 'date') {
            if ($request->fromDate === $request->toDate) {
                $data = Pasien::with('kartuRm')->whereDate('created_at', '=', $request->fromDate)->orderBy('name', 'asc')->paginate(100)->withQueryString();
            } else {
                $data = Pasien::with('kartuRm')->whereBetween('created_at', array($request->fromDate, $request->toDate))->orderBy('name', 'asc')->paginate(100)->withQueryString();
            }
        }

        if (count($data) != 0) {
            return view('rekammedis.register.index', [
                'data' => $data,
                'link' => '/Pasien'
            ]);
        } else {
            return redirect('/Pasien')->with('kosong', 'Maaf Data tidak ditemukan..');
        }
    }

    public function register()
    {
        $data = Register::with('pasien')->orderBy('name_pasien', 'asc')->paginate(100)->withQueryString();
        return view('rekammedis.register.register', compact('data'));
    }

    public function addFamily(Request $request)
    {
        $this->authorize('rekam_medis');
        $data = $request->all();

        Pasien::create($data);
        return redirect('Kartu-RM/' . $request->kartu_rm_id)->with('success', 'Data Berhasil di tambahkan.');
    }

    public function search(Request $request)
    {
        $this->authorize('rekam_medis');
        // return $request->keyword;
        $data = Pasien::with('kartuRm')->where('name', 'like', '%' . $request->keyword . '%')->orderBy('name', 'asc')->paginate(100)->withQueryString();
        $data->withPath('/Pasien');
        if (count($data) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rekammedis.register.search', [
                'data' => $data,
                'link' => '/Pasien'
            ]);
        }
    }

    public function searchNoRegister(Request $request)
    {
        $this->authorize('rekam_medis');
        $huruf = substr($request->keyword, 0, 1);
        $codeRm = substr($request->keyword, 1);
        $data = KartuRm::with('pasien')->where('abjad', $huruf)
            ->where('no_rm', 'like', '%' . $codeRm . '%')->orWhere('name', 'like', '%' . $request->keyword . '%')->take(3)->get();
        $result = count($data);
        if ($result == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rekammedis.register.searchNo', [
                'data' => $data
            ]);
        }
    }

    public function searchByDate(Request $request)
    {
        $this->authorize('rekam_medis');
        if ($request->fromDate === $request->toDate) {
            $data = Pasien::with('kartuRm')->whereDate('created_at', '=', $request->fromDate)->orderBy('name', 'asc')->paginate(7)->withQueryString();
        } else {
            $data = Pasien::with('kartuRm')->whereBetween('created_at', array($request->fromDate, $request->toDate))->orderBy('name', 'asc')->paginate(7)->withQueryString();
        }
        if (count($data) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('rekammedis.register.search', [
                'data' => $data,
                'link' => '/Pasien'
            ]);
        }
    }

    public function dataPasien()
    {
        $this->authorize('rekam_medis');
        $data = Pasien::with('kartuRm')->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->orderBy('name', 'asc')->paginate(100)->withQueryString();
        return view('rekammedis.register.data_pasien', [
            'data' => $data,
            'link' => '/Pasien'
        ]);
    }
}
