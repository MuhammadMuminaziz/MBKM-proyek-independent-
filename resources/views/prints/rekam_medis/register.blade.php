@extends('prints.layout.index');

@section('content')
<h3 style="margin-top: -10; text-align: center;">REKAM MEDIS RAWAT JALAN</h3>
<div style="width: 100%; margin-top: 30px;">
    <div style="width: 49%; display: inline-block;">
        <table>
            <tr>
                <td>Kode Desa</td>
                <td>:</td>
                <td>{{ $data->kartuRM->code_ds }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $data->birthday }}</td>
            </tr>
            <tr>
                <td>Nama KK</td>
                <td>:</td>
                <td>{{ $data->kartuRM->name }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $data->address }}</td>
            </tr>
        </table>
    </div>
    <div style="width: 49%; display: inline-block;">
        <table>
            <tr>
                <td>Kode RM</td>
                <td>:</td>
                <td>{{ $data->kartuRm->abjad . $data->kartuRm->code_rm }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $data->job }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $data->religion }}</td>
            </tr>
            <tr>
                <td>Golongan Darah</td>
                <td>:</td>
                <td>{{ $data->blood }}</td>
            </tr>
            <tr>
                <td>Alergi Obat</td>
                <td>:</td>
                <td>{{ $data->allergy }}</td>
            </tr>
        </table>
    </div>
</div>

<div style="margin-top: 20px;">
    <table width="100%" border="1">
        <tr>
            <th width="40px">No</th>
            <th>Kelengkapan</th>
            <th>Ttd/Nama</th>
            <th>Poli</th>
            <th>Keterangan</th>
        </tr>
        @foreach( $data->register as $dt)
        <tr>
            <td style="text-align: center; vertical-align: top;">{{ $loop->iteration }}</td>
            <td style="vertical-align: top; text-align: center;">{{ $dt->complited }}</td>
            <td style="vertical-align: top;">{{ $dt->name }}</td>
            <td style="vertical-align: top;">{{ $dt->poli }}</td>
            <td style="vertical-align: top;">{{ $dt->desc }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection