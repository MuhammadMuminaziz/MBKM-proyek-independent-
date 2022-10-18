<h5 class="modal-title text-center mb-3" id="showRegisterPasienLabel">Register Pasien</h5>
<div class="row px-2">
    <table width="100%">
        <tr>
            <th width="40%">Subject</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->subject }}</td>
        </tr>
        <tr>
            <th>Object</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->object }}</td>
        </tr>
        <tr>
            <th>Analasa</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->analisa }}</td>
        </tr>
        <tr>
            <th>Penata Laksana</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->penata_laksana }}</td>
        </tr>
        <tr>
            <th>Kelengkapan</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->complited }}</td>
        </tr>
        <tr>
            <th>Ttd dan Nama</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <th>Poli</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->poli }}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Keterangan</th>
            <td width="20" class="text-center" style="vertical-align: top;">:</td>
            <td style="vertical-align: top;">{{ $data->desc }}</td>
        </tr>
        <tr>
            <th>Dibuat Pada</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <th>Tanggal Kembali</th>
            <td width="20" class="text-center">:</td>
            <td>{{ $data->tanggal_kembali }}</td>
        </tr>
    </table>
</div>