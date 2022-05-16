<!Doctype html>
<html>
    <head>
        <title>Profile</title>
        <link rel='stylesheet' href='styles/style.css'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch&display=swap" rel="stylesheet">
    </head>
    <body>
        <form action='index.php' method='post' enctype="multipart/form-data">
            <div class='inputs'>
                <label for='firstName'>First Name:</label>
                <input id='firstName' type='text' name='firstName' placeholder='Enter First Name'>
            </div>
            <div class='inputs'>
                <label for='lastName'>Last Name:</label>
                <input id='lastName' type='text' name='lastName' placeholder='Enter Last Name'>
            </div>
            <div class='inputs'>
                <label for="image">Upload Image</label>
                <input id='image' type='file' name='img' accept='image/*'>
            </div>  
            <input id='submit' type='submit' value='submit'>
        </form>
        <hr>
        <?php 
            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                $first_name = $_POST['firstName'];
                $last_name = $_POST['lastName'];
                if (preg_match("/^[A-Za-z]+$/", $first_name) && preg_match("/^[A-Za-z]+$/", $last_name) 
                    && move_uploaded_file($_FILES["img"]["tmp_name"], "images/img")){
                        echo "
                        <div class='output'>
                        <p>$first_name $last_name</p>
                        <img src='images/img'>
                        </div>";
                }
                else{
                    echo "<p class='error'>first name and last name must contain a-z characters!</p>";
                }
            }
        ?>
    </body>
</html>