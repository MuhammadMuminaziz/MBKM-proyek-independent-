@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="card col-lg-8">
    <div class="card-body">
      <div class="row mb-5 justify-content-between">
        <a href="/Kartu-RM" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
        <div class="row">
          <a href="" class="btn btn-sm btn-success mx-1" data-toggle="modal" data-target="#createRegister"><i class="fa fa-plus"></i> Tambah Anggota Keluarga</a>
          <a href="{{ '/Kartu-RM' . '/' . $data->id }}/edit" class="btn btn-sm btn-success text-decoration-none mr-1"><i class="fa fa-pencil-square-o"></i> <span>Edit</span></a>
          <a href="/printCardRm/{{ $data->id }}" class="btn btn-sm btn-primary" target="_black"><i class="fa fa-download"></i></a>
        </div>
      </div>
      <h3 class="mb-4 text-center">KARTU TANDA PENGENAL KELUARGA</h3>
      <ul class="p-0 mb-5">
        <table width="100%">
            <tr>
                <th width="40%">No. RM / Kode Ds</th>
                <td width="20" class="text-center">:</td>
                <td>{{ $data->no_rm }} / {{ $data->code_ds }}</td>
            </tr>
            <tr>
                <th>Nama KK</th>
                <td width="20" class="text-center">:</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td width="20" class="text-center">:</td>
                <td>{{ $data->gender }}</td>
            </tr>
            <tr>
                <th>Umur</th>
                <td width="20" class="text-center">:</td>
                <td>{{ $data->age }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td width="20" class="text-center">:</td>
                <td>{{ $data->address }}</td>
            </tr>
        </table>
      </ul>

      <h5 class="text-center">Anggota Keluarga</h5>
      <div class="row mt-3">
        <table class="table table-borderless table-sm">
          <tbody>
            @foreach( $data->pasien as $pasien)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $pasien->name }}</td>
              <td class="text-right">
                <a href="/Pasien/{{ $pasien->id }}" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Detail</span></a>
                <a href="/Pasien/{{ $pasien->id }}/edit" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="createRegister" tabindex="-1" aria-labelledby="createRegisterLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d-flex justify-content-end mr-3 mt-2">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h5 class="modal-title text-center mb-4" id="createRegisterLabel">Tambah Pasien</h5>
          <form action="/Kartu-RM/addFamily" method="post">
              @csrf
              <input type="hidden" name="kartu_rm_id" value="{{ $data->id }}">
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control shadow-none" id="name" required autocomplete="off">
              </div>
              <div class="form-group">
                <label for="birthday">Tanggal Lahir</label>
                <input type="date" name="birthday" class="form-control shadow-none" id="birthday" required autocomplete="off">
              </div>
              <div class="row mb-3 px-2 flex-column">
                <label for="gender">Jenis Kelamin</label>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="gender" value="laki-laki" id="laki-laki" checked>
                  <label for="laki-laki" class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="gender" value="perempuan" id="perempuan">
                  <label for="perempuan" class="form-check-label">Perempuan</label>
                </div>
              </div>
              <div class="form-group">
                <label for="job">Pekerjaan</label>
                <input type="text" name="job" class="form-control shadow-none" id="job" required>
              </div>
              <div class="form-group">
                <label for="religion">Agama</label>
                <input type="text" name="religion" class="form-control shadow-none" id="religion" required>
              </div>
              <div class="form-group">
                <label for="blood">Golongan Darah</label>
                <input type="text" name="blood" class="form-control shadow-none" id="blood" required>
              </div>
              <div class="form-group">
                <label for="allergy">Alergi Obat</label>
                <input type="text" name="allergy" class="form-control shadow-none" id="allergy" required>
              </div>
              <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" class="form-control shadow-none" id="address" required>
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm">Tambah Sekarang</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    // sweetalert
    let message = $('#message').data('message');
      if(message){
          Swal.fire(
              '',
              message,
              'success'
          )
      }
  })
</script>
@endsection