@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="row">
    <div class="col">
        <div class="card mb-3 p-4">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="/img/users/{{ $data->photo }}" class="img-fluid img-circle" alt="{{ $data->name }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <ul class="list-group list-group-flush mt-2 p-2">
                            <h4>{{ $data->name }}</h4>
                            <li class="list-group-item">{{ $data->email }}</li>
                            <li class="list-group-item">{{ $data->no_hp }}</li>
                            <li class="list-group-item">{{ $data->place . ', ' . $data->birth }}</li>
                            <li class="list-group-item">{{ $data->address }}</li>
                            <li class="list-group-item">{{ $data->type }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end p-5">
                <a href="" class="btn btn-sm rounded-pill px-3 btn-success" data-toggle="modal" data-target="#editUserModal">Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="/dashboard/user/edit" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $data->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $data->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="no_hp">No Hp</label>
                <input type="number" name="no_hp" class="form-control" id="no_hp" value="{{ $data->no_hp }}">
            </div>
            <div class="form-group">
                <label for="place">Tempat Lahir</label>
                <input type="text" name="place" class="form-control" id="place" value="{{ $data->place }}">
            </div>
            <div class="form-group">
                <label for="birth">Tanggal Lahir</label>
                <input type="date" name="birth" class="form-control" id="birth" value="{{ $data->birth }}">
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ $data->address }}">
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control-file" name="photo" id="photo">
              </div>
        </div>
        <div class="modal-footer">
            <button type="submit" type="button" class="btn btn-sm btn-primary px-3">Edit</button>
        </div></form>
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