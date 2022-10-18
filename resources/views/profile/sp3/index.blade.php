@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="row justify-content-between px-2 mb-3">
    <h2 class="text-center">{{ $title }}</h2>
    <div>
        <a href="" data-toggle="modal" data-target="#buatIndikatorModal"><button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Buat Data Indikator</button></a>
    </div>
</div>

<div class="card p-4">
    <h3 class="text-center">TARGET DAN INDIKATOR PENERIMA LAYANAN</h3>
    <h5 class="text-center mb-4">STANDAR PELAYANAN MINIMAL SESUAI PERATURAN MENTERI KEDEHATAN REPUBLIK INDONESIA<br>NOMOR 4 TAHUN 2019<br>TRIWULAN II, TAHUN {{ date('Y') }}</h5>
    <div class="row mb-2">
        <div class="col-md-6">
            <div class="form-row">
                <div class="col-6 col-md-4">
                    <select class="form-control form-control-sm" id="tahunIndikator">
                        @foreach ($tahun as $y)
                            <option {{ ($y->year == date('Y')) ? 'selected' : '' }}>{{ $y->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select class="form-control form-control-sm" name="bulan" id="bulanIndikator">
                        @foreach($bulan as $b)
                            <option value="{{ $b->moon }}" {{ ($b->moon == date('m')) ? 'selected' : '' }}>{{ $b->bulan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-sm btn-success" id="btnFilterIndikator" data-filter="Pasien">Filter</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id="pageFilterIndikator">
            <table class="table table-bordered table-sm" width="500px">
                <thead>
                  <tr class="text-center">
                    <th scope="col" style="vertical-align: center;" width="50px">No</th>
                    <th scope="col">Jenis Pelayanan Dasar</th>
                    <th scope="col" class="d-none d-md-block">File</th>
                    <th scope="col" width="390px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($indikator as $ind)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $ind->pelayanan }}</td>
                    <td class="d-none d-md-block">{{ $ind->file }}</td>
                    <td class="text-center">
                        <a href="/profile/view/indikator/{{ $ind->id }}" class="btn btn-xs btn-success rounded-pill px-3"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Lihat</span></a>
                        <a href="" class="btn btn-xs rounded-pill px-3 btn-success btnEditIndikator mb-1 mb-md-0" data-toggle="modal" data-target="#editIndikatorModal" id="{{ $ind->id }}"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
                        <form action="{{ '/profile/delete/indikator/' . $ind->id }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 submit d-none" id="{{ $ind->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                            <a href="" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none not-link confirm-delete mb-1 mb-md-0"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
                        </form>
                        <a href="/file/profile/{{ $ind->file }}" class="btn btn-xs rounded-pill px-3 btn-primary mb-1 mb-md-0" download=""><i class="fa fa-download"></i> <span class="d-none d-lg-inline">Download</span></a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Buat Indikator -->
<div class="modal fade" id="buatIndikatorModal" tabindex="-1" aria-labelledby="buatIndikatorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buatIndikatorModalLabel">Data Indikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="pageBuatIndikator">
    
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Indikator -->
<div class="modal fade" id="editIndikatorModal" tabindex="-1" aria-labelledby="editIndikatorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editIndikatorModalLabel">Data Indikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="pageEditIndikator">
    
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $.ajax({
            url: "{{ url('/profile/sp3/form-buat-indikator') }}",
            type: 'get',
            success:function(data){
                $('#pageBuatIndikator').html(data);
            }
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

        // Edit Indikator
        $('.btnEditIndikator').on('click', function(){
            let id = $(this).attr('id');
            $.ajax({
                url: "{{ url('/profile/sp3/edit-indikator') }}",
                type: 'get',
                data: {id},
                success:function(data){
                    $('#pageEditIndikator').html(data);
                }
            })
        })

        // Filter
        $('#btnFilterIndikator').on('click', function(){
            let tahun = $('#tahunIndikator').val();
            let bulan = $('#bulanIndikator').val();
            $.ajax({
                url: "{{ url('/profile/sp3/filter-indikator') }}",
                type: 'get',
                data: {tahun, bulan},
                success:function(data){
                    $('#pageFilterIndikator').html(data);
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