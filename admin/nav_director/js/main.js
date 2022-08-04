$(document).ready(function() {
    $("#table").load("includes/load.php");

    $("#regForm").submit(function(e) {
        let fd = new FormData();
        fd.append('username',$("#username").val());
        fd.append('fullname',$("#fullname").val());
        fd.append('rank',$("#rank").val());
        fd.append('password',$("#password").val());
        fd.append('password_2',$("#password_2").val());
        let files = $('#upload')[0].files;
        if(files.length > 0 ){
            fd.append('upload',files[0]);
        }else{
            fd.append('upload',null);
        }
        e.preventDefault();
        $.ajax({
                type: "POST",
                url: "includes/post.php",
                data:  fd,// $(this).serialize(),
                contentType: false,
              processData: false,
            })
            .done(function(data) {
                $("#table").load("includes/load.php");
                $("#username").val('');
                $("#fullname").val('');
                $("#rank").val('president');
                $("#password").val('');
                $("#password_2").val('');
                $("#upload").val(null);
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