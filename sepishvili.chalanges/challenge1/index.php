
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section id="form-section">
    <form action= "" method="POST" enctype="multipart/form-data">
            <input class="name_class" type="text" name="FirstName"  placeholder="First name"  />
            <input class="name_class" type="text" name="lastName"  placeholder="Last name"  />
            <input type="file" name="file" id="image-upload" accept=".jpg, .jpeg,.png"  />
            <button type="submit" name="submit" value="upload">submit</button>
        </form>
    </section>
    <section id="php_section">
            <?php
            if (isset ($_POST['submit']) && isset($_FILES["file"]) && isset($_POST['FirstName']) && isset($_POST['lastName'])) { 
                $filename=$_FILES['file']["name"];
                $tempname=$_FILES['file']["tmp_name"];
                $firstname=$_POST['FirstName'];
                $lastname=$_POST['lastName'];

                
                if(strlen($filename)>0 && strlen($firstname)>0 && strlen($lastname)>0){
                    if(!is_dir("img")){
                        mkdir("img");
                    }

                    $folder="img/".$filename;
                    move_uploaded_file($tempname, $folder);
                  
                    if(ctype_alpha($firstname. $lastname)){
                        echo "<p id='initials'>" . $firstname . ' ' . $lastname . "</p>"; 
        
                        echo "<img id='img' src='img/".$filename."'>";
                    }else{  
                        echo "<p class='error_msg'> wrong format, use  A-Z for first and last name </p>";
                    }  
                }else{
                    echo "<p class='error_msg'> wrong format, empty field error </p>";
                }
            }else{
                echo "<p class='error_msg'> please input first, last name and image </p>";
            } 

    ?>
 </section>

</body>
</html>

