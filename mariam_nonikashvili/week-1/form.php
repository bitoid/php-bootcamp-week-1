<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Challenge #1</title>
</head>
<body>
    <?php 
        $firstName="";
        $lastName="";
        $image="";
        $fnEr = "";
        $lnEr = "";
        $imgEr="";
        $borderEr="border border-danger";
    ?>  
    <section class="bg-dark bg-gradient vh-100 wh-100 text-center d-flex justify-content-center">
        <section class="align-self-center bg-light bg-gradient p-5">
            <h1>Challenge #1</h1>
  
                <?php
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];

                        if (empty($firstName)) {
                            echo "FirstName is empty";              
                        }elseif(!ctype_alpha($firstName)){
                            $fnEr = "FirstName not contain only alphabet characters"; 
                        }
                        else{
                            ?>
                        
                            <?php
                        }

                        if (empty($lastName)) {
                            echo "LastName is empty";
                        }elseif(!ctype_alpha($lastName)){
                            $lnEr = "LastName not contain only alphabet characters";
                        }else{
                            ?>
                     
                            <?php
                        }
             
                    // echo "Filename: " . $_FILES['file']['name']."<br>";
                    // echo "Type : " . $_FILES['file']['type'] ."<br>";
                    // echo "Size : " . $_FILES['file']['size'] ."<br>";
                    // echo "Temp name: " . $_FILES['file']['tmp_name'] ."<br>";
                    // echo "Error : " . $_FILES['file']['error'] . "<br>";

                        $filename = $_FILES["file"]["name"];
                        $tempname = $_FILES["file"]["tmp_name"];
                        $folder = "image/".$filename;
                        // echo $filename.'<br>';
                        // echo $tempname.'<br>';

                        if(move_uploaded_file($tempname, $folder)) 
                        {
                        $image = "<img src=".$folder." height=200 width=300 />";
                        } 
                        else 
                        {
                        $imgEr = "Image not uploaded";
                        }
                    
                    }  
                ?>
        
            <div class="form">
                <form action="form.php" method="post" enctype="multipart/form-data">
                    <div class="mt-3">
                        <input class="form-control <?php echo $fnEr ? $borderEr :'' ?>" type="text" name="firstName" placeholder="firstName" value="<?php echo $fnEr ? $firstName :'' ?>" required>
                        <span class="text-danger"><?php echo $fnEr?></span>
                
                    </div>
                    <div class="mt-3">
                        <input class="form-control <?php echo $lnEr ? $borderEr :'' ?>" type="text" name="lastName" placeholder="lastName" value="<?php echo $lnEr ? $lastName :'' ?>" required>
                        <span class="text-danger"><?php echo $lnEr?></span>
                    </div>
                    <div class="mt-3">
                        <input class="form-control <?php echo $imgEr ? $borderEr :'' ?>" type="file" name="file" required>
                        <span class="text-danger"><?php echo $imgEr?></span>
                    </div>
                    <div class="mt-3">
                        <input class="btn btn-primary" type="submit" value="submit" name="submit">
                    </div>
                    
                </form>
            </div>
            

            <?php 
                if(isset($_POST['submit']) && $fnEr==="" && $lnEr==="" && $imgEr===""){
                    ?>
                        <div class="info">
                            <h3><?php echo $firstName?></h3>
                            <h3><?php echo $lastName?></h3>
                            <?php echo $image;?>
                        </div>
                      
                    <?php
                    
                    
                   
                }
               
            ?>
           
            
        </section>
        
    </section>

</body>
</html>