@extends('layouts.main')

@section('content')
<div class="card p-2">
  <h3 class="text-center mb-3 mt-3">Kartu Rekam Medis</h3>
  {{-- message --}}
  <div id="message" data-message="{{ session('success') }}"></div>

  <div class="row justify-content-between">
    <div class="col-lg-8">
      <div class="row flex-column flex-md-row">
        <div class="col-md-5">
          {{-- Search --}}
          <form action="/Kartu-RM/search" method="post">
            @csrf
            <input type="hidden" name="type" value="card">
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control" name="keyword" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="button-addon2">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-sm" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-5 d-flex flex-colomn">
          <form class="d-flex" action="/Kartu-RM/search" method="post">
            @csrf
            <input type="hidden" name="type" value="date">
            <div class="form-group mr-1">
              <input class="form-control form-control-sm" name="fromDate" placeholder="Dari" type="date" required autocomplete="off">
            </div>
            <div class="form-group mr-1">
              <input class="form-control form-control-sm" name="toDate" placeholder="Sampai" type="date" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-sm btn-secondary mr-1" style="height: 66%;" id="filter">Filter</button>
          </form>
          <a href="/Kartu-RM" class="btn btn-sm btn-danger mr-1" style="height: 66%;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

    {{-- Add dadta --}}
    <div class="col-lg-4 d-flex justify-content-end">
      <a href="" class="btn btn-sm btn-primary shadow-none mb-3 mr-1" id="modal" data-toggle="modal" data-target="#createCard" style="height: 30px;"><i class="fa fa-plus"></i> Buat Kartu Baru</a>
      {{-- <a href="/Kartu-RM/create" class="btn btn-sm btn-primary shadow-none mb-3 mr-1" id="modal" style="height: 30px;"><i class="fa fa-plus"></i> Tambah Kartu</a> --}}
      <a href="/Kartu-RM/download" target="_black" class="btn btn-sm btn-primary mb-1 mb-md-0" style="height: 30px;"><i class="fa fa-download"></i></a>
    </div>
  </div>
  <div class="row">
      <div class="col" id="contentCardRm">
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
            @if(session()->has('kosong'))
              <tr>
                <td colspan="5">{{ session('kosong') }}</td>
              </tr>
            @else
              @foreach( $data as $key => $dt)
              <tr>
                <td>{{ $data->firstItem() + $key }}</td>
                <td>{{ $dt->kartuRm->no_rm }}</td>
                <td>{{ $dt->name }}</td>
                <td class="d-none d-sm-block">{{ $dt->address }}</td>
                <td class="text-right">
                  <a href="{{ $link . '/' . $dt->id }}" class="btn btn-xs btn-success text-decoration-none rounded-pill px-3"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Detail</span></a>
                  <a href="{{ $link . '/' . $dt->id }}/edit" class="btn btn-xs btn-success text-decoration-none rounded-pill px-3"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
                  <form action="{{ $link . '/' . $dt->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger text-decoration-none rounded-pill px-3 border-0 submit d-none" id="{{ $dt->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                    <a href="" class="btn btn-xs btn-danger text-decoration-none rounded-pill px-3 not-link confirm-delete"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
                  </form>
                </td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="row justify-content-between p-3">
          <div>
            Show {{ $data->firstItem() }} 
            to {{ $data->lastItem() }} 
            of {{ $data->total() }}
          </div>
          <div>
            {{ $data->links() }}
          </div>
        </div>
      </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createCard" tabindex="-1" aria-labelledby="createCardLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-end mr-3 mt-2">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 class="modal-title text-center mb-4" id="createCardLabel">Kartu Rekam Medis</h5>
            <form action="/Kartu-RM" method="post">
                @csrf
                <div class="form-group">
                  <label for="name">Nama KK</label>
                  <input type="text" name="name" class="form-control shadow-none" id="name" required autofocus autocomplete="off">
                </div>
                <div class="row mb-3">
                  <div class="col">
                    <label for="code_ds">Kode Desa</label>
                    <input type="number" class="form-control" name="code_ds" id="code_ds" required autocomplete="off">
                  </div>
                  <div class="col">
                    <label for="age">Umur</label>
                    <input type="number" class="form-control" name="age" id="age" required autocomplete="off">
                  </div>
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
                  <label for="address">Alamat</label>
                  <input type="text" class="form-control" name="address" id="address">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Buat kartu baru</button>
            </div>
        </form>
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
  });
  </script>
@endsection