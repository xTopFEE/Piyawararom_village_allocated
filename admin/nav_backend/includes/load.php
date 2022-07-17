<?php require_once "class.php";
session_start();

$user = new user;

$page = 1;
$enter_year = 2564;
if (!empty($_SESSION['page'])) {
	$page = $_SESSION['page'];
}

if (!empty($_SESSION['enter_year'])) {
	$enter_year = $_SESSION['enter_year'];
}
echo "<script>console.log($page);</script>";
//echo "<script>console.log($enter_year);</script>";

echo $user->load($page, $enter_year);
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
				var payment_id = $(this).attr('payment_id');
				$.ajax({
					url: 'includes/delete.php',
					type: 'POST',
					data: {
						payment_id: payment_id
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