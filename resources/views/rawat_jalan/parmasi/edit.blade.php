@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="modal-title text-center mb-4" id="createCardLabel">Edit Data Pengeluaran Obat</h5>
                <form action="/rawat-jalan/parmasi/update/{{ $data->id }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control shadow-none" id="name" value="{{ old('name', $data->name) }}" required autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="obat_id">Nama Obat</label>
                        <input type="text" name="obat_id" class="form-control searchEditObat shadow-none" id="obat_id" value="{{ old('obat_id', $data->obat->nama_obat) }}" required autocomplete="off">
                    </div>
                    <div class="mb-3 mx-1 d-none pageObatEdit">
                    
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control shadow-none" id="keterangan" value="{{ old('keterangan', $data->keterangan) }}" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="jumblah">Jumblah</label>
                        <input type="text" name="jumblah" class="form-control shadow-none" id="jumblah" value="{{ old('jumblah', $data->jumblah) }}" required autocomplete="off">
                    </div>
                    <div class="row justify-content-end px-2">
                        <a href="/rawat-jalan/parmasi" class="btn btn-danger btn-sm mr-1"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Edit kartu Rekam Medis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //   Search Obat Edit
      $('.searchEditObat').on('keyup', function(){
        let keyword = $('.searchEditObat').val();
        // search
        if(keyword != ''){
          $('.pageObatEdit').removeClass("d-none");
          $.ajax({
            type    : 'get',
            url     : "{{ url('/searchObat') }}",
            data    : {key:keyword, type: 'Edit'},
            success : function(data){
              $('.pageObatEdit').html(data);
            }
          })
        }else{
          $('.pageObatEdit').addClass("d-none");
        }
      });
    })
</script>
@endsection