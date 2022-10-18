@extends('prints.layout.index');

@section('content')
<h3 style="margin: 0;">Data Total Pengeluaran Obat</h3>
<p style="margin: 0; margin-bottom: 10px;">{{ $bulan . ' ' . $tahun }}</p>
<table width="100%" border="1">
    <tr>
        <th width="40px">No</th>
        <th>Obat</th>
        <th>Jenis</th>
        <th>Jumlah</th>
    </tr>
    @foreach($data as $dt)
    <tr>
        <td style="text-align: center; vertical-align: top;">{{ $loop->iteration }}</td>
        <td style="vertical-align: top;">{{ $dt->nama_obat }}</td>
        <td style="vertical-align: top;">{{ $dt->jenis }}</td>
        <td style="text-align: center; vertical-align: top;">{{ $dt->daftarObat->sum('jumblah_obat') }}</td>
    </tr>
    @endforeach
</table>
@endsection