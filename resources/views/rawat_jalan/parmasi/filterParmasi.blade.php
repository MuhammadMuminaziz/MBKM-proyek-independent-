<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th scope="col" width="50px">No</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $dataParmasi as $dt)
        <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <div class="dropdown">
                <span class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                  {{ $dt->name }}
                </span>
                <div class="dropdown-menu">
                  @foreach($dt->daftarObat as $item)
                  <div class="row">
                    <div class="col">
                        <p class="dropdown-item">{{ $item->nama_obat }}</p>
                    </div>
                    <div class="col">
                        <p class="dropdown-item">{{ $item->jumblah_obat }}</p>
                    </div>
                    <div class="col">
                        <p class="dropdown-item">{{ $item->keterangan_obat }}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
        </td>
        <td class="text-right">
            <form action="{{ '/rawat-jalan/delete-parmasi/' . $dt->id }}" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 submit d-none" id="{{ $dt->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                <a href="" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none not-link confirm-delete"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
            </form>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>