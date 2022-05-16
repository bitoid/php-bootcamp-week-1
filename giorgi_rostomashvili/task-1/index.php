<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Week 1 Task 1 </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="img_container">
				<?php  if(isset($imageName)) { ?>
					<div style="background: url(assets/profile_imgs/<?php echo $imageName ?>); background-position: center; background-size: cover;"> </div> 
					<?php echo date("Y-m-d h:i:sa") ?>
				<?php } ?>		
			</div>
		</div>
		<form action="results.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="user_picture"> <br>
			<input type="text" placeholder="username" name="user_name" value="<?php echo htmlspecialchars($username) ?>"> <br> 
				<?php  if(isset($name_error)) { ?>
					<p> <?php echo $name_error ?> </p>
				<?php } ?>			
			<input type="password" placeholder="password" name="user_password"> <br>
				<?php  if(isset($password_error)) { ?>
					<p> <?php echo $password_error ?> </p>
				<?php } ?>	
			<input class="register_button" type="submit" value="REGISTER">	
		</form>
	</div>
</body>
</html>