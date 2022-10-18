@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="card py-4 px-3">
    <h3 class="text-center mb-4">Data Register Pasien</h3>
    <div class="row">
      <div class="col-lg-8">
        <div class="row flex-column flex-md-row">
          <div class="col-md-5 d-flex p-0">
            <div class="col">
               {{-- Search --}}
              <form action="/register/search" method="post">
                @csrf
                <input type="hidden" name="type" value="register">
                <div class="input-group input-group-sm mb-3">
                  <input type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </form>
            </div>
          </div>
          <div class="col-md-7 d-flex flex-colomn">
            <form class="d-flex" action="/register/search" method="post">
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
            <a href="/register" class="btn btn-sm btn-danger mr-1 text-right" style="height: 66%;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
  
      {{-- Add dadta --}}
      <div class="col-lg-4 d-flex">
        <a href="" class="btn btn-sm btn-primary ml-lg-auto" style="height: 30px;" data-toggle="modal" data-target="#createRegisterPasien"><i class="fa fa-plus"></i> Buat Register Pasien</a>
      </div>
    </div>
    <div class="row">
        <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Ttd dan Nama</th>
                <th scope="col">Kelengkapan</th>
                <th scope="col">Poli</th>
                <th scope="col">Keterangan</th>
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
                <td>{{ $dt->pasien->name }}</td>
                <td>{{ $dt->name }}</td>
                <td>{{ $dt->complited }}</td>
                <td>{{ $dt->poli }}</td>
                <td>{{ $dt->desc }}</td>
                <td class="text-right">
                  <a href="" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none showRegister" data-toggle="modal" data-target="#showRegisterPasien" id="{{ $dt->id }}"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Detail</span></a>
                  <a href="/edit" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none editRegister" data-toggle="modal" data-target="#editRegisterPasien" id="{{ $dt->id }}"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
                  <form action="/Register/{{ $dt->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 d-none"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                    <a href="" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 confirm-delete not-link"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
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
            <h5 class="modal-title text-center mb-3" id="createRegisterPasienLabel">Register Pasien</h5>
            <form action="/Register" method="post">
                @csrf
                <input type="hidden" name="pasien_id" id="pasien_id">
                <input type="hidden" name="name_pasien">
                <div class="input-group p-0 input-group-sm mb-3 col-8">
                    <input type="text" class="form-control" placeholder="Cari nama pasien..." aria-label="Recipient's username" aria-describedby="button-addon2" id="searchPasien" name="rekam_medis_id" autocomplete="off" required>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary btn-sm" type="button" id="button-addon2">@</button>
                    </div>
                </div>
                <div class="mb-3 mx-1 d-none" id="pageSearchNamePasien">
                
                </div>
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

    // Search Name Pasien
    $('#searchPasien').on('keyup', function(){
        let keyword = $('#searchPasien').val();
        // search
        if(keyword != ''){
          $('#pageSearchNamePasien').removeClass("d-none");
          $.ajax({
            type    : 'get',
            url     : "{{ url('/search-name-pasien') }}",
            data    : 'keyword=' + keyword,
            success : function(data){
              $('#pageSearchNamePasien').html(data);
            }
          })
        }else{
          $('#pageSearchNamePasien').addClass("d-none");
        }

        
      });
    
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