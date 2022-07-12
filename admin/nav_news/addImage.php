<?php
	//include dbConfig file  
	require_once 'dbConfig.php'; 
    $db = new mysqli('127.0.0.1', 'root', '', 'project');
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
                //global $db;
            	//Now run insert query
            	$query = $db->query("INSERT into image (image, title) VALUES ('$img_content', '$title')"); 

             
             	//check if successfully inserted
            	if($query){ 
                	$status = "Image has been successfully uploaded."; 
	            }else{ 
	            	$error = true;
	                $status = "Something went wrong when uploading image!!!"; 
	            }  
	        }else{ 
	        	$error = true;
	            $status = 'Only support jpg, jpeg, png, gif format'; 
	        } 

		}

	}
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
				<h1>Upload Image</h1>	
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
			<form class="col-8" method="post" action="addImage.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
				</div>
				<div class="form-group">
					<label for="image">Select Image</label>
					<input type="file" class="form-control-file" id="image" name="image" placeholder="select image" required>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-success">Add Image</button>
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