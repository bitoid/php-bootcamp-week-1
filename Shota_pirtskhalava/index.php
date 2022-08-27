<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./style.css" type="text/css">
<body>
    <?php
    include "display.php";
    ?>
    <?php if(empty($_POST) || !empty($nameErr) || !empty($lastnameErr) ||!empty($errorFile)): ?>
    
     
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="firstname" class="feedback-input" placeholder="First Name" >
            <span><?= $nameErr ?></span>
            <br>

            <input type="text" name="lastname" class="feedback-input" placeholder="Last Name">
            <span><?= $lastnameErr ?></span>
            <br>
            <form action="upload.php" enctype="multipart/form-data" method="post">
            <input type="file" name="profileimage"  class="feedback-input">
            <span><?= $errorFile ?></span>
            <button type="submit" name="submit">submit

            </button>
        

        

        


</form>



    



<?php  
else:
?>


<div>
    <img src="<?php print "uploads/" .  $porfile_image;  ?>">
    <ul class="list">
        <li class= "list"><?= $name ?></li>
        <li class="list"><?= $lastname ?></li>
        
    </ul>
</div>

<?php endif; ?>


    
</body>
</html>