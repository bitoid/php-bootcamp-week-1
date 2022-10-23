<?php include 'header.php' ?>
       
        <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
            <?php 
            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case 'emtyinput':
                        echo "<p class='error'>Fill in all the fields!</p>";
                        break;
                    case 'invalidinput':
                        echo "<p class='error'>Incorrect name or email!</p>";
                        break;
                    case 'invalidfile':
                        echo "<p class='error'>Incorrect type of file!</p>";
                        break;
                    case 'largefile':
                        echo "<p class='error'>File is too large!</p>";
                        break;
                }
            }
            ?>
            <div class="input-wrapper">
                <label for="name">First Name</label>
                <input type="text" name="fname" placeholder="First Name...">
            </div>
            <div class="input-wrapper">
                <label for="name">Last Name</label>
                <input type="text" placeholder="First Name..." name="lname">
            </div>
            <div class="input-wrapper">
                <label for="name">Profile Picture</label>
                <input type="file"name='upload'>
            </div>
            <input type="submit" class="button" name="submit" value="SUBMIT">
        </form>
<?php include 'footer.php' ?>

    