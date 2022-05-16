<!doctype HTML>
<html>
    <head>
    <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <div class="formContainer">
            <?php
            
                $notSubmitedWell = true;
                

                if(isset($_FILES['pic']) && isset($_FILES['pic']['error']) && !$_FILES['pic']['error'] && $_POST['name'] && $_POST['email'] ){
                    $notSubmitedWell = false;
                }
                if($notSubmitedWell){
                echo '<form class="form" action="" method="POST" enctype="multipart/form-data">
                            <input class="forminput formitem" type="text" name="name"/><br/>
                            <input class="forminput formitem" type="email" name="email"/><br/>
                            <input class="forminput formitem" type="hidden" name="MAX_FILE_SIZE" value="300000" />
                            <input class="forminput formitem" type="file" name="pic"/><br>
                            <input class="formbutton formitem" type="submit" name="submit" value="Upload">
                        </form>';
                
                }

            ?>
        </div>
        
        <?php
            //variable list used in file:
            //$name - contains name from form input
            //$email - contains name from form input
            //$error_list - array containing error strings. If there is no error it is empty array.
            require_once("upload.php");
            //handling post request after submited form
            if(isset($_POST['submit'])){
                if(!$error_list){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    move_uploaded_file($_FILES['pic']["tmp_name"], "uploads/".$_FILES["pic"]["name"]);
                }
            }
        ?>
        <?php 
            if($notSubmitedWell){
                echo '<ul class="errorList">';
                            foreach($error_list as $key => $value) {
                                echo '<li class="listItem">'.$value.'</li>';
                            }
                echo '</ul>';
                unset($value);
            }
        ?>
        
        <?php 
                //var_dump('<img src= "uploads/"'.$_FILES["pic"]["name"].'/>');   
            if(!$notSubmitedWell){
                echo '<div class="card">';
                echo '<img class="cardImg" src=uploads/'.$_FILES["pic"]["name"].'/>';
                echo '<div class="cardInfo">';
                echo '<h4>Hi <p>'.$name.'</p></h4>';
                echo '<h4>Your email is <p>'.$email.'</p></h4>';
                echo '</div>';
                echo '</div>';
            }
        ?>
    </body>
</html>