$(document).ready(function() {
    function get_edit_id() {
        let url = new URLSearchParams(window.location.search);
        let director_id = url.get('director_id');
        director_id = parseInt(director_id);
        console.log('get edit id');
        console.log(director_id);
        return director_id;
    }

    function get_rows() {
        let director_id = get_edit_id();
        $.get(
            "includes/get.php", { director_id: director_id },
            function(data) {
                data = JSON.parse(data);
                $("#upd_username").val(data.username);
                $("#upd_password").val(data.password);
                $("#upd_rank").val(data.rank);
                $("#upd_fullname").val(data.fullname);
                console.log(data);
            });
    }
    if (get_edit_id()) {
        get_rows();
    }
    $("#editForm").submit(function(e) {
        e.preventDefault();
        let director_id = get_edit_id();
        console.log(director_id);

        var password_1 = $('#upd_password').val();
        var password_2 = $('#upd_password_2').val();

        console.log(password_1);
        console.log(password_2);

        if (password_1 != password_2) {
            Swal.fire(
                'รหัสผ่านไม่ตรงกัน',
                '',
                'warning'
            )
        } else {
            Swal.fire({
                title: 'ต้องการที่จะแก้ไขข้อมูล?',
                showCancelButton: true,
                confirmButtonText: 'แก้ไขข้อมูล',
                denyButtonText: 'ยกเลิก',
            }).then((result) => {

                if (result.isConfirmed) {
                    Swal.fire('แก้ไขข้อมูลแล้ว!', '', 'success')
                        //
                        let fd = new FormData();
                        fd.append('director_id',director_id);
                        fd.append('username',$('#upd_username').val());
                        fd.append('password',$('#upd_password').val());
                        fd.append('rank',$('#upd_rank').val());
                        fd.append('fullname',$('#upd_fullname').val());
                        let files = $('#upload')[0].files;
                        if(files.length > 0 ){
                            fd.append('upload',files[0]);
                        }else{
                            fd.append('upload',null);
                        }
                    $.ajax({
                            type: "POST",
                            url: "includes/update.php",
                            data: fd,
                            contentType: false,
                            processData: false,
                        })
                        .done(function(data) {
                            $("#upd_username").val('');
                            $("#upd_password").val('');
                            $("#upd_rank").val('');
                            $("#upd_fullname").val('');
                            $("#upload").val(null);
                            $("#table").load("includes/load.php");
                            $("#msgEdit").html("<p class='text-center alert alert-success'>" + data + "</p>");
                            $("#msgEdit").slideDown(1000);
                        });
                    //
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    });
});