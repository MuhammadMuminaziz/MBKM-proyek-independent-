@extends('layouts.main')

@section('content')
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item bg-white" src="/file/profile/{{ $data->file }}"></iframe>
</div>
@endsection