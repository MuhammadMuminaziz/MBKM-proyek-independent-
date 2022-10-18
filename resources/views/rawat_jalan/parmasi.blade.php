@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="row justify-content-between px-2 mb-4">
    <h2 class="text-center">{{ $title }}</h2>
    <a href="" data-toggle="modal" data-target="#uploadParmasiModal"><button class="btn btn-sm btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload Data</button></a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-3">
        <a href="" data-toggle="modal" data-target="#modalObatPasien">
            <div class="card p-2">
                <div class="row justify-content-center">
                    <i class="fa fa-male display-3" aria-hidden="true"></i>
                </div>
                <h4 class="text-center text-dark">Pasien</h4>
            </div>
        </a>
    </div>
    <div class="col-lg-3">
        <a href="" data-toggle="modal" data-target="#modalObatPerawat">
            <div class="card p-2">
                <div class="row justify-content-center">
                    <i class="fa fa-plus-circle display-3" aria-hidden="true"></i>
                </div>
                <h4 class="text-center text-dark">Perawatan</h4>
            </div>
        </a>
    </div>
    <div class="col-lg-3">
        <a href="" data-toggle="modal" data-target="#modalObatPoned">
            <div class="card p-2">
                <div class="row justify-content-center">
                    <i class="fa fa-thermometer-full display-3" aria-hidden="true"></i>
                </div>
                <h4 class="text-center text-dark">Poned</h4>
            </div>
        </a>
    </div>
</div>

<!-- Modal Upload Data -->
<div class="modal fade" id="uploadParmasiModal" tabindex="-1" aria-labelledby="uploadParmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadParmasiModalLabel">Upload Data {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="formUploadPoliUmum" data-type="{{ $type }}">
    
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat Obat Pasien -->
<div class="modal fade" id="modalObatPasien" tabindex="-1" aria-labelledby="modalObatPasienLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalObatPasienLabel">Pengeluaran Obat Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <input type="hidden" class="type-pasien" name="type" value="Pasien">
                <div class="modal-body" id="add-modal-pasien">
                    <div class="form-group">
                        <label for="namePasien">Nama Pasien</label>
                        <input type="text" name="name" class="form-control shadow-none" id="namePasien" required autocomplete="off">
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control nama_obat_pasien">
                                    <option selected>pilih obat</option>
                                    @foreach($select as $item)
                                        <option>{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                          <input type="number" class="form-control jumblah_obat_pasien" placeholder="jumlah">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control keterangan_obat_pasien" placeholder="keterangan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success" id="add-input-pasien"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-primary" id="submit-pasien">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat Obat Perawat -->
<div class="modal fade" id="modalObatPerawat" tabindex="-1" aria-labelledby="modalObatPerawatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalObatPerawatLabel">Pengeluaran Obat Perawat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <input type="hidden" class="type-perawat" name="type" value="Perawat">
                <div class="modal-body" id="add-modal-perawat">
                    <div class="form-group">
                        <label for="namePerawat">Nama Perawat</label>
                        <input type="text" name="name" class="form-control shadow-none" id="namePerawat" required autocomplete="off">
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control nama_obat_perawat">
                                    <option selected>pilih obat</option>
                                    @foreach($select as $item)
                                        <option>{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                          <input type="number" class="form-control jumblah_obat_perawat" placeholder="jumlah">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control keterangan_obat_perawat" placeholder="keterangan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success" id="add-input-perawat"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-primary" id="submit-perawat">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat Obat Poned -->
<div class="modal fade" id="modalObatPoned" tabindex="-1" aria-labelledby="modalObatPonedLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalObatPonedLabel">Pengeluaran Obat Poned</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <input type="hidden" class="type-poned" name="type" value="Poned">
                <div class="modal-body" id="add-modal-poned">
                    <div class="form-group">
                        <label for="namePoned">Nama Petugas</label>
                        <input type="text" name="name" class="form-control shadow-none" id="namePoned" required autocomplete="off">
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control nama_obat_poned">
                                    <option selected>pilih obat</option>
                                    @foreach($select as $item)
                                        <option>{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                          <input type="number" class="form-control jumblah_obat_poned" placeholder="jumlah">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control keterangan_obat_poned" placeholder="keterangan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success" id="add-input-poned"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-primary" id="submit-poned">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Data Pasien --}}
<div class="card p-2">
    <div class="row flex-column px-2 mb-5">
        <h4 class="m-2">Data Pengeluaran Obat Pasien</h4>
        <div class="row px-2 mb-2">
            <div class="col-md-6" style="height: 31px;">
                <form action="/rawat-jalan/parmasi/print/pengeluran-obat" method="get" target="_black">
                    @csrf
                    <input type="hidden" name="type" value="Pasien">
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control form-control-sm" name="tahun" id="tahunPasien">
                                @foreach ($tahun as $y)
                                    <option {{ ($y->year == date('Y')) ? 'selected' : '' }}>{{ $y->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-control-sm" name="bulan" id="bulanPasien">
                                @foreach($bulan as $b)
                                    <option value="{{ $b->moon }}" {{ ($b->moon == date('m')) ? 'selected' : '' }}>{{ $b->bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-primary" id="btnFilterPasien" data-filter="Pasien">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col" id="pageFilterPasien">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" width="50px">No</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $dataParmasi->where('type', 'Pasien') as $dt)
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
        </div>
        <a href="/rawat-jalan/parmasi/pengeluaran-obat/Pasien"><button class="btn btn-sm btn-outline-secondary mx-2 mt-4">Lihat Total Pengeluaran Obat Pasien</button></a>
    </div>
</div>

{{-- Data Perawat --}}
<div class="card p-2">
    <div class="row flex-column px-2 mb-5">
        <h4 class="m-2">Data Pengeluaran Obat Perawat</h4>
        <div class="row px-2 mb-2">
            <div class="col-md-6" style="height: 31px;">
                <form action="/rawat-jalan/parmasi/print/pengeluran-obat" method="get" target="_black">
                    @csrf
                    <input type="hidden" name="type" value="Perawat">
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control form-control-sm" name="tahun" id="tahunPerawat">
                                @foreach ($tahun as $y)
                                    <option {{ ($y->year == date('Y')) ? 'selected' : '' }}>{{ $y->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-control-sm" name="bulan" id="bulanPerawat">
                                @foreach($bulan as $b)
                                    <option value="{{ $b->moon }}" {{ ($b->moon == date('m')) ? 'selected' : '' }}>{{ $b->bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-primary" id="btnFilterPerawat" data-filter="Perawat">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col" id="pageFilterPerawat">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" width="50px">No</th>
                        <th scope="col">Nama Perawat</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $dataParmasi->where('type', 'Perawat') as $dt)
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
        </div>
        {{-- <a href="/rawat-jalan/parmasi/pengeluaran-obat/Perawat"><button class="btn btn-sm btn-outline-secondary mx-2 mt-4">Lihat Total Pengeluaran</button></a> --}}
    </div>
</div>

{{-- Data Poned --}}
<div class="card p-2">
    <div class="row flex-column px-2 mb-5">
        <h4 class="m-2">Data Pengeluaran Obat Poned</h4>
        <div class="row px-2 mb-2">
            <div class="col-md-6" style="height: 31px;">
                <form action="/rawat-jalan/parmasi/print/pengeluran-obat" method="get" target="_black">
                    @csrf
                    <input type="hidden" name="type" value="Poned">
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control form-control-sm" name="tahun" id="tahunPoned">
                                @foreach ($tahun as $y)
                                    <option {{ ($y->year == date('Y')) ? 'selected' : '' }}>{{ $y->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-control-sm" name="bulan" id="bulanPoned">
                                @foreach($bulan as $b)
                                    <option value="{{ $b->moon }}" {{ ($b->moon == date('m')) ? 'selected' : '' }}>{{ $b->bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-primary" id="btnFilterPoned" data-filter="Poned">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col" id="pageFilterPoned">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" width="50px">No</th>
                        <th scope="col">Nama Petugas Poned</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $dataParmasi->where('type', 'Poned') as $dt)
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
        </div>
        {{-- <a href="/rawat-jalan/parmasi/pengeluaran-obat/Poned"><button class="btn btn-sm btn-outline-secondary mx-2 mt-4">Lihat Total Pengeluaran</button></a> --}}
    </div>
</div>

{{-- Data Seluruh Pengeluaran --}}
<div class="card p-2">
    <div class="row flex-column px-2 mt-2 mb-2">
        <div class="row m-2 justify-content-between">
            <h4>Data Seluruh Pengeluaran Obat</h4>
            <a href="/rawat-jalan/parmasi/daftar-obat"><button class="btn btn-sm btn-success">Daftar Obat</button></a>
        </div>
        <div class="row px-2 mb-2">
            <div class="col-md-6" style="height: 31px;">
                <form action="/rawat-jalan/parmasi/print/pengeluran-total-obat" method="get" target="_black">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control form-control-sm" name="tahun" id="tahunObat">
                                @foreach ($tahun as $y)
                                    <option {{ ($y->year == date('Y')) ? 'selected' : '' }}>{{ $y->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-control-sm" name="bulan" id="bulanObat">
                                @foreach($bulan as $b)
                                    <option value="{{ $b->moon }}" {{ ($b->moon == date('m')) ? 'selected' : '' }}>{{ $b->bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-primary" id="btnFilterObat">Filter</button>
                            <button type="submit" class="btn btn-sm btn-primary m-0"><i class="fa fa-download"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row flex-column px-2 mb-5">
            <div class="col" id="pageFilterObat">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col" width="50px">No</th>
                            <th scope="col">Obat</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $select as $dt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dt->nama_obat }}</td>
                            <td>{{ $dt->jenis }}</td>
                            <td>{{ $dt->daftarObat->sum('jumblah_obat') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($tahun as $th)
<div class="card p-2">
    <div class="row flex-column px-2 mb-5">
        <h4 class="m-2">Data {{ $title }} Tahun {{ $th->year }}</h4>
        <div class="col">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">File</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $dataFile->where('year', $th->year) as $dt)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt->moon }}</td>
                    <td>{{ $dt->file }}</td>
                    <td>{{ date('l, d F Y', strtotime($dt->created_at)) }}</td>
                    <td class="text-right">
                        <a href="/rawat-jalan/view/{{ $dt->id }}" class="btn btn-xs rounded-pill px-3 rounded-pill px-3 btn-success"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Lihat</span></a>
                        <form action="{{ '/rawat-jalan/delete/' . $dt->id }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-xs rounded-pill px-3 rounded-pill px-3 btn-danger text-decoration-none border-0 submit d-none" id="{{ $dt->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                            <a href="" class="btn btn-xs rounded-pill px-3 rounded-pill px-3 btn-danger text-decoration-none not-link confirm-delete"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
                        </form>
                        <a href="/file/rawat_jalan/{{ $dt->file }}" class="btn btn-xs rounded-pill px-3 rounded-pill px-3 btn-primary" download=""><i class="fa fa-download"></i> <span class="d-none d-lg-inline">Download</span></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function(){
        let key = $('#formUploadPoliUmum').data('type');
        $.ajax({
            url: "{{ url('/rawat-jalan/poli-umum/form') }}",
            type: 'get',
            data: {type:key},
            success:function(data){
                $('#formUploadPoliUmum').html(data);
            }
        })

        // Search Obat Pasien
      $('.searchObatPasien').on('keyup', function(){
        let keyword = $('.searchObatPasien').val();
        // search
        if(keyword != ''){
          $('.pageObatPasien').removeClass("d-none");
          $.ajax({
            type    : 'get',
            url     : "{{ url('/searchObat') }}",
            data    : {key:keyword, type:'Pasien'},
            success : function(data){
              $('.pageObatPasien').html(data);
            }
          })
        }else{
          $('.pageObatPasien').addClass("d-none");
        }
      });

    // Search Obat Perawat
      $('.searchObatPerawat').on('keyup', function(){
        let keyword = $('.searchObatPerawat').val();
        // search
        if(keyword != ''){
          $('.pageObatPerawat').removeClass("d-none");
          $.ajax({
            type    : 'get',
            url     : "{{ url('/searchObat') }}",
            data    : {key:keyword, type: 'Perawat'},
            success : function(data){
              $('.pageObatPerawat').html(data);
            }
          })
        }else{
          $('.pageObatPerawat').addClass("d-none");
        }
      });
      
    //   Search Obat Poned
      $('.searchObatPoned').on('keyup', function(){
        let keyword = $('.searchObatPoned').val();
        // search
        if(keyword != ''){
          $('.pageObatPoned').removeClass("d-none");
          $.ajax({
            type    : 'get',
            url     : "{{ url('/searchObat') }}",
            data    : {key:keyword, type: 'Poned'},
            success : function(data){
              $('.pageObatPoned').html(data);
            }
          })
        }else{
          $('.pageObatPoned').addClass("d-none");
        }
      });

    //  Add Obat
    let baris = 1;
    // add obat pasien
      $(document).on('click', '#add-input-pasien', function(){
        baris = baris + 1;
        let input = `<div class="row mb-1" id="baris${baris}">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control nama_obat_pasien">
                                    <option selected>pilih obat</option>
                                    @foreach($select as $item)
                                        <option>{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                          <input type="number" class="form-control jumblah_obat_pasien" placeholder="jumlah">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control keterangan_obat_pasien" placeholder="keterangan">
                        </div>
                        <button class="btn text-center vertical-align-center rounded-circle btn-outline-danger p-0" style="height: 25px; width: 25px; margin: 8px 10px 0 0;" data-row="baris${baris}" id="hapus">X</button>
                    </div>`;
        $('#add-modal-pasien').append(input);
      });

    //   add obat perawat
      $(document).on('click', '#add-input-perawat', function(){
        baris = baris + 1;
        let input = `<div class="row mb-1" id="baris${baris}">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control nama_obat_perawat">
                                    <option selected>pilih obat</option>
                                    @foreach($select as $item)
                                        <option>{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                          <input type="number" class="form-control jumblah_obat_perawat" placeholder="jumlah">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control keterangan_obat_perawat" placeholder="keterangan">
                        </div>
                        <button class="btn text-center vertical-align-center rounded-circle btn-outline-danger p-0" style="height: 25px; width: 25px; margin: 8px 10px 0 0;" data-row="baris${baris}" id="hapus">X</button>
                    </div>`;
        $('#add-modal-perawat').append(input);
      });
    
      //   add obat Poned
      $(document).on('click', '#add-input-poned', function(){
        baris = baris + 1;
        let input = `<div class="row mb-1" id="baris${baris}">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control nama_obat_poned">
                                    <option selected>pilih obat</option>
                                    @foreach($select as $item)
                                        <option>{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                          <input type="number" class="form-control jumblah_obat_poned" placeholder="jumlah">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control keterangan_obat_poned" placeholder="keterangan">
                        </div>
                        <button class="btn text-center vertical-align-center rounded-circle btn-outline-danger p-0" style="height: 25px; width: 25px; margin: 8px 10px 0 0;" data-row="baris${baris}" id="hapus">X</button>
                    </div>`;
        $('#add-modal-poned').append(input);
      });

      $(document).on('click', '#hapus', function(){
            let hapus = $(this).data('row');
            $('#' + hapus).remove();
        })
      
      $(document).on('click', '#submit-pasien', function(){
            let name = $('#namePasien').val();
            let nama_obat = [];
            let jumblah_obat = [];
            let keterangan_obat = [];
            let type = [];

            $('.nama_obat_pasien').each(function(){
                nama_obat.push($(this).val());
            })
            $('.jumblah_obat_pasien').each(function(){
                jumblah_obat.push($(this).val());
            })
            $('.keterangan_obat_pasien').each(function(){
                keterangan_obat.push($(this).val());
            })
            $('.type-pasien').each(function(){
                type.push($(this).val());
            })


            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/tambah-daftar-obat') }}",
                type: 'post',
                data: {
                    name, nama_obat, jumblah_obat, keterangan_obat, type, "_token": "{{ csrf_token() }}"
                },
                success: function(res){
                    window.location.reload();
                },
                error: function(xhr){
                    console.log(xhr);
                }
            })
        })
        
        // submit perawat
        $(document).on('click', '#submit-perawat', function(){
            let name = $('#namePerawat').val();
            let nama_obat = [];
            let jumblah_obat = [];
            let keterangan_obat = [];
            let type = [];

            $('.nama_obat_perawat').each(function(){
                nama_obat.push($(this).val());
            })
            $('.jumblah_obat_perawat').each(function(){
                jumblah_obat.push($(this).val());
            })
            $('.keterangan_obat_perawat').each(function(){
                keterangan_obat.push($(this).val());
            })
            $('.type-perawat').each(function(){
                type.push($(this).val());
            })


            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/tambah-daftar-obat') }}",
                type: 'post',
                data: {
                    name, nama_obat, jumblah_obat, keterangan_obat, type, "_token": "{{ csrf_token() }}"
                },
                success: function(res){
                    window.location.reload();
                },
                error: function(xhr){
                    console.log(xhr);
                }
            })
        })
        
        // submit Poned
        $(document).on('click', '#submit-poned', function(){
            let name = $('#namePoned').val();
            let nama_obat = [];
            let jumblah_obat = [];
            let keterangan_obat = [];
            let type = [];

            $('.nama_obat_poned').each(function(){
                nama_obat.push($(this).val());
            })
            $('.jumblah_obat_poned').each(function(){
                jumblah_obat.push($(this).val());
            })
            $('.keterangan_obat_poned').each(function(){
                keterangan_obat.push($(this).val());
            })
            $('.type-poned').each(function(){
                type.push($(this).val());
            })


            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/tambah-daftar-obat') }}",
                type: 'post',
                data: {
                    name, nama_obat, jumblah_obat, keterangan_obat, type, "_token": "{{ csrf_token() }}"
                },
                success: function(res){
                    window.location.reload();
                },
                error: function(xhr){
                    console.log(xhr);
                }
            })
        })

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

        // Filter
        // Pasien
        $('#btnFilterPasien').on('click', function(){
            let tahun = $('#tahunPasien').val();
            let bulan = $('#bulanPasien').val();
            let type = $('#btnFilterPasien').data('filter');
            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/filter') }}",
                type: 'get',
                data: {tahun, bulan, type},
                success:function(data){
                    $('#pageFilterPasien').html(data);
                }
            })
        })
        // Perawat
        $('#btnFilterPerawat').on('click', function(){
            let tahun = $('#tahunPerawat').val();
            let bulan = $('#bulanPerawat').val();
            let type = $('#btnFilterPerawat').data('filter');
            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/filter') }}",
                type: 'get',
                data: {tahun, bulan, type},
                success:function(data){
                    $('#pageFilterPerawat').html(data);
                }
            })
        })
        // Poned
        $('#btnFilterPoned').on('click', function(){
            let tahun = $('#tahunPoned').val();
            let bulan = $('#bulanPoned').val();
            let type = $('#btnFilterPoned').data('filter');
            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/filter') }}",
                type: 'get',
                data: {tahun, bulan, type},
                success:function(data){
                    $('#pageFilterPoned').html(data);
                }
            })
        })
        // Obat
        $('#btnFilterObat').on('click', function(){
            let tahun = $('#tahunObat').val();
            let bulan = $('#bulanObat').val();
            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/filter-obat') }}",
                type: 'get',
                data: {tahun, bulan},
                success:function(data){
                    $('#pageFilterObat').html(data);
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
    })
</script>
@endsection