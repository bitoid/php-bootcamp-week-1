<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">

    <title>
        First Challenge 
    </title>
    </head>
<body>

<div class = "upload-form" >
    <form action="form.php" method="POST" enctype="multipart/form-data">
        <input class = "info first-name"  type="text" name = "FirstName" placeholder="First Name"/>
        <input class = "info last-name"  type="text" name = "LastName" placeholder="Last Name"/>
        <input class = "info image"  type="file" name = "img" placeholder="Choose File"/>
        <input class = "info submite"  type="submit" name = "Submit" placeholder="Submit"/>
    </form>
</div>
 
    <?php 
    if($_POST['FirstName'] && $_POST['LastName'] ){
        print "Full Name: " .$_POST['FirstName']  . " " .   $_POST['LastName'] ;
    }

    if(isset($_POST['submit']))
    {
        $img_name = $_FILES['image']['name'];
        $tmp_img_name = $_FILES['image']['tmp_name'];
        $uploads = "uploads";
        move_uploaded_file($tmp_img_name,$uploads.$img_name);
        echo "img src = '$uploads./$img_name'/>";
    
    }
    ?> 
    
    
</body>

</html>

