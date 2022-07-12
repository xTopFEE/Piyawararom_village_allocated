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
                $("#table").load("includes/load.php");
                $("#username").val('');
                $("#fullname").val('');
                $("#password").val('');
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
        var a = document.querySelectorAll('a input') //เพิ่มมา
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
            a.forEach((i) => { i.style.display = 'none' }) //เพิ่มมา
        } else {
            $("#table").load("includes/load.php");
            a.forEach((i) => { i.style.display = '' }) //เพิ่มมา
        }
    });
});