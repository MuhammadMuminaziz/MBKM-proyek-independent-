<?php

namespace App\Http\Controllers;

use App\Models\KartuRm;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function printCardRm($id)
    {
        $this->authorize('rekam_medis');
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $dompdf = new Dompdf($options);
        $data = KartuRm::with('pasien')->firstWhere('id', $id);
        $html = view('prints.rekam_medis.card', [
            'data' => $data
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A7', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Kartu-RM-' . $data->no_rm . '-' . $data->name . '.pdf', array('Attachment' => FAlSE));
    }
}
