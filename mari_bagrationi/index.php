<html>
    <head>
        
    </head>
        
    <body>
    <form action= "" method = "post" enctype = "multipart/form-data">

        <input type="text" name="firstName">
        <input type="text" name="surname">
        <input type="file" name="photo">
        <input type="submit" name="upload">

    </form>

        

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = false;


        $name = $_POST['firstName'];
        $surname = $_POST['surname'];

        if (!ctype_alpha($name)) {
            echo "your name includes invalid characters";
            $error = true;
        } 
        if (!ctype_alpha($surname)) {
            echo "your surname includes invalid characters";
            $error = true;
        } 
        


        $fileName =$_FILES['photo'] ['name'];
        $fileTmpName =$_FILES['photo'] ['tmp_name'];
        $fileSize =$_FILES['photo'] ['size'];
        $fileError =$_FILES['photo'] ['error'];
        $fileType =$_FILES['photo'] ['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg', 'png');

        $fileDestination = '';

        if (in_array($fileActualExt, $allowed)){

            if ($fileError ===0){
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true). ".".$fileActualExt;
                    $fileDestination = 'profile/'. $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);                }
                
                    
                } else {
                    echo "Your file is too big";
                    $error = true;
                }

            } else {
                echo "There was an error uploading your file!";
                $error = true;
            }
        } else{
            echo "you cannot upload files of thos type!";
            $error = true;
        
    }

        

    if ($error == false) { 

        echo $name. ' ';
        echo $surname.'<br>';

    }


    
    

    ?>

    <img src=" <?php 
        if ($error == false) { 
            echo $fileDestination;
        }  
    ?>" >

    


    </body>


</html>