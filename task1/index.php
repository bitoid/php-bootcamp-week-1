


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Link to local CSS -->
    <link href="app.css" rel="stylesheet" />

    <title>Document</title>

</head>
<body>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <div class="inputs">
            <div class="row justify-content-center">
                <div class="form-group">
                    <label>First name</label>
                    <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name">
                </div>
                <div class="form-group">
                    <br>
                    <label>Last name</label>
                    <input type="text" name="lname" class="form-control" placeholder="Enter Your Last Name">
                </div>
                <div class="form-group">
                    <br>
                    <label>Select image:</label>
                    <input type="file" name="file" id="fileToUpload">
                </div>
                <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-success" name="save">Save</button>
                </div>
            </div>
        </div>
    </form>
    <div class="users">
    <?php
                if(isset($_POST['save'])){
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $tempname = $_FILES["file"]["name"];
                    $tempfile = $_FILES["file"]["tmp_name"];
                    $folder = "uploads/".$tempname;
                    move_uploaded_file($tempfile, $folder);
                    if(empty($fname) || empty($lname)){
                        echo "Fill Input";
                        
                    }else{
                        if (ctype_alpha($fname) && ctype_alpha($lname)){
                            if($tempname == ''){
                                echo "Upload Image";
                            }else{
                                echo "$fname  $lname" ."<br>";
                                echo "<img src=$folder width='250px' heigth='100px'>";
                            }
                        } else {
                            echo "Input Only Letters";
                        }
                    }
                    
                    
                }
            ?>
    </div>
    
</body>
</html>


