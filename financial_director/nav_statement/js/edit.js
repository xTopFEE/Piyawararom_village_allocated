$(document).ready(function() {
    function get_edit_id() {
        let url = new URLSearchParams(window.location.search);
        let accounting_id = url.get('accounting_id');
        accounting_id = parseInt(accounting_id);
        console.log('get edit id');
        console.log(accounting_id);
        return accounting_id;
    }

    function get_rows() {
        let accounting_id = get_edit_id();
        $.get(
            "includes/get.php", { accounting_id: accounting_id },
            function(data) {
                data = JSON.parse(data);
                $("#upd_income").val(data.income);
                $("#upd_expense").val(data.expense);
                $("#upd_balance").val(data.balance);
                $("#upd_other").val(data.other);
                console.log(data);
            });
    }
    if (get_edit_id()) {
        get_rows();
    }
    $("#editForm").submit(function(e) {
        e.preventDefault();
        let accounting_id = get_edit_id();
        console.log(accounting_id);


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
                        data: { accounting_id: accounting_id, income: $('#upd_income').val(), expense: $('#upd_expense').val(), balance: $('#upd_balance').val(), other: $('#upd_other').val() },
                    })
                    .done(function(data) {
                        $("#upd_income").val('');
                        $("#upd_expense").val('');
                        $("#upd_balance").val('');
                        $("#upd_other").val('');
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
})