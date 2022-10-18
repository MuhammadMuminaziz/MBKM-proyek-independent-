<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Month;
use App\Models\Profile;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $this->authorize('profile');
        $tahun = Year::all();
        $bulan = Month::all();
        $indikator = Indikator::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
        $title = 'SP-3';
        return view('profile.sp3.index', compact('title', 'indikator', 'tahun', 'bulan'));
    }

    public function upload(Request $request)
    {
        $this->authorize('profile');
        $data = $request->validate([
            'file' => 'required|unique:rawat_jalans|mimes:doc,docx,pdf,xls,xlsx|file|max:5120'
        ]);

        $data['type'] = $request->type;
        $data['moon'] = Carbon::parse()->translatedFormat('F');
        $data['year'] = Carbon::parse()->translatedFormat('Y');
        $file = $request->file;
        $name = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
        $data['file'] = $name;
        $file->move('file/profile', $name);
        Profile::create($data);

        return redirect()->back()->with('success', 'Data berhasil di upload.');
    }

    public function viewFile($id)
    {
        $this->authorize('profile');
        $data = Profile::find($id);
        return view('profile.sp3.viewFile', compact('data'));
    }

    public function viewIndikator($id)
    {
        $this->authorize('profile');
        $data = Indikator::find($id);
        return view('profile.sp3.viewFile', compact('data'));
    }

    public function editIndikator(Request $request)
    {
        $this->authorize('profile');
        $data = $request->validate([
            'file' => 'unique:rawat_jalans|mimes:doc,docx,pdf,xls,xlsx|file|max:5120'
        ]);

        $data['pelayanan'] = $request->pelayanan;
        $oldFile = Indikator::find($request->id);
        $file = $request->file;
        if ($file) {
            $name = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            unlink('file/profile/' . $oldFile->file);
            $file->move('file/profile', $name);
        } else {
            $name = $oldFile->file;
        }
        $data['file'] = $name;
        Indikator::where('id', $request->id)->update($data);
        return back()->with('success', 'Data Berhasil di Update!');
    }

    public function formEditIndikator(Request $request)
    {
        $this->authorize('profile');
        $data = Indikator::find($request->id);
        return view('profile.sp3.formEditIndikator', compact('data'));
    }

    public function filterIndikator(Request $request)
    {
        $this->authorize('profile');
        $data = Indikator::whereYear('created_at', $request->tahun)->whereMonth('created_at', $request->bulan)->get();
        if (count($data) == 0) {
            return 'Maaf Data tidak ditemukan!';
        } else {
            return view('profile.sp3.filterIndikator', compact('data'));
        }
    }

    public function deleteFile($id)
    {
        $this->authorize('profile');
        $data = Profile::find($id);
        unlink('file/profile/' . $data->file);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function deleteIndikator($id)
    {
        $this->authorize('profile');
        $data = Indikator::find($id);
        unlink('file/profile/' . $data->file);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function downloadFile($file)
    {
        $this->authorize('profile');
        return response()->download(public_path('/file/profile/' . $file));
    }

    public function formIndikator()
    {
        $this->authorize('profile');
        return view('profile.sp3.formBuatIndikator');
    }

    public function createIndikator(Request $request)
    {
        $this->authorize('profile');
        $data = $request->validate([
            'file' => 'required|unique:rawat_jalans|mimes:doc,docx,pdf,xls,xlsx|file|max:5120'
        ]);
        $file = $request->file;
        $name = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
        $data['pelayanan'] = $request->pelayanan;
        $data['file'] = $name;
        $file->move('file/profile', $name);
        Indikator::create($data);
        return back()->with('success', 'Data Berhasil di Upload');
    }

    // Laporan Tahunan
    public function laporan()
    {
        $this->authorize('profile');
        $data = Profile::all();
        $title = 'Laporan Tahunan';
        return view('profile.laporan.index', compact('title', 'data'));
    }

    public function formUploadLaporan()
    {
        $this->authorize('profile');
        return view('profile.laporan.formUpload');
    }

    public function uploadLaporan(Request $request)
    {
        $this->authorize('profile');
        $data = $request->validate([
            'file' => 'required|unique:rawat_jalans|mimes:doc,docx,pdf,xls,xlsx|file|max:5120'
        ]);

        $data['type'] = $request->type;
        $data['moon'] = Carbon::parse()->translatedFormat('F');
        $data['year'] = Carbon::parse()->translatedFormat('Y');
        $file = $request->file;
        $name = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
        $data['file'] = $name;
        $file->move('file/profile', $name);
        Profile::create($data);

        return redirect()->back()->with('success', 'Data berhasil di upload.');
    }
}
