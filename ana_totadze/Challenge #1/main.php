<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./demo.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Radio+Canada:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <title>File Upload</title>
</head>
<body>
	<div class="form-container">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            Your Name:
            <input type="text" name="name">
            <br>
            Your Last Name:
            <input type="text" name="last-name">
            <br>
            Please, upload your photo here:
			<input type="file" name="file">
			<input type="submit" name="submit">
        </form>
    </div>
</body>
</html>