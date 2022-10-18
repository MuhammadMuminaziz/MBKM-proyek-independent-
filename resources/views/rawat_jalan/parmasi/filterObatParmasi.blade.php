<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th scope="col" width="50px">No</th>
            <th scope="col">Obat</th>
            <th scope="col">Jenis</th>
            <th scope="col">Jumblah</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $obat as $dt)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $dt->nama_obat }}</td>
            <td>{{ $dt->jenis }}</td>
            <td>{{ $dt->daftarObat->where('type', $type)->sum('jumblah_obat') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>