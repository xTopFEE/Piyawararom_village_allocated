<?php
	//include dbConfig file  
	require_once 'dbConfig.php'; 
    $db = new mysqli('127.0.0.1', 'root', '', 'project');
	if( isset($_GET['id']) ){

		//get image id
		$img_id = $_GET['id'];

		//check if image is present
    	$img = $db->query("SELECT * FROM image WHERE id = $img_id"); 

		//no of rows
		$no_of_rows = $img->num_rows;

		if( !$no_of_rows ){
			die("Image not found!");
		}

	}//end of get check
    else{
		die("Image not found!");
	}
		

	//check if form submitted
	if(isset($_POST["submit"])){ 
		
		$error = false;
		$status = "";

		//check if file is not empty
		if(!empty($_FILES["image"]["name"])) { 

			//file info 
	        $file_name = basename($_FILES["image"]["name"]); 
	        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

	        //make an array of allowed file extension
	        $allowed_file_types = array('jpg','jpeg','png','gif');


	        //check if upload file is an image
	        if( in_array($file_type, $allowed_file_types) ){ 

            	$tmp_image = $_FILES['image']['tmp_name']; 
            	$img_content = addslashes(file_get_contents($tmp_image)); 
            	$title = $_POST['title'];


            	//Now run update query
    			$query = $db->query("UPDATE image SET image = '$img_content', title = '$title' WHERE id = $img_id");

             	//check if successfully inserted
            	if($query){ 
                	$status = "Image has been successfully updated."; 
	            }else{ 
	            	$error = true;
	                $status = "Something went wrong when updating image!!!"; 
	            }  
	        }else{ 
	        	$error = true;
	            $status = 'Only support jpg, jpeg, png, gif format'; 
	        } 

		}
	}//end of post check

	$img = $db->query("SELECT * FROM image WHERE id = $img_id"); 
    $row = $img->fetch_row();

	//image title
	$img_title = $row[2];
	
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
</head>
<body>

	<div class="container h-100 mt-5">
		
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-8 mb-4">
				<h1>Update Image</h1>	
				<?php 
					if( isset($error) ){

						if(!$error){
							echo '
							<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
		                        <strong>Well done!</strong> '.$status.'
		                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                            <span aria-hidden="true">×</span>
		                        </button>
		                    </div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
				                    <strong>Oh snap!</strong> '.$status.'
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                        <span aria-hidden="true">×</span>
				                    </button>
				                </div>';
						}
					}


				?>	
			</div>	
			<form class="col-8" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="<?php echo $img_title;?>" required>
				</div>
				<div class="form-group">
					<label for="image">Select Image</label>
					<input type="file" class="form-control-file" id="image" name="image" placeholder="select image" required>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-success">Update Image</button>
					<a href="addImage.php" class="btn btn-warning">Add New Image</a>
					<a href="viewImage.php" class="btn btn-info">View Image</a>
				</div>	
				
			</form>   
		</div>

		
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>