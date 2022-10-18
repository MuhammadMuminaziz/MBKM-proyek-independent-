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
        <td>{{ $dt->no_rm }}</td>
        <td>{{ $dt->name }}</td>
        <td class="d-none d-sm-block">{{ $dt->address }}</td>
        <td class="text-right">
          <a href="{{ $link . '/' . $dt->id }}" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Detail</span></a>
          <a href="{{ $link . '/' . $dt->id }}/edit" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
          <form action="{{ $link . '/' . $dt->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 submit d-none" id="{{ $dt->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
            <a href="" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none not-link confirm-delete"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <script>
    $(document).ready(function(){

      $('.not-link').click(function(e){
        e.preventDefault();
      });
      $(document).on('click', '.confirm-delete', function(){
          Swal.fire({
              title: '',
              text: 'Apakah Anda yakin ingin menghapus?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus'
          }).then((result) => {
              if(result.isConfirmed){
                // mengubah lingkup sweetalert
                $(this).prev().trigger('click');
              }
          })
      })
    })
  </script>