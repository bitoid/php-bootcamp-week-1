<!DOCTYPE html>
<html>
    <head>
    <title>first task</title>
    <link rel="stylesheet" href="styles.css">
    </head>

        <div>
            <h3>Enter your full name and upload picture</h3>
            <form action="/index.php" method="POST" enctype="multipart/form-data">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fist_name" placeholder="first name" required>
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="last_name" placeholder="last name" required>
                <label for="picture">Choose Piture</label>
                <input type="file" id="picture" name="file" required>
                <input type="submit" value="Submit" name="submited">
            </form>
        </div>

        <?php
        
            $name = $_POST['fist_name'] . $_POST['last_name'];
            $print_name = $_POST['fist_name'] . " " . $_POST['last_name'];
            
            function check_name($val){
                    
                if (ctype_alpha($val) ){
                    return true;
                }
                return false;

            } 

            $checked = check_name($name);
            $img_set = isset($_POST['submited']);

            if($checked && $img_set)
            {
                if(!is_dir("images")){
                    mkdir("images");
                }
                
                $filepath = "images/" . $_FILES["file"]["name"];
                    
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) 
                    {
                        echo " <div> <img src=".$filepath."/> </div>"; 
                        echo "<p class =\"name\"> $print_name </p>"; 
                    } 
                else 
                    {
                        echo "<p class=\"error\"> Error ! Upload picture</p>";
                    
                }
                    
            }else if($_POST['fist_name'] && !$checked){
                echo "<p class=\"error\">Error ! Use only alphabetic characters</p>";
            }

        ?>
</html>