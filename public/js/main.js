$(document).ready(function(){
    let message = $('#message').data('message');
    if(message){
        Swal.fire(
            '',
            message,
            'success'
        )
    }

    $('#confirm-delete').click(function(){
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
                $.ajax({
                    url: ""
                })
            }
        })
    })
});