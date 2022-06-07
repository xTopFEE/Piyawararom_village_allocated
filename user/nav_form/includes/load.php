<?php require_once "class.php";
session_start();

$user = new user;

$page = 0;

if (!empty($_SESSION['page'])) {
	$page = $_SESSION['page'];
}

echo "<script>console.log($page);</script>";

echo $user->load($page);
?>

<script type="text/javascript">
	$('.del').click(function() {

		Swal.fire({
			title: 'ต้องการที่จะลบข้อมูล?',
			showCancelButton: true,
			confirmButtonText: 'ลบข้อมูล',
			denyButtonText: 'ยกเลิก',
		}).then((result) => {

			if (result.isConfirmed) {
				Swal.fire('ลบข้อมูลแล้ว!', '', 'success')
				//
				var id = $(this).attr('id');
				$.ajax({
					url: 'includes/delete.php',
					type: 'POST',
					data: {
						id: id
					},
					success: function(data) {
						$("#table").load("includes/load.php");
						$("#msg").html("<p class='col-sm-3 mx-auto text-center alert alert-success'>" + data + "</p>");
						$("#msg").slideDown("slow");
						setTimeout(function() {
							$("#msg").slideUp(900);
						}, 900)
					}
				});
				//
			} else if (result.isDenied) {
				Swal.fire('Changes are not saved', '', 'info')
			}
		})

	});
</script>