<?php require_once "class.php";
// session_start();

if (isset($_POST['q'])) {
	$q = $_POST['q'];
	// $q = "%" . $q . "%";
	$usr = new user;
	$data = $usr->search($q);
	echo $data;
}
?>
<script type="text/javascript">
	function get_edit_id() {
		let url = new URLSearchParams(window.location.search);
		let admin_id = url.get('admin_id');
		admin_id = parseInt(admin_id);
		return admin_id;
	}

	function get_rows() {
		let admin_id = get_edit_id();
		$.get(
			"includes/get.php", {
				admin_id: admin_id
			},
			function(data) {
				data = JSON.parse(data);
				$("#upd_username").val(data.username);
				$("#upd_fullname").val(data.fullname);
				$("#upd_password").val(data.password);
				console.log(data);
			});
	}
	if (get_edit_id()) {
		get_rows();
	}
	$("#editForm").submit(function(e) {


		Swal.fire({
			title: 'ต้องการที่จะแก้ไขข้อมูล?',
			showCancelButton: true,
			confirmButtonText: 'แก้ไขข้อมูล',
			denyButtonText: 'ยกเลิก',
		}).then((result) => {

			if (result.isConfirmed) {
				Swal.fire('ลบข้อมูลแล้ว!', '', 'success')
				
				e.preventDefault();
				let admin_id = get_edit_id();
				$.ajax({
						type: "POST",
						url: "includes/update.php",
						data: {
							admin_id: admin_id,
							username: $('#upd_username').val(),
							fullname: $('#upd_fullname').val(),
							password: $('#upd_password').val()
						},
					})
					.done(function(data) {
						$("#upd_username").val('');
						$("#upd_fullname").val('');
						$("#upd_password").val('');
						$("#table").load("includes/load.php");
						$("#msgEdit").html("<p class='text-center alert alert-success'>" + data + "</p>");
						$("#msgEdit").slideDown(1400);
					});
				//
			} else if (result.isDenied) {
				Swal.fire('Changes are not saved', '', 'info')
			}
		})

	});
	$('.del').click(function() {

		Swal.fire({
			title: 'ต้องการที่จะลบข้อมูล?',
			showCancelButton: true,
			confirmButtonText: 'ลบข้อมูล',
			denyButtonText: `ยกเลิก`,
		}).then((result) => {

			if (result.isConfirmed) {
				Swal.fire('Deleted!', '', 'success')
				//
				var admin_id = $(this).attr('admin_id');
				$.ajax({
					url: 'includes/delete.php',
					type: 'POST',
					data: {
						admin_id: admin_id
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