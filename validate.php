
<style>
  .img{
    width:200px;
    height:200px;
    display:block;
  }
</style>

<?php

    if($_SERVER('REQUEST_METHOD') == 'POST'){
      if(!ctype_alpha($_POST['firstname'])){
        echo "it is an invalid name!";
      }
      if(!ctype_alpha($_POST['lastname'])){
        echo "it is an invalid lastname!";
      }
    }
?>
<?php
  if(isset($_POST['submit'])){
    echo $_POST ['firstname'] . "\n";
    echo $_POST ['lastname'];

    $file = $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];

    //seperate the file name and the dot after it
    $fileExt = explode('.', $fileName);

    //make the second data lowercase after seperating the file name and the dot
    $fileActualExt = strtolower(end($fileExt));

    //only allow jpg jpeg png pdf 
     $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'svg', 'raw', 'tif', 'tiff', 'eps');

    //let's check if user has a allowing image

    if(in_array($fileActualExt, $allowed)){
      //let's check if we had an error inside the file info
      if($fileError === 0){
        //let's check for file size
        if($fileSize < 1000000){
          //let's make the image's name an unique and then add the type
          // $fileNameNew = uniqid('', true).".".$fileActualExt;
          //let's make the file destination
          $fileDestination = 'uploads/'.$fileName;
          move_uploaded_file($fileTmpName, $fileDestination);
          echo "<img class='img' src='uploads/".$fileName."'>";
        }else{
          echo "your file is too big";
        }
      }else{
        echo "It's an error";
      }
    }else{
      echo "You cannot upload files of this type!";
    }

  }
?>

