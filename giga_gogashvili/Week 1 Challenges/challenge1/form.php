<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="Dummy form">
        <meta name="author" content="Giga Gogashvili">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
            <form enctype="multipart/form-data" action="/challenge1/form.php" method="POST">
                <input type="text" placeholder="Your Name" name="firstName"/>
                <input type="text" placeholder="Your Lastname" name="lastName"/>
                <input type="file" name="image"/>
                <button type="submit" name="submit">Submit</button>
            </form>

            <?php

            if(isset($_POST["submit"])){
                if($_POST["firstName"] && $_POST["lastName"] && $_FILES["image"]){
                    $firstName = $_POST["firstName"];
                    $lastName = $_POST["lastName"];
                    $regPattern = "/^[a-zA-Z]+$/";
                    $imageName = $_FILES["image"]["name"];
                    $imageTmpName = $_FILES['image']['tmp_name'];
                    $imageDestination = "uploads/".$imageName;

                    if (!preg_match($regPattern, $firstName) && !preg_match($regPattern, $lastName)) {
                        print "<p class='error_message'>Firstname and Lastname should 
                                only include a alphabetical characters.</p>";
                    }else{
                        move_uploaded_file($imageTmpName, $imageDestination);
                        $htmlContent = <<<CON
        
                        <div class='mainContent'>
                            <p>Your Name is: <span>$firstName</span></p>
                            <p>Your Surname is: <span>$lastName</span></p>
                            <p class='picture'>Your Picture is: <img src="$imageDestination" width="300px"/></p>
                        </div>
                        CON;
                        echo $htmlContent;
                    }
                }
            }
            ?>
        </main>

    </body>
</html>