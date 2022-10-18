@extends('layouts.main')

@section('content')
<div class="card p-3">
    <h3>Buat Kartu Rekam Medis</h3>
    <table class="table table-sm table-bordered" id="table1">
        <thead>
          <tr class="text-center">
            <th width="50px">No</th>
            <th width="10%">No RM</th>
            <th width="10%">Kode DS</th>
            <th width="20%">Nama</th>
            <th width="7%">Umur</th>
            <th width="13%">Jenis Kelamin</th>
            <th width="30%">Alamat</th>
            <th width="50px"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">1</td>
            <td contenteditable="true" class="no_rm"></td>
            <td contenteditable="true" class="code_ds"></td>
            <td contenteditable="true" class="name"></td>
            <td contenteditable="true" class="age"></td>
            <td contenteditable="true" class="gender"></td>
            <td contenteditable="true" class="address"></td>
            <td class="text-center">
                {{-- <button class="btn btn-sm btn-danger" id="hapus"><i class="fa fa-minus"></i></button> --}}
            </td>
          </tr>
        </tbody>
    </table>
    <div class="row justify-content-between p-2">
        <a href="/Kartu-RM"><button class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Kembali</button></a>
        <div class="row">
            <button class="btn btn-sm btn-success" id="tambah"><i class="fa fa-plus"></i></button>
            <button class="btn btn-sm btn-primary mx-1" id="simpan">Simpan</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        let baris = 1;
        $(document).on('click', '#tambah', function(){
            baris = baris + 1;
            var html = `<tr id="baris${ baris }">
                            <td class="text-center">${ baris }</td>
                            <td contenteditable="true" class="no_rm"></td>
                            <td contenteditable="true" class="code_ds"></td>
                            <td contenteditable="true" class="name"></td>
                            <td contenteditable="true" class="age"></td>
                            <td contenteditable="true" class="gender"></td>
                            <td contenteditable="true" class="address"></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger rounded-circle" data-row="baris${baris}" id="hapus"><i class="fa fa-minus"></i></button>
                            </td>
                        </tr>"`;
            $('#table1').append(html);
        })

        $(document).on('click', '#hapus', function(){
            let hapus = $(this).data('row');
            $('#' + hapus).remove();
        })
        
        $(document).on('click', '#simpan', function(){
            let no_rm = [];
            let code_ds = [];
            let name = [];
            let age = [];
            let gender = [];
            let address = [];

            $('.no_rm').each(function(){
                no_rm.push($(this).text());
            })
            $('.code_ds').each(function(){
                code_ds.push($(this).text());
            })
            $('.name').each(function(){
                name.push($(this).text());
            })
            $('.age').each(function(){
                age.push($(this).text());
            })
            $('.gender').each(function(){
                gender.push($(this).text());
            })
            $('.address').each(function(){
                address.push($(this).text());
            })

            $.ajax({
                url: "{{ url('/Kartu-RM/tambah-data') }}",
                type: 'post',
                data: {
                    no_rm, code_ds, name, age, gender, address, "_token": "{{ csrf_token() }}"
                },
                success: function(res){
                    window.location.replace('/Kartu-RM');
                },
                error: function(xhr){
                    console.log(xhr);
                }
            })
        })


    })
</script>
@endsection
