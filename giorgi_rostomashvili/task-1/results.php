<?php 
	$username = $_POST['user_name'];

	$password = $_POST['user_password'];

	if(empty($username)) {
		$name_error= 'please insert your username';
	}

	if(!ctype_alpha($username)) {
		$name_error= 'please use only letters';
	}


	if(empty($password)) {
		$password_error= 'please insert your password';
	}

	$target_dir = "assets\profile_imgs\\";
	$target_file = $target_dir . basename($_FILES["user_picture"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["user_picture"]["tmp_name"]);
	if($check !== false) {
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	} else {
	  if (move_uploaded_file($_FILES["user_picture"]["tmp_name"], $target_file)) {
	      $imageName=basename( $_FILES["user_picture"]["name"]);
	  } else {
	    echo "Sorry, there was an error uploading your file.";
	  }
	}
	include('index.php');
?>

