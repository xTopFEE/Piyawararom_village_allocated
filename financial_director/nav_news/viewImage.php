<?php
	//include dbConfig file  
	require_once 'dbConfig.php'; 
$db = new mysqli('127.0.0.1', 'root', '', 'project');
	//get all images
	$images = $db->query("SELECT * FROM image ORDER BY uploaded DESC"); 
	
	//no of rows
	$no_of_rows = $images->num_rows;

	
?>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<title>Store, retrieve, and update image from database in PHP</title>
<style type="text/css">
	.img-200{
		width: 200px;
		height: 100px;
	}
</style>
</head>
<body>

	<div class="container h-100 mt-5">
		
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-10 mb-4">
				<h1>View Image</h1>	
			</div>	
			<div class="col-10 m-auto">
				<table class="table table-striped table-border text-center">
					<thead>
						<th>#</th>
						<th>Image</th>
						<th>Title</th>
						<th>Uploaded</th>
						<th>Option</th>
					</thead>
					<tbody>
					<?php
						//check if image present
						if( $no_of_rows > 0 ){
							
							//counter
							$i = 1;

							while( $img = $images->fetch_object() ){
								
								$img_file = base64_encode( $img->image );

							?>
							
							<tr>
								<td><?php echo $i;?></td>
								<td>
									<img class="img-200 img-thumbnail" src="data:image/jpg;charset=utf8;base64,<?php echo $img_file; ?>" />
								</td>
								<td><?php echo $img->title;?></td>
								<td><?php echo date( 'm/d/y', strtotime($img->uploaded));?></td>
								<td>
									<a class="btn btn-sm btn-success" href="<?php echo 'editImage.php?id='.$img->id?>">edit</a>
									<a class="btn btn-sm btn-danger" href="<?php echo 'delImg.php?id='.$img->id?>">del</a>
								</td>
							</tr>
							
							<?php
							$i++;
							}
							
						}

					?>
					</tbody>
				</table>
			</div>
		</div>

		
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>