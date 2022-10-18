@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="row">
    <div class="col">
        <div class="card mb-3 p-4">
            <a href="/dashboard/users"><button class="btn btn-danger btn-sm m-2 mb-2"><i class="fa fa-arrow-left"></i> Kembali</button></a>
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