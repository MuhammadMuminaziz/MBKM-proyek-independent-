<table class="table table-hover table-sm">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">No. RM</th>
        <th scope="col">Nama</th>
        <th scope="col" class="d-none d-sm-block">Alamat</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach( $data as $dt)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $dt->kartuRm->no_rm }}</td>
        <td>{{ $dt->name }}</td>
        <td class="d-none d-sm-block">{{ $dt->address }}</td>
        <td class="text-right">
          <a href="{{ $link . '/' . $dt->id }}" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Detail</span></a>
          <a href="{{ $link . '/' . $dt->id }}/edit" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-end">
    {{ $data->links() }}
  </div>
  