@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="card">
    <div class="card-body">
      <div class="row mb-5 justify-content-between">
        <a href="/Pasien" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
        <div class="row">
          <a href="/printCardRm/{{ $data->id }}" class="btn btn-sm btn-success mr-1" data-toggle="modal" data-target="#createRegisterPasien"><i class="fa fa-plus"></i> Buat Register</a>
          <a href="{{ '/Pasien' . '/' . $data->id }}/edit" class="btn btn-sm btn-success text-decoration-none mr-1"><i class="fa fa-pencil-square-o"></i> Edit</a>
          @if($data->created_at != $data->kartuRm->created_at)
          <form action="/Pasien/{{ $data->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-sm btn-danger mr-1 d-none" type="submit">Hapus</button>
            <a href="" class="btn btn-sm btn-danger mr-1 not-link confirm-delete"><i class="fa fa-trash-o"></i> Hapus</a>
          </form>
          @endif
          <a href="/print/register-pasien/{{ $data->id }}" class="btn btn-sm btn-primary" target="_black"><i class="fa fa-download" aria-hidden="true"></i></a>
        </div>
      </div>
      <h3 class="mb-4 text-center">REKAM MEDIS RAWAT JALAN</h3>
        <div class="row">
            <div class="col-md-6">
                <table width="100%">
                    <tr>
                        <th width="40%">Kode Desa</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->kartuRm->code_ds }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->birthday }}</td>
                    </tr>
                    <tr>
                        <th>Nama KK</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->kartuRm->name }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->address }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 mb-5">
                <table width="100%">
                    <tr>
                        <th width="40%">No Rekam Medis</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->kartuRm->no_rm }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->gender }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->religion }}</td>
                    </tr>
                    <tr>
                        <th>Golongan Darah</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->blood }}</td>
                    </tr>
                    <tr>
                        <th>Alergi Obat</th>
                        <td width="20" class="text-center">:</td>
                        <td>{{ $data->allergy }}</td>
                    </tr>
                </table>
            </div>
        </div>

      <h5 class="text-center mt-5">Register Pasien</h5>
      <div class="row mt-3">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>No</th>
              <th class="d-none d-lg-block">Kelengkapan</th>
              <th>Ttd dan Nama</th>
              <th>Poli</th>
              <th class="d-none d-md-block">Keterangan</th>
              <th></th>
            </tr>
          </thead>
          @foreach( $data->register as $register)
          <tbody>
            <tr>
              <td>{{ $loop->iteration }} .</td>
              <td class="d-none d-lg-block">{{ $register->complited }}</td>
              <td>{{ $register->name }}</td>
              <td>{{ $register->poli }}</td>
              <td class="d-none d-md-block">{{ $register->desc }}</td>
              <td class="text-right">
                <a href="" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none showRegister" data-toggle="modal" data-target="#showRegisterPasien" id="{{ $register->id }}"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Detail</span></a>
                <a href="" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none editRegister" data-toggle="modal" data-target="#editRegisterPasien" id="{{ $register->id }}"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
                <form action="/Register/{{ $register->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 d-none"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                  <a href="" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 confirm-delete not-link"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
                </form>
              </td>
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>
    </div>
  </div>

<!-- Modal Buat Register -->
<div class="modal fade" id="createRegisterPasien" tabindex="-1" aria-labelledby="createRegisterPasienLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d-flex justify-content-end mr-3 mt-2">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h5 class="modal-title text-center mb-5" id="createRegisterPasienLabel">Register Pasien</h5>
          <form action="/Register" method="post">
              @csrf
              <input type="hidden" name="pasien_id" value="{{ $data->id }}">
              <input type="hidden" name="name_pasien" value="{{ $data->name }}">
              <div class="row mb-3 px-2">
                <label for="subject">Subject</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="subject" value="diisi" id="subject">
                    <label for="subject" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="subject" value="tidak diisi" id="no_subject" checked>
                    <label for="no_subject" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3 px-2">
                <label for="object">Object</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="object" value="diisi" id="object">
                    <label for="object" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="object" value="tidak diisi" id="no_object" checked>
                    <label for="no_object" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3 px-2">
                <label for="analisa">Analisa</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="analisa" value="diisi" id="analisa">
                    <label for="analisa" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="analisa" value="tidak diisi" id="no_analisa" checked>
                    <label for="no_analisa" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3 px-2">
                <label for="penata_laksana">Penata Laksana</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="penata_laksana" value="diisi" id="penataLaksana">
                    <label for="penataLaksana" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="penata_laksana" value="tidak diisi" id="no_penataLaksana" checked>
                    <label for="no_penataLaksana" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Ttd dan Nama</label>
                <input type="text" name="name" class="form-control shadow-none" id="name" required>
              </div>
              <div class="form-group">
                <label for="poli">Poli</label>
                <input type="text" name="poli" class="form-control shadow-none" id="poli" required>
              </div>
              <div class="form-group">
                <label for="desc">Keterangan</label>
                <input type="text" name="desc" class="form-control shadow-none" id="desc" required>
              </div>
              <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali</label>
                <input type="datetime-local" name="tanggal_kembali" class="form-control shadow-none" id="tanggal_kembali">
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm">Tambah Sekarang</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Show Register -->
<div class="modal fade" id="showRegisterPasien" tabindex="-1" aria-labelledby="showRegisterPasienLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d-flex justify-content-end mr-3 mt-2">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalShowRegister">
          
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Register -->
<div class="modal fade" id="editRegisterPasien" tabindex="-1" aria-labelledby="editRegisterPasienLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d-flex justify-content-end mr-3 mt-2">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalEditRegister">
          
      </div>
    </div>
  </div>
</div>

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

    // sweetalert
    let message = $('#message').data('message');
      if(message){
          Swal.fire(
              '',
              message,
              'success'
          )
      }

    // Show Register
    $('.showRegister').on('click', function(){
      let id = $(this).attr('id');
      $.ajax({
        url : "{{ url('/showRegisterPasien') }}",
        type: 'get',
        data: 'id=' + id,
        success:function(data){
          $('#modalShowRegister').html(data);
        }
      })
    })

    // Edit register
    $('.editRegister').on('click', function(){
      let id = $(this).attr('id');
      $.ajax({
        url : "{{ url('/editRegisterPasien') }}",
        type: 'get',
        data: 'id=' + id,
        success:function(data){
          $('#modalEditRegister').html(data);
        }
      })
    })
  })
</script>
@endsection