$(document).ready(function() {
    function get_edit_id() {
        let url = new URLSearchParams(window.location.search);
        let df_id = url.get('id');
        df_id = parseInt(df_id);
        console.log('get edit id');
        console.log(df_id);
        console.log(url);
        // console.log("geteditid hello");
        return df_id;
    }

    function get_rows() {
        let df_id = get_edit_id();
        console.log("get_rows hello");
        $.get(
            "includes/get.php", { df_id: df_id },
            function(data) {
                console.log(data);
                data = JSON.parse(data);
                $("#upd_name").val(data.name);
                $("#upd_other").val(data.other);
                console.log(data);
            });
    }
    if (get_edit_id()) {
        get_rows();
    }
    $("#editForm").submit(function(e) {
        e.preventDefault();
        let df_id = get_edit_id();
        console.log(df_id);


        Swal.fire({
            title: 'ต้องการที่จะแก้ไขข้อมูล?',
            showCancelButton: true,
            confirmButtonText: 'แก้ไขข้อมูล',
            denyButtonText: 'ยกเลิก',
        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({
                    title: 'แก้ไขข้อมูลแล้ว!',
                    showCancelButton: false,
                    type: 'success'
                }).then((result) => { location.href = "./downloadform.php"; })
                let fd = new FormData();
                fd.append('df_id', df_id);
                fd.append('name', $('#upd_name').val());
                fd.append('other', $('#upd_other').val());
                let files = $('#upload')[0].files;
                if (files.length > 0) {
                    fd.append('upload', files[0]);
                } else {
                    fd.append('upload', null);
                }
                $.ajax({
                        type: "POST",
                        url: "includes/update.php",
                        data: fd,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(data) {
                        $("#upd_name").val('');
                        $("#upd_other").val('');
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

    });
});