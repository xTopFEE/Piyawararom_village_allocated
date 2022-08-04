$(document).ready(function() {
    function get_edit_id() {
        let url = new URLSearchParams(window.location.search);
        let form_id = url.get('id');
        form_id = parseInt(form_id);
        console.log('get edit id');
        console.log(form_id);
        console.log(url);
        // console.log("geteditid hello");
        return form_id;
    }

    function get_rows() {
        let form_id = get_edit_id();
        console.log("get_rows hello");
        $.get(
            "includes/get.php", { id: form_id },
            function(data) {
                console.log(data);
                data = JSON.parse(data);
                $("#upd_other").val(data.other);
                console.log(data);
            });
    }
    if (get_edit_id()) {
        get_rows();
    }
    $("#editForm").submit(function(e) {
        e.preventDefault();
        let form_id = get_edit_id();
        console.log(form_id);


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
                    }).then((result) => { location.href = "./form.php"; })
                    //
                $.ajax({
                        type: "POST",
                        url: "includes/update.php",
                        data: { form_id: form_id, other: $('#upd_other').val() },
                    })
                    .done(function(data) {
                        // $("#upd_reply").val('');
                        // $("#upd_status").val('');
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