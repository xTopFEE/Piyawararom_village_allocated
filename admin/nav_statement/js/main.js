$(document).ready(function() {
    $("#table").load("includes/load.php");

    $("#regForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
                type: "POST",
                url: "includes/post.php",
                data: $(this).serialize(),
            })
            .done(function(data) {
                // $income, $expense, $balance, $other, $accounting_id
                $("#table").load("includes/load.php");
                $("#income").val('');
                $("#expense").val('');
                $("#balance").val('');
                $("#other").val('');
                $("#msgReg").html("<p class='text-center alert alert-success'>" + data + "</p>");
                $("#msgReg").slideDown(1400);
                setTimeout(function() {
                    $("#msgReg").slideUp(900);
                }, 900)
            });
    });
    // search bar
    $("#q").keyup(function() {
        $("#msg").hide();
        let q = $("#q").val();
        if (q != '') {
            $("#table").html('');
            $.ajax({
                type: "POST",
                url: "includes/search.php",
                data: { q: q },
                success: function(data) {
                    $("#table").html(data);
                }
            });
        } else {
            $("#table").load("includes/load.php");
        }
    });
});