<table class="table table-bordered table-sm">
    <thead>
      <tr class="text-center">
        <th scope="col" style="vertical-align: center;" width="50px">No</th>
        <th scope="col">Jenis Pelayanan Dasar</th>
        <th scope="col">FIle</th>
        <th scope="col" width="390">Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $ind)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $ind->pelayanan }}</td>
        <td>{{ $ind->file }}</td>
        <td class="text-center">
            <a href="/profile/view/indikator/{{ $ind->id }}" class="btn btn-sm rounded-pill px-3 btn-success"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Lihat</span></a>
            <a href="" class="btn btn-sm rounded-pill px-3 btn-success btnEditIndikator" data-toggle="modal" data-target="#editIndikatorModal" id="{{ $ind->id }}"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
            <form action="{{ '/profile/delete/indikator/' . $ind->id }}" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm rounded-pill px-3 btn-danger text-decoration-none border-0 submit d-none" id="{{ $ind->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                <a href="" class="btn btn-sm rounded-pill px-3 btn-danger text-decoration-none not-link confirm-delete"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
            </form>
            <a href="/profile/download/file/{{ $ind->file }}" class="btn btn-sm rounded-pill px-3 btn-primary"><i class="fa fa-download"></i> <span class="d-none d-lg-inline">Download</span></a>
        </td>
      </tr>
    @endforeach
    </tbody>
</table>