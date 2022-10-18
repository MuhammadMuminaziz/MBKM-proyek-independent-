@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="card p-2">
    <div class="row flex-column px-2 mb-3">
        <div class="row justify-content-between p-3 mb-2">
            <h2 class="text-center">Users</h2>
            <div>
                <a href="/dashboard/users/registrasi"><button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Buat Akun Baru</button></a>
            </div>
        </div>
        <div class="col mb-3">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Petugas</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $data as $dt)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt->name }}</td>
                    <td>{{ $dt->email }}</td>
                    <td>{{ $dt->type }}</td>
                    <td class="text-right">
                        <a href="/dashboard/users/view-user/{{ $dt->id }}" class="btn btn-sm rounded-pill px-3 btn-success"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">Lihat</span></a>
                        <form action="{{ '/dashboard/users/delete/' . $dt->id }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm rounded-pill px-3 btn-danger text-decoration-none border-0 submit d-none" id="{{ $dt->id }}"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></button>
                            <a href="" class="btn btn-sm rounded-pill px-3 btn-danger text-decoration-none not-link confirm-delete"><i class="fa fa-trash-o"></i> <span class="d-none d-lg-inline">Hapus</span></a>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
    })
</script>
@endsection