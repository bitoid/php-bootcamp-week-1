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
                <input type="text" id="fname" name="fistName" placeholder="first name">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lastName" placeholder="last name">
                <label for="picture">Choose Piture</label>
                <input type="file" id="picture" name="file">
                <input type="submit" value="Submit" name="Submited">
            </form>
        </div>

        <?php
        
            $name = $_POST['fistName'] . $_POST['lastName'];
            $printName = $_POST['fistName'] . " " . $_POST['lastName'];
            
            function checkName($val){
                    
                if (ctype_alpha($val) ){
                    return true;
                }
                return false;

            } 

            $checked = checkName($name);
            $imgSet = isset($_POST['Submited']);

            if($_POST['fistName'] && $_POST['lastName'] && $checked && $imgSet){
                
                $filepath = $_FILES["file"]["name"];
                    
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) 
                    {
                        echo " <div> <img src=".$filepath."/> </div>"; 
                        echo "<p class =\"name\"> $printName </p>"; 
                    } 
                else 
                    {
                        echo "<p class=\"error\"> Error ! Upload picture</p>";
                    
                    }
                    
            }elseif ($_POST['lastName'] && $checked){
                print " <p class=\"error\"> Error! Enter fist name</p>";

            }elseif ($_POST['fistName'] && $checked){
                print "<p class=\"error\">Error ! Enter last name</p>";
            }elseif($_POST['fistName'] && $_POST['lastName'] && !$checked ){
                print "<p class=\"error\">Error ! Use only alphabetic characters</p>";
            }else{
                echo "<p>Enter First Name and Last Name</p>";
            }

        ?>
</html>