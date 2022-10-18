@extends('layouts.main')

@section('content')
{{-- Data Pasien --}}
<div class="card p-2">
    <div class="row flex-column px-2 mb-5">
        <h4 class="m-2">Total Pengeluaran Obat {{ $type }}</h4>
        {{-- <a href="/rawat-jalan/parmasi"><button class="btn btn-sm btn-danger mb-2"><i class="fa fa-arrow-left"></i> Kembali</button></a> --}}
        <div class="col px-2">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" width="50px">No</th>
                        <th scope="col">Obat</th>
                        <th scope="col">Jumblah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->nama_obat }}</td>
                        <td>{{ $dt->parmasi->where('type', $type)->sum('jumblah') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection