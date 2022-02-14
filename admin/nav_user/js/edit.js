$(document).ready(function() {
    function get_edit_id() {
        let url = new URLSearchParams(window.location.search);
        let user_id = url.get('user_id');
        user_id = parseInt(user_id);
        console.log('get edit id');
        console.log(user_id);
        return user_id;
    }

    function get_rows() {
        let user_id = get_edit_id();
        $.get(
            "includes/get.php", { user_id: user_id },
            function(data) {
                data = JSON.parse(data);
                $("#upd_username").val(data.username);
                $("#upd_password").val(data.password);
                $("#upd_fullname").val(data.fullname);
                console.log(data);
            });
    }
    if (get_edit_id()) {
        get_rows();
    }
    $("#editForm").submit(function(e) {
        e.preventDefault();
        let user_id = get_edit_id();
        console.log(user_id);

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
                    $.ajax({
                            type: "POST",
                            url: "includes/update.php",
                            data: { user_id: user_id, username: $('#upd_username').val(), password: $('#upd_password').val(), fullname: $('#upd_fullname').val() },
                        })
                        .done(function(data) {
                            $("#upd_username").val('');
                            $("#upd_password").val('');
                            $("#upd_fullname").val('');
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