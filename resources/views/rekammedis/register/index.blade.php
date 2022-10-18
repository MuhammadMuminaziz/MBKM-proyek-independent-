@extends('layouts.main')

@section('content')
<div class="card p-2">
  <h3 class="text-center mb-4 mt-3">Data Pasien</h3>
  {{-- message --}}
  <div id="message" data-message="{{ session('success') }}"></div>

  <div class="row">
    <div class="col-lg-8">
      <div class="row flex-column flex-md-row">
        <div class="col-md-5 d-flex p-0">
          <div class="col">
            {{-- Search --}}
            <form action="/Pasien/search" method="post">
              @csrf
              <input type="hidden" name="type" value="pasien">
              <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control" placeholder="Cari nama pasien..." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-7 d-flex flex-colomn">
          <form class="d-flex" action="/Pasien/search" method="post">
            @csrf
            <input type="hidden" name="type" value="date">
            <div class="form-group mr-1">
              <input class="form-control form-control-sm" name="fromDate" placeholder="Dari" type="date" required autocomplete="off">
            </div>
            <div class="form-group mr-1">
              <input class="form-control form-control-sm" name="toDate" placeholder="Sampai" type="date" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-sm btn-secondary mr-1" style="height: 66%;" id="filterPasien">Filter</button>
          </form>
          <a href="/Pasien" class="btn btn-sm btn-danger mr-1 text-right" style="height: 66%;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

    {{-- Add dadta --}}
    <div class="col-lg-4 d-flex">
      <a href="" class="btn btn-sm btn-primary shadow-none mb-3 ml-lg-auto" data-toggle="modal" data-target="#createRegister" style="height: 30px;"><i class="fa fa-plus"></i> Tambah Pasien Baru</a>
      <a href="/register" class="btn btn-sm btn-primary shadow-none mb-3 mx-1" style="height: 30px;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Data Register</a>
      <a href="/Pasien/download" target="_black" class="btn btn-sm btn-primary mb-1 mb-md-0" style="height: 30px;"><i class="fa fa-download"></i></a>
    </div>
  </div>
  
  <div class="row">
    <div class="col">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" id="all-data"><a href="/Pasien" style="text-decoration: underline;">Semua data</a></li>
        <li class="breadcrumb-item" id="day-data"><a href="/pasien-data">Data hari ini</a></li>
      </ol>
    </div>
  </div>

  <div class="row">
      <div class="col" id="contentRegister">
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
            @foreach( $data as $index => $dt)
            <tr>
              <td>{{ $data->firstItem() + $index }}</td>
              <td>{{ $dt->kartuRm->no_rm }}</td>
              <td>{{ $dt->name }}</td>
              <td class="d-none d-sm-block">{{ $dt->address }}</td>
              <td class="text-right">
                <a href="{{ $link . '/' . $dt->id }}" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Detail</span></a>
                <a href="{{ $link . '/' . $dt->id }}/edit" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
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
            <form action="/Pasien" method="post">
                @csrf
                <div class="input-group p-0 input-group-sm mb-3 col-8">
                  <input type="text" class="form-control" placeholder="Cari nomer rekam medis..." aria-label="Recipient's username" aria-describedby="button-addon2" id="searchNoRegister" name="rekam_medis_id" autocomplete="off" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-sm" type="button" id="button-addon2">@</button>
                  </div>
                </div>
                <div class="mb-3 mx-1 d-none" id="pageNoRm">
                  
                </div>
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
      $('#formDate').on('submit', function(e){
        e.preventDefault();
      })

      // Search No RM
      $('#searchNoRegister').on('keyup', function(){
        let keyword = $('#searchNoRegister').val();
        // search
        if(keyword != ''){
          $('#pageNoRm').removeClass("d-none");
          $.ajax({
            type    : 'get',
            url     : "{{ url('/searchNoRegister') }}",
            data    : 'keyword=' + keyword,
            success : function(data){
              $('#pageNoRm').html(data);
            }
          })
        }else{
          $('#pageNoRm').addClass("d-none");
        }

        
      });

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