@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="row justify-content-between px-2 mb-3">
    <h2 class="text-center">{{ $title }}</h2>
    <a href="" data-toggle="modal" data-target="#uploadLaporanModal"><button class="btn btn-sm btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload Data</button></a>
</div>

<div class="card p-2">
    <div class="row flex-column px-2 mb-5">
        <h4 class="m-2">Data {{ $title }}</h4>
        <div class="col">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Petugas</th>
                        <th scope="col" class="d-none d-md-block">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $data as $dt)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt->year }}</td>
                    <td>{{ $dt->type }}</td>
                    <td class="d-none d-md-block">{{ date('l, d F Y', strtotime($dt->created_at)) }}</td>
                    <td class="text-right">
                        <a href="/profile/view/indikator/{{ $dt->id }}" class="btn btn-xs btn-success rounded-pill px-3"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Lihat</span></a>
                        <form action="{{ '/profile/delete/file/' . $dt->id }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-danger text-decoration-none border-0 submit d-none rounded-pill px-3" id="{{ $dt->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                            <a href="" class="btn btn-xs btn-danger text-decoration-none not-link confirm-delete rounded-pill px-3"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
                        </form>
                        <a href="/file/profile/{{ $dt->file }}" class="btn btn-xs btn-primary rounded-pill px-3"><i class="fa fa-download"></i> <span class="d-none d-lg-inline">Download</span></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Upload Data -->
<div class="modal fade" id="uploadLaporanModal" tabindex="-1" aria-labelledby="uploadLaporanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadLaporanModalLabel">Upload Data SP-3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="pageUploadLaporan">
    
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $.ajax({
            url: "{{ url('/profile/laporan-tahunan/form-upload-laporan') }}",
            type: 'get',
            success:function(data){
                $('#pageUploadLaporan').html(data);
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