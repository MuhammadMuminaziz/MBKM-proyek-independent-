@extends('prints.layout.index');

@section('content')
<h3 style="margin: 0; margin-bottom: 10px;">Data Kartu RM</h3>
<table width="100%" border="1">
    <tr>
        <th width="40px">No</th>
        <th>No Rekam Medis</th>
        <th>Nama</th>
        <th>Kelamin</th>
        <th>Umur</th>
        <th>Alamat</th>
    </tr>
    @foreach( $data as $dt)
    <tr>
        <td style="text-align: center; vertical-align: top;">{{ $loop->iteration }}</td>
        <td style="vertical-align: top; text-align: center;">{{ $dt->no_rm }}</td>
        <td style="vertical-align: top;">{{ $dt->name }}</td>
        <td style="vertical-align: top;">{{ $dt->gender }}</td>
        <td style="vertical-align: top;">{{ $dt->age }} tahun</td>
        <td style="vertical-align: top;">{{ $dt->address }}</td>
    </tr>
    @endforeach
</table>
@endsection