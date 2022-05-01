<?php require_once "class.php";
session_start();

$user = new user;

$page = 0;
$house_id =0;
$enter_year = 2564;
if (!empty($_SESSION['page'])) {
	$page = $_SESSION['page'];
}
$first_houseid = 0;
$last_houseid = 0;
if (!empty($_SESSION['enter_year'])) {
	$enter_year = $_SESSION['enter_year'];
}

if (!empty($_SESSION['first_houseid']) ) {
	(string)$first_houseid = $_SESSION['first_houseid'];
}
if(!empty($_SESSION['last_houseid'])){
	(string)$last_houseid = $_SESSION['last_houseid'];
}
echo "<script>console.log($page);</script>";
//echo "<script>console.log($enter_year);</script>";

echo $user->load($page, $enter_year,$first_houseid,$last_houseid);
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