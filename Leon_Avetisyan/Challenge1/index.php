<?php
    // Connect validate.php file 
    include('validate.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitCamp Challenge1</title>
    <link rel='stylesheet' href='css/main.css' />
</head>

<body>
    <!-- The block where profile data and greeting will be shown  -->
    <div class="profile">
        
        <?php
            // Here we check whether all profile datas is inputted or not 
            // If all profile datas correctly filled then hide form block 
            if(isset($_POST['submit']) && !$firstNameErr && !$lastNameErr && ($_FILES['profImg']['error'] == 0)) {
                $display = 'display: none';
        ?>
            <!-- After hiding form block we display profile data and greeting on the page  -->
            <h1>Welcome, <?php echo "$firstName $lastName"?></h1>
            <img src="images/<?php echo $image; ?>" alt="Profile image">
            <p>First name: <span><?php echo $firstName; ?></span></p>
            <p>Last name: <span><?php echo $lastName; ?></span></p>

        <?php
            // If profile datas are incorrect or aren't inputted yet then display default image and 
            // simple initial text
            }else {
        ?>

            <img src="images/default.png" alt="Default image">
            <p>First name: </p>
            <p>Last name: </p>

        <?php       
            }
        ?>
        
        
    </div>
                <!-- Here is form block  -->
    <div class="profileForm" style="<?php echo $display;?>">
        <h2>Hi, please fill in your profile data</h2>
        <form action="" method="post" enctype='multipart/form-data' >
            <!-- It's first name input field section  -->
            <div class="input-group firstName">
                <label for="">First name:</label>
                <!-- Here we check first name field, if submit button is clicked and error text exists, 
                    then style input field with red border  -->
                <input style="<?php if (!empty($_POST) && $firstNameErr) echo $style; ?>" 
                    type="text" 
                    name="firstName" 
                    placeholder="Please enter your first name"
                    value="<?php echo $firstName;?>"
                ><br/>
                <!-- If error text exists then we display error message  -->
                <span><?php echo $firstNameErr; ?></span>
            </div>
            <div class="input-group lastName">
                <label for="">Last name:</label>
                <!-- Here we check last name field, if submit button is clicked and error text exists, 
                    then style input field with red border  -->
                <input style="<?php if (!empty($_POST) && $lastNameErr) echo $style; ?>" 
                    type="text" 
                    name="lastName" 
                    placeholder="Please enter your last name"
                    value="<?php echo $lastName;?>"
                ><br/>
                <!-- If error text exists then we display error message  -->
                <span><?php echo $lastNameErr; ?></span>
            </div>
            <div class="input-group">
                <!-- Here is image button with custom styles  -->
                <label for="profImg" class='upload'>
                    
                    <input type="file" name="profImg" id="profImg" accept="image/png, image/jpeg, image/svg">
                    Choose a file
                </label>
                <!-- Here we add image name into span with id - profImgName, using JS script  -->
                <span id='profImgName'></span>
                <br/>
                <!-- If error text exists then we display error message  -->
                <span><?php echo $fileErr; ?></span>
            </div>

            <button name='submit' type="submit">Submit</button>
        </form>
    </div>
    <!-- Here we add JS script  -->
    <script src="js/script.js"></script>
</body>

</html>