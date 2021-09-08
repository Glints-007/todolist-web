$(document).ready(function() {
    $('.edituser').click(function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var id = $(this).data('id');
        var old_name = $(this).data('oldname');
        var old_email = $(this).data('oldemail');
        var old_password = $(this).data('oldpassword');
        var name = $('#name_edit' + id).val();
        var email = $('#email_edit' + id).val();
        var password = $('#password_edit' + id).val();
        console.log(old_password);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token-edit"]').attr('content')
            }
        });
        $.ajax({
            url:url,
            data:{name:name, email:email, password:password, id:id, old_name:old_name, old_email:old_email, old_password:old_password},
            method:'PUT',
            success:function(data){
                if(data.errors) {
                    var values = '';
                    $.each(data.errors, function (key, value) {
                        values = value
                    });

                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: values,
                });
                }else if(data.nothing){
                    Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: data.nothing,
                });
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                }else {
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data User Berhasil Diubah!',
                });
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                }
            }
        });
    });
    $('.deleteuser').click(function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data('url');
        console.log(url);
        Swal.fire({
            title: 'Apa Anda Yakin?',
            text: "Anda Tidak Dapat Membatalkan Operasi Ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-delete"]').attr('content')
                    }
                });
                $.ajax({
                    url:url,
                    data:{id:id},
                    method:'DELETE',
                    success:function(data){
                    Swal.fire(
                        'Dihapus!',
                        'Data User Berhasil Dihapus.',
                        'success'
                    )
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                    }
                });
            }
            })
    });
});
