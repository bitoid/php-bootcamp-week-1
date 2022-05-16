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

       <?php

$fname = $lname = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (preg_match('/[^a-zA-Z]/', $_POST["fname"])) {
			$fname = "სახელი არ უნდა შეიცავდეს ციფრებს და სიმბოლოებს";
			} 
			else {
				$fname = ($_POST["fname"]);
				}
		if (preg_match('/[^a-zA-Z]/', $_POST["lname"])) {
			$lname = "სახელი არ უნდა შეიცავდეს ციფრებს და სიმბოლოებს";
			} 
			else {
				$lname = ($_POST["lname"]);
				}
				
 
 $filename   = uniqid() . "-" . time(); 
$target_dir = "";
$target_file = $target_dir . $filename. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<div class='alert alert-danger'>დაშვებულია მხოლოდ სურათის შემდეგი ფორმატები JPG, JPEG, PNG</div>";
  $uploadOk = 0;
}



  }
if ($uploadOk == 1) {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

echo '<img src="'.$target_file.'" width="100px" alt=""/><br/>';
echo $fname;
echo "<br>";
echo $lname;
  }

}
?>

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
</body>
</html>