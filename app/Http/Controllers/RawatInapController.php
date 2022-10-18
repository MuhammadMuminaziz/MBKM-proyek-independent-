<?php

namespace App\Http\Controllers;

use App\Models\RawatInap;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RawatInapController extends Controller
{
    // Perawatan
    public function perawatan()
    {
        $this->authorize('rawat_inap');
        $title = 'Perawatan';
        $type = 'perawatan';
        $tahun = Year::all();
        $data = RawatInap::where('type', 'perawatan')->get();
        return view('rawat_inap.index', compact('title', 'type', 'tahun', 'data'));
    }

    // Poned
    public function poned()
    {
        $this->authorize('rawat_inap');
        $title = 'Poned';
        $type = 'poned';
        $tahun = Year::all();
        $data = RawatInap::where('type', 'poned')->get();
        return view('rawat_inap.index', compact('title', 'type', 'tahun', 'data'));
    }

    // UGD
    public function ugd()
    {
        $this->authorize('rawat_inap');
        $title = 'UGD';
        $type = 'ugd';
        $tahun = Year::all();
        $data = RawatInap::where('type', 'ugd')->get();
        return view('rawat_inap.index', compact('title', 'type', 'tahun', 'data'));
    }

    public function formUpload(Request $request)
    {
        $this->authorize('rawat_inap');
        $type = $request->type;
        return view('rawat_inap.formUpload', compact('type'));
    }

    public function upload(Request $request)
    {
        $this->authorize('rawat_inap');
        $data = $request->validate([
            'file' => 'required|unique:rawat_jalans|mimes:doc,docx,pdf,xls,xlsx|file|max:5120'
        ]);

        $data['moon'] = Carbon::parse()->translatedFormat('F');
        $data['year'] = Carbon::parse()->translatedFormat('Y');
        $file = $request->file;
        $name = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
        $data['file'] = $name;
        $data['type'] = $request->type;
        $file->move('file/rawat_inap', $name);
        RawatInap::create($data);

        return redirect()->back()->with('success', 'Data berhasil di upload.');
    }

    public function viewFile($id)
    {
        $this->authorize('rawat_inap');
        $data = RawatInap::find($id);
        return view('rawat_inap.viewFile', compact('data'));
    }

    public function deleteFile($id)
    {
        $this->authorize('rawat_inap');
        $data = RawatInap::find($id);
        unlink('file/rawat_inap/' . $data->file);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function downloadFile($file)
    {
        $this->authorize('rawat_inap');
        return response()->download(public_path('/file/rawat_inap/' . $file));
    }
}
