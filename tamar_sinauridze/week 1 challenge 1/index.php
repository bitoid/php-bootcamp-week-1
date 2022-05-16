<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <?php
            
            $uploadOk = 0;

            if(isset($_POST["submit"])) {

                $uploadOk = 1;

                // validates first name
                if(empty($_POST["first_name"])) {
                    $uploadOk = 0;
                    echo '<p class="errmsg">First name required</p>';
                } else {
                    if (!preg_match("/^[a-zA-Z]*$/",$_POST["first_name"])) {
                        echo '<p class="errmsg">Only English letters allowed</p>';
                        $uploadOk = 0;
                    } else {
                        $_POST["first_name"] = test_input($_POST["first_name"]);
                    }
                }

                // validates last name
                if(empty($_POST["last_name"])) {
                    $uploadOk = 0;
                    echo '<p class="errmsg">Last name required</p>';
                } else {
                    if (!preg_match("/^[a-zA-Z]*$/",$_POST["last_name"])) {
                        echo '<p class="errmsg">Only English letters allowed</p>';
                        $uploadOk = 0;
                    } else {
                        $_POST["last_name"] = test_input($_POST["last_name"]);
                    }
                }

                // validates picture
                if(empty($_FILES["userpic"]["name"])) {
                    echo '<p class="errmsg">Picture required</p>';
                    $uploadOk = 0;
                } else {
                    $check = getimagesize($_FILES["userpic"]["tmp_name"]);

                    // creates uploads folder if it doesn't exist
                    if (!is_dir("uploads")) {
                        $oldmask = umask(0);
                        mkdir("uploads", 0777);
                        umask($oldmask);
                    }

                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["userpic"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    if($check ===false){
                        echo '<p class="errmsg">File is not an image</p>';
                        $uploadOk = 0;
                    } else {
                        if ($_FILES["userpic"]["size"] > 5242880) {
                            echo '<p class="errmsg">File is too large</p>';
                            $uploadOk = 0;
                        }
                        if($imageFileType !="jpg" && $imageFileType !="png" && $imageFileType !="jpeg" && $imageFileType !="gif"){
                            echo '<p class="errmsg">Only JPG, JPEG, PNG & GIF files are allowed</p>';
                            $uploadOk = 0;
                        }
                    }
                }

                // if form successfully uploaded displays submitted data
                if($uploadOk==0){
                    echo '<p class="errmsg">Form was not uploaded</p>';
                } else {
                    if(move_uploaded_file($_FILES["userpic"]["tmp_name"], $target_file)) {
                        echo '<p>Successfully submitted:</p><p>Name:</p><h2>' . $_POST["first_name"] . ' ' . $_POST["last_name"] . '</h2><p>Picture:</p>';
                        echo '<img src="' . $target_file . '" alt="User image"';
                    } else {
                        echo '<p class="errmsg">There was an error uploading your file</p>';
                    }
                }
            }

            // displays form if it's not submitted successfully
            if($uploadOk==0) {
                echo <<<TEXT
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <label for="first-name">First name:</label>
                    <input type="text" id="first-name" name="first_name" placeholder="Enter your first name"
                    pattern="[a-zA-Z]{1,}" title="English letters only" required>
                    <label for="last-name">Last name:</label>
                    <input type="text" id="last-name" name="last_name" placeholder="Enter your last name"
                    pattern="[a-zA-Z]{1,}" title="English letters only" required>
                    <label for="picture">Picture:</label>
                    <input type="file" id="picture" name="userpic" title="Upload JPG, JPEG, PNG or GIF file. Up to 5MB" required>
                    <input type="submit" name="submit">
                </form>
                TEXT;
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
        </div>
    </body>
</html>
