<?php 
	$fname = $lname = "";
	$fnameErr = "სახელი უნდა შეიცავდეს მხოლოდ ანბანის ასოებს";
	$lnameErr = "გვარი უნდა შეიცავდეს მხოლოდ ანბანის ასოებს";
	$imageErr = "დაშვებულია მხოლოდ სურათის შემდეგი ფორმატები JPG, JPEG, PNG";
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<section class="vh-100" style="background-color: orange;">
	  <div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
		  <div class="col-12 col-md-8 col-lg-6 col-xl-5">
			<div class="card shadow-2-strong" style="border-radius: 1rem;">
			  <div class="card-body p-5 text-center">
				<h3 class="mb-5">დავალება N1</h3>
				<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
				<div class="form-outline mb-4">
				  <input type="file" name="fileToUpload" id="fileToUpload">
				</div>
				<div class="form-outline mb-4">
				  <input type="text" name="fname" class="form-control form-control-lg" placeholder="First Name" />
				</div>
				<div class="form-outline mb-4">
				  <input type="lname" name="lname" class="form-control form-control-lg" placeholder="Last Name" />
				</div>
			<input type="submit" value="დამატება" class="btn btn-primary btn-block mb-4">
			</form> 

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
		<?php if (preg_match('/[^a-zA-Zა-ჰ]/u', $_POST["fname"])): ?>
			<?php $fname = $fnameErr; ?>
		<?php else: ?>
			<?php $fname = ($_POST["fname"]); ?>
		<?php endif ?>
		<?php if (preg_match('/[^a-zA-Zა-ჰ]/u', $_POST["lname"])): ?>
			<?php $lname = $lnameErr; ?>
		<?php else: ?>
			<?php $lname = ($_POST["lname"]); ?>
		<?php endif ?>
		
<?php
$filename   = uniqid() . "-" . time(); 
$target_dir = "";
$target_file = $target_dir . $filename. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
?>

	<?php if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ): ?>
	  <div class="alert alert-danger">
		<?=$imageErr; ?>
	  </div>
	<?php $uploadOk = 0; ?>
	<?php endif ?>

	<?php if ($uploadOk == 1): ?>
		<?php if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)): ?>
			<img src="<?=$target_file; ?>" width="100px" alt=""/><br/>
			<?=$fname; ?>
			<br>
			<?=$lname; ?>
		<?php endif ?>
	<?php endif ?>
<?php endif ?>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
</body>
</html>