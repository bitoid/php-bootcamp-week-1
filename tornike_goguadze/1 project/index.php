<?php
    if (!isset($_SESSION)) {
        session_start();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
     .error {color: #FF0000;} 
    </style>
</head>
<body>
<?php 

    $fnameErr = $lnameErr = $filepathErr = "";
    $fname =  $lname = $filepath = ""; 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['postdata'] = $_POST;
        $_SESSION['file_tmp_name'] = $_FILES["myfile"]["name"];
        $_SESSION['filepath'] = "uploads/" . $_SESSION['file_tmp_name'];

        //   var_dump( $_SESSION['file_tmp_name']); 
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $_SESSION['filepath']);
        unset($_POST);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }


    if (array_key_exists('postdata', $_SESSION) || !empty($_SESSION['file_tmp_name'])) {

        if (empty($_SESSION['postdata']["fname"])) {
            $fnameErr = "Name is required";
        } elseif (!ctype_alpha($_SESSION['postdata']["fname"])) {
            $fnameErr = "Name must contain only letters";
        }

        if (empty($_SESSION['postdata']["lname"])) {
            $lnameErr = "Name is required";
        } elseif (!ctype_alpha($_SESSION['postdata']["lname"])) {
            $lnameErr = "Last name must contain only letters";
        }

        if (empty($_SESSION['file_tmp_name'])) {

            $filepathErr = "File is required";
        }  

    }

?>


    <form action="index.php" method="POST" enctype="multipart/form-data">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname">
        <span class="error">*<?php  if(isset($fnameErr)) echo $fnameErr  ?> </span>
        <br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname">
        <span class="error">* <?php  if(isset($lnameErr))  echo $lnameErr  ?> </span>
        <br><br>
        <label for="myfile">Select a file:</label>
        <input type="file" id="myfile" name="myfile">
        <span class="error">* <?php  if(isset($filepathErr))  echo $filepathErr  ?> </span>
        <br><br>
        <input type="submit" value="Submit"> 
    </form>


<?php
    if (array_key_exists('postdata', $_SESSION) || !empty($_SESSION['file_tmp_name'])) {

        if (empty($fnameErr)) {
            print "First name : ". $_SESSION['postdata']["fname"]."\r\n "   ;
        }

        if (empty($lnameErr)) {
            print "Last name : ".$_SESSION['postdata']["lname"] ;
        }

        if (!empty($_SESSION['file_tmp_name'])) {

            echo "<br><br><img src=".$_SESSION['filepath']." height=200 width=300 />";
        }

        unset($_SESSION['postdata'], $_SESSION['filepath'] ,$_SESSION['file_tmp_name'] );
    }   
?>




</body>
</html> 