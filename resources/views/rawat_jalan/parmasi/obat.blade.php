@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="card px-3">
    <h3 class="text-center mt-3 mb-4">Daftar Obat</h3>
    <div class="row justify-content-between mx-1">
        <a href="/rawat-jalan/parmasi">
            <button class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Kembali</button>
        </a>
        <div class="col d-flex justify-content-end px-2">
            <a href="" class="btn btn-sm btn-primary ml-1">Print</a>
            <a href="/rawat-jalan/parmasi/create-obat" class="btn btn-sm btn-success ml-1"><i class="fa fa-plus"></i> Tambah Obat</a>
        </div>
    </div>

    <div class="row flex-column px-2 mb-5 mt-2">
        <div class="col">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" width="50px">No</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Jenis Obat</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->nama_obat }}</td>
                        <td>{{ $dt->jenis }}</td>
                        <td class="text-right">
                            <a href="" class="btn btn-xs rounded-pill px-3 btn-success text-decoration-none editObat" data-toggle="modal" data-target="#modalEditObat" id="{{ $dt->id }}"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-lg-inline">Edit</span></a>
                            <form action="/rawat-jalan/parmasi/hapus-obat/{{ $dt->id }}" method="post" class="d-inline">
                                @csrf
                                <button class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 d-none"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                                <a href="" class="btn btn-xs rounded-pill px-3 btn-danger text-decoration-none border-0 confirm-delete not-link"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
                              </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Buat Obat -->
<div class="modal fade" id="modalEditObat" tabindex="-1" aria-labelledby="modalEditObatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="pageEditObat">
            
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

        // Edit register
        $('.editObat').on('click', function(){
        let id = $(this).attr('id');
        $.ajax({
            url : "{{ url('/rawat-jalan/parmasi/edit-obat') }}",
            type: 'get',
            data: 'id=' + id,
            success:function(data){
            $('#pageEditObat').html(data);
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